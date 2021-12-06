<?php
include 'dbConnection.php';
session_start();
$sessionId = $_SESSION['id'];
$date = date("Y/m/d");

         $sql = "SELECT * FROM attendance WHERE (enrollmentId = $_POST[enrollmentid] AND attendanceDate='$date') ";
         $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) > 0){
            echo "<script>alert('You can not attampt more than once in a day');</script>";
            
         }
         else{
            $sql = "INSERT INTO attendance (enrollmentId, attendanceDate, attendance) 
            VALUES ($_POST[enrollmentid], '$date', '$_POST[present]')";
            if (mysqli_query($conn, $sql)) {
                
                header("Location: studentProfile.php");
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }
    

mysqli_close($conn);
?>