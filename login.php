<?php
  $pid="";
  $password="";
  $remember="no";
  $error = false;
  $loginOK = null;

  if(isset($_POST["login"])){

    if(isset($_POST["pid"])) $pid=$_POST["pid"];
    if(isset($_POST["password"])) $password=$_POST["password"];
    if(isset($_POST["remember"])) $remember=$_POST["remember"];

    //Check if the Username and Password are empty
    if(empty($pid) || empty($password)) {
      $error=true;
    }

    //Set a cookie to remember the email if Remember button is Yes
    if(!empty($pid) && $remember=="yes"){
      setcookie("pidLogin", $pid, time()+60*60*24, "/");
    }

    //If there are no errors in how we input, we must verify with the database
    if(!$error){
      require_once("db.php");
      $sql = "select Password from user where ID='$pid'";
      $result = $mydb->query($sql);

      $row=mysqli_fetch_array($result);
      if ($row)
      {
        if(strcmp($password, $row["Password"]) ==0 )
        {
          $loginOK=true;
        } else 
        {
          $loginOK = false;
        }
      }

      if($loginOK) {
        //set session variable to remember the pid on the homepage. 
        session_start();
        $_SESSION["pid"] = $pid;

        Header("Location:homepage.php");
      }
    }
  }

 ?>

<!doctype html>

<html>

    <head>
        
        <!-- Background Stuff -->
        <title> Login | MentorMatch </title>
        <meta charset="utf-8"/>

        <!-- Link to our overall CSS sheet -->
        <!-- Link to our overall JavaScript file: <script src="main.js"></script>  -->

        <!-- Style for this sheet only -->
        <style>
            .errlabel {color:red};
        </style>
        
        <script src="jquery-3.1.1.min.js"></script>
        <!-- JavaScript right here -->
        <script type="text/javascript">
            function passToggle() 
            {
                var x = document.getElementById("pass");
                if (x.type === "password") 
                {
                    x.type = "text";
                } else 
                {
                x.type = "password";
                }
            }

            $("#password").password('toggle');
        
        </script>

    </head>

    <body>

        <h1>Pamplin MentorMatch</h1>       <!-- Should be replaced with an official image later -->

        <p>Pamplin MentorMatch is a student-made and Pamplin-run program seeking to pair upperclassmen mentors and first-year students. </p>
        
        <div> Log In to Your Account! </div>

        <form id ="loginForm" method="post"> 

            <table>
                <tr>
                    <td>
                        <p class="boxFields">PID</p>
                    </td>

                    <td>
                        <input class="input" type="text" name="pid" size="25" value=
                        
                        <?php
                            echo "'";
                            if(!empty($pid))
                            {
                                echo $pid;
                            }
                            else if(isset($_COOKIE['pidLogin']))
                            {
                                echo $_COOKIE['pidLogin'];
                            }
                            echo "'";
                        ?>  />
                        
                        <?php 
                            if($error && empty($username)) 
                                echo "<span class='errlabel'> Please enter a Virginia Tech PID! </span>"; 
                        ?>
                        
                    </td>   
                </tr>

                <tr>
                    <td>
                        <p class="boxFields">Password</p>
                    </td>

                    <td>
                        <input class ="input" type="password" name="password" id="pass" size="25">
                        <input type="checkbox" onclick="passToggle()"> <label>Show Password</label>
                    </td>   
                </tr>
            </table>

            <table>
                <tr>
                    <input type="checkbox" name="remember" value="yes"/><label>Remember Me</label>
                    
                </tr>
                
                <tr>
                    <?php 
                        if(!is_null($loginOK) && $loginOK==false) echo "<span class='errlabel'> PID and Password do not match! </span>"; 
                    ?>
                </tr>

                <tr>
                    <p></p>
                    <input type="submit" name="login" value="Login" size="25">
                </tr>
            </table>

            <p class="register">Don't have an account? Click <a href="register.php"> here to register!</a> </p>

        </form>
      
    </body>

</html>