<?php
  require(__DIR__."/misc/config.php");// require("./misc/config.php");
  require(__DIR__."/misc/db.php");// require("lib/db.php");
 
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
    
   
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  $LIMIT_PER_PAGE = 10; // from nav.php
	
	
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

  <link rel="stylesheet" type="text/css" href="./misc/style.css">
  <!-- :::4me Generic page styles -->
  <!-- <link rel="stylesheet" href="jQuery-File-Upload/css/style.css"> -->
  <!-- :::4me CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="jQuery-File-Upload/css/jquery.fileupload.css">

  <!-- Bootstrap -->
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>

</head>
<body id="target">
	<div class="container-fluid">      
		<header class="row">
		</header>
	
		<!-- Start. row 4 TW-Bootstrap -->
		<div class="row">		
			<div class="col-md-9">
				<article>
				</article>
			</div>
		
			<nav class="col-md-3" id="mymy">
			</nav>		
		</div>
	</div>

	<script src="./misc/jsIndex.js"></script>
	<!-- End. row 4 TW-Bootstrap -->

	
	
	<?php require("part/body_bottom.php"); ?>

  
  
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="./bootstrap/js/bootstrap.min.js"></script>  

</body>
</html>
