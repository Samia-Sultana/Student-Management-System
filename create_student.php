<?php
include 'dbConnection.php';
if(isset($_POST["create"])){
    $pass = md5($_POST['password']);
    $sql = "INSERT INTO student(stName, stEmail, stAddress, stPass) 
       VALUES ('$_POST[name]', '$_POST[email]', '$_POST[address]', '$pass' )";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Account created successfully!!!!!!!!!!!')</script>";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Create student account</title>
</head>
<style>
    body{
        margin:0px;
        padding:0px;
    }
    .student_form{
        width:60%;
        text-align:center;
    }
</style>
<body>
    <!-- Navbar starts -->
    <?php include 'admin_navbar.php' ?>
    <div class="student_form mx-auto">
    <form action="" method="post" class="mt-5">
        <input type="text" name="name" placeholder="enter name" class="form-control col-sm-7 mt-2">
        <input type="email" name="email" placeholder="enter email" class="form-control col-sm-7 mt-2" required>
        <input type="text" name="address" placeholder="enter address" class="form-control col-sm-7 mt-2">
        <input type="text" name="password" placeholder="enter password"class="form-control col-sm-7 mt-2" required>
        <br>
        <br>
        <button type="submit" name="create" class="btn btn-primary">Create</button>
    </form>
    </div>
</body>
</html>