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

//$error="false";

//Error-checking
$error = "false";
$loginOK = null;

if(isset($_POST["doneButton"]))
  {
    //Setting PHP variables for register.php form variables  

    //Getting our PK from login, studentID
    session_start();
    $studentIdent = $_SESSION["studentID"];
    echo $studentIdent."<br>";
    echo "status of error when button is clicked".$error."<br>";

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
    
    //Every PHP variable is now set; time for error checking................

    /*
    * Required boxes are everything from extention and 
    * register.php except for mName and pName
    */
    if(empty($studentid) || empty($email) 
    || empty($pid) || empty($fName) || empty($lName)
    || empty($gender) || empty($dob) || empty($gradeLevel)
    || empty($pass1) || empty($pass2) || empty($roleType)
    || empty($state) || empty($major) || empty($minor)
    || empty($food) || empty($hobby) || empty($place)
    || empty($dorm) || empty($advice))
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

        //does insertions to the User database based on combinations of empty middlename and preferred name
        if(empty($mName)==false && empty($pName)==false)
        {
            $sql = "UPDATE User SET Email='$email', PID='$pid', FirstName='$fName', MiddleName='$mName', LastName='$lName', Nickname='$pName', Gender='$gender', DOB='$dob', Grade='$gradeLevel', `Password`='$pass1' WHERE StudentID='$studentIdent'";
            $result = $mydb->query($sql);

            echo "updated User with A middle name and A nickname";
        }
        elseif(empty($mName)==false && empty($pName)==true)
        {
            $sql = "UPDATE User SET Email='$email', PID='$pid', FirstName='$fName', MiddleName='$mName', LastName='$lName', Nickname=NULL, Gender='$gender', DOB='$dob', Grade='$gradeLevel', `Password`='$pass1' WHERE StudentID='$studentIdent'";
            $result = $mydb->query($sql);
    
            echo "updated User with A middle name and no nickname";
        }
        elseif(empty($mName)==true && empty($pName)==false)
        {
            echo $dob;
            $sql = "UPDATE User SET Email='$email', PID='$pid', FirstName='$fName', MiddleName=NULL, LastName='$lName', Nickname='$pName', Gender='$gender', DOB='$dob', Grade='$gradeLevel', `Password`='$pass1' WHERE StudentID='$studentIdent'";
            $result = $mydb->query($sql);
      
            echo "updated User with no middle name and A nickname";
        }
        else
        {
            $sql = "UPDATE User SET Email='$email', PID='$pid', FirstName='$fName', Middlename=NULL, LastName='$lName', Nickname=NULL, Gender='$gender', DOB='$dob', Grade='$gradeLevel', `Password`='$pass1' WHERE StudentID='$studentIdent'";
            $result = $mydb->query($sql);

            echo "updated User with no middle name and no nickname";
        }

        //now the mentor and mentee database updating
        if($type == "mentor")
        {
            $sql2 = "UPDATE Mentor SET `State`='$state', Major='$major', Minor='$minor', Eatery='$food', Hobbies='$hobby', `Location`='$place', Dorm='$dorm', AdviceType='$advice' WHERE StudentID='$studentIdent'";
            $result2 = $mydb->query($sql2);
          
            echo "updated Mentor";
        }
        else //$type == "mentee"
        {
            $sql2 = "UPDATE Mentee SET `State`='$state', Major='$major', Minor='$minor', Eatery='$food', Hobbies='$hobby', `Location`='$place', Dorm='$dorm', AdviceType='$advice' WHERE StudentID='$studentIdent'";
            $result2 = $mydb->query($sql2);
       
            echo "updated Mentee";
        }

        Header("Homepage.html");
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
        <title>Edit Account | MentorMatch</title>
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
            
            var hiddenArray = document.getElementsByClassName("hidden");

            function visibilitySwitch()
            {
                if(hiddenArray.item(0).className == "hidden")
                {
                    for(var x=0; x < hiddenArray.length; x++)
                    {
                        hiddenArray[x].style.visibility="visible";
                    }
                }                
            }

            function startVisible()
            {
                if(hiddenArray.item(0).className == "hidden")
                {
                    for(var x=0; x < hiddenArray.length; x++)
                    {
                        hiddenArray[x].style.visibility="visible";
                    }
                }
            }

            function init()
            {
                //First eventListener is for password strength
                if(password)
                {
                    password.addEventListener('input', passwordCheck, false);
                }

                if(document.getElementById("mentorBox").checked == "false")
                {
                    document.getElementById("mentorBox").addEventListener("load", startVisible);
                }

                document.getElementById("mentorBox").addEventListener("click", visibilitySwitch);
                document.getElementById("menteeBox").addEventListener("click", visibilitySwitch);


            }

            document.addEventListener("DOMContentLoaded", init);

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
                        <li><a href="beforeloginlanding.html">Log-out</a></li>
                    </ul>
                </div>
            </div>
    </div>

        <h1>Edit Account | Pamplin MentorMatch</h1>       <!-- Should be replaced with an official image later -->

        <p>Pamplin MentorMatch is a student-made and Pamplin-run program seeking to pair upperclassmen mentors and first-year students. </p>

        <p> Edit your account! </p>

        <form id ="registerForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 

            <table>
                <!-- <tr>
                    <td>
                        <label>Student ID</label>
                    </td>
                    <td>
                        <input type="number" id="sID" name="studentID" placeholder="Ex: 123456789" value='<?php echo $studentid;?>'/>
                    </td>

                    <td>
                        <?php 
                            $ifEmptyError=false;
                            if($error && empty($studentid)) 
                            {
                                echo "<span class='errlabel'> Please enter your 9 digit VT Student ID Number! </span>"; 
                                $ifEmptyError = true;
                            }
                                

                            if($error && $ifEmptyError == false && strlen($studentid) < 9)
                                echo "<span class='errlabel'> Please enter ALL 9 digits! </span>";

                            // if($error && $ifEmptyError == false)
                            // {
                            //     if(stripos($studentid, 'a') === false)
                            //     {
                            //         //All numbers, we're okay!
                            //     }
                            //     else
                            //     {
                            //         echo "<span class='errlabel'> Please only enter digits! </span>";
                            //     }
                            // }  
                        ?>
                    </td>
                    
                </tr> -->

                <tr>
                    <td>
                        <label>Email</label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class="input" type="email" name="email" size="25" placeholder="jwalk6@vt.edu" value='<?php echo $email;?>'>
                    </td>

                    <td>
                        <?php 
                            if($error=="true" && empty($email)) 
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
                        <input class="input" type="text" name="pid" size="25" placeholder="jwalk6" value='<?php echo $pid;?>'>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($pid)) 
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
                        <input class="input" type="text" name="fName" size="25" placeholder="Ex: Jonathan" value='<?php echo $fName;?>'>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($fName)) 
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
                        <input class="input" type="text" name="mName" size="25" placeholder="Ex: Walker" value='<?php if($mName==""){}else{echo $mName;}?>'>
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Last Name</label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class="input" type="text" name="lName" size="25" placeholder="Ex: Smith" value='<?php echo $lName;?>' >
                    </td>

                    <td>
                        <?php 
                            if($error=="true" && empty($lName)) 
                            {
                                echo "<span class='errlabel'> Please enter your last name! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Preferred Name / Nickname (optional) </label>  &nbsp; &nbsp;
                    </td>
                    <td>
                        <input class="input" type="text" name="pName" size="25" placeholder="Jon" value='<?php if($pName==""){}else{echo $pName;}?>'>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Gender</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Gender" name="gender" list="genList" value='<?php echo $gender;?>' />

                        <datalist id="genList">
        
                            <option value="Male">
                            <option value="Female">
                            <option value="Prefer not to answer">

                        </datalist>
                    </td>

                    <td>
                        <?php 
                            if($error=="true" && empty($gender)) 
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
                        <input name="dob" type="date" value='<?php echo $dob;?>'/>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($dob)) 
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
                        <input type="text" placeholder="Select your grade level" name="gradeLevel" list="list" value='<?php echo $gradeLevel;?>' />
            
                            <datalist id="list">

                                <option value="Freshman">
                                <option value="Sophomore">
                                <option value="Junior">     
                                <option value="Senior">

                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($gradeLevel)) 
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
                        <input type="password" id="password" name="pass" size="25" value='<?php echo $pass1;?>'>
                    </td>
                    <td>
                        <meter max="4" id="passwordStrengthMeter"> </meter> 
                    </td>
                    <td>
                        <label id="passwordStrengthText"> </label>
                    </td>

                    <td>
                        <?php 
                            if($error=="true" && empty($pass1)) 
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
                        <input class ="input" type="password" id="passAgainID" name="passAgain" size="25" value='<?php echo $pass2;?>'>
                    </td>

                    <td>
                        <?php 
                            if($error=="true" && empty($pass2)) 
                            {
                                if(strcmp($pass1, $pass2) != 0)
                                {
                                    echo "<span class='errlabel'> Passwords do not match! </span>"; 
                                }
                                else
                                {
                                    echo "<span class='errlabel'> Please re-enter the password! </span>"; 
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
                            <!-- OnChange = getContent() -->
                        <input type="radio" name="roleType" id="mentorBox" value="mentor" <?php if($type == "mentor") echo "checked";?> > Mentor <br>
                        <input type="radio" name="roleType" id="menteeBox" value="mentee" <?php if($type == "mentee") echo "checked";?> > Mentee <br>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="hidden" id="type">Where are you from? </label>
                    </td>
                    <td>
                        <input class="hidden" type="text" name="state" placeholder="Select a state" list="stateList" value='<?php echo $state?>'/>
                            
                            <datalist id="stateList">
                                <option value="Alabama">
                                <option value="Alaska">
                                <option value="Arizona">
                                <option value="Arkansas">
                                <option value="California">
                                <option value="Colorado">
                                <option value="Connecticut">
                                <option value="Delaware">
                                <option value="Florida">
                                <option value="Georgia">
                                <option value="Hawaii">
                                <option value="Idaho">
                                <option value="Illinois">
                                <option value="Indiana">
                                <option value="Iowa">
                                <option value="Kansas">
                                <option value="Kentucky">
                                <option value="Louisiana">
                                <option value="Maine">
                                <option value="Maryland">
                                <option value="Massachusetts">
                                <option value="Michigan">
                                <option value="Minnesota">
                                <option value="Mississippi">
                                <option value="Missouri">
                                <option value="Montana">
                                <option value="Nebraska">
                                <option value="Nevada">
                                <option value="New Hampshire">
                                <option value="New Jersey">
                                <option value="New Mexico">
                                <option value="North Carolina">
                                <option value="North Dakota">
                                <option value="Ohio">
                                <option value="Oklahoma">
                                <option value="Oregon">
                                <option value="Pennsylvania">
                                <option value="Rhode Island">
                                <option value="South Carolina">
                                <option value="South Dakota">
                                <option value="Tennessee">
                                <option value="Texas">
                                <option value="Utah">
                                <option value="Vermont">
                                <option value="Virginia">
                                <option value="West Virginia">
                                <option value="Wisconsin">
                                <option value="Wyoming">
                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($state)) 
                            {
                                echo "<span class='errlabel'> Please select a US State! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="hidden" id="type">What's your major? </label>
                    </td>
                    <td>
                        <input class="hidden" type="text" name="major" placeholder="Select a major" list="majorList" value='<?php echo $major;?>' />
                            
                            <datalist id="majorList">
                                <option value="Accounting and Information Systems">
                                <option value="Business Information Technology">
                                <option value="Economics">
                                <option value="Finance">
                                <option value="Management">
                                <option value="Marketing">
                                <option value="Real Estate">
                                <option value="Not listed">
                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($major)) 
                            {
                                echo "<span class='errlabel'> Please select your major! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="hidden" id="type">What's your minor? (If none, select 'Not listed')</label>
                    </td>
                    <td>
                        <input class="hidden" type="text" name="minor" placeholder="Select a minor" list="minorList" value='<?php echo $minor?>' />
                            
                            <datalist id="minorList">
                                <option value="Digital Marketing Strategy">
                                <option value="Entrepreneurship-New Venture Growth">
                                <option value="International Business">
                                <option value="Leadership">
                                <option value="Professional Sales">
                                <option value="Other (College of Engineering, College of Science, etc.)">
                                <option value="Not listed">
                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($minor)) 
                            {
                                echo "<span class='errlabel'> Please select your minor! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label class="hidden" id="type">What's your favorite on-campus place to eat? </label>
                    </td>
                    <td>
                        <input class="hidden" type="text" name="food" placeholder="Select a dining hall" list="foodList" value='<?php echo $food?>' />
                            
                            <datalist id="foodList">
                                <option value="Turner Place">
                                <option value="West End Market">
                                <option value="D2">
                                <option value="DX">
                                <option value="Deets Place">
                                <option value="Owens Food Court">
                                <option value="Burger 37">
                                <option value="ABP">
                                <option value="Not listed">
                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($food)) 
                            {
                                echo "<span class='errlabel'> Please select a dining hall! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="hidden" id="type">What are your hobbies? </label>
                    </td>
                    <td>
                        <input class="hidden" type="text" name="hobby" placeholder="Select a hobby" list="hobbyList" value='<?php echo $hobby?>'/>
                            
                            <datalist id="hobbyList">
                                <option value="Art">            <label>(Ex: Photography, painting, etc.)</label>
                                <option value="Music">          <label>(Ex: In a band, with friends or independently, etc.)</label>
                                <option value="Sports">         <label>(Ex: On a team, intramural or with friends, etc.)</label>
                                <option value="Videogames">     <label>(Ex: On a team, casually or with friends etc.)</label>
                                <option value="Other">          <label>(Ex: Something unique to you!)</label>
                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($hobby)) 
                            {
                                echo "<span class='errlabel'> Please select a hobby category! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="hidden" id="type">What's your favorite area on campus? </label>
                    </td>
                    <td>
                        <input class="hidden" type="text" name="place" placeholder="Select a place" list="placeList" value='<?php echo $place?>' />
                            
                            <datalist id="placeList">
                                <option value="Drillfield">
                                <option value="Pylons/War Memorial Chapel">
                                <option value="Torgerson Bridge">
                                <option value="Newman Library">
                                <option value="War Memorial Gym">
                                <option value="McComas Gym">
                                <option value="Squires">
                                <option value="Burruss Hall">
                                <option value="Cassell Coliseum">
                                <option value="Lane Stadium">
                                <option value="Hahn Horticulture Garden">
                                <option value="Not listed">
                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($place)) 
                            {
                                echo "<span class='errlabel'> Please select a location on campus! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="hidden" id="type">Where did you live/where are you living on-campus? </label>
                    </td>
                    <td>
                        <input class="hidden" type="text" name="dorm" placeholder="Select a dorm" list="dormList" value='<?php echo $dorm?>'/>
                            
                            <datalist id="dormList">
                                <option value="East Ambler Johnston">
                                <option value="West Ambler Johnston">
                                <option value="Barringer Hall">
                                <option value="Main Campbell Hall">
                                <option value="East Campbell Hall">
                                <option value="Cochrane Hall">
                                <option value="East Eggleston Hall">
                                <option value="Main Eggleston Hall">
                                <option value="West Eggleston Hall">
                                <option value="Hillcrest Hall">
                                <option value="Harper Hall">
                                <option value="Johnson Hall">
                                <option value="Lee Hall">
                                <option value="Miles Hall">
                                <option value="New Hall West">
                                <option value="Newman Hall">
                                <option value="New Residence Hall East">
                                <option value="Pritchard">
                                <option value="O'Shaughnessy Hall">
                                <option value="Payne Hall">
                                <option value="Slusher Hall">
                                <option value="Peddrew-Yates Hall">
                                <option value="Pearson Hall">
                                <option value="New Cadet Hall">
                                <option value="Vawter Hall">
                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($dorm)) 
                            {
                                echo "<span class='errlabel'> Please select a dorm! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="hidden" id="type"> What kind of primary advice are you seeking? </label>
                    </td>
                    <td>
                        <input class="hidden" type="text" name="advice" placeholder="Select a concept" list="adviceList" value='<?php echo $advice?>' />
                            
                            <datalist id="adviceList">
                                <option value="Academic"> <label>(Ex: course selection and Professor suggestions)</label>
                                <option value="Social">   <label>(Ex: Clubs and Greek life)</label>
                                <option value="Career">   <label>(Ex: Internships, Co-Ops and Research)</label>
                                <option value="Other">    <label>(Ex: 'Just looking for life advice!')>
                            </datalist>
                    </td>
                    <td>
                        <?php 
                            if($error=="true" && empty($advice)) 
                            {
                                echo "<span class='errlabel'> Please select a primary advice type! </span>"; 
                            }  
                        ?>
                    </td>
                </tr>

                <tr>
                    
                    <td>
                        <br>
                        <input class="hidden" type="submit" name="doneButton" value="Submit Changes" />
                    </td>

                </tr>  

            </table>

        </form>

        <a href="Homepage.html">
            <button class="hidden">Go back to homepage</button>
        </a>

    </body>

</html>