<?php
require 'sql.php';
require 'connectdb.php';
session_start();
$student_id = $_SESSION['student_id'];
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
    
    
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="static/theme.css">

    <title>TutorMe - Review</title>



</head>



<body>
    
<?php include 'navbar.php'; ?>

    <div class="container" style="margin-top: 1%;">

        <div class="row justify-content-center">
            <h1>Review Tutor</h1>
        </div>
        </br>


        <form action= "<?php $_SERVER['PHP_SELF']?>" name = "submitReview" method = "post">
        <div class = "form-group">
            <label for = "subject">Course Number</label>
            <select class ="form-control" id = "course_number" name = "course_number" >
                <option selected>Choose...</option>
                <option value ="CS 3250">CS 3250</option>
                <option value ="CS 4102">CS 4102</option>
                <option value ="CS 4750">CS 4750</option>
             </select>
        </div>
        <div class = "form-group">
            <label for = "professor">Tutor</label>
            <select class ="form-control" id = "professor" name = "tutor_id">
                <option selected>Choose...</option>
                <option value ="Upsorn Praphamontripong">Upsorn Praphamontripong</option>
                <option value ="James Yun">James Yun</option>
             </select>
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <select multiple class="form-control" id="rating" name = "star_rating">  
                <option value = 1>1</option>
                <option value = 2>2</option>
                <option value = 3>3</option>
                <option value = 4>4</option>
                <option value = 5>5</option>
             </select>
        </div>
        
        <div class="form-group">
            <label for="comment">Describe your experience with your tutor: </label>
            <textarea class="form-control" id="comment" name = "comment" rows="7"></textarea>
        </div>
        <div class="row justify-content-center">
        <button type = "submit" name = "action" value = "Submit Review" class = "btn btn-primary">Submit</button>
        </div>
        </div>
        </form>







 
    

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
     if(!empty($_POST['action']) && ($_POST['action'] == 'Submit Review')){
        if (!empty($_POST['course_number']) && !empty($_POST['tutor_id']) && !empty($_POST['star_rating'] && !empty($_POST['comment'])))
        {
            echo $student_id;
            $tid = getTutorId($_POST['tutor_id']);
            //echo $tid;
            insertReview($student_id,$tid, $_POST['course_number'], $_POST['star_rating'], $_POST['comment']);
            
        }
     }
    
}
?>
<!-- <?php include 'footer.php'; ?>  -->
</body>
</div>
</html>