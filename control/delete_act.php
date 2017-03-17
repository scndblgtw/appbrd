<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  echo "[, *]bgnpage=".$crrPage;
  
  $willDeleteTopicId = $_POST['willDeleteId'];
  echo "$ willDeleteTopicId = ".$willDeleteTopicId."\n";
  
	
  $user_id = $_POST['uid'];
  echo "$ user_id = ".$user_id."\n";
  

  $G_table_appitems = "appitems";
  $G_table_users = "users";


  $sql = "DELETE FROM ".$G_table_appitems." WHERE id=".$willDeleteTopicId;
	$result = mysqli_query($conn, $sql);
	var_dump($result); echo "@@@result;;\n\n";
	
	header("Location:$entry_ip/../part/article.php?id=-6&rldNav=true&bgnpage=".$crrPage);
?>
