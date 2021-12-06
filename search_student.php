<?php
include 'dbConnection.php';
if(isset($_POST["Submit"])){
    $studentId = $_POST['studentId'];
    $sql = "SELECT * FROM student WHERE stId = $studentId ";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
    }
    else{
        echo "no student found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=0.6" rel="stylesheet">
</head>
<body>
    <div>
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Activity</th>
                </tr>
            </thead>
            <tbody id="alluser">
                <tr>
                    <td><?php echo $row['stId'] ?></td>
                    <td><?php echo $row['stName'] ?></td>
                    <td><?php echo $row['stEmail'] ?></td>
                    <td><?php echo $row['stAddress'] ?></td>
                    <td><a href="delete_student.php?studentId=<?php echo $row['stId']; ?>">Delete</a></td>
                    <td><a href="modify_student.php?studentId=<?php echo $row['stId']; ?>">Modify</a></td>
                    
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>