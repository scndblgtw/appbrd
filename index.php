<?php
  // require(__DIR__."/misc/config.php");// require("./misc/config.php");
  require("./misc/config.php");
  // require(__DIR__."/misc/db.php");// require("lib/db.php");
  require("./misc/db.php");
  echo __DIR__."<br>";
 
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
    
   
  $G_table_appitems = "appitems";
  $G_table_users = "users";

  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
	
	
  echo "=============||||  ||||=========<br>";


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
	

		<!-- Start. row 4 TW-Bootstrap -->
		<div class="row" id="partArticleNav-padding-LR">
		  <?php
			// if(true) {
			if(isset($_GET["id"]) ) {
			  echo "
				<div class='col-md-8'>
					<article>";
			  require(__DIR__.'/part/article.php');
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
	<!-- End. row 4 TW-Bootstrap -->

	

	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<script src="./bootstrap/plugins/bootbox.min.js"></script>
	<script src="./misc/ckeditor/ckeditor.js"></script>	
	
</body>
</html>
