<?php
include 'dbConnection.php';
$studentId = $_GET['studentId'];
$sql = "DELETE FROM student WHERE stId = $studentId ";
if(mysqli_query($conn, $sql)){
    header("Location: view_student.php");
}
else{
    echo "delettion unsuccessful";
}

?>
