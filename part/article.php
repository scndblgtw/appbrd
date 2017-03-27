<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
  
  $Gget_rldNav = isset($_GET["rldNav"]) ? $_GET["rldNav"] : false;
  if(GLOBAL_TST) {	echo ", Gget_rldNav=";  var_dump($Gget_rldNav);	}
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  $crrPage = isset($_GET["bgnpage"]) ? $_GET["bgnpage"] : 0; // from nav.php
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
    
  $LIMIT_PER_PAGE = 4; // from nav.php
	
	
  $sql_id = "id";

  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; }
  

  if(empty($GET_ID) === false){ // '===' is better than '=='
	if		 ($GET_ID == -6) {
		echo "<br><br><br><br><h1>The article has been deleted.</h1><br><br><br><br>";
		
	} else if($GET_ID == -4) {
		echo "<br><br><br><br><h1>You are logged out.</h1><br><br><br><br>";
		
	} else if($GET_ID == -3) {
		echo "<br><br><br><br><h1>There is NO ID.</h1><br><br><br><br>";
		
	} else if($GET_ID == -2) {
		echo "<br><br><br><br><h1>Password ERROR.</h1><br><br><br><br>";
		
	} else if($GET_ID == -1) {
		echo "<br><br><br><br><h1>Welcome to log in.</h1><br><br><br><br>";
		
	} else {
		if($GET_ID == -5) {
			$result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT 1");
			$row = mysqli_fetch_assoc($result);
			$GET_ID = $row['id'];
		}
		
	  // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, created_date, updated_date, img_file FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
	  $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, url_gglply, created_date, updated_date, UNIX_TIMESTAMP(updated_date) AS updated_ux_ts, img_file FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
	  $result = mysqli_query($conn, $sql);
	  $row = mysqli_fetch_assoc($result);
		
	  echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
		echo '<img id="launcher_icon_img" src="" width="75" height="75" onCLick="loadThumbnail('."'".htmlspecialchars($row['img_file'])."'".')"/>';
	  echo '<span>';
		echo '<span>';
		echo '&#32; <a href="'.htmlspecialchars($row['url_gglply']).'" target="_blank">[다운▽</a>';
		echo '&#32; <a href="'.htmlspecialchars($row['url_gglply']).'"> 로드▼＂]</a>';
		echo '&#32; @올린이: '.htmlspecialchars($row['loginID']);
		
		$unx_tmp = htmlspecialchars($row['updated_date']);
		if($unx_tmp == 0)
			echo '&#32; |created : <span>'.htmlspecialchars($row['created_date']).'</span>';
		else
			echo '&#32; |updated: <span>'.htmlspecialchars($row['updated_date']).'</span>';
		echo '</span>';
		echo '</span>';
		echo "<pre>".$row['description']."</pre>";
		
		if(GLOBAL_TST) {
			echo "<span class='dev_val_color'> []img_file=";  echo htmlspecialchars($row['img_file']);
			echo '&#32;| created : <span>'.htmlspecialchars($row['created_date']).'</span>';
			echo '&#32;| updated: <span>'.htmlspecialchars($row['updated_date']).'</span>';
			echo '&#32;| uUnxTS: <span>'.htmlspecialchars($row['updated_ux_ts']).'</span>';
			echo "</span>";
		}
	  $user_id = $row['user_id'];
	}
	
	if($Gget_rldNav)
		echo "<script>refreshNavMy($crrPage)</script>";
  }
?>

<div id="control">		
	<script>
		showControl(<?php echo $GET_ID.', '.$crrPage ?>);
	</script>
</div>

<script>
$(function() {
	loadThumbnail('<?php echo htmlspecialchars($row['img_file']) ?>');
});
</script>
	
<?php require(__DIR__."/../part/article_bottom.php"); ?>