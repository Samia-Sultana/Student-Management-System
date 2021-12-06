
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>view student</title>
</head>
<body>
    <!-- Navbar starts -->
<?php include 'admin_navbar.php' ?>
<div class="mx-auto mt-5 mb-5" style="width:50%;text-align:center;">
    <form action="" method="POST">
      <input type="text" class="form-control mt-2 mb-2" name="studentId" placeholder="Search with student Id" required>
      <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>

<?php
include 'dbConnection.php';
if(isset($_POST["Submit"])){
    $studentId = $_POST['studentId'];
    $sql = "SELECT * FROM student WHERE stId = $studentId ";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
        echo "<table class='table table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>";
        echo "Student name";
        echo "</th>";
        echo "<th>";
        echo "Name";
        echo "</th>";
        echo "<th>";
        echo "Email";
        echo "</th>";
        echo "<th>";
        echo "Address";
        echo "</th>";
        echo " <th>";
        echo "Task1";
        echo "</th>";
        echo " <th>";
        echo "Task2";
        echo "</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody id='alluser'>";
        echo "<tr>";
        echo "<td>";
        echo $row['stId'];
        echo"</td>";
        echo "<td>";
        echo $row['stName'];
        echo"</td>";
        echo "<td>";
        echo $row['stEmail'];
        echo"</td>";
        echo "<td>";
        echo $row['stAddress'];
        echo"</td>";
        echo "<td>";
        echo "<a href='delete_student.php?studentId=$row[stId]'>";
        echo "Delete";
        echo "</a>";
        echo "</td>";
        echo "<td>";
        echo "<a href='modify_student.php?studentId=$row[stId]'>";
        echo "Update";
        echo "</a>";
        echo "</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
    }
    else{
        echo "no student found";
    }
}
?>