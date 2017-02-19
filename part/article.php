<?php
  require(__DIR__."/../config/config.php");
  require(__DIR__."/../lib/db.php");
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  $Gget_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "[]Gget_ID=";  var_dump($Gget_ID);	}
  
  $Gget_rldNav = isset($_GET["rldNav"]) ? $_GET["rldNav"] : false;
  if(GLOBAL_TST) {	echo ",Gget_rldNav=";  var_dump($Gget_rldNav);	}
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  // == crrPage @nav.php file
  $crrPage = isset($_GET["bgnpage"]) ? $_GET["bgnpage"] : ""; // from nav.php
  if(GLOBAL_TST) {	echo ",bgnpage=".$crrPage;	}
    
  $LIMIT_PER_PAGE = 4; // from nav.php
	
	
  $sql_id = "id";
  
  
  
  ini_set("session.gc_probability", 1);
  ini_set("session.gc_divisor", 1);
  ini_set("session.cache_expire", 10); 
  ini_set("session.gc_maxlifetime", 10);
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo ",isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ",loginID=";  var_dump($loginID);	}
  

  // exit;
  
  
  
	// echo "<br><br>_get[id]=".$Gget_ID."<br><br>";
    if(empty($Gget_ID) === false){ // '===' is better than '=='
		if		 ($Gget_ID == -6) {
			// echo "<script>refreshNavMy()</script>";
			echo "<br><br><br><br><h1>The article has been deleted.</h1><br><br><br><br>";
			
		} else if($Gget_ID == -4) {
			echo "<br><br><br><br><h1>You are logged out.</h1><br><br><br><br>";
			
		} else if($Gget_ID == -3) {
			echo "<br><br><br><br><h1>There is NO ID.</h1><br><br><br><br>";
			
		} else if($Gget_ID == -2) {
			echo "<br><br><br><br><h1>Password ERROR.</h1><br><br><br><br>";
			
		} else if($Gget_ID == -1) {
			echo "<br><br><br><br><h1>Welcome to log in.</h1><br><br><br><br>";
			
		} else {
			
			//Display the first item on each page of navi.
			if($Gget_ID == -5) {
				$result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT 1");
				// $result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT ".$crrPage.", 1");
				$row = mysqli_fetch_assoc($result);
				$Gget_ID = $row['id'];
				
				// echo '<script>alert("Gget_ID == -5");</script>';
			}
			
		  // echo file_get_contents($Gget_ID.".txt");
		  // $sql = "SELECT * FROM ".$G_table_appitems." WHERE id=";
		  // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, created_date FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$Gget_ID;
		  $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, created_date FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$Gget_ID;
		  $result = mysqli_query($conn, $sql);
		  $row = mysqli_fetch_assoc($result);
		  echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
		  echo '<div><span>&#32; '.htmlspecialchars($row['loginID']).'</span><span id="article_date_float">'.htmlspecialchars($row['created_date']).'</span></div>';
		  echo "<pre>".$row['description']."</pre>";
		  $user_id = $row['user_id'];
		  
		  // echo "<script>refreshNavMy()</script>";
		}
		
		if($Gget_rldNav)
			echo "<script>refreshNavMy($crrPage)</script>";
		
		// echo "<script>refreshNavMy()</script>";
		
    } else {
		echo "<br><br><br><br><h1>No article selected.</h1><br><br><br><br>";
	}
?>


<div id="control">
<?php
	$row_loginID = isset($row['loginID']) ? $row['loginID'] : "false";
					
	if(isset($isLogined) && $isLogined===true) {
		if($loginID == $row_loginID) {
		  echo '<a class="btn btn-success" id="ax_modify">수정</a>';
		  // echo '<a href="./modify.php?id='.$Gget_ID.'&uid='.$user_id.'" class="btn btn-success">수정</a>';
		  // echo '<a href="./delete.php?id='.$Gget_ID.'&uid='.$user_id.'" class="btn btn-success">삭제</a>';
		  echo '<a class="btn btn-success" id="ax_delete">삭제</a>';
		}
		// echo '<a href="./write.php" class="btn btn-success" id="button_a_tag_align">쓰기</a>';
		echo '<a class="btn btn-success" id="ax_write_float">쓰기</a>';
		// echo '<a class="btn btn-success" id="button_a_tag_align">쓰기</a>';
	}
?>
</div>
	
<script type="text/javascript">
$(function(){
	$("#ax_write_float").click(function(){
		$.ajax({
			type: 'GET',
			url: <?php echo "'./write.php?id=".$Gget_ID."'" ?>,
			// url: <?php //echo "'./write.php?id=".$Gget_ID."&uid=".$user_id."'" ?>,
			// url: <?php //echo __DIR__."'/../delete.php?id=".$Gget_ID."&uid=".$user_id."'" ?>,
			dataType : 'text',
			error : function() {
			  alert('Loading a process page of WRITE failed!');
			},
			success: function(data) {
				$('article').html(data);
			}
		});
	})	
})
$(function(){
	$("#ax_modify").click(function(){
		$.ajax({
			type: 'GET',
			url: <?php echo "'./modify.php?id=".$Gget_ID."&bgnpage=".$crrPage."'" ?>,
			// url: <?php //echo "'./modify.php?id=".$Gget_ID."&uid=".$user_id."'" ?>,
			// url: <?php //echo __DIR__."'/../delete.php?id=".$Gget_ID."&uid=".$user_id."'" ?>,
			dataType : 'text',
			error : function() {
			  alert('Loading a process page of MODIFY failed!');
			},
			success: function(data) {
				$('article').html(data);
			}
		});
	})	
})
$(function(){
	$("#ax_delete").click(function(){
		$.ajax({
			type: 'GET',
			url: <?php echo "'./delete.php?id=".$Gget_ID."&bgnpage=".$crrPage."'" ?>,
			// url: <?php //echo "'./delete.php?id=".$Gget_ID."&uid=".$user_id."'" ?>,
			// url: <?php //echo __DIR__."'/../delete.php?id=".$Gget_ID."&uid=".$user_id."'" ?>,
			dataType : 'text',
			error : function() {
			  alert('Loading a process page of DELETE failed!');
			},
			success: function(data) {
				$('article').html(data);
			}
		});
	})	
})
</script>




<?php require(__DIR__."/../part/article_bottom.php"); ?>
	
	
	