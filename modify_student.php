<?php
include 'dbConnection.php';
session_start();
$studentId = $_GET['studentId'];
$sql = "SELECT * FROM student WHERE stId=$studentId";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$studentName = $row['stName'];
		$studentEmail = $row['stEmail'];
		$studentAddress = $row['stAddress'];	
	}
	
if (isset($_POST['submit'])) {
    $pass = md5($_POST['password']);
	$sql = "SELECT * FROM student WHERE email=$row[email]";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 1) {
		echo "provide an unique email";
	}
	else{
        if($pass != null){
            $sql = "UPDATE student SET stName='$_POST[username]',
             stEmail='$_POST[email]', stAddress='$_POST[address]',
             stPass='$pass' WHERE stId=$studentId";
        }
        else{
            $sql = "UPDATE student SET stName='$_POST[username]', stEmail='$_POST[email]', stAddress='$_POST[address]' 
            WHERE stId=$studentId";
        }
		
       if(mysqli_query($conn, $sql)){
        header("Location: view_student.php");
       }			

	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Update Student</title>
	<style>
		.update_form{
        width:40%;
        text-align:center;
    }
		</style>
</head>
<body>
	<?php include 'admin_navbar.php' ?>
<div class="container update_form mx-auto">
		<form action="" method="POST" class="mt-5"> 
				<label>Name: </label>
				<input type="text" class="mb-2 form-control" name="username" value="<?php echo $studentName; ?>">
				
				<label>Email: </label>  
				<input type="email" class="mb-2 form-control" name="email" value="<?php echo $studentEmail ?>" >
				
				<label>Address: </label>
				<input type="tel" class="mb-2 form-control" name="address" value="<?php echo $studentAddress ?>">
				
				<label>Password: </label>
				<input type="text" class="mb-2 form-control" name="password">
				
				<button type="submit" name="submit" class="btn btn-primary">Update</button>
		</form>
	</div>
</body>
</html>