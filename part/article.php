<?php
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
    if(GLOBAL_TST) {	echo "<span class='dev_val_color'> [article::]GET_ID=";  var_dump($GET_ID);	}

  

  $Gget_rldNav = isset($_GET["rldNav"]) ? $_GET["rldNav"] : false;
  if(GLOBAL_TST) {	echo ", Gget_rldNav=";  var_dump($Gget_rldNav);	}
  
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  $crrPage = isset($_GET["bgnpage"]) ? $_GET["bgnpage"] : 0; // from nav.php
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
  if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "<br></span>"; }
  

  // echo "=================1<br><br>";
  // echo "=================GET_ID== $GET_ID<br><br>";
  // echo "=================empty(GET_ID)== ".empty($GET_ID)."<br><br>";
  // if(empty($GET_ID) === false){ // '===' is better than '=='
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
		// echo "=================2<br><br>";
	  // if(isset($_GET["id"])) {
	  	if($GET_ID == 0) {
			$result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT 1");
			// var_dump($result);
			// echo "<br><br><br>";
			// var_dump(mysqli_fetch_assoc($result));
			// echo "<br>";
			// echo "=================2:0<br><br>";
		} else {
			$sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, url_gglply, created_date, updated_date, UNIX_TIMESTAMP(updated_date) AS updated_ux_ts, img_file FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
			$result = mysqli_query($conn, $sql);
			// echo "=================2:s<br><br>";
		}

		// echo "=================3<br><br>";

		$row = mysqli_fetch_assoc($result);
		// var_dump($row);
		// echo "=================row<br><br>";

		if($row['img_file'] == "")
			echo "<img id='launcher_icon_img' src='./defaulcon512x512_empty.png' width='75' height='75' />";
		else 
			echo '<img id="launcher_icon_img" src="./jQuery-File-Upload/server/php/files/thumbnail/'.$row['img_file'].'" width="75" height="75" />';

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
	  // }

	  	// echo "=================4<br><br>";
	}
	
	// if($Gget_rldNav)
	//   echo "<script>refreshNavMy($crrPage)</script>";

	// echo "=================5<br><br>";
  // }
?>

<div id="control">		
	<script>
		function showControl(idx, crrPage){
			// dlgAlrtPlgn("showControl(" +idx +",  " +crrPage +")");
			$.ajax({
				type: 'GET',
				url: 'part/control.php?id=' +idx +"&bgnpage=" +crrPage,
				dataType : 'text',
				error : function() {
				  dlgAlrtPlgn('Loading a process of control failed!');
				},
				success: function(data) {
					$('#control').html(data);
				}
			});
		}

		showControl(<?php echo $GET_ID.', '.$crrPage ?>);
	</script>
</div>