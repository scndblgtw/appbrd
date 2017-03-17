<div>
<?php
	require(__DIR__."/../misc/config.php");
	require(__DIR__."/../misc/db.php");
	$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  
	$GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
	if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
	
	$crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
	if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
	
	
	$G_table_appitems = "appitems";
	$G_table_users = "users";
  
	session_start();
	$isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
	if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
	$loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
	if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; }
  
  
  if(empty($GET_ID) === false){ // '===' is better than '=='
    $sql = "SELECT ".$G_table_appitems.".id, title, created_date, updated_date, img_file, description FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".id=".$GET_ID;
    // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
		
		echo '<img id="launcher_icon_img" src="" width="75" height="75" onCLick="loadThumbnail('."'".htmlspecialchars($row['img_file'])."'".')"/>';
	  echo '<span>  <span> loginID</span>';
		echo '<span id="article_date_float">c: <span>'.htmlspecialchars($row['created_date']).'</span> <br> u: <span>'.htmlspecialchars($row['updated_date']).'</span></span>  </span>';
		
    echo "<pre>".strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>")."</pre>";
  } else {
    echo 'No article!';
  }
  
	$goLoginScr = true;
	require_once(__DIR__."/../isLogged.php");
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
    echo '<input type="hidden" size="2" name="willDeleteId"  value="'.$GET_ID.'">'."\n";
	?>
	
	<input type="hidden" role="uploadcare-uploader" />
	<input type="button" value="예" class="btn btn-success" onClick="submitWhatForm('control/delete_act.php', <?php echo $crrPage ?>);">
	<input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $GET_ID?>, <?php echo $crrPage ?>);">
</form>

<script>
$(document).ready(function(){
	loadThumbnail('<?php echo htmlspecialchars($row['img_file']) ?>');
});
</script>