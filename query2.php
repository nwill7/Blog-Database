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
	   $query = "SELECT posted_by, COUNT(*) AS postercomments
         FROM comments
         GROUP BY posted_by
         ORDER BY postercomments DESC";
	   $result = mysqli_query($db, $query);
	   ?><div>2. List the users who posted the most number of comments; if there is a tie, list all the users who have a tie. </div>
	      <div class="blog-title"><?php
         $row = $result->fetch_assoc();  
         echo $row['posted_by'];
            $check = $row['posted_by']; ?></div>
            <?php
            while($row=$result->fetch_assoc()){
               if($row['posted_by'] == $check){
                  ?>
                  <div class="blog-title"><?php echo $row['posted_by']; ?></div>
               <?php
               }
            }
	   ?>
        <form method="post" action="queries.html">
        <input type="submit" class="btn" id="returnQueriesButton" value="Return to Queries Page">
        </form>
      </div>
   </div>
</body>
</html>