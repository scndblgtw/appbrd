<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);


	$GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
   
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}  

  $img_file_old = isset($_GET["fl_ld"]) && $_GET["fl_ld"]!==''? $_GET["fl_ld"] : null;
  if(GLOBAL_TST) {	echo ", fl_ld=".$fl_ld;	echo "</span>"; }
	
	
	
	echo "<br><br><br>";
  // $img_file = mysqli_real_escape_string($conn, $_POST['img_file']);
  // $img_file_old = $_POST['img_file_old'];
  echo "$ img_file_old = ".$img_file_old."\n";
	
	echo "<br><br><br>";
	$url = '../jQuery-File-Upload/server/php/files/';	// Default
	$urlThumb = 'thumbnail/';
	
	// if($img_file !== $img_file_old) {
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
	// }
	
	// exit;
	

	header("Location:$entry_ip/../part/article.php?id=".$GET_ID."&bgnpage=".$crrPage);
?>
