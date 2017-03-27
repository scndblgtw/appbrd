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
  $img_file = mysqli_real_escape_string($conn, $_POST['imgFile']);
  $img_file_old = mysqli_real_escape_string($conn, $_POST['imgFileOld']);
  $urlGglPly = mysqli_real_escape_string($conn, $_POST['urlGglPly']);
  echo "$ img_file_old = ".$img_file_old."\n";
	
	echo "<br><br><br>";
	$url = '../jQuery-File-Upload/server/php/files/';	// Default
	$urlThumb = 'thumbnail/';
	
	if($img_file !== $img_file_old) {
		$tmp = $url.$img_file_old;
		if(is_file($tmp)) {
			unlink($tmp);
			echo "Deleted:: ";
		} else
			echo "No file:: ";
		echo $img_file_old."<br>";
		
		$tmp = $url.$urlThumb.$img_file_old;
		if(is_file($tmp)) {
			unlink($tmp);
			echo "Deleted:: ";
		} else
			echo "No file:: ";	
		echo $urlThumb.$img_file_old."<br>";
	}
	
	// exit;
	
  $sql_id = "id";
  $sql_title = "title";
  $sql_description = "description";
	$sql_updated_date = "updated_date";
	$sql_img_file = "img_file";
  $sql_url_gglply = "url_gglply";
	$sql = "UPDATE ".$G_table_appitems." SET ".$sql_title."='".$title."', ".$sql_updated_date."=now(), ".$sql_img_file."='".$img_file."', ".$sql_description."='".$description."', ".$sql_url_gglply."='".$urlGglPly."' WHERE ".$sql_id."='".$willUpdateId."';";
	
	// echo $sql;
	// echo "<br><br>";
	// var_dump($sql);
	// exit;

	$result = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);


	header("Location:$entry_ip/../part/article.php?id=".$willUpdateId."&rldNav=true&bgnpage=".$crrPage);
?>
