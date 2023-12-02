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

<div class="newslist">
<?php
   $dbuser = "root";
   $dbpass = "";
   $db = mysqli_connect("127.0.0.1", $dbuser, $dbpass, "users");
   session_start();
   $username = $_SESSION['username'];
   $id = $_GET['blogid'];

   $query = "SELECT * FROM blogs WHERE blogid = '$id';";
   $result = mysqli_query($db, $query);

   while($rows=$result->fetch_assoc())
   { ?>
      <div class="blog-title">Subject: <?php echo $rows['subject'];?></div>
      <div>Created By: <?php echo $rows['created_by'];?></div>
      <div>Posted On: <?php echo $rows['pdate'];?></div>
      <div class="blog-content"><?php echo $rows['description'];?></div>
   <?php
      $postedBy = $rows['created_by'];
   }

   $query = "SELECT * FROM blogstags WHERE blogid = '$id';";
   $result = mysqli_query($db, $query); ?>
   <p>Tags:</p>
   <?php
   while($rows=$result->fetch_assoc())
   { ?>
      <div><?php echo $rows['tag'];?></div>
   <?php
   }

?>
</div>
<br /> <br />
<?php
$query = "SELECT sentiment, description, cdate, posted_by FROM comments WHERE blogid = '$id';";
$result = mysqli_query($db, $query);
?>
<form method="POST" action= "followPage.php">
<input type= "hidden" id="theID" class="input" name="theID" value="<?php echo $id; ?>">
<input type= "hidden" id="po" class="input" name="po" value="<?php echo $rows['created_by']; ?>">
<input type= "hidden" id="user" class="input" name="user" value="<?php echo $createdBy; ?>">
<input class="btn" type="submit" value="Follow" >
</form>
<div class="newslist">
<p class="blog-sub">Comments:</p> <?php
while($rows=$result->fetch_assoc())
{ ?>
   <div><?php echo $rows['posted_by'];?></div>
   <div><?php echo $rows['cdate'];?></div>
   <div><?php echo $rows['sentiment'];?></div>
   <div><?php echo $rows['description'];?></div>
   <br />
<?php
}
?>
</div>
<br /> <br />
<div class="newslist">
<div class="blog-sub">Leave a comment:</div>
<form method="post" action="insertComment.php">
   <label for="sentiment">Choose a sentiment:</label>
   <select id="sentiment" name="sentiment">
      <option value="dummy">Select</option>
      <option value="positive">Positive</option>
      <option value="negative">Negative</option>
   </select>
   <br />
   <input type ="text" id="commentdes" class="input" name="commentdes" placeholder="Write comment here..." >
   <input type= "hidden" id="theID" class="input" name="theID" value="<?php echo $id; ?>">
   <input type= "hidden" id="user" class="input" name="user" value="<?php echo $postedBy; ?>">
   <input type="submit" value="Post comment">
</form>

</div>

<br /> <br />
<div class="newslist">

   <form method="post" action="newsFeed.php">
   <input type="submit" class="btn" id="returnNewsfeedButton" value="Return to Newsfeed">
</form>
</div>

</div>
</body>
</html>