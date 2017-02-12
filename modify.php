<?php
  // echo __DIR__."<br>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  // echo __FILE__."<BR>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd\index.php
  // echo dirname(__FILE__)."<BR>";	// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  require(__DIR__."/config/config.php");
  require(__DIR__."/lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  
  $Gget_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  echo "[]Gget_ID=";  var_dump($Gget_ID);
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  echo ",bgnpage=".$crrPage;
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  
  
  $LIMIT_PER_PAGE = 4; // from nav.php
  
  $sql_id = "id";
  
  
  session_start();
  $isLogined = $_SESSION['isLogined'];
  $loginID = $_SESSION['loginID'];
?>



<?php
	if(empty($Gget_ID)){
	  echo "<br><a class='error_red'>[X] The article which will be modified is None.</a><br>";
	  exit;
	} else {
	  // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$Gget_ID;
	  $sql = "SELECT ".$G_table_appitems.".id, title, description FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".id=".$Gget_ID;
	  $result = mysqli_query($conn, $sql);
	  $row = mysqli_fetch_assoc($result);
	  // var_dump($row);
	  // echo "<br><br>";
	  // echo "<br>".htmlspecialchars($row['title']);
	  // echo "<br>".$loginID;
	  // echo "<br>".strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>");
	  // exit;
	}		
?>

<!-- <form class="" action="modify_process.php" method="post"> -->
<form class="" name="modifyForm">
  <div class="form-group">
    <label for="form-title">제목:</label>
    <input type="text" class="form-control" name="title" id="form-title" value=<?php echo "'".htmlspecialchars($row['title'])."'"?>>
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
    echo '<input type="hidden" size="2" name="willUpdateId" value="'.$Gget_ID.'">'."\n";
  ?>
  
  <input type="hidden" role="uploadcare-uploader" />
  <!-- <input type="submit" value="수정 완료" name="name" class="btn btn-success"> -->
  <input type="button" value="수정 완료" class="btn btn-success" onClick="submitModifyForm();">
  <input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $Gget_ID?>, <?php echo $crrPage ?>);">
</form>

<script>
function submitModifyForm(){
	// alert("submitLoginForm()");
	var queryString = $("form[name=modifyForm]").serialize();
	
	// alert("submitLoginForm( " +queryString +" )");
	$.ajax({
		type: 'POST',
		url: './modify_process.php?bgnpage=<?php echo $crrPage ?>',
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