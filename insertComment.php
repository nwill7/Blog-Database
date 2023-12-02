<!DOCTYPE html>
<html lang="en">
     <head>
        <meta charset="UTF-8">
        <title>Database Design</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     </head>
<body>
<?php
	$dbuser = "root";
   	 $dbpass = "";
   $db = mysqli_connect("127.0.0.1", $dbuser, $dbpass, "users");
   session_start();
   $username = $_SESSION['username'];
   $sentiment = $_POST['sentiment'];
   $description = $_POST['commentdes'];
   $blogid = $_POST['theID'];
   $poster = $_POST['user'];
   $date = date('y-m-d');
   if ($username <> $poster) {
      $rowSQL = mysqli_query($db, "SELECT MAX( commentid ) AS max FROM comments;" );
      $row = mysqli_fetch_array( $rowSQL );
      $largestNumber = $row['max'];
      $largestNumber++;
      
      $rowSQL = mysqli_query($db,  "SELECT COUNT( commentid ) AS today FROM comments WHERE posted_by='$username' AND cdate='$date';" );
     $row1 = mysqli_fetch_array( $rowSQL );
     $today = $row1['today'];
      if($today <= 2){
        $rowSQL = mysqli_query($db,  "SELECT COUNT( commentid ) AS now FROM comments WHERE posted_by='$username' AND cdate='$date' AND blogid='$blogid';" );
        $row2 = mysqli_fetch_array( $rowSQL );
        $now = $row2['now'];
        if($now <= 0)
         {
            $query = mysqli_query($db, "INSERT INTO `comments` VALUES ('$largestNumber','$sentiment', '$description','$date', '$blogid', '$username')" );
         }
       }
      
   }

?>
<div class="container">
<div class="newslist">
   <p class="header-sub">Congrats, you made a comment!</p>
<form method="get" action="viewBlog.php">
<input type="hidden" name="blogid" value="<?php echo $blogid; ?>">
<input type="submit" value="Return to viewing blog">
</form>
</div>
</div>
</body>
</html>