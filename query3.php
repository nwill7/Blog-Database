<!DOCTYPE html>
<html lang="en">
     <head>
        <meta charset="UTF-8">
        <title>Database Design</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     </head>
<body>
   <div class="wrapper">
      <div class="container">
	<?php
	   $dbuser = "root";
           $dbpass = "";
           $db = mysqli_connect("127.0.0.1", $dbuser, $dbpass, "users");
	   $usernameX = $_POST['username3X'];
	   $usernameY = $_POST['username3Y'];
	   $query = "SELECT leadername FROM follows 
	   WHERE followername = '$usernameX' AND leadername IN (
				SELECT leadername 
				FROM follows 
				WHERE followername = '$usernameY');";
	   $result = mysqli_query($db, $query);
	   ?><div>3. List the users who are followed by both X and Y. Usernames X and Y are inputs
		from the user.</div> <?php
	   while($row=$result->fetch_assoc())
	   { ?>
	      <div class="blog-title"><?php echo $row['leadername'];?></div>
	   <?php
	   }
	?>
        <form method="post" action="queries.html">
        <input type="submit" class="btn" id="returnQueriesButton" value="Return to Queries Page">
        </form>
      </div>
   </div>
</body>
</html>