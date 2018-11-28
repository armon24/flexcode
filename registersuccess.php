<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register Success | MentorMatch</title>
    <link href="resources/css/bootstrap.min.css" rel="stylesheet" />
    <script src="resources/jquery-3.1.1.min.js"></script>
    <script src="resources/js/bootstrap.min.js"></script>
    <link href="resources/css/styles.css" rel="stylesheet" />
</head>
<body>
<?php
        //Variables from register.php
$studentid="";
$email="";
$pid="";
$fName="";
$mName="";
$lName="";
$pName="";
$gender="";
$dob="";
$gradeLevel="";
$pass1="";
$pass2="";
$type="";

//Previously hidden variables that are revealed after click
$state="";
$major="";
$minor="";
$food="";
$hobby="";
$place="";
$dorm="";
$advice="";

//Error-checking
$error = false;

if(isset($_POST["registerButton"]))
  {
    //Setting PHP variables for register.php form variables  
    if(isset($_POST["studentID"]))      $studentid=$_POST["studentID"];
    if(isset($_POST["email"]))          $email=$_POST["email"];
    if(isset($_POST["pid"]))            $pid=$_POST["pid"];
    if(isset($_POST["fName"]))          $fName=$_POST["fName"];
    if(isset($_POST["mName"]))          $mName=$_POST["mName"];
    if(isset($_POST["lName"]))          $lName=$_POST["lName"];
    if(isset($_POST["pName"]))          $pName=$_POST["pName"];
    if(isset($_POST["gender"]))         $gender=$_POST["gender"];
    if(isset($_POST["dob"]))            $dob=$_POST["dob"];
    if(isset($_POST["gradeLevel"]))     $gradeLevel=$_POST["gradeLevel"];
    if(isset($_POST["pass"]))           $pass1=$_POST["pass"];
    if(isset($_POST["passAgain"]))      $pass2=$_POST["passAgain"];
    if(isset($_POST["roleType"]))       $type=$_POST["roleType"]; 

    //Setting PHP variables for extended form variables
    if(isset($_POST["state"]))          $state=$_POST["state"];
    if(isset($_POST["major"]))          $major=$_POST["major"];
    if(isset($_POST["minor"]))          $minor=$_POST["minor"];
    if(isset($_POST["food"]))           $food=$_POST["food"]; 
    if(isset($_POST["hobby"]))          $hobby=$_POST["hobby"];
    if(isset($_POST["place"]))          $place=$_POST["place"];
    if(isset($_POST["dorm"]))           $dorm=$_POST["dorm"];
    if(isset($_POST["advice"]))         $advice=$_POST["advice"];
  }

  require_once("db.php");
  $sql = "INSERT INTO user(StudentID, Email, PID, FirstName, MiddleName, LastName, Nickname, Gender, DOB, Grade, `Password`) 
        VALUES('$studentid', '$email', '$pid', '$fName', '$mName', '$lName', '$pName', '$gender', '$dob', '$gradeLevel', '$pass1')";
  $result=$mydb->query($sql);

  if ($type == "mentor") {
    $sql = "INSERT INTO mentor(StudentID, `State`, Major, Minor, Eatery, Hobbies, `Location`, Dorm, AdviceType)
            VALUES('$studentid', '$state', '$major', '$minor', '$food', '$hobby', '$place', '$dorm', '$advice')";
    $result=$mydb->query($sql);

  } elseif ($type == "mentee") {
    $sql = "INSERT INTO mentee(StudentID, `State`, Major, Minor, Eatery, Hobbies, `Location`, Dorm, AdviceType)
            VALUES('$studentid', '$state', '$major', '$minor', '$food', '$hobby', '$place', '$dorm', '$advice')";
    $result=$mydb->query($sql);
  }

?>
    <div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <img class="navbar-brand" src="images/vtlogo.png">
                <a href="https://pamplin.vt.edu/" class="navbar-brand">Pamplin Homepage</a>
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collpase navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="beforeloginlanding.html">Welcome</a></li>
                        <li><a href="login.php">Log In</a></li>
                        <li><a href="register.php">Create An Account</a></li>
                    </ul>
                </div>
            </div>
    </div>
    <h1>Thank you <?php echo $fName; ?> for registering with MentorMatch. The next time you log-on, you'll see your match!</h1>
</body>
</html>