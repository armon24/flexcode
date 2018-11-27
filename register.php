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

//Variables from furtherRegistration.php
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
    if(isset($_POST["pass1"]))          $pass1=$_POST["pass1"];
    if(isset($_POST["pass2"]))          $pass2=$_POST["pass2"];
    if(isset($_POST["roleType"]))       $type=$_POST["roleType"]; 

    //Setting PHP variables for furtherRegistration.php form variables
    if(isset($_POST["state"]))          $state=$_POST["state"];
    if(isset($_POST["major"]))          $major=$_POST["major"];
    if(isset($_POST["minor"]))          $minor=$_POST["minor"];
    if(isset($_POST["food"]))           $food=$_POST["food"]; 
    if(isset($_POST["hobby"]))          $hobby=$_POST["hobby"];
    if(isset($_POST["place"]))          $place=$_POST["place"];
    if(isset($_POST["dorm"]))           $dorm=$_POST["dorm"];
    if(isset($_POST["advice"]))         $advice=$_POST["advice"];
    
    //Every PHP variable is now set; time for error checking................

    /*
    * Required boxes are everything from furtherRegistration, and everything
    * from register.php except for mName and pName
    */
    if(empty($studentid) || empty($email) 
    || empty($pid) || empty($fName) || empty($lName)
    || empty($gender) || empty($dob) || empty($gradeLevel)
    || empty($pass1) || empty($pass2) || empty($roleType)
    || empty($state) || empty($major) || empty($minor)
    || empty($food) || empty($hobby) || empty($place)
    || empty($dorm) || empty($advice))
    {
        $error=true;
    }

    //Not sure if I should double check the passwords to be the same string again
    if($pass1 == $pass2)
    {
        $error=true;
    }

    if(!$error)
    {
        //last minute changes which would flag $loginOK traditionally

        setcookie("pidRegister", $pid, time()+60*60*24, "/");

        //Probably need to do an insert into the database here

        //require_once("db.php);
        //$sql = "INSERT INTO users (val) VALUES (val)";
        //$result = $mydb->query($sql);

        //if $_POST("roleType") == "mentor"
        //$sql = "INSERT INTO mentors (val) VALUES (val)";
        //else
        //$sql = "INSERT INTO mentees (val) VALUES (val)";

        Header("homepage.php");
        
    }

  }

?>

<!doctype html>

<html>

    <head>
        <!-- Background Stuff -->
        <title> Register | MentorMatch </title>
        <meta charset="utf-8"/>

        <!-- Link to our overall CSS sheet -->
        <!-- <script src="main.js"></script>  -->

        <!-- Style for this sheet only -->
        <style>
            .errlabel {color:red};

            meter {
                -webkit-appearance: none;
                -moz-appearance: none;
                    appearance: none;

                margin: 0 auto 1em;
                width: 100%;
                height: 0.5em;

                /* Applicable only to Firefox */
                background: none;
                background-color: rgba(0, 0, 0, 0.1);
            }

            meter::-webkit-meter-bar {
                background: none;
                background-color: rgba(0, 0, 0, 0.1);
            }

            meter[value="1"]::-webkit-meter-optimum-value { background: red; }
            meter[value="2"]::-webkit-meter-optimum-value { background: orange; }
            meter[value="3"]::-webkit-meter-optimum-value { background: yellow; }
            meter[value="4"]::-webkit-meter-optimum-value { background: green; }
        </style>

        <!-- Importing a Javascript library known as "zxcvbn" for Password Checking -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>

        <!-- Importing a library for Ajax use. Taken from HW14 -->
        <script src="jquery-3.1.1.min.js"></script>

        <!-- JavaScript right here -->
        <script>

            /*
            * Declares a variable to be used in the passwordCheck method
            */
            var strength = {
                0: "Poor",
                1: "Weak",
                2: "Moderate",
                3: "Good",
                4: "Strong"
            }
            
            /*
            * Will indicate the strength of a the Password being used
            */
            function passwordCheck()
            {
                var password = document.getElementById("password");
                var meter = document.getElementById("passwordStrengthMeter");
                var text = document.getElementById("passwordStrengthText");

                var val = password.value;
                var result = zxcvbn(val);

                // Update the password strength meter
                meter.value = result.score;

                // Update the text indicator
                if (val !== "") 
                {
                    text.innerHTML = "Password Strength: " + strength[result.score]; 
                } else 
                {
                    text.innerHTML = "";
                }
            }
            
            var asyncRequest = new XMLHttpRequest();

            /*
            * Method that will set up and send the asynchronous request to either
            * mentorRegistration or menteeRegistration
            */
            function getContent()
            {
                //The code below is taken directly from Ajax homework
                try
                {
                    //asyncRequest   //create request object
                    
                    //register event handler
                    asyncRequest.onreadystatechange=stateChange;
                    var url="furtherRegistration.php";  //?id="+id;
                    asyncRequest.open('GET',url,true);  // prepare the request
                    asyncRequest.send(null);  // send the request
                }
                catch (exception)
                {
                    alert(exception);
                }
            }

            /*
            * Will connect mentorRegistration.php or menteeRegistration.php
            * via Ajax code
            */
            function stateChange() 
            {
                // If request completed successfully
                if(asyncRequest.readyState==4 && asyncRequest.status==200) 
                {
                    document.getElementById("contentArea").innerHTML = asyncRequest.responseText;
                }
            }

            function init()
            {
                //First eventListener is for password strength
                if(password)
                {
                    password.addEventListener('input', passwordCheck, false);
                }

                //Next eventListener is for Ajax regardless of which radio button is clicked
                document.getElementById("mentorBox").addEventListener("click", getContent);
                document.getElementById("menteeBox").addEventListener("click", getContent);
            }

            document.addEventListener("DOMContentLoaded", init);

        </script>
    </head>

    <body>

        <h1>Pamplin MentorMatch</h1>       <!-- Should be replaced with an official image later -->

        <p>Pamplin MentorMatch is a student-made and Pamplin-run program seeking to pair upperclassmen mentors and first-year students. </p>

        <p> Registration! </p>

        <form id ="registerForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 

            <table>
                <tr>
                    <td>
                        <label>Student ID</label>
                    </td>
                    <td>
                        <input type="tel" id="sID" name="studentID" placeholder="Ex: 123456789" />
                    </td>

                    <td>
                        <?php 
                            $ifEmptyError=false;
                            if($error && empty($username)) 
                            {
                                echo "<span class='errlabel'> Please enter your 9 digit VT Student ID Number! </span>"; 
                                $ifEmptyError = true;
                            }
                                

                            if($ifEmptyError == false && strlen($studentid) <= 9)
                                echo "<span class='errlabel'> Please enter a 9 digit number! </span>";

                            if($ifEmptyError == false)
                            {
                                if(stripos($studentid, 'a') === false)
                                {
                                    //All numbers, we're okay!
                                }
                                else
                                {
                                    echo "<span class='errlabel'> Please only enter digits! </span>";
                                }
                            }  
                        ?>
                    </td>
                    
                </tr>

                <tr>
                    <td>
                        <label>Email</label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class="input" type="email" name="email" size="25" placeholder="pid@vt.edu">
                    </td>

                    <td>
                        <?php 
                            if($error && empty($email)) 
                            {
                                echo "<span class='errlabel'> Please enter your valid VT email address! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>PID</label>
                    </td>
                    <td>
                        <input class="input" type="text" name="pid" size="25" placeholder="pid">
                    </td>
                    <td>
                        <?php 
                            if($error && empty($pid)) 
                            {
                                echo "<span class='errlabel'> Please enter your valid VT pid! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>First Name</label> &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class="input" type="text" name="fName" size="25" placeholder="Jonathan">
                    </td>
                    <td>
                        <?php 
                            if($error && empty($fName)) 
                            {
                                echo "<span class='errlabel'> Please enter your first name! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Middle Name (optional)</label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class="input" type="text" name="mName" size="25" placeholder="Smith">
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Last Name</label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class="input" type="text" name="lName" size="25" placeholder="Johnson" >
                    </td>

                    <td>
                        <?php 
                            if($error && empty($lName)) 
                            {
                                echo "<span class='errlabel'> Please enter your first name! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Preferred Name / Nickname (optional) </label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class="input" type="text" name="pName" size="25" placeholder="Jon">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Gender</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Gender" name="gender" list="genList" />

                        <datalist id="genList">
        
                            <option value="Male">
                            <option value="Female">
                            <option value="Prefer not to answer">

                        </datalist>
                    </td>

                    <td>
                        <?php 
                            if($error && empty($gender)) 
                            {
                                echo "<span class='errlabel'> Please select an option! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Date of Birth</label>
                    </td>
                    <td>
                        <input name="dob" type="date"/>
                    </td>
                    <td>
                        <?php 
                            if($error && empty($dob)) 
                            {
                                echo "<span class='errlabel'> Please enter your date of birth! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Grade level</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Select your grade level" name="gradeLevel" list="list" />
            
                            <datalist id="list">

                                <option value="Freshman">
                                <option value="Sophomore">
                                <option value="Junior">     
                                <option value="Senior">

                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error && empty($gradeLevel)) 
                            {
                                echo "<span class='errlabel'> Please select your grade level! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label id="pass">Password</label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input type="password" id="password" name="pass" size="25">
                    </td>
                    <td>
                        <meter max="4" id="passwordStrengthMeter"> </meter> 
                    </td>
                    <td>
                        <p id="passwordStrengthText"> </p>
                    </td>

                    <td>
                        <?php 
                            if($error && empty($pass1)) 
                            {
                                echo "<span class='errlabel'> Please set up a password! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label id="passAgain">Confirm Password</label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class ="input" type="password" id="passAgainID" name="passAgain" size="25">
                    </td>

                    <td>
                        <?php 
                            if($error && empty($pass2)) 
                            {
                                echo "<span class='errlabel'> Please re-enter the password! </span>"; 

                                if(strcmp($pass1, $pass2) != 0)
                                {
                                    echo "<span class='errlabel'> Passwords do not match! </span>"; 
                                }
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label  id="type">Would you like to be a mentor or mentee? </label>
                    </td>
                    <td>
                        <input type="radio" name="roleType" id="mentorBox" value="mentor"> Mentor <br>
                        <input type="radio" name="roleType" id="menteeBox" value="mentee"> Mentee <br>
                    </td>
                </tr>

            </table>
            <div id="contentArea">
                <!-- This div will be filled by furtherRegistration page -->
            </div>

            <?php

                if($error && empty($major)) 
                {
                    echo "<span class='errlabel'> Please select your major! </span>"; 

                }  

            ?>
        </form>

    </body>

</html>