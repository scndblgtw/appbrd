<?php
  require(__DIR__."/misc/config.php");
  require(__DIR__."/misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  session_start();
  
	$loginID = mysqli_real_escape_string($conn, $_POST['loginID']);
	$loginPW = mysqli_real_escape_string($conn, $_POST['loginPW']);


	$sql = "SELECT id, loginID, loginPW FROM ".$G_table_users." WHERE loginID='$loginID'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	
	if(!empty($row)) {
		if($row['loginPW'] == $loginPW) {
			$_SESSION['isLogined'] = true;
			$_SESSION['loginID'] = $loginID;
			$_SESSION['loginTime'] = time();
			// header("Location:$entry_ip/index.php");
			echo '<script type="text/javascript">location.href="./index.php";</script>';
			return 0;
		}
		else {
			echo "PASSWORD ERROR";
			// header("Location:$entry_ip/index.php?id=-2");
			echo '<script>location.href="./index.php?id=-2";</script>';
			return 1;
		}
	} else {
		echo "ID DOESN'T EXIST";
			// header("Location:$entry_ip/part/article.php?id=-3");
			echo '<script>location.href="./index.php?id=-3";</script>';
		return 1;
	}
?>