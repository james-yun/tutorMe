<?php
  session_start();
  require 'connectdb.php';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $student_id = $_POST['id'];
    $phoneNumber = $_POST['phoneNumber'];
    $venmoID = $_POST['venmoID'];
    $password = $_POST['password'];
    if (strlen($student_id) > 7) {
      $idError = "Student ID is too long";
    } elseif (strlen($password) < 4) {
      $pwError = "Password must be at least 4 characters";
    } else {
      $query = "SELECT hash FROM student WHERE student_id = '$student_id'";
      $statement = $db->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll();
      $count = count($results);
      if ($count == 1) {
        $idError = "User already exists";
      } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO student (first_name, last_name, student_id, phone_number, venmo_id, hash) 
                    VALUES ('$firstName', '$lastName', '$student_id', '$phoneNumber', '$venmoID', '$hash')";
        $statement = $db->prepare($query);
        $statement->execute();
        $_SESSION['student_id'] = $student_id;
        header("location: homepage.php");
        exit;
      }
    }
  }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TutorMe Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="static/signin.css">
</head>

<body class="text-center">
<form class="form-signin needs-validation" method="post" action="signup.php" novalidate>
    <!-- logo here -->
    <img class="mb-4" src="https://conejovalleytutor.com/wp-content/uploads/2015/06/sq-011-300x300.png" alt="TutorMe" width="120" height="120">
    <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
    <div class="form-row">
        <div class="col">
            <label for="firstName" class="sr-only">First name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" maxlength="20" required autofocus>
        </div>
        <div class="col">
            <label for="lastName" class="sr-only">Last name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" maxlength="20" required>
        </div>
    </div>
    <div class="input-group">
        <label for="inputId" class="sr-only">Computing ID</label>
        <input type="text" class="form-control <?php echo isset($idError) ? 'is-invalid' : ''?>" name="id" id="inputId" placeholder="Computing ID" aria-describedby="email" required>
        <div class="input-group-append">
            <span class="input-group-text" id="email">@virginia.edu</span>
        </div>
        <div class="invalid-feedback">
          <?php if (isset($idError)) echo $idError." <a href=login.php>Log in?</a>" ?>
        </div>
    </div>

    <label for="phoneNumber" class="sr-only">Phone Number</label>
    <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Phone number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>

    <div class="input-group">
        <label for="venmoID" class="sr-only">Venmo ID</label>
        <div class="input-group-prepend">
            <span class="input-group-text" id="email">@</span>
        </div>
        <input type="text" class="form-control" name="venmoID" id="venmoID" placeholder="Venmo ID" maxlength="20" required>
    </div>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" class="form-control <?php echo isset($pwError) ? 'is-invalid' : ''?>" name="password" id="inputPassword" placeholder="Password" minlength="4" maxlength="20" required>
    <div class="invalid-feedback">
      <?php if (isset($pwError)) echo $pwError ?>
    </div>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" style="background-color: #7F0FFF;" style="border: none;" type="submit">Sign up</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2020 TutorMe</p>
</form>

<script>
    <?php require 'static/formatPhone.js' ?>
    const inputElement = document.getElementById('phoneNumber');
    inputElement.addEventListener('keydown',enforceFormat);
    inputElement.addEventListener('keyup',formatToPhone);
</script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</body>
</html>
