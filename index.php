<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
	<title>Student attendance management system</title>
	<style>
		html, body {
    height:100%;
} 
		body{
			background-image:url("images/pic2.jpg");
			
			height: 100%;

/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover;

		}
		.admin{
			text-decoration:none;
        font-weight:bolder;
        color:black;
		}
	</style>
</head>
<body>
	<div class="login_form mx-auto" style="text-align:center; width:40%;">
		<form action="" method="POST" class="login">
			<h3 class="mb-3" style="color:white;">Student login</h3>
  			<input type="email" placeholder="enter email" class="form-control mb-3" id="Email" name="email">
  			<input type="password" placeholder="enter password" class="form-control mb-3" id="Password" name="password">
  			<button type="submit" name="submit" class="btn btn-primary col-sm-4"  >Sign in</button>
			<p class="mt-2"><a href="admin_login.php" class="admin">Admin Login</a></p>
		</form>
	</div>
</body>
</html>

<?php 
include 'dbConnection.php';
session_start();

if (isset($_SESSION['email'])) {
    header("Location: studentProfile.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM student WHERE stEmail='$email' AND stPass='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['id'] = $row['stId'];
		$_SESSION['email'] = $row['stEmail'];
		header("Location: studentProfile.php");
	}
	else {
		echo "<script>alert('Error login!!!!try with valid email and password');</script>";
	}
}
?>