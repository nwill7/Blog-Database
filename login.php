<!DOCTYPE html>
<html>
	<head>
	    <title>Login</title>
	    <script>
		function iButtonClicked()
		{
	    	    window.location.href="initDB.php";
		}

	        function init()	
		{
		    initButton.addEventListener("click", iButtonClicked);
		}

        	window.addEventListener("DOMContentLoaded", init);
	    </script>
	</head>
	<body>
	<?php

    $dbuser = "root";
   	$dbpass = "";

    	$db = new mysqli("127.0.0.1", $dbuser, $dbpass, "users");

    	if ( ! $db ) // connection failed
   		{
       		print "<p>Could not connect to database</p>";
       		print ( mysqli_connect_error() );
       		print "</body></html>";
        	mysqli_close($db);
        	die();  // go no further than this line!
   		}
    	else
    	{
        	print "<p>Connection succeeded</p>";
    	}

	$newLusername = $_POST["lusername"];
	$newLpassword = $_POST["lpassword"];

	$query = "SELECT username, password FROM userinformation";
	$result = mysqli_query($db, $query);

	$successCheck = false;

	while ($row = mysqli_fetch_row($result))
	{
		if($row[0] == $newLusername AND $row[1] == $newLpassword)
		{
	    	print("You have logged in successfully");
	    	$successCheck = true;
	    	session_start();
	    	$_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $newLusername;
		    header("Location: /DB Proj/home.php");
		}
	}
	
	if($successCheck == false)
	{
	    print("Invalid login information");
	    header("Location: /DB Proj/loginFail.html");
	}
	
	?>

	</body>
</html>