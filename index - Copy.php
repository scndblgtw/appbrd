<?php
  // echo __DIR__."<br>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  // echo __FILE__."<BR>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd\index.php
  // echo dirname(__FILE__)."<BR>";	// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  require(__DIR__."/config/config.php");
  require(__DIR__."/lib/db.php");
  // require("./config/config.php");
  // require("lib/db.php");
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  // ajax로 화면 일부 바꾸기 http://boxfoxs.tistory.com/293
  
  $Gget_ID = isset($_GET["id"]) ? $_GET["id"] : "";
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  $Gget_begin_item = isset($_GET["bgnitem"]) ? $_GET["bgnitem"] : ""; // from nav.php
    
  $LIMIT_PER_PAGE = 4; // from nav.php
	
	
  $sql_id = "id";
  // $sql_title = "title";
  // $sql_description = "description";
  
  // $result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT 4");


  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : "";
  // ini_set("session.cache_expire", 60); 
  // ini_set("session.gc_maxlifetime", 90); 
  
  // echo "<br>hellolllllllllllllll<br>";
  // echo "<br>hello2222222222222<br>";
  // echo "<br>hello33333333333333<br>";
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!-- TW-Bootstrap -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <link rel="stylesheet" type="text/css" href="./style.css">

  <!-- Bootstrap -->
  <link href="./bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  

</head>
<body id="target">		
			
    <div >      
	  <?php require("part/header.php"); ?>

      <!-- Start. row 4 TW-Bootstrap -->
      <div class="row">
	  
		<?php require("part/nav.php"); ?>

		<div class="col-md-9">
          <article>

	<?php
	// echo "<br><br>_get[id]=".$Gget_ID."<br><br>";
    if(empty($Gget_ID) === false){ // '===' is better than '=='
		if($Gget_ID == -3) {
			echo "<br><br><br><br><h1>There is NO ID.</h1><br><br><br><br>";
		} else if($Gget_ID == -2) {
			echo "<br><br><br><br><h1>Password ERROR.</h1><br><br><br><br>";
		} else if($Gget_ID == -1) {
			echo "<br><br><br><br><h1>Welcome to log in.</h1><br><br><br><br>";
		} else if($Gget_ID == 0) {
			echo "<br><br><br><br><h1>The article has been deleted.</h1><br><br><br><br>";
		} else {
			
			//Display the first item on each page of navi.
			if($Gget_ID == -4) {
				$result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT ".$Gget_begin_item.", 1");
				$row = mysqli_fetch_assoc($result);
				$Gget_ID = $row['id'];
			}
			
		  // echo file_get_contents($Gget_ID.".txt");
		  // $sql = "SELECT * FROM ".$G_table_appitems." WHERE id=";
		  // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, created_date FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$Gget_ID;
		  $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, created_date FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$Gget_ID;
		  $result = mysqli_query($conn, $sql);
		  $row = mysqli_fetch_assoc($result);
		  echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
		  echo '<p>'.'올린이: '.htmlspecialchars($row['loginID']).' | 작성일자: '.htmlspecialchars($row['created_date']).'</p>';
		  // echo "<textarea style='resize:none;' readonly>".strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>")."</textarea>";
		  // echo "<pre>".strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>")."</pre>";
		  echo "<pre>".$row['description']."</pre>";
		  // echo strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>");
		  // echo $row['description'];
		  $user_id = $row['user_id'];
		  // echo "<br><br>$ user_id = ".$user_id; 
		}
    } else {
		echo "<br><br><br><br><h1>No article selected.</h1><br><br><br><br>";
	}
?>


<div id="control">
<?php
	$row_loginID = isset($row['loginID']) ? $row['loginID'] : "false";
	if(isset($isLogined)) {
		if($loginID == $row_loginID) {
		  echo '<a href="./modify.php?id='.$Gget_ID.'&uid='.$user_id.'" class="btn btn-success">수정</a>';
		  echo '<a href="./delete.php?id='.$Gget_ID.'&uid='.$user_id.'" class="btn btn-success">삭제</a>';
		}
		echo '<a href="./write.php" class="btn btn-success" id="button_a_tag_align">쓰기</a>';
	}
?>
</div>
	
<?php require("part/article_bottom.php"); ?>
		  
		  
		  

          </article>
        </div>

      </div>
    </div>

    <!-- End. row 4 TW-Bootstrap -->

  <?php require("part/body_bottom.php"); ?>

  
	<script type="text/javascript">
	</script>
		
  <!-- <a href="">  </a> -->
  <!-- <input type="button" id="listButton" value="리스트출력" /> -->

</body>
</html>
