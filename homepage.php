<?php
  session_start();
  require 'connectdb.php';
  require 'sql.php';
  if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];
    $query = "SELECT first_name FROM student WHERE student_id = '$student_id'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $first_name = $result['first_name'];
  }
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
  <link rel="stylesheet" type="text/css" href="static/style.css">
  <title>TutorMe</title>
</head>

<body>
  <?php include 'navbar.php'; ?>

  <div class="container" style="margin-top: 1%;">
    <!-- Jumbotron -->
    <div class="jumbotron">
      <h1 class="display-4">
        <?php echo isset($first_name) ? 'Welcome, '.$first_name.'!' : 'Welcome to TutorMe!'?>
      </h1>
      <p class="lead">Taking a hard class? Get homework and exam help from veteran students who've taken the class
        before.
      </p>
      <hr class="my-4">
      <p>Select tutors by class, location, and rating.</p>
      <a class="btn btn-primary btn-lg" href="request.php" role="button">Request a tutor</a>
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
  <?php include 'footer.php'; ?>
</body>

</html>