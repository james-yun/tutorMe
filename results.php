<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="static/style.css">
    <link rel="icon" type="image/png" href="static/logo.png">
    <title>TutorMe - Results</title>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container" style="margin-top: 1%;">
        <div class="row">
            <div class="col-8">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">Name</th>
                            <th scope="col">Availability</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="active">Active</th>
                            <td>John Snow</td>
                            <td>john@snow.com</td>
                            <td>Particle Physics</td>
                            <td><button type="button" class="btn btn-sm btn-outline-success">Confirm</button></td>
                        </tr>
                        <tr>
                            <th class="inactive">Inactive</th>
                            <td>Tony Stark</td>
                            <td>rdj@ironman.com</td>
                            <td>Superheroes 101</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <th class="active">Active</th>
                            <td>Larry Bird</td>
                            <td>john@snow.com</td>
                            <td>Basketball 101</td>
                            <td><button type="button" class="btn btn-sm btn-outline-success">Confirm</button></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-4">
                <div class=""> <img src="https://via.placeholder.com/200" class="img-fluid" alt="Responsive image"></div>
                <div class="">
                    <h3>Tony Stark</h3>
                </div>
                <div>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>