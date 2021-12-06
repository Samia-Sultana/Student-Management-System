<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin navbar</title>
    <style>
            .navbar{
        width: 100%;
        background-color: #867979 ;
        overflow: auto;
      }

      .navbar a {
    float: left;
    padding: 12px;
    color: white;
    text-decoration: none;
    font-size: 17px;
    width: 20%; 
    text-align: center;
    }

.navbar a:hover {
  background-color: #5e5555;
}

.navbar a.active {
  background-color: #808080;
}
    </style>
</head>
<body>
<div class="navbar">
  <a class="active" href="adminProfile.php">Dashboard</a>
  <a href="create_student.php">Create Student</a>
  <a href="view_student.php">View Student</a>
  <a href="report_form.php">Generate Report</a>
  <a href="logout.php">Logout</a>
</div>
</body>
</html>