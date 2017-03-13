<?php
  require(__DIR__."/misc/config.php");
  require(__DIR__."/misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) { echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) { echo "[]bgnpage=".$crrPage;	echo "</span>"; }
  
  
  
  $Gget_again = isset($_GET["again"]) ? $_GET["again"] : "";
  $G_table_appitems = "appitems";
  $Gget_loginID = isset($_GET['loginID']) ? $_GET['loginID'] : "";
  
  
  
  $LIMIT_PER_PAGE = 4; // from nav.php
  
  
  $sql_id = "id";
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;  
?>

<div>
	<?php
		if($Gget_again == -1) {
		  echo "<a class='error_red'>[X] Two passwords are different. Again please.</a><br>";
		} else if($Gget_again == -2) {
			echo "<a class='error_red'>[X] The ID [".$Gget_loginID."] already taken. Register again, please.</a><br>";
		}
	?>
  <!-- <form class="" action="register_process.php" method="post"> -->
  <form class="" name="whatForm">
		<label for="form-title"><h3>회원 가입</h3></label>
    <div class="form-group">
      <label for="form-loginID">아이디:</label>
			<input type="text" class="form-control" name="loginID" id="form-loginID" placeholder="prefered ID" required>
    </div>	  
    <div class="form-group">
      <label for="form-nameNic">별명:</label>
      <input type="text" class="form-control" name="nameNic" id="form-nameNic" placeholder="prefered nic name" required>
    </div>	  
    <div class="form-group">
      <label for="form-loginPW">암호:</label>
      <input type="password" class="form-control" name="loginPW" id="form-loginPW" value="" required>
    </div>
		<div class="form-group">
      <label for="form-loginPWcf">암호 학인:</label>
      <input type="password" class="form-control" name="loginPWcf" id="form-loginPWcf" value="" required>
    </div>	  
    <input type="button" value="확인" class="btn btn-success" onClick="submitWhatForm('register_act.php');">
		<input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $GET_ID?>, <?php echo $crrPage ?>);">
  </form>
</div>