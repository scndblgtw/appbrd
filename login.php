<?php
  // require(__DIR__."/config/config.php");
  // require(__DIR__."/lib/db.php");
  // $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

  
  $Gget_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  // $Gget_ID = $_GET["id"];
  echo "[, *]Gget_ID=";  var_dump($Gget_ID);
	
  $Gget_AGAIN = isset($_GET["again"]) ? $_GET["again"] : "";
  //$G_table_appitems = "appitems";
  

  $sql_id = "id";
  
  ini_set("session.gc_probability", 1);
  ini_set("session.gc_divisor", 1);
  ini_set("session.cache_expire", 10); 
  ini_set("session.gc_maxlifetime", 10);
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  echo "[, *]isLogined=";  var_dump($isLogined);
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  echo "[, *]loginID=";  var_dump($loginID);
?>

<div>
  <!-- <form class="" name="loginForm" action="login_process.php" method="post"> -->
  <form class="" name="loginForm">
	<label for="form-title"><h3>사용자 로그인</h3></label>
    <div class="form-group">
       <label for="form-loginID">아이디:</label>
       <input type="text" class="form-control" name="loginID" id="form-loginID" placeholder="my ID">
    </div>

    <div class="form-group">
       <label for="form-loginPW">암호:</label>
       <input type="password" class="form-control" name="loginPW" id="form-loginPW" value="">
    </div>

	<!-- <input type="hidden" role="uploadcare-uploader" /> -->
    <input type="hidden" />
    <input type="button" value="로그인" class="btn btn-success" onClick="submitLoginForm();">
    <!-- <input type="submit" value="로그인" name="login" class="btn btn-success"> -->
	<input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2(<?php echo $Gget_ID ?>);">
  
	<!-- <a href="./register.php" class="btn btn-info">회원가입</a> -->
	<input type="button" value="회원가입" class="btn btn-info" onClick="gotoRegisterForm();">
  </form>


<?php
if($Gget_AGAIN == 1) {
  echo "<a class='confirm_royalblue'><br>[O] You are registered. Welcome to join. Login please.</a><br>";
}
?>
</div>


<script>
function gotoRegisterForm(){
	$.ajax({
		type: 'GET',
		// url: <?php echo "'".__DIR__."\..\login.php?action=1'" ?>,
		url: <?php echo "'./register.php?{$sql_id}={$Gget_ID}'" ?>,
		// url: <?php echo "'./register.php?{$sql_id}={$Gget_ID}&action=1'" ?>,
		dataType : 'text',
		error : function() {
		  alert('Loading a process page of REGISTER failed!');
		},
		success: function(data) {
			$('article').html(data);
		}
	});
}





function returnBackTheArticle() {
	// alert("returnBackTheArticle");
    //document.getElementById("demo").style.color = "red";
	$('article').load('part/article.php?id=<?php echo $Gget_ID ?>');
}
function returnBackTheArticle2(inx){
	// alert("returnBackTheArticle2");	
	//$("#tstButton").click(function(){
	//alert("inx= " +inx);
	
		$.ajax({
			type: 'GET',
			//url: 'part/article.php?id=<?php //echo $Gget_ID ?>',
			url: 'part/article.php?id=' +inx,
			dataType : 'text',
			error : function() {
			  alert('Fail!!');
			},
			success: function(data) {
				$('article').html(data);
			}
		});
	//})
}






function submitLoginForm(){
	// alert("submitLoginForm()");
	var queryString = $("form[name=loginForm]").serialize();
	
	// alert("submitLoginForm( " +queryString +" )");
	$.ajax({
		type: 'POST',
		url: './login_act.php',
		data: queryString,
		dataType : 'text',
		error : function() {
		  alert('Fail!!');
		},
		success: function(data) {
			//$('header').load("./part/header.php");
			$('article').html(data);
			refreshHeader();
		}
	});
}




</script>