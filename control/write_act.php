<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

  
  $G_table_appitems = "appitems";
  $G_table_users = "users";

  if(empty($_POST['loginID'])) {
  	echo "Wrong access! $ _POST['loginID']= ".$_POST['loginID']."<br>";
  	exit;
  }

  // echo "Right access? $ _POST['loginID']= ".$_POST['loginID']."<br>";
  // exit;

  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $loginID = mysqli_real_escape_string($conn, $_POST['loginID']);	//Undefined index:
  $loginPW = $_POST['loginPW'];	//Undefined index:
  $description = mysqli_real_escape_string($conn, $_POST['editor1']);
  // $description = mysqli_real_escape_string($conn, $_POST['description']);
  $imgFile = mysqli_real_escape_string($conn, $_POST['imgFile']);
  $urlGglPly = mysqli_real_escape_string($conn, $_POST['urlGglPly']);

	echo "<br>".$title."<br>";
	echo "<br>".$loginID."<br>";
	echo "<br>".$imgFile."<br>";
	echo "<br>".$urlGglPly."<br>";
	// exit;

	$sql = "SELECT * FROM ".$G_table_users." WHERE loginID='".$loginID."'";
	$result = mysqli_query($conn, $sql);

	if($result->num_rows == 0) {	//Already user registered so that May not require this IF statement.
		// $sql = "INSERT INTO ".$G_table_users."(loginID, loginPW) VALUES('".$loginID."', '".$loginPW."')";
		// mysqli_query($conn, $sql);
		// $user_id = mysqli_insert_id($conn);
	} else {
		$row = mysqli_fetch_assoc($result);
		$user_id = $row['id'];
	}

	$sql = "INSERT INTO ".$G_table_appitems."(title, description, user_id, created_date, img_file, url_gglply) VALUES('".$title."', '".$description."', '".$user_id."', now(), '".$imgFile."', '".$urlGglPly."')";
	$result = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);

	// header("Location:$entry_ip/../part/article.php?id=".$id."&rldNav=true");	// '..' added after moved here(control folder).
	header("Location:$entry_ip/../index.php?id=".$id."&rldNav=true");
?>
