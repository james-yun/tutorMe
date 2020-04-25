<?php
    session_start();
    require 'connectdb.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $student_id = $_POST['id'];
      $password = $_POST['password'];
      $query = "SELECT hash FROM student WHERE student_id = '$student_id'";
      $statement = $db->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll();
      $count = count($results);

      // If result matched $computingID and $password, table row must be 1 row
      if ($count == 1) {
        $result = $results[0];
        $hash = $result['hash'];
        if (password_verify($password, $hash)) {
          $_SESSION['student_id'] = $student_id;
          header("location: homepage.php");
          exit;
        } else {
          $pwError = "Incorrect password";
        }
      } else {
        $idError = "User does not exist";
      }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- original styling -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TutorMe Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="static/signin.css">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="login.php">
      <!-- logo link -->
      <img class="mb-4" src="https://conejovalleytutor.com/wp-content/uploads/2015/06/sq-011-300x300.png" alt="TutorMe" width="120" height="120">
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
      <div class="input-group">
        <label for="inputId" class="sr-only">Computing ID</label>
        <input type="text" class="form-control <?php echo isset($idError) ? 'is-invalid' : ''?>" name="id" id="inputId" placeholder="Computing ID" aria-describedby="email" required autofocus>
        <div class="input-group-append">
          <span class="input-group-text" id="email">@virginia.edu</span>
        </div>
        <div class="invalid-feedback">
          <?php echo $idError." <a href=signup.php>Create account?</a>" ?>
        </div>
      </div>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" class="form-control <?php echo isset($pwError) ? 'is-invalid' : ''?>" name="password" id="inputPassword" placeholder="Password" required>
      <div class="invalid-feedback">
        <?php echo $pwError ?>
      </div>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" style="background-color: #FF5242;" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2020 TutorMe</p>
    </form>
  </body>
</html>
