<?php
  require("./misc/config.php");
  require("./misc/db.php");
 
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
    
   
  $G_table_appitems = "appitems";
  $G_table_users = "users";

  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  
  $sql_id = "id";

  ini_set("session.gc_probability", 1);
  ini_set("session.gc_divisor", 1);
  ini_set("session.cache_expire", 60); 
  ini_set("session.gc_maxlifetime", 90);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!-- TW-Bootstrap -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <link href="./misc/style.css" rel="stylesheet" type="text/css" >
  <!-- :::4me Generic page styles -->
  <!-- <link rel="stylesheet" href="jQuery-File-Upload/css/style.css"> -->
  <!-- :::4me CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link href="./jQuery-File-Upload/css/jquery.fileupload.css" rel="stylesheet">
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>

	<script>

	</script>
	
</head>
<body id="target">
	<div class="container-fluid">      
		<header class="row">
			<?php require(__DIR__."/part/header.php"); ?>
		</header>
	

		<div class="row" id="partArticleNav-padding-LR">

<?php
			if(isset($_GET["id"]) ) {
			  echo "
				<div class='col-md-8'>
					<article>";




  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
    if(GLOBAL_TST) {	echo "<span class='dev_val_color'> [article::]GET_ID=";  var_dump($GET_ID);	}

  

  $Gget_rldNav = isset($_GET["rldNav"]) ? $_GET["rldNav"] : false;
  if(GLOBAL_TST) {	echo ", Gget_rldNav=";  var_dump($Gget_rldNav);	}
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  $crrPage = isset($_GET["bgnpage"]) ? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
  if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "<br></span>"; }
  

	if		 ($GET_ID == -11) {
		echo "<br><a class='confirm_royalblue'>[O] You are registered. Welcome to join. Login please. @article</a><br>";
		
	} else if ($GET_ID == -6) {
		echo "<br><br><br><br><h1>The article has been deleted.</h1><br><br><br><br>";
		
	} else if($GET_ID == -4) {
		echo "<br><br><br><br><h1>You are logged out.</h1><br><br><br><br>";
		
	} else if($GET_ID == -3) {
		echo "<br><br><br><br><h1>There is NO ID.</h1><br><br><br><br>";
		
	} else if($GET_ID == -2) {
		echo "<br><br><br><br><h1>The password WRONG.</h1><br><br><br><br>";
		
	} else if($GET_ID == -1) {
		echo "<br><br><br><br><h1>Welcome to log in.</h1><br><br><br><br>";
		
	} else {
	  	if($GET_ID == 0) {
			$result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT 1");
		} else {
			$sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, url_gglply, created_date, updated_date, UNIX_TIMESTAMP(updated_date) AS updated_ux_ts, img_file FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
			$result = mysqli_query($conn, $sql);
		}


		$row = mysqli_fetch_assoc($result);

		if($row['img_file'] == "")
			echo "<img id='launcher_icon_img' src='./defaulcon512x512_empty.png' width='75' height='75' />";
		else
			echo "<img id='launcher_icon_img' src='./jQuery-File-Upload/server/php/files/".$row['img_file']."' width='75' height='75' />";

		echo '&#32; <span id="h2_id">'.htmlspecialchars($row['title']).'</span><br>';
		echo '<span>';
		echo '<span>';
		echo '&#32; <a href="'.htmlspecialchars($row['url_gglply']).'" target="_blank">[다운▽</a>';
		echo '&#32; <a href="'.htmlspecialchars($row['url_gglply']).'" target="_blank"> 로드▼＂]</a>';
		echo '&#32; @'.htmlspecialchars($row['loginID']);
				
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



echo "<div id='control'>"; 
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'>[]GET_ID=";  var_dump($GET_ID);	}  
  $crrPage = isset($_GET["bgnpage"]) ? $_GET["bgnpage"] : "";
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
    

  
  
  
	$sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, created_date FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	

	$refreshHdr = true;
	
	$row_loginID = isset($row['loginID']) ? $row['loginID'] : "false";
					
	if(isset($isLogined) && $isLogined===true) {

		if($loginID == $row_loginID) {


		  echo "<a class='btn btn-success' href='./modify_whl.php?id=".$GET_ID."&bgnpage=".$crrPage."'>수정</a>";
		  echo "<a class='btn btn-success' href='delete_whl.php?id=".$GET_ID."&bgnpage=".$crrPage."'>삭제</a>";
		} else {
		}
		echo "<a class='btn btn-success' href='./write_whl.php?id=".$GET_ID."&bgnpage=".$crrPage."&rldNav=true'>쓰기</a>";
	}
echo '</div>';






			  echo "
					</article>
				</div>";
			}
?>
		
			<nav
			  <?php 
				if(isset($_GET["id"]))
					echo "class='col-md-4'";
				else
					echo "class='col-md-offset-4 col-md-4'";
			  ?> id='mymy'>
			  <?php require(__DIR__.'/part/nav.php'); ?>
			</nav>		
		</div>
		
		<div class="row" id="partArticleNav-padding-LR">
			<div class="col-md-3">
			</div>	
			<div class="col-md-6">
				<?php require(__DIR__."/part/services3th.php"); ?>
			</div>
		</div>
	</div>

	<script src="./misc/jsIndex.js"></script>

	

	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<script src="./bootstrap/plugins/bootbox.min.js"></script>
	<script src="./misc/ckeditor/ckeditor.js"></script>	
	
</body>
</html>
