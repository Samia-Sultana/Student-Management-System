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
			background-image:url("images/pic1.jpg");
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.student{
			text-decoration:none;
        font-weight:bolder;
        color:white;
		}
	</style>
</head>
<body>
	<div class="login_form mx-auto" style="text-align:center; width:40%;">
		<form action="" method="POST" class="login">
			<h3 class="mb-3" style="color:white;">Admin login</h3>
  			<input type="email" placeholder="enter email" class="form-control mb-3" id="Email" name="email">
  			<input type="password" placeholder="enter password" class="form-control mb-3" id="Password" name="password">
  			<button type="submit" name="submit" class="btn btn-primary col-sm-4"  >Sign in</button>
			<p class="mt-2"><a href="index.php" class="student">Student Login</a></p>
		</form>
	</div>
</body>
</html>

<?php 
include 'dbConnection.php';
session_start();

if (isset($_SESSION['email'])) {
    header("Location: adminProfile.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM admin WHERE adEmail='$email' AND adPass='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['Id'] = $row['adId'];
		$_SESSION['email'] = $row['adEmail'];
		header("Location: adminProfile.php");
	}
	else {
		echo "<script>alert('Error login!!!!try with valid email and password');</script>";
	}
}
?>