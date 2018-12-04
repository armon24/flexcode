<?php

$match="";
$mentor="false";
$studo="";
$type="";
$error = "false";
$loginOK = null;

if(isset($_POST["doneButton"]))
  {
    //Setting PHP variables for register.php form variables  

    //Getting our PK from login, studentID
    session_start();
    $studentIdent = $_SESSION["studentID"];

    require_once("db.php");
    $sql = "SELECT MentorID FROM Matches WHERE MenteeID='$studo'";    
    $result = $mydb ->query($sql);
    $row = mysqli_fetch_array($result);
    $match = $row["MenteeID"];
    if ($match == NULL)
    {
        $sql = "SELECT MenteeID FROM Matches WHERE MentorID='$studo'";    
        $result = $mydb ->query($sql);
        $row = mysqli_fetch_array($result);
        $match = $row["MenteeID"];
        $mentor = "true";
    } 

    if(isset($_POST["roleType"]))       $type=$_POST["roleType"]; 

    //Every PHP variable is now set; time for error checking................

    /*
    * Required boxes are everything from extention and 
    * register.php except for mName and pName
    */
    if(empty($type))
    {
        $error="true";
    }
    else{
        $loginOK=true;
    }

    //errorcheckign complete to make sure they chose something

    if($loginOK==true)
    {
        //now the mentor and mentee database updating
        if($type == "yes")
        {
            if(strcmp($mentor, "true") == 0)
            {
                require_once("db.php");
                $sql5 = "DELETE FROM Matches WHERE MentorID='$studentIdent'";
                $result5 = $mydb->query($sql5);

                require_once("db.php");
                $sql3 = "DELETE FROM Mentor WHERE StudentID='$studentIdent'";
                $result3 = $mydb->query($sql3);   
            }
            else
            {
                require_once("db.php");
                $sql5 = "DELETE FROM Matches WHERE MenteeID='$studentIdent'";
                $result5 = $mydb->query($sql5);

                require_once("db.php");
                $sql4 = "DELETE FROM Mentee WHERE StudentID='$studentIdent'";
                $result4 = $mydb->query($sql4);
            }

            require_once("db.php");
            $sql2 = "DELETE FROM user WHERE StudentID='$studentIdent'";
            $result2 = $mydb->query($sql2);
            header("Location: /flexcode/afterdelete.html");
        }
        else //$type == "no"
        {
            header("Location: Homepage.html");
        }
    }

  }

?>

<!doctype html>

<html>

    <head>
        <!-- Background Stuff -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Delete Account | MentorMatch</title>
        <link href="resources/css/bootstrap.min.css" rel="stylesheet" />
        <script src="resources/jquery-3.1.1.min.js"></script>
        <script src="resources/js/bootstrap.min.js"></script>
        <link href="resources/css/styles.css" rel="stylesheet" />

        <!-- Link to our overall CSS sheet -->

        <!-- Style for this sheet only -->
        <style>
            .errlabel {
                color:red;
            }

            .hidden {
                visibility: hidden;
            };
        </style>
        <!-- Importing a library for Ajax use. Taken from HW14 -->
        <script src="jquery-3.1.1.min.js"></script>

        <!-- JavaScript right here -->
        <script>
  
        </script>
    </head>

    <body>
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
                        <li><a href="Homepage.html">Home</a></li>
                        <li><a href="#">My Matches</a></li>
                        <li><a href="myaccount.php">My Account</a></li>
                    </ul>
                </div>
            </div>
    </div>

        <h1>Delete Account | Pamplin MentorMatch</h1>       <!-- Should be replaced with an official image later -->

        <p>Pamplin MentorMatch is a student-made and Pamplin-run program seeking to pair upperclassmen mentors and first-year students. </p>

        <p> Delete your account... :( </p>

        <form id ="registerForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 

            <table>

                <tr>
                    <td>
                        <label  id="type">Are you sure you want to delete your account? </label>
                    </td>
                    <td>
                            <!-- OnChange = getContent() -->
                        <input type="radio" name="roleType" id="yes" value="yes" <?php if($type == "yes") echo "checked";?> > Yes <br>
                        <input type="radio" name="roleType" id="no" value="no" <?php if($type == "no") echo "checked";?> > No <br>
                    </td>
                    <td>
                        <button name="doneButton">Confirm deletion or go back!</button>
                    </td>
                </tr>

                <tr>
                    
                </tr>

            </table>

        </form>

    </body>

</html>