<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>TutorMe - Request</title>
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
              <a class="nav-link" href="request.php">Request a Tutor! <span class="sr-only">(current)</span></a>
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

        <div class="row justify-content-center">
            <h1>Request Tutor</h1>
        </div>

        <div class="row">
            <div class="col">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Subject for Tutoring" aria-label="subject"
                        aria-describedby="addon-wrapping">
                </div>
                <br>
                <h6>Describe your request in more detail</h6>
                <div class="input-group">
                    <textarea rows=7 class="form-control"
                        placeholder="Are you preparing for a quiz, test, or assessment? Do you just want general assistance? Are you totally lost and need an expert to get you up to speed?"
                        aria-label="With textarea"></textarea>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <h3>Tutoring Style</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                        value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        In Person
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                        value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Online
                    </label>
                </div>
            </div>
            <div class="col">
                <h3>Timeframe</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                        value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Today
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                        value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        By a certain day
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                        value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Within a week
                    </label>
                </div>
                <br>
                <h6>Enter the date you would like tutoring by if relevant</h6>
                <div class="input-group">
                    <input type="date" class="form-control" placeholder="01/01/2001" aria-label="subject"
                        aria-describedby="addon-wrapping">
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <button type="button" class="btn btn-lg btn-success">Submit Request</button>
        </div>

    </div>

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
</body>

</html>