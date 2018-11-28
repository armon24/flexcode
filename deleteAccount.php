<?php

$type="";
$error = "false";
$loginOK = null;

echo "status of error at the beginning".$error."<br>";

if(isset($_POST["doneButton"]))
  {
    //Setting PHP variables for register.php form variables  

    //Getting our PK from login, studentID
    session_start();
    $studentIdent = $_SESSION["studentID"];


    echo $studentIdent."<br>";
    echo "status of error when button is clicked".$error."<br>";

    if(isset($_POST["roleType"]))       $type=$_POST["roleType"]; 

    //Every PHP variable is now set; time for error checking................

    /*
    * Required boxes are everything from extention and 
    * register.php except for mName and pName
    */
    if($type != "")
    {
        $error="true";
        echo "status of error when doing empty checks of everybox".": ".$error."<br>";
    }
    
    if($error=="true")
    {
        $loginOK=true;
        echo "login is true"."<br>";
    }

    if($loginOK==true)
    {
        echo"insideloginif";
        // setcookie("pidRegister", $pid, time()+60*60*24, "/");

        // setcookie("mentormentee", $type, time()+60*60*24, "/");
        echo "before SQL methods";
        echo $error;
        require_once("db.php");

        //now the mentor and mentee database updating
        if($type == "mentor")
        {
            // $sql2 = "UPDATE Mentor SET `State`='$state', Major='$major', Minor='$minor', Eatery='$food', Hobbies='$hobby', `Location`='$place', Dorm='$dorm', AdviceType='$advice' WHERE StudentID='$studentIdent'";
            // $result2 = $mydb->query($sql2);
          
            echo "updated Mentor";
            
        }
        else //$type == "mentee"
        {
            // $sql2 = "UPDATE Mentee SET `State`='$state', Major='$major', Minor='$minor', Eatery='$food', Hobbies='$hobby', `Location`='$place', Dorm='$dorm', AdviceType='$advice' WHERE StudentID='$studentIdent'";
            // $result2 = $mydb->query($sql2);
       
            echo "updated Mentee";
            //Header("Homepage.html");
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

        <p> Delete your account </p>

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
                </tr>

                <tr>
                    <button name="doneButton">Confirm deletion</button>
                </tr>

            </table>

        </form>

        

        <a href="Homepage.html">
            <button>Go back to homepage</button>
        </a>

    </body>

</html>