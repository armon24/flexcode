<?php

    //All user information to be displayed
    $studo="";
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
    $state="";
    $major="";
    $minor="";
    $food="";
    $hobby="";
    $place="";
    $dorm="";
    $advice="";

    //Getting our PK, studentID
    session_start();
    $studo = $_SESSION["studentID"];

    //Getting our Mentor or Mentee type
    //$type = $_COOKIE["mentormentee"];
    
    //SQL work to initialize half of account variables from User table
    require_once("db.php");
    $sql = "SELECT * FROM User where StudentID='$studo'";
    $result = $mydb->query($sql);
    $row=mysqli_fetch_array($result);

    $email = $row["Email"];
    $pid = $row["PID"];
    $fName = $row["FirstName"];
    $mName = $row["MiddleName"];
    $lName = $row["LastName"];
    $pName = $row["Nickname"];
    $gender = $row["Gender"];
    $gradeLevel = $row["Grade"];

    //if statement checking the cookie for database for mentor/mentee status

    //SQL work to initialize other half of account variables from Mentor or Mentee table
    // $sql2 = "SELECT * FROM User where StudentID='$studo'";
    // $result2 = $mydb->query($sql2);
    // $row2=mysqli_fetch_array($result2);

    // $state = $row["State"];
    // $major = $row["Major"];
    // $minor= $row["Minor"];
    // $food = $row["Eatery"];
    // $hobby = $row["Hobby"];
    // $place = $row["Location"];
    // $dorm = $row["Dorm"];
    // $advice = $row["AdviceType"];
    
?>

<!DOCTYPE HTML>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>My Account | MentorMatch </title>
        <link href="resources/css/bootstrap.min.css" rel="stylesheet" />

        <style>
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 300px;
                margin: auto;
                text-align: center;
            }

            .left {
                font-weight: bold;
            }

            button {
                border: none;
                outline: 0;
                display: inline-block;
                padding: 8px;
                color: white;
                background-color: #000;
                text-align: center;
                cursor: pointer;
                width: 100%;
                font-size: 18px;
            }

            a {
                text-decoration: none;
                font-size: 22px;
                color: black;
            }

            label {
                font-weight: normal;
            }

            button:hover, a:hover {
                opacity: 0.7;
            }

            .edit {
                background-color: green;
            }
            .delete {
                background-color: red;
            }
        </style>

        <script src="resources/jquery-3.1.1.min.js"></script>
        <script src="resources/js/bootstrap.min.js"></script>
        <link href="resources/css/styles.css" rel="stylesheet" />
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <img class="navbar-brand" src="images/vtlogo.png"></img>
                <a href="https://pamplin.vt.edu/" class="navbar-brand">Pamplin</a>
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collpase navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="Homepage.html">Home</a></li>
                        <li><a href="#">Mentor List</a></li>
                        <li><a href="#">Mentee List</a></li>
                        <li><a href="MyAccount.html">My Account</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <h1>My Account</h1>

        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            
        <p> Welcome to the My Account page. Take a look at your user information and explore our options (but don't delete your account, we'll miss you)<p>

        <br>
        <div class="card">

            <h1> <?php 
                if(is_null($mName))
                {
                    echo $fName.' '.$lName;
                }
                else
                {
                    echo $fName.' '.$mName.' '.$lName;
                }
            ?> </h1>
                
            <p> <?php
                echo "<label class='left'>Grade Level: &nbsp &nbsp</label>";
                echo "<label class='right'>$gradeLevel</label>";
            ?> </p>

            <p> <?php
                echo "<label class='left'>MentorMatch Status: &nbsp &nbsp</label>";
                echo "<label class='right'>Mentor</label>";
            ?> </p>

            <p> <?php 
                echo "<label class='left'>Email Address: &nbsp &nbsp</label>";
                echo "<label class='right'>$email</label>";
            ?> </p>

            <p> <?php 
                echo "<label class='left'>PID: &nbsp &nbsp</label>";
                echo "<label class='right'>$pid</label>";
            ?> </p>

            
            <!-- <a href="#"><i class="fa fa-dribbble"></i></a> 
            <a href="#"><i class="fa fa-twitter"></i></a> 
            <a href="#"><i class="fa fa-linkedin"></i></a> 
            <a href="#"><i class="fa fa-facebook"></i></a>  -->
            <button class="edit">Edit Account</button>
            <button class="delete">Delete Account</button>
        </div>

    </body>

</html>