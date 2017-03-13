<?php
  require(__DIR__."/misc/config.php");
  require(__DIR__."/misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  session_start();
  
 
	$loginID = mysqli_real_escape_string($conn, $_POST['loginID']);
	$nameNic = $_POST['nameNic'];
	$loginPW = mysqli_real_escape_string($conn, $_POST['loginPW']);
	$loginPWcf = mysqli_real_escape_string($conn, $_POST['loginPWcf']);
	
	$G_table_users = "users";

	
	$sql = "SELECT id, nameNic, loginPW FROM ".$G_table_users." WHERE loginID='".$loginID."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	  
	  
	  
	
	if(empty($row)) {
	  echo "<br>The ID ".$loginID." OK.<br>";
	  
		if($loginPW == $loginPWcf) {
		  // echo "<br>[OK]Two passwords are the same.<br>";			
		  $sql = "INSERT INTO ".$G_table_users."(loginID, nameNic, loginPW, joined_date) VALUES('".$loginID."', '".$nameNic."', '".$loginPW."', now())";
		  mysqli_query($conn, $sql);
  
		  header("Location:$entry_ip/login.php?again=1");
		  exit;
		
		} else {
		  // echo "<br>[X]Two passwords are the different.<br>";
		  header("Location:$entry_ip/register.php?again=-1");
		  exit;
		}
	} else {
		header("Location:$entry_ip/register.php?again=-2&loginID=$loginID");
		exit;
	}
	
	header("Location:$entry_ip/register.php?id=".$id);
?>