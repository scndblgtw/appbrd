<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

  
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  
  $willUpdateId = $_POST['willUpdateId'];
  $POST_ID = $_POST["id"];	//Undefined index:
  $G_table_appitems = "appitems";
  $G_table_users = "users";

  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $loginID = mysqli_real_escape_string($conn, $_POST['loginID']);
  $loginPW = $_POST['loginPW'];	//Undefined index:
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $imgFile = mysqli_real_escape_string($conn, $_POST['imgFile']);

  $sql_id = "id";
  $sql_title = "title";
  $sql_description = "description";
	$sql_updated_date = "updated_date";
	$sql_img_file = "img_file";
	$sql = "UPDATE ".$G_table_appitems." SET ".$sql_title."='".$title."', ".$sql_updated_date."=now(), ".$sql_img_file."='".$imgFile."', ".$sql_description."='".$description."' WHERE ".$sql_id."='".$willUpdateId."';";
	
	echo $sql;
	// exit;

	$result = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);


	header("Location:$entry_ip/../part/article.php?id=".$willUpdateId."&rldNav=true&bgnpage=".$crrPage);
?>
