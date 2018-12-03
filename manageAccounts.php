<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Manage Accounts | MentorMatch</title>
        <link href="resources/css/bootstrap.min.css" rel="stylesheet" />
        <script src="resources/jquery-3.1.1.min.js"></script>
        <script src="resources/js/bootstrap.min.js"></script>
        <link href="resources/css/styles.css" rel="stylesheet" />
</head>
<body>
    <div class="navbar navbar-inverse navbar-static-top">
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
                            <li><a href="adminHome.html">Home</a></li>
                            <li><a href="manageAccounts.php">Manage Accounts</a></li>                        
                            <li><a href="Analytics.html">Analytics</a></li>
                            <li><a href="thankyou.html">Log-out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <form id="f" method="post" action="adminManageAccounts.php" >
        <table>
            <tr>
                <td>             
                    <p id="allproducts">Select a Student ID to manage</p>
                </td>
            </tr>
            <tr>
                <td>
                    <?php    
                        require_once("db.php");
                        $sql = "SELECT DISTINCT StudentID FROM user";  
                        $result = $mydb->query($sql);
                        echo "<select name='studentid'><option id='blank'>-</option>";
                        while($row=mysqli_fetch_array($result)){
                            echo "<option value='" .$row["StudentID"]. "'>".$row["StudentID"]."</option>";
                        }
                        echo "</select>";
                    ?>
                </td>        
            </tr>
        </table><br>
        <input type="submit" value="Submit">
    </form>
    <div id="contentArea">&nbsp;</div>
</body>
</html>