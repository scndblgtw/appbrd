<div>
  <?php
	require(__DIR__."/config/config.php");
	require(__DIR__."/lib/db.php");
	$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  
    $Gget_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
	if(GLOBAL_TST) {	echo "[]Gget_ID=";  var_dump($Gget_ID);	}
	
	$crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
    if(GLOBAL_TST) {	echo ",bgnpage=".$crrPage;	}
	
	
	$G_table_appitems = "appitems";
	$G_table_users = "users";
  
  ini_set("session.gc_probability", 1);
  ini_set("session.gc_divisor", 1);
  ini_set("session.cache_expire", 10); 
  ini_set("session.gc_maxlifetime", 10);
  
	session_start();
	$isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
    if(GLOBAL_TST) {	echo ",isLogined=";  var_dump($isLogined);	}
    $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
    if(GLOBAL_TST) {	echo ",loginID=";  var_dump($loginID);	}
  
  
  if(empty($Gget_ID) === false){ // '===' is better than '=='
    // echo file_get_contents($Gget_ID.".txt");
    // $sql = "SELECT * FROM ".$G_table_appitems." WHERE id=";
    $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$Gget_ID;
    // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".id=".$Gget_ID;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
    echo '<p>'.htmlspecialchars($row['loginID']).'</p>';
    echo "<pre>".strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>")."</pre>";
  } else {
    echo 'No artice!';
  }
  
    $goLoginScr = true;
    require_once(__DIR__."/./isLogged.php");
  ?>
</div>

<br><br>	

<!-- <form class="" action="delete_process.php" method="post"> -->
<form class="" name="whatForm">
	<div class="form-group">
      <label for="form-title">이 아이템을 삭제할까요?</label>
      <label for="form-title">(삭제된 아이템은 복구할 수 없습니다.)</label>
	</div>
	
	<?php
    echo '<input type="hidden" size="2" name="willDeleteId"  value="'.$Gget_ID.'">'."\n";
	//echo '<input type="hidden" size="2" name="uid"  value="'.$Gget_user_id.'">'."\n";
	?>
	
	<input type="hidden" role="uploadcare-uploader" />
	<input type="button" value="예" class="btn btn-success" onClick="submitWhatForm('delete_act.php', <?php echo $crrPage ?>);">
	<!-- <input type="submit" value="예" name="notYet" class="btn btn-success"> -->
	<!-- <input type="button" value="취소" class="btn btn-success" onClick="history.back();"> -->
	<input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $Gget_ID?>, <?php echo $crrPage ?>);">
	<!-- <input type="button" value="취소" class="btn btn-success" onClick="$('article').load('article.php', {id:<?php echo $Gget_ID ?>});"> -->
	<!-- <input type="button" value="취소" class="btn btn-success" onClick="$('article').load('article.php?id=<?php echo $Gget_ID ?>');"> -->
</form>

<script>
</script>