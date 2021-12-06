<?php
include 'config.php';
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
    echo "<tr>";
    echo "<td>" .$enId . "</td>";
    echo "<td>" .$attDate . "</td>";
    echo "<td>" .$attendance . "</td>";
    echo "</tr>";

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

    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>EnrollmentId</th>";
    echo "<th>Attendance date</th>";
    echo "<th>Attendance</th>";
    echo "</tr>";

    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $sql = "SELECT daySlot,clsTime FROM slot WHERE classId=$row[classId] ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $days = array();
            while($row = mysqli_fetch_assoc($result)){
                array_push($days,$row['daySlot']);
            }

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
                $weekStartDate = strtotime("last sunday");
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
