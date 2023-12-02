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
	   session_start();
	?>
      <div class="wrapper">
	   <div class="container">
	   	<div class="newslist">
	      <form method="post" action="insertBlog.php">
	      	<label id="welcome-sign">New Blog Post</label>
	         <label class="input-label">Enter a blog subject:</label>
		 <input type="text" id="subject" class="input" name="subject" placeholder="Subject" required><br />

	         <label class="input-label">Enter a blog description:</label>
		 <input type="text" id="description" class="input" name="description" placeholder="Description" required><br />

	         <label class="input-label">Enter blog tags:</label>
		 <input type="text" id="tags" class="input" name="tags" placeholder="tag1,tag2,..."><br />

		 <input type="submit" name="submit" id="postButton" value="Post">
	      </form>
	   </div>
	   </div>
	</div>
     </body>
</html>