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
	   $query = "SELECT username FROM userinformation 
         WHERE username NOT IN(
            SELECT created_by FROM blogs);";
	   $result = mysqli_query($db, $query);
	   ?><div>4. Display all the users who never posted a blog.</div> <?php
	   while($row=$result->fetch_assoc())
	   { ?>
	      <div class="blog-title"><?php echo $row['username'];?></div>
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