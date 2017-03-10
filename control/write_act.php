<?php
  // echo __DIR__."<br>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  // echo __FILE__."<BR>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd\index.php
  // echo dirname(__FILE__)."<BR>";	// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  require(__DIR__."/../config/config.php");
  require(__DIR__."/../lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  // $conn = db_init("localhost", "root", "987654321", "opentutorials");
  // $conn = db_init();

  
  $G_table_appitems = "appitems";
  $G_table_users = "users";

  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $loginID = mysqli_real_escape_string($conn, $_POST['loginID']);
  $loginPW = $_POST['loginPW'];	//Undefined index:
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  
  
  // echo $title."<b>";
  // echo $loginID."<b>";
  // echo $loginPW."<b>";
  // echo $description."<b>";
  // exit;
  
echo "*************************";

$sql = "SELECT * FROM ".$G_table_users." WHERE loginID='".$loginID."'";
// $sql = "SELECT * FROM user WHERE name='".$_POST['author']."'";
$result = mysqli_query($conn, $sql);
// var_dump($result);
// echo $result->num_rows;
if($result->num_rows == 0) {	//Already user registered so that May not require this IF statement.
  $sql = "INSERT INTO ".$G_table_users."(loginID, loginPW) VALUES('".$loginID."', '".$loginPW."')";
  mysqli_query($conn, $sql);
  $user_id = mysqli_insert_id($conn);
} else {
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['id'];
}
// $row = mysqli_fetch_assoc($result);
// var_dump($row);
// $user_id = $row['id'];
// echo $sql;


// exit;
// echo $_POST['title'];
// $sql = "INSERT INTO topic(title, description, author, created) VALUES('".$_POST['title']."', '".$_POST['description']."', '".$_POST['author']."', now())";
$sql = "INSERT INTO ".$G_table_appitems."(title, description, user_id, created_date) VALUES('".$title."', '".$description."', '".$user_id."', now())";
$result = mysqli_query($conn, $sql);
$id = mysqli_insert_id($conn);

header("Location:$entry_ip/../part/article.php?id=".$id."&rldNav=true");	// '..' added after moved here(control folder).
?>
