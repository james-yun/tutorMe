<?php
  session_start();
  require 'connectdb.php';
  if (!isset($_SESSION['student_id'])) {
    header("location: homepage.php");
    exit;
  }
  $student_id = $_SESSION['student_id'];
  $query = "SELECT first_name, last_name, phone_number, venmo_id FROM student WHERE student_id = '$student_id'";
  $statement = $db->prepare($query);
  $statement->execute();
  $result = $statement->fetch();
  $first_name = $result['first_name'];
  $last_name = $result['last_name'];
  $phone_number = $result['phone_number'];
  $venmo_id = $result['venmo_id'];

  $query = "SELECT student_id, isPaid FROM tutor WHERE student_id = '$student_id'";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();
  if (count($results) == 0) {
      $isTutor = false;
      $isPaid = false;
  } else {
      $isTutor = true;
      $result = $results[0];
      $isPaid = $result['isPaid'];
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['firstName'])){
            $first_name = $_POST['firstName'];
            $last_name = $_POST['lastName'];
            $phone_number = $_POST['phoneNumber'];
            $venmo_id = $_POST['venmoID'];
            $query = "UPDATE student SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number', venmo_id='$venmo_id' WHERE student_id = '$student_id'";
            $statement = $db->prepare($query);
            if ($statement->execute()) {
                $success = "Successfully updated info";
            } else {
                $error = "Failed to update info";
            }
            $isTutorNew = isset($_POST['isTutor']);
            $isPaidNew = isset($_POST['isPaid']);
            if (!$isTutor and $isTutorNew) {
                $query = "INSERT INTO tutor (student_id, isPaid) VALUES ('$student_id', $isPaidNew)";
                $statement = $db->prepare($query);
                $statement->execute();
            } elseif ($isTutor and $isPaid != $isPaidNew) {
                $query = "UPDATE tutor SET isPaid='$isPaidNew' WHERE student_id='$student_id'";
                $statement = $db->prepare($query);
                $statement->execute();
            } elseif ($isTutor and !$isTutorNew) {
                $query = "DELETE FROM tutor WHERE student_id='$student_id'";
                $statement = $db->prepare($query);
                $statement->execute();
                $isPaidNew = false;
            }
            $isTutor = $isTutorNew;
            $isPaid = $isPaidNew;
            echo $isPaid;
      } elseif (isset($_POST['oldPassword'])) {
            $old_password = $_POST['oldPassword'];
            $query = "SELECT hash FROM student WHERE student_id = '$student_id'";
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $hash = $result['hash'];
            $new_password = $_POST['newPassword'];
            if (password_verify($old_password, $hash)) {
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE student SET hash='$hash' WHERE student_id = '$student_id'";
                $statement = $db->prepare($query);
                if ($statement->execute()) {
                  $pwSuccess = "Successfully updated password";
                } else {
                  $pwError = "Failed to update password";
                }
            } else {
                $pwError = "Incorrect old password";
            }
      }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="static/style.css">
    <title>Profile</title>
  </head>
  <body>
    <?php include 'navbar.php' ?>
    <div class="container" style="padding-bottom: 80px">
      <p class="font-weight-bold mt-5">Edit personal information</p>
      <form method="post" action="profile.php">
        <div class="form-group">
          <label for="computingID">Computing ID</label>
          <input type="text" class="form-control" id="computingID" value="<?php echo $student_id ?>" readonly>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstName">Update first name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $first_name ?>" maxlength="20" required>
          </div>
          <div class="form-group col-md-6">
            <label for="lastName">Update last name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $last_name ?>" maxlength="20" required>
          </div>
        </div>
        <div class="form-group">
          <label for="phoneNumber">Update phone number</label>
          <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $phone_number ?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
        </div>
        <div class="form-group">
          <label for="venmoID">Update Venmo ID</label>
          <input type="text" class="form-control" id="venmoID" name="venmoID" value="<?php echo $venmo_id ?>" maxlength="20" required>
        </div>
        <?php if (isset($success)): ?>
        <div class="valid-feedback" style="display: block">
          <?php echo $success; ?>
        </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="invalid-feedback" style="display: block">
              <?php echo $error; ?>
            </div>
        <?php endif; ?>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" name="isTutor" id="isTutor" <?php if ($isTutor) echo "checked"?>>
              <label class="form-check-label" for="isTutor">
                  Are you a tutor?
              </label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" name="isPaid" id="isPaid" <?php if (!$isTutor) echo " disabled"; if ($isPaid) echo " checked" ?>>
              <label class="form-check-label" for="isPaid">
                  Do you get paid?
              </label>
          </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
      </form>

      <p class="font-weight-bold mt-5">Change password</p>
      <form method="post" action="profile.php">
        <label for="oldPassword">Old password</label>
        <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
        <label for="newPassword">New password</label>
        <input type="password" class="form-control" id="newPassword" name="newPassword" minlength="4" maxlength="20" required>
        <?php if (isset($pwSuccess)): ?>
            <div class="valid-feedback" style="display: block">
              <?php echo $pwSuccess; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($pwError)): ?>
            <div class="invalid-feedback" style="display: block">
              <?php echo $pwError; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary mt-2">Change password</button>
      </form>
    </div>
    <script>
      <?php require 'static/formatPhone.js' ?>
      const inputElement = document.getElementById('phoneNumber');
      inputElement.addEventListener('keydown',enforceFormat);
      inputElement.addEventListener('keyup',formatToPhone);
    </script>
    <?php include 'footer.php' ?>
  </body>
</html>