<!DOCTYPE html>
<?php
   	$dbuser = "root";
    $dbpass = "";
   $db = mysqli_connect("127.0.0.1", $dbuser, $dbpass, "users");
   session_start();
   $username = $_SESSION['username'];
   $subject = $_POST['subject'];
   $description = $_POST['description'];
   $tags = $_POST['tags'];
   $array=explode(',',$tags);

   $date = date('y-m-d');
   $rowSQL = mysqli_query($db, "SELECT MAX( blogid ) AS max FROM blogs;" );
   $row = mysqli_fetch_array( $rowSQL );
   $largestNumber = $row['max'];
   $largestNumber++;
   
   //this should check for the limit
   $rowSQL = mysqli_query($db,  "SELECT COUNT( blogid ) AS today FROM blogs WHERE created_by='$username' AND pdate='$date';" );
   $row1 = mysqli_fetch_array( $rowSQL );
   $today = $row1['today'];

    if($today <= 1){

    $query = mysqli_query($db, "INSERT INTO `blogs` VALUES ('$largestNumber', '$subject', '$description','$date', '$username')" );
    }

   $query1 = "SELECT max(blogid) FROM blogs;";
   
   $result = mysqli_query($db, $query1);
   while ($therow = mysqli_fetch_row($result)){
      print($therow[0]);
      $id = $therow[0];
   }

   $sqlq = "insert into insert blogs(subject, description, created_by) values ($subject, $description, $username)";

   $num = 0;
   foreach($array as $row){
      print($array[$num]);
      $insertQ = "INSERT INTO blogstags (blogid, tag) VALUES (?, ?)";
      $stmt = $db->prepare($insertQ);
      $stmt->bind_param("ss", $id, $array[$num]);
      $stmt->execute();
      $num = $num + 1;
   }
   
   header("Location: /DB Proj/newsFeed.php");
?>