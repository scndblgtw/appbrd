<?php
  require(__DIR__."/misc/config.php");// require("./misc/config.php");
  require(__DIR__."/misc/db.php");// require("lib/db.php");
 
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
    
   
  $G_table_appitems = "appitems";
  $G_table_users = "users";

  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  // $Gget_again = isset($_GET["again"]) ? $_GET["again"] : "";
  $Gget_loginID = isset($_GET['loginID']) ? $_GET['loginID'] : "";
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
	
	
  $sql_id = "id";

  // ini_set("session.gc_probability", 1);
  // ini_set("session.gc_divisor", 1);
  // ini_set("session.cache_expire", 60); 
  // ini_set("session.gc_maxlifetime", 90);
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


	
</head>
<body id="target">
	<div class="container-fluid">      
		<header class="row">
			<?php require(__DIR__."/part/header.php"); ?>
		</header>
	

		<!-- Start. row 4 TW-Bootstrap -->
		<div class="row" id="partArticleNav-padding-LR">
		  <div class='col-sm-offset-4 col-sm-4 z_index_higher'>
			<article>


	<?php
		if($GET_ID == -1) {
		  echo "<a class='error_red'>[X] Two passwords are different. Again please.</a><br>";
		} else if($GET_ID == -2) {
			echo "<span class='error_red'>[X] The ID [".$Gget_loginID."] already taken. Register again, please.</span><br>";
		}
	?>



			  <form class="" name="whatForm" action="register_act.php" method="post">
				<label for="form-title"><h3>회원 가입</h3></label>
			    <div class="form-group">
			      <label for="form-loginID">아이디:</label>
				  <input type="text" class="form-control" name="loginID" id="form-loginID" placeholder="prefered ID" required autofocus>
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
			    <input type="submit" value="확인" class="btn btn-success">
				<a class="btn btn-success" href="index.php">취소</a>
			  </form>
  	  	
		  	</article>
		  </div>
		
			<nav
			  <?php 
				if(isset($_GET["id"]) && isset($_GET["id"])>0 )
					echo "class='col-sm-4 z_index_lower'";
				else
					echo "class='col-sm-offset-4 col-sm-4 z_index_lower'";
			  ?> id='mymy'>
			  <?php require(__DIR__.'/part/nav.php'); ?>
			</nav>		
		</div>
		

	</div>

	<script src="./misc/jsIndex.js"></script>
	<!-- End. row 4 TW-Bootstrap -->

	

	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<script src="./bootstrap/plugins/bootbox.min.js"></script>
	<script src="./misc/ckeditor/ckeditor.js"></script>	
	
</body>
</html>
