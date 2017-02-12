﻿<div>
	<?php
	require(__DIR__."/config/config.php");
	require(__DIR__."/lib/db.php");
	$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  
    $Gget_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
	echo "[]Gget_ID=";  var_dump($Gget_ID);
	
	$crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
    echo ",bgnpage=".$crrPage;
	
	
	$G_table_appitems = "appitems";
	$G_table_users = "users";
  
  
	session_start();
	$isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
    echo "[]isLogined=";  var_dump($isLogined);
    $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
    echo "[]loginID=";  var_dump($loginID);
  
  
	if(empty($Gget_ID) === false){ // '===' is better than '=='
	  // echo file_get_contents($Gget_ID.".txt");
	  // $sql = "SELECT * FROM ".$G_table_appitems." WHERE id=";
	  $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$Gget_ID;
	  // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".id=".$Gget_ID;
	  $result = mysqli_query($conn, $sql);
	  $row = mysqli_fetch_assoc($result);
	  echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
	  echo '<p>'.htmlspecialchars($row['loginID']).'</p>';
	  echo strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>");
	} else {
	  echo 'No artice!';
	}
	?>		
</div>

<br><br>	

<!-- <form class="" action="delete_process.php" method="post"> -->
<form class="" name="deleteForm">
	<div class="form-group">
      <label for="form-title">이 아이템을 삭제할까요?</label>
      <label for="form-title">(삭제된 아이템은 복구할 수 없습니다.)</label>
	</div>
	
	<?php
    echo '<input type="hidden" size="2" name="willDeleteId"  value="'.$Gget_ID.'">'."\n";
	//echo '<input type="hidden" size="2" name="uid"  value="'.$Gget_user_id.'">'."\n";
	?>
	
	<input type="hidden" role="uploadcare-uploader" />
	<input type="button" value="예" class="btn btn-success" onClick="submitDeleteForm();">
	<!-- <input type="submit" value="예" name="notYet" class="btn btn-success"> -->
	<!-- <input type="button" value="취소" class="btn btn-success" onClick="history.back();"> -->
	<input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $Gget_ID?>, <?php echo $crrPage ?>);">
	<!-- <input type="button" value="취소" class="btn btn-success" onClick="$('article').load('article.php', {id:<?php echo $Gget_ID ?>});"> -->
	<!-- <input type="button" value="취소" class="btn btn-success" onClick="$('article').load('article.php?id=<?php echo $Gget_ID ?>');"> -->
</form>

<script>
function submitDeleteForm(){
	// alert("submitLoginForm()");
	var queryString = $("form[name=deleteForm]").serialize();
	
	// alert("submitLoginForm( " +queryString +" )");
	$.ajax({
		type: 'POST',
		url: './delete_process.php?bgnpage=<?php echo $crrPage ?>',
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