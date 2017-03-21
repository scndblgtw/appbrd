<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	echo " </span>"; }
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  
  
  $LIMIT_PER_PAGE = 4; // from nav.php
  
  $sql_id = "id";
  
  
  session_start();
  $isLogined = $_SESSION['isLogined'];
  $loginID = $_SESSION['loginID'];

  if(empty($GET_ID)){
    echo "<br><a class='error_red'>[X] The article which will be modified is None.</a><br>";
    exit;
  } else {
    $sql = "SELECT ".$G_table_appitems.".id, title, description, created_date, updated_date, img_file FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".id=".$GET_ID;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
  }
  
  $goLoginScr = true;
  require_once(__DIR__."/../isLogged.php");
?>

<!-- <form class="" action="modify_process.php" method="post"> -->
<form class="" name="whatForm">	
	<div class="form-group">
    <!-- <label for="form-title">제목:</label> -->
    <input type="text" class="form-control" name="title" id="form-title" value=<?php echo '"'.htmlspecialchars($row['title']).'"'?>>
  </div>
	
	<img id="launcher_icon_img" src=".\control/" width="75" height="75"/>
	<input type="hidden" name="imgFile" id="form-imgFile" value="<?php echo htmlspecialchars($row['img_file'])?>" />
	<input type="hidden" name="imgFileOld" id="form-imgFile-old" value="<?php echo htmlspecialchars($row['img_file'])?>" />
	
	<label id="id_float_center" for="form-loginID"> <?php echo $loginID?></label>
	<input type="hidden" class="form-control" name="loginID" id="form-loginID" value=<?php echo $loginID?>>
	
	<span id="article_date_float">
	c: <span><?php echo htmlspecialchars($row['created_date'])?></span> <br>
	u: <span><?php echo htmlspecialchars($row['updated_date'])?></span>
	</span>
	
  <?php
		if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []img_file=";  echo htmlspecialchars($row['img_file']);	echo "</span>";	}
  ?>
	
  <div class="form-group">
    <!-- <label for="form-description">본문:</label> -->
    <textarea class="form-control" name="description" id="form-description" rows="10"><?php echo strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>")?> </textarea>
  </div>

  <?php
    echo '<input type="hidden" size="2" name="willUpdateId" value="'.$GET_ID.'">'."\n";
  ?>
  
  <input type="hidden" role="uploadcare-uploader" />
  <input type="button" value="수정 완료" class="btn btn-success" onClick="theOriginImg=null;submitWhatForm('control/modify_act.php', <?php echo $crrPage ?>);">
  <input type="button" value="취소" class="btn btn-success" onClick="theOriginImg=null;document.getElementById('form-imgFile').value !== document.getElementById('form-imgFile-old').value ? returnBackTheArticle3in(<?php echo $GET_ID?>, <?php echo $crrPage ?>, document.getElementById('form-imgFile').value ) : returnBackTheArticle2in(<?php echo $GET_ID?>, <?php echo $crrPage ?>)">
</form>

<script>
$(document).ready(function(){
	loadThumbnail('<?php echo htmlspecialchars($row['img_file']) ?>');
});
</script>

<?php
  require(__DIR__."/file_uploader.php");
?>