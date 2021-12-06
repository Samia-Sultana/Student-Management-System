<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Generate Report</title>
</head>
<body>
  <!-- Navbar starts -->
<?php include 'admin_navbar.php' ?>
<div class="mx-auto mt-5 mb-5" style="width:50%;text-align:center;">
<form action="" method="post">
      <input type="text" class="form-control mt-2 mb-2" placeholder="Enrollment id" name="enId">
      <label for="duration">Duration:</label>
      <select name="duration" id="duration" class="mt-2 mb-2">
        <option value="Daily">Daily</option>
        <option value="Weekly">Weekly</option>
        <option value="Monthly">Monthly</option>
      </select>
      <br>
      <button type="submit" name="Submit" class="btn btn-primary">generate</button>
    </form>
</div>

</body>
</html>
<?php
include 'dbConnection.php';
function dateRange( $first, $last, $step = '+1 day', $format = 'Y/m/d' ) {
	$dates = array();
	$current = strtotime( $first );
	$last = strtotime( $last );
	while( $current <= $last ) {
		$dates[] = date( $format, $current );
		$current = strtotime( $step, $current );
	}
	return $dates;
}
function showAttendance($enId,$attDate,$attendance){
  echo "<tbody id='alluser'>";
    echo "<thead>";
    echo "<tr>";
    echo "<td>" .$enId . "</td>";
    echo "<td>" .$attDate . "</td>";
    echo "<td>" .$attendance . "</td>";
    echo "</tr>";
    echo "</tbody>";
   

}
function findClassDates($first,$last,$days,$enId,$conn){
                $dates = array();
                $dates = dateRange($first,$last);
                foreach($dates as $date){
                    foreach($days as $day){
                        if(date('w', strtotime($date)) == date("w", strtotime($day)) ){
                            $sql = "SELECT * FROM attendance WHERE attendanceDate='$date' AND enrollmentId = $enId ";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0){
                                $row = mysqli_fetch_assoc($result);
                                showAttendance($row['enrollmentId'],$row['attendanceDate'],$row['attendance']);
                            }
                            else{
                                showAttendance($enId,$date,"absent");
                             }
                         }
                    }
                }
}

if(isset($_POST["Submit"])){
    $enId = $_POST['enId'];
    $duration = $_POST['duration'];
    $sql = "SELECT classId FROM enrolled WHERE enrollmentId=$enId ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $sql = "SELECT daySlot,clsTime FROM slot WHERE classId=$row[classId] ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $days = array();
            while($row = mysqli_fetch_assoc($result)){
                array_push($days,$row['daySlot']);
            }
            echo "<table class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>EnrollmentId</th>";
            echo "<th>Attendance date</th>";
            echo "<th>Attendance</th>";
            echo "</tr>";
            echo "</thead>";

            if($duration == 'Monthly'){
                $currDate = date("Y/m/d"); 
                if($currDate == date("Y/m/01")){
                $firstDate = date('Y/m/01', strtotime('previous month'));
                $lastDate = date('Y/m/t', strtotime('previous month'));
                }
                else{
                $firstDate = date("Y/m/01");
                $lastDate = $currDate;
                }
                findClassDates($firstDate,$lastDate,$days,$enId,$conn);
            }
            else if($duration == 'Weekly'){
                $weekStartDate = strtotime("last monday");
                if(date('w', $weekStartDate)==date('w')){
                    $weekStartDate = $weekStartDate+7*86400;
                    $weekEndDate = strtotime(date("Y/m/d",$weekStartDate)." +6 days");
                }
                else{
                    $weekStartDate = $weekStartDate;
                    $weekEndDate = strtotime(date("Y/m/d"));   
                }
                $week_started = date("Y/m/d",$weekStartDate);
                $week_ended = date("Y/m/d",$weekEndDate);
                findClassDates($week_started,$week_ended,$days,$enId,$conn);

            }
            else if($duration == 'Daily'){
                $today = date("Y/m/d");
                foreach($days as $day){
                    if(date('w', strtotime($today)) == date("w", strtotime($day))){
                        $sql = "SELECT * FROM attendance WHERE enrollmentId=$enId AND attendanceDate = '$today'";
                        $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0){
                                $row = mysqli_fetch_assoc($result);
                                showAttendance($row['enrollmentId'],$row['attendanceDate'],$row['attendance']);
                            }
                            else{
                                showAttendance($enId,$today,"absent");
                            }

                    }
                    else{
                        
                        
                    }
                }
                
            }       
        }                 
    }
}
?>
