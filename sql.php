<?php
function getLessons()
{
    global $db;
    $query = "SELECT course_number,
       course_name,
       CONCAT(first_name, ' ', last_name) as tutor,
       (SELECT AVG(star_rating)
        FROM reviews
        WHERE reviews.tutor_id = student.student_id
           AND reviews.course_number = course.course_number) AS avg_star_rating
FROM teaches
    JOIN student ON teaches.tutor_id = student.student_id
    NATURAL JOIN course;";
    $statement = $db->prepare($query);
    $statement->execute();

    // fetchAll() returns an array for all of the rows in the result set
    $results = $statement->fetchAll();

    // closes the cursor and frees the connection to the server so other SQL statements may be issued
    $statement->closecursor();

    return $results;
}
function getTutorId($tname)
{
    global $db;
    $query = "SELECT student_id FROM student WHERE CONCAT(first_name, ' ', last_name) = :tname limit 1";
    $statement = $db->prepare($query);
    $statement->bindValue(':tname', $tname);
    $statement->execute();
    $results = $statement->fetch();

    return $results['student_id'];
}

function insertReview($student_id, $tutor_id, $course_number, $star_rating, $comment){
    global $db;
    $query = "INSERT INTO reviews (student_id, tutor_id, course_number, star_rating, comment) VALUES
('$student_id', '$tutor_id', '$course_number', $star_rating, '$comment');";
    $statement = $db->prepare($query);
    $statement->execute();
    echo implode($statement->errorInfo());
}
