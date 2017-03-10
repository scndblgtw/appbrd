<?php
  // echo __DIR__."<br>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  // echo __FILE__."<BR>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd\index.php
  // echo dirname(__FILE__)."<BR>";	// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  require(__DIR__."/../config/config.php");
  require(__DIR__."/../lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  // $conn = db_init("localhost", "root", "987654321", "opentutorials");
  // $conn = db_init();

  // var_dump($_POST); echo "\n";
  
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  echo "[, *]bgnpage=".$crrPage;
  
  
  
  $willDeleteTopicId = $_POST['willDeleteId'];
  echo "$ willDeleteTopicId = ".$willDeleteTopicId."\n";
  
  $user_id = $_POST['uid'];
  echo "$ user_id = ".$user_id."\n";
  
  echo "---\n";
  
 
 
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  
 



  $sql = "DELETE FROM ".$G_table_appitems." WHERE id=".$willDeleteTopicId;
   $result = mysqli_query($conn, $sql);
   var_dump($result); echo "@@@result;;\n\n";
// echo $sql;
   header("Location:$entry_ip/../part/article.php?id=-6&rldNav=true&bgnpage=".$crrPage);
?>
