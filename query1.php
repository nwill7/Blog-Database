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
      <div>1. List all the blogs of user X, such that all the comments are
      		positive for these blogs.</div>
	<?php
	   $dbuser = "root";
           $dbpass = "";
           $db = mysqli_connect("127.0.0.1", $dbuser, $dbpass, "users");
	   $username = $_POST['username2X'];

	   $query = "SELECT DISTINCT subject, blogs.description FROM blogs, comments
			WHERE blogs.created_by = '$username'
			AND blogs.blogid = comments.blogid 
			AND NOT blogs.blogid IN (
            SELECT blogid 
            FROM comments 
            WHERE sentiment = 'negative');";

	   $result = mysqli_query($db, $query);

	   while($row=$result->fetch_assoc())
	   { ?>
	      <div class="blog-title">Subject: <?php echo $row['subject'];?></div>
	      <div class="blog-title">Description: <?php echo $row['description'];?></div>
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