<?php
  require(__DIR__."/misc/config.php");
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) { echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
	
  $Gget_AGAIN = isset($_GET["again"]) ? $_GET["again"] : "";
  

  $sql_id = "id";
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) { echo "[]isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) { echo "[]loginID=";  var_dump($loginID);	echo "</span>"; }
?>

<div>
  <!-- <form class="" name="loginForm" action="login_process.php" method="post"> -->
  <form class="" name="whatForm">
		<label for="form-title"><h3>사용자 로그인</h3></label>
		<div class="form-group">
			<label for="form-loginID">아이디:</label>
			<input type="text" class="form-control" name="loginID" id="form-loginID" placeholder="my ID">
		</div>
		
		<div class="form-group">
			<label for="form-loginPW">암호:</label>
			<input type="password" class="form-control" name="loginPW" id="form-loginPW" value="">
		</div>
		
		<input type="hidden" />
		<input type="button" value="로그인" class="btn btn-success" onClick="submitWhatForm('login_act.php');">
		<input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $GET_ID ?>);">
		
		<input type="button" value="회원가입" class="btn btn-info" onClick="goLoginForm('register.php');">
  </form>


<?php
	if($Gget_AGAIN == 1) {
		echo "<br><a class='confirm_royalblue'>[O] You are registered. Welcome to join. Login please.</a><br>";
	}
?>
</div>