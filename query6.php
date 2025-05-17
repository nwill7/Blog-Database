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
	   
	   $query = "SELECT * FROM hobbies
         WHERE hobby IN (
         SELECT hobby FROM hobbies
            GROUP BY hobby
            HAVING COUNT(hobby) > 1
      );";

	   $rowsresult = mysqli_query($db, $query);
	   ?><div>6. List the (pair of) users with same hobby. In each row, you have to display both users as well as the common hobby. </div>
         <?php
         $currval = null;
            while($thisrow=$rowsresult->fetch_assoc()){ 
                  if($currval == null){
                     $currval = $thisrow['hobby']; ?>
                     <div class="blog-title">(<?php echo $thisrow['username']; ?><?php
                  }else if($currval == $thisrow ['hobby']){
                     ?>, <?php echo $thisrow ['username'];?>
                     <?php
                  }else if($currval != $thisrow['hobby']){
                     ?>) Hobby : <?php echo $thisrow['hobby'];?></div>
                     <?php $currval = $thisrow['hobby'];?>
                     <div class="blog-title">(<?php echo $thisrow['username']; ?>
                  <?php
                  }
               } ?>) Hobby : <?php echo $currval;?></div><?php
         ?>
        <form method="post" action="queries.html">
        <input type="submit" class="btn" id="returnQueriesButton" value="Return to Queries Page">
        </form>
      </div>
   </div>
</body>
</html>