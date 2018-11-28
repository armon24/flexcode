<?php

    //All user information to be displayed
    $match="";
    $studo="";
    $email="";
    $fName="";
    $mName="";
    $lName="";
    $pName="";
    $gender="";
    $gradeLevel="";
    $type="";
    $state="";
    $major="";
    $minor="";
    $food="";
    $hobby="";
    $place="";
    $dorm="";

    //Getting our PK, studentID
    session_start();
    $studo = $_SESSION["studentID"];

    require_once("db.php");
    $sql = "SELECT MentorID FROM Matches WHERE MenteeID='$studo'";
    if ($sql != Null)
    {
        $result = $mydb ->query($sql);
        $row = mysqli_fetch_array($result);
        $match = $row["MentorID"];
    }
    else
    {
        $sql = "SELECT MenteeID FROM Matches WHERE MentorID='$studo'";
        $result = $mydb ->query($sql);
        $row = mysqli_fetch_array($result);
        $match = $row["MenteeID"];
    }
    
    

    //Getting our Mentor or Mentee type
    //$type = $_COOKIE["mentormentee"];
    
    //SQL work to initialize half of account variables from User table
    require_once("db.php");
    $sql = "SELECT * FROM User where StudentID='$match'";
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
                <img class="navbar-brand" src="images/vtlogo.png" />
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
        <h1>Its a Match!</h1>

        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">            
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
                echo "<label class='left'>Email Address: &nbsp &nbsp</label>";
                echo "<label class='right'>$email</label>";
            ?> </p>

            <p> <?php 
                echo "<label class='left'>PID: &nbsp &nbsp</label>";
                echo "<label class='right'>$pid</label>";
            ?> </p>
        </div>

    </body>

</html>