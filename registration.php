<!DOCTYPE html>
<html>
	<head>
		<title>Registration</title>
	</head>
	<body>
	<?php

	$dbuser = "root";
   	 $dbpass = "";

    	$db = mysqli_connect("localhost", $dbuser, $dbpass, "users");

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
			  
    	}

	$newUsername = $_POST["username"];
	$newPassword = $_POST["password"];
	$newFirstName = $_POST["firstName"];
	$newLastName = $_POST["lastName"];
	$newEmail = $_POST["email"];

	//checks for duplicate
	$query = "SELECT username, email FROM userinformation";
	$result = mysqli_query($db, $query);
	$failCheck = false;

	while ($row = mysqli_fetch_row($result))
	{
	    if($row[0] == $newUsername) //username already registered
	    {
	    	$failCheck = true;
	    	header("Location: /registrationFail.php?flag1=true");
	    }

	    if($row[1] == $newEmail) //email already registered
	    {
	    	$failCheck = true;
	      header("Location: /registrationFail.php?flag2=true");
	    }

	}

	if($failCheck == false){
		$insertQ = "INSERT INTO userinformation (username, password, firstName, lastName, email) VALUES (?, ?, ?, ?, ?)";

		$stmt = $db->prepare($insertQ);
		$stmt->bind_param("sssss", $newUsername, $newPassword, $newFirstName, $newLastName, $newEmail);
		$stmt->execute();

	        session_start();
	        $_SESSION['loggedin'] = true;
	        $_SESSION['username'] = $newUsername;

		header("Location: /DB Proj/index.html");
	}

	?>

	<p>Registration successful</p>
	</body>
</html>
