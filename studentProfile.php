<?php 
include 'dbConnection.php';
session_start();
$sessionEmail = $_SESSION['email'];
$sql = "SELECT * FROM student WHERE stEmail='$sessionEmail'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);
  $studentId = $row['stId'];
  $studentName = $row['stName'];
  $studentEmail = $row['stEmail'];
  $studentAddress = $row['stAddress'];
}
else{
  echo "no student found";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
      html, body {
    height:100%;
} 
      body{
        background-image:url("images/pic7.jpg");
	      height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        color:white;
      }
      .attendance{
        padding-left:50px;
      }
      .profile{
        display: flex;
        color:black;
        justify-content: space-between;
      }
      .logout a{
        text-decoration:none;
        font-weight:bolder;
        color:black;
      }
      </style>
</head>
<body>
  <div class="profile mx-auto bg-light">
    <div class="profInfo mx-2 px-2">
      <h4 class="pb-1">Welcome <?php echo $studentName; ?></h3>
      <h5> Email: <?php echo $studentEmail; ?> </h4>
    </div>
    <div class="logout mx-2 px-2">
      <a href="logout.php">Logout</a>
    </div>
  </div>
  <?php
        $sql = "SELECT classId,enrollmentId FROM enrolled where stId = $studentId ";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
          while($row = mysqli_fetch_assoc($result)){
            $sql = "SELECT cId,section FROM class where classId = $row[classId]";
            $result1 = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result1) > 0) {
              $row1 = mysqli_fetch_assoc($result1);

              $sql = "SELECT ctitle FROM course where cId = $row1[cId] ";
              $result2 = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result2) > 0) {
                $row2 = mysqli_fetch_assoc($result2);
                $sqlX = "SELECT daySlot,clsTime FROM slot where classId = $row[classId]";
                $resultX = mysqli_query($conn, $sqlX);
                if ($resultX->num_rows > 0) {
                  while($rowX = mysqli_fetch_assoc($resultX)){
                    if(date('w', strtotime(date("Y/m/d"))) == date("w", strtotime($rowX['daySlot']))){
                      echo "<button class='mx-3 my-5' onclick='checkSlot($row1[cId],$row1[section],`$rowX[daySlot]`,`$rowX[clsTime]`,$row[enrollmentId])'>" .$row2['ctitle'] ."</button>";
                    }
                  }
                }
              }
            }
          }
       }
      ?>
  <div class="attendance">

  </div>
  <script>
        function checkSlot(cid,section,clsDay,clsTime,enrollmentId){
          const date = new Date();
          const month = date.getMonth() + 1
          const days = date.getDate()
          const year = date.getFullYear();
          const currentDate = month + "-" + days + "-" + year;
          const hour = date.getHours()
          const minutes = date.getMinutes()
          const seconds = date.getSeconds();
          const currentTime = hour + "." + minutes + "." + seconds;
          const week = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
          const today = new Date (currentDate);
          const dayName = week[today.getDay()];
          
          if(dayName == clsDay){
            const currTimeArray = currentTime.split(".").map(Number);
            const clsTimeArray = clsTime.split(".").map(Number);
             

            if(currTimeArray[0] == clsTimeArray[0]){
              if(currTimeArray[1] >= clsTimeArray[1]){
                attendanceForm(cid,section,enrollmentId)
              }
              else{
                document.getElementsByClassName("attendance")[0].innerHTML = "Your slot hasn't started yet";
              }
            }
            else if (currTimeArray[0]==clsTimeArray[0]+1){
              if(currTimeArray[1] <= clsTimeArray[1]){
                attendanceForm(cid,section,enrollmentId);
              }
              else{
                document.getElementsByClassName("attendance")[0].innerHTML = "Your slot is over";
              }
              
            }
            else{
              document.getElementsByClassName("attendance")[0].innerHTML = "Please come when it is your slot";
            }

          }
          else{
            document.getElementsByClassName("attendance")[0].innerHTML = "Please come when it is your slot";
          }
         
        }

        function attendanceForm(cid,section,enrollmentid){
          
          const clearFeild = document.getElementsByClassName("attendance")[0];
          clearFeild.innerHTML = '';
 
          var br = document.createElement("br");

          var form = document.createElement("form");
          form.setAttribute("method", "POST");
          form.setAttribute("action", "attendance.php");

          var courseLabel = document.createElement("Label");
          courseLabel.setAttribute("for","cId");
          courseLabel.innerHTML = "Course code";
          form.appendChild(courseLabel);
          var courseId = document.createElement("input");
          courseId.setAttribute("type", "text");
          courseId.setAttribute("name", "cId");
          courseId.setAttribute("value", cid);
          courseId.disabled = true;
          form.appendChild(courseId);
          form.appendChild(br.cloneNode());
          form.appendChild(br.cloneNode());

          var secLabel = document.createElement("Label");
          secLabel.setAttribute("for","section");
          secLabel.innerHTML = "Section";
          form.appendChild(secLabel);
          var secId = document.createElement("input");
          secId.setAttribute("type", "text");
          secId.setAttribute("name", "section");
          secId.setAttribute("value", section);
          secId.disabled = true;
          form.appendChild(secId);
          form.appendChild(br.cloneNode());
          form.appendChild(br.cloneNode());

          var enrollmentId = document.createElement("input");
          enrollmentId.setAttribute("type", "hidden");
          enrollmentId.setAttribute("name", "enrollmentid");
          enrollmentId.setAttribute("value", enrollmentid);
          form.appendChild(enrollmentId);

          var attendance = document.createElement("input");
          attendance.setAttribute("type", "radio");
          attendance.setAttribute("id", "present");
          attendance.setAttribute("name", "present");
          attendance.setAttribute("value", "present" );
          form.appendChild(attendance);

          var attendanceLabel = document.createElement("Label");
          attendanceLabel.setAttribute("for","present");
          attendanceLabel.innerHTML = "Present";
          form.appendChild(attendanceLabel);
          form.appendChild(br.cloneNode());
          form.appendChild(br.cloneNode());

          var submit = document.createElement("input");
          submit.setAttribute("type", "submit");
          submit.setAttribute("value", "Submit");
          form.appendChild(submit);

        

          document.getElementsByClassName("attendance")[0].appendChild(form);

        }
      
      </script>
      
</body>
</html>