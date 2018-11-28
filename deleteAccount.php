<?php

$match="";
$mentor=false;
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
        $mentor = true;
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
            require_once("db.php");
            $sql2 = "DELETE FROM user WHERE StudentID='$studentIdent'";
            $result2 = $mydb->query($sql2);

            require_once("db.php");
            $sql5 = "DELETE FROM Matches WHERE StudentID='$studentIdent'";
            $result5 = $mydb->query($sql5);

            if($mentor)
            {
                require_once("db.php");
                $sql3 = "DELETE FROM mentor WHERE StudentID='$studentIdent'";
                $result3 = $mydb->query($sql3);   
            }
            else{
                require_once("db.php");
                $sql4 = "DELETE FROM mentee WHERE StudentID='$studentIdent'";
                $result4 = $mydb->query($sql4);
            }
        }
        else //$type == "no"
        {
            Header("Location: Homepage.html");
        }
    }

  }

?>

<!doctype html>

<html>

    <head>
        <!-- Background Stuff -->
        <title> Delete Account | MentorMatch </title>
        <meta charset="utf-8"/>

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