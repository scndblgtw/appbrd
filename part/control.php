<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'>[]GET_ID=";  var_dump($GET_ID);	}
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
	// == crrPage @nav.php file
  $crrPage = isset($_GET["bgnpage"]) ? $_GET["bgnpage"] : ""; // from nav.php
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
    
  $LIMIT_PER_PAGE = 4; // from nav.php
  
  // $sql_id = "id";
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; 	}
  
  
  
	$sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, created_date FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	
?>

<?php
	$refreshHdr = true;
	require_once(__DIR__."/../isLogged.php");
	echo "<br>";
	
	$row_loginID = isset($row['loginID']) ? $row['loginID'] : "false";
					
	if(isset($isLogined) && $isLogined===true) {
		if($loginID == $row_loginID) {
		  echo '<a class="btn btn-success" id="ax_modify">수정</a>';
		  echo '<a class="btn btn-success" id="ax_delete">삭제</a>';
		}
		echo '<a class="btn btn-success" id="ax_write_float">쓰기</a>';
	}
?>


<script type="text/javascript">
$(function(){
	$("#ax_write_float").click(function(){
		$.ajax({
			type: 'GET',
			url: <?php echo "'./control/write.php?id=".$GET_ID."'" ?>,
			dataType : 'text',
			error : function() {
			  dlgAlrtPlgn('Loading a process page of WRITE failed!');
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
			url: <?php echo "'./control/modify.php?id=".$GET_ID."&bgnpage=".$crrPage."'" ?>,
			dataType : 'text',
			error : function() {
			  dlgAlrtPlgn('Loading a process page of MODIFY failed!');
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
			url: <?php echo "'./control/delete.php?id=".$GET_ID."&bgnpage=".$crrPage."'" ?>,
			dataType : 'text',
			error : function() {
			  dlgAlrtPlgn('Loading a process page of DELETE failed!');
			},
			success: function(data) {
				$('article').html(data);
			}
		});
	})	
})
</script>