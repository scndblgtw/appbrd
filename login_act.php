<?php
  require(__DIR__."/misc/config.php");
  require(__DIR__."/misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  session_start();
  
	$loginID = mysqli_real_escape_string($conn, $_POST['loginID']);
	$loginPW = mysqli_real_escape_string($conn, $_POST['loginPW']);


// echo "<br>==============<br>";

// echo $loginID."<br>==============<br>";
// echo $loginPW."<br>==============<br>";


	$sql = "SELECT id, loginID, loginPW FROM ".$G_table_users." WHERE loginID='$loginID'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	
// var_dump($sql);
// echo "<br>==============<br>";
// var_dump($result);
// echo "<br>==============<br>";
// var_dump($row);
// echo "<br>==============<br>";

// exit;

	// if(!empty($row)) {
	if(isset($row)) {
		if($row['loginPW'] == $loginPW) {
			$_SESSION['isLogined'] = true;
			$_SESSION['loginID'] = $loginID;
			$_SESSION['loginTime'] = time();
			echo '<script>location.href="./index.php?id=0";</script>';
			return 0;
		}
		else {
			echo '<script>location.href="./login_whl.php?id=-2";</script>';
			return 1;
		}
	} else {
			echo '<script>location.href="./login_whl.php?id=-3";</script>';
		return 1;
	}
?>