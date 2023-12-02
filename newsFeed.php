 <!DOCTYPE html>
 <html lang="en">
     <head>
        <meta charset="UTF-8">
        <title>Database Design</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	   function postButtonClicked()
	   {
	      window.location.href="postBlog.php";
	   }
	   function returnToHomePage()
	    {
	        window.location.href="home.php";
	    }

	   function init()
	   {
	      postButton.addEventListener("click", postButtonClicked);
	      returnHomepageButton.addEventListener("click", returnToHomePage);
	   }

	   window.addEventListener("DOMContentLoaded", init);
	</script>
     </head>
     <body>

	<?php
	$dbuser = "root";
   	 $dbpass = "";

    	   $db = mysqli_connect("127.0.0.1", $dbuser, $dbpass, "users");

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
           error_log("Hi I am an error and db username is " . $dbuser . "\r\n");     
    	   }

	   session_start();

	   $query = "SELECT blogid, subject FROM blogs ORDER BY pdate DESC;";
	   $result = mysqli_query($db, $query);
	?>

   <div class="wrapper">
   	<div class="header">
	      <label class="header-title">Blog Database</label>
	      <br />
	      <label class="header-sub">Create blogs or leave a comment</label>
    	</div>

	<div class="container">
		<div class="newslist">
	    <p class="header-sub">Hello <?php echo $_SESSION['username']; ?>!</p>
	    <input type="button" class="btn" id="postButton" value="Create a Blog Post">
	    <input type="button" class="btn" id="returnHomepageButton" value="Return to HomePage">
	    <br />
	</div>
	</div>

	<div class="container">
		<div class="newslist">
			<p class="header-sub">News Feed</p>
			<?php
            while ($rows = $result->fetch_assoc()) {
            ?>
      	<form method="get" action="viewBlog.php">
	 	      <input type ="hidden" name = "blogid" value="<?php echo $rows['blogid']; ?>">
		<?php $_SESSION['blogid'] = $rows['blogid']; ?>
				<input type="submit" value="<?php echo $rows['subject']; ?>">
	    	</form><?php
            }
			?>
		</div>
	</div>
   </div>
   </body>
</html>