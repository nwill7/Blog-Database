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
   $blogid = $_POST['theID'];
   $po = $_POST['po'];
   $poster = $_POST['user'];

   
    $insertf = "INSERT INTO follows (leadername, followername) VALUES (?, ?)";
    $stmtf = $db->prepare($insertf);
    $stmtf->bind_param("ss", $po, $username);
    $stmtf->execute();

?>
<div class="container">
<div class="newslist">
   <p class="header-sub">Congrats, you now following the user!</p>
<form method="get" action="viewBlog.php">
<input type="hidden" name="blogid" value="<?php echo $blogid; ?>">
<input type="submit" value="Return to viewing blog">
</form>
</div>
</div>
</body>
</html>