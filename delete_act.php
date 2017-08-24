<?php
  require(__DIR__."/./misc/config.php");
  require(__DIR__."/./misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  echo "[, *]bgnpage=".$crrPage;
  
  $willDeleteTopicId = $_POST['willDeleteId'];
  echo "$ willDeleteTopicId = ".$willDeleteTopicId."\n";
  
  $img_file = $_POST['imgFile'];
  echo "$ img_file = ".$img_file."\n";
	
  $user_id = $_POST['uid'];
  echo "$ user_id = ".$user_id."\n";
	
	echo "<br><br><br>";
	$url = '../jQuery-File-Upload/server/php/files/';	// Default
	$urlThumb = 'thumbnail/';
	$tmp = $url.$img_file;
	echo $tmp."<br>";
	if(is_file($tmp)) {
		unlink($tmp);
		echo "Deleted:: ".$img_file."<br>";
	} else
		echo "No file:: ".$img_file."<br>";
	
	$tmp = $url.$urlThumb.$img_file;
	echo $tmp."<br>";
	if(is_file($tmp)) {
		unlink($tmp);
		echo "Deleted:: ".$urlThumb.$img_file."<br>";
	} else
		echo "No file:: ".$urlThumb.$img_file."<br>";

  $G_table_appitems = "appitems";
  $G_table_users = "users";


  $sql = "DELETE FROM ".$G_table_appitems." WHERE id=".$willDeleteTopicId;
	$result = mysqli_query($conn, $sql);
	var_dump($result); echo "@@@result;;\n\n";
	
	// header("Location:$entry_ip/../part/article.php?id=-6&rldNav=true&bgnpage=".$crrPage);
	header("Location:$entry_ip/./index.php?id=".$id."&bgnpage=".$crrPage."&rldNav=true");
?>
