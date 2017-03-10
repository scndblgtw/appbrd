<?php
  // echo __DIR__."<br>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  // echo __FILE__."<BR>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd\index.php
  // echo dirname(__FILE__)."<BR>";	// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  require(__DIR__."/../config/config.php");
  require(__DIR__."/../lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	echo " </span>"; }
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  
  
  $LIMIT_PER_PAGE = 4; // from nav.php
  
  $sql_id = "id";
  
  // ini_set("session.gc_probability", 1);
  // ini_set("session.gc_divisor", 1);
  // ini_set("session.cache_expire", 10); 
  // ini_set("session.gc_maxlifetime", 10);
  
  session_start();
  $isLogined = $_SESSION['isLogined'];
  $loginID = $_SESSION['loginID'];

  if(empty($GET_ID)){
    echo "<br><a class='error_red'>[X] The article which will be modified is None.</a><br>";
    exit;
  } else {
    // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
    $sql = "SELECT ".$G_table_appitems.".id, title, description FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".id=".$GET_ID;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
  }
  
  $goLoginScr = true;
  require_once(__DIR__."/../isLogged.php");
?>

<!-- <form class="" action="modify_process.php" method="post"> -->
<form class="" name="whatForm">
  <div class="form-group">
    <label for="form-title">제목:</label>
    <!-- <input type="text" class="form-control" name="title" id="form-title" value=<?php //echo "'".htmlspecialchars($row['title'])."'"?>> -->
    <input type="text" class="form-control" name="title" id="form-title" value=<?php echo '"'.htmlspecialchars($row['title']).'"'?>>
  </div>

  <div class="form-group">
    <label for="form-loginID">작성자: <?php echo $loginID?></label>
	<input type="hidden" class="form-control" name="loginID" id="form-loginID" value=<?php echo $loginID?>>
  </div>

  <div class="form-group">
    <label for="form-description">본문:</label>
    <textarea class="form-control" name="description" id="form-description" rows="10"><?php echo strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>")?> </textarea>
  </div>

  <?php
    echo '<input type="hidden" size="2" name="willUpdateId" value="'.$GET_ID.'">'."\n";
  ?>
  
  <input type="hidden" role="uploadcare-uploader" />
  <!-- <input type="submit" value="수정 완료" name="name" class="btn btn-success"> -->
  <input type="button" value="수정 완료" class="btn btn-success" onClick="submitWhatForm('control/modify_act.php', <?php echo $crrPage ?>);">
  <input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $GET_ID?>, <?php echo $crrPage ?>);">
</form>

<script>
</script>