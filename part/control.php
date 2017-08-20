<?php
  echo "<br>==== 0 ====<br>";

  require_once(__DIR__."/../misc/config.php");
  require_once(__DIR__."/../misc/db.php");
  
  echo "<br>==== 1====<br>";

  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  echo "</br>==== 2 ====</br>";

  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'>[]GET_ID=";  var_dump($GET_ID);	}
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
	// == crrPage @nav.php file
  $crrPage = isset($_GET["bgnpage"]) ? $_GET["bgnpage"] : ""; // from nav.php
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
    

  
  echo "<br>==== 3 ====<br>";
  // $sql_id = "id";
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; 	}
  
  
  echo "<br>==== 4 ====<br>";
  
	$sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, created_date FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	
?>

<?php
  echo "<br>==== 5 ====<br>";

	$refreshHdr = true;
	// require_once(__DIR__."/../isLogged.php");
	
	$row_loginID = isset($row['loginID']) ? $row['loginID'] : "false";
					
	if(isset($isLogined) && $isLogined===true) {

    echo "<br>==== 6 ====<br>";
		if($loginID == $row_loginID) {
		  echo "==== 6a ====<br>";


		  echo "<a class='btn btn-success' href='./modify_whl.php?id=".$GET_ID."&bgnpage=".$crrPage."'>수정</a>";
		  // echo '<a class="btn btn-success" id="ax_modify">수정</a>';
		  // echo '<a class="btn btn-success" id="ax_delete">삭제</a>';
		  echo "<a class='btn btn-success' href='./delete_whl.php?id=".$GET_ID."&bgnpage=".$crrPage."'>삭제</a>";
		} else {

		  echo "<br>==== 6b ====<br>";
		  // echo '<a class="btn btn-default">수정</a>';
		  // echo '<a class="btn btn-default">삭제</a>';
		}
		echo '<a class="btn btn-success" href="./write_whl.php?id='.$GET_ID.'&rldNav=true">쓰기</a>';
		// header("Location:$entry_ip/../write_whl.php?id=".$id."&rldNav=true");
	}
  echo "<br>==== 7 ====<br>";
?>