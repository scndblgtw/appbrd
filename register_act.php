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
		if($loginPW == $loginPWcf) {
		  // echo "<br>[OK]Two passwords are the same.<br>";			
		  $sql = "INSERT INTO ".$G_table_users."(loginID, nameNic, loginPW, joined_date) VALUES('".$loginID."', '".$nameNic."', '".$loginPW."', now())";
		  mysqli_query($conn, $sql);
  

		  echo "<br><a class='confirm_royalblue'>[O] You are registered. Welcome to join. Login please. @register_whl</a><br>";
		  // header("Location:$entry_ip/login.php?again=1");
		  echo '<script>location.href="./index.php?id=-11";</script>';
		  return 0;
		  // exit;
		
		} else {
		  // echo "<br>[X]Two passwords are the different. @register_act<br>";
		  // header("Location:$entry_ip/register.php?again=-1");
		  echo '<script>location.href="./register_whl.php?id=-1";</script>';
		  exit;
		}
	} else {
		// echo "<br><a class='error_red'>[X] The ID [".$loginID."] already taken. Register again, please. @register_act</a><br>";
		echo "<script>location.href='./register_whl.php?id=-2&loginID={$loginID}';</script>";
		return 0;
	}
	
	// header("Location:$entry_ip/register.php?id=".$id);
?>