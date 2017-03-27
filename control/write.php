<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
  
  
  $G_table_appitems = "appitems";
  
  
  $LIMIT_PER_PAGE = 4; // from nav.php
  $sql_id = "id";
  
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; }
  
  $goLoginScr = true;
  require_once(__DIR__."/../isLogged.php");
?>


<!-- <form class="" action="write_process.php" method="post"> -->
<form class="" name="whatForm">
	<img id="launcher_icon_img" src="./Pavicon512x512_empty.png" width="75" height="75" alt=" Upload image"/>
	<input type="hidden" name="imgFile" id="form-imgFile" />
	
	<label id="id_float_center" for="form-loginID"> <?php echo $loginID?></label>
	<input type="hidden" class="form-control" name="loginID" id="form-loginID" value=<?php echo $loginID?>>
	
  <div>
    <!-- <label for="form-title">제목:</label> -->
		<input class="form-control" type="text" name="title" id="form-title" placeholder="앱 이름.">
  </div>

  <div>
    <!-- <label for="form-description">본문:</label> -->
    <textarea class="form-control" name="description" id="form-description" rows="10" placeholder="앱 설명을 적으세요."></textarea>
  </div>
	
  <div>
		<input class="form-control" type="text" name="urlGglPly" id="form-urlGglPly" placeholder="앱 주소."><br>
  </div>
	
  <!-- <input type="hidden" role="uploadcare-uploader" /> -->
  <!-- <input type="submit" value="쓰기 완료" name="name" class="btn btn-success"> -->
  <input type="button" value="쓰기 완료" class="btn btn-success" onClick="theOriginImg=null;submitWhatForm('control/write_act.php');">
	<input type="button" value="취소" class="btn btn-success" onClick="theOriginImg=null;document.getElementById('form-imgFile').value ? returnBackTheArticle3in(<?php echo $GET_ID?>, <?php echo $crrPage ?>, document.getElementById('form-imgFile').value ) : returnBackTheArticle2in(<?php echo $GET_ID?>, <?php echo $crrPage ?>)">
</form>

<?php
  require(__DIR__."/file_uploader.php");
?>