<?php
  require 'connectdb.php';
  require 'sql.php'
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Javascript -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>TutorMe</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">TutorMe</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="request.html">Request a Tutor! <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            @Username
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">My Profile</a>
            <a class="dropdown-item" href="#">My Appointments</a>
            <a class="dropdown-item" href="#">My Requests</a>
          </div>
        </li>

      </ul>
    </div>
  </nav>

  <div class="container" style="margin-top: 1%;">
    <!-- Jumbotron -->
    <div class="jumbotron">
      <h1 class="display-4">Welcome to TutorMe!</h1>
      <p class="lead">Taking a hard class? Get homework and exam help from veteran students who've taken the class
        before.
      </p>
      <hr class="my-4">
      <p>Select tutors by class, location, and rating.</p>
      <a class="btn btn-primary btn-lg" href="request.html" role="button">Request a tutor</a>
    </div>

    <!-- Main Body -->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Course number</th>
          <th scope="col">Course name</th>
          <th scope="col">Tutor</th>
          <th scope="col">Rating</th>
          <th scope="col">Request</th>
        </tr>
      </thead>

      <tbody>
        <?php
          $lessons = getLessons();
          foreach ($lessons as $lesson):
        ?>
        <tr>
          <td>
            <?php echo $lesson['course_number']; ?>
          </td>
          <td>
            <?php echo $lesson['course_name']; ?>
          </td>
          <td>
            <?php echo $lesson['tutor']; ?>
          </td>
          <td>
            <?php echo $lesson['avg_star_rating']; ?>
          </td>
          <td>
            <a class="btn btn-primary btn-sm" href="#" role="button">Request tutor</a>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</body>

</html>