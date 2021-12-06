<?php 
include 'dbConnection.php';
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: admin_login.php");
}
$sql = "SELECT * FROM admin WHERE adEmail = '$_SESSION[email]'";
$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
body{
  background-image:url("images/pic4.jpg");
	height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.profile{
  width:60%;
  text-align:center;
  font-family: cursive;
  color:white;
}
h4{
  color:black; 
}
</style>
</head>
<body>
    
<!-- Navbar starts -->
<?php include 'admin_navbar.php' ?>
<div class="profile-body">
<div class="profile mt-5 mx-auto">
  <h3 class=" pt-2 pb-4">Welcome to the admin page</h3>
  <h4 class=" pt-2"> Name: <?php echo $row['adName']; ?> </h4>
  <h4 class=" pt-2"> Email: <?php echo $_SESSION['email']; ?> </h4>
  <h4 class=" pt-2"> Address: <?php echo $row['adAddress']; ?> </h4>
</div>
</div>
</body>
</html>