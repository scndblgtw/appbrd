<?php
  // require_once(__DIR__."/../misc/config.php");
  // require_once(__DIR__."/../misc/db.php");
  
  // $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  

  $G_table_appitems = "appitems";
  // $sql_id = "id";
  
  

  // session_start();
  // $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []isLogined=";  var_dump($isLogined);	}
  // $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; }
?>
	

	
<ol class="nav nav-pills nav-stacked">
  <?php
    $refreshHdr = true;
    // require_once(__DIR__."/../isLogged.php");
  
    // 현재 쪽 번호 @nav 하단 쪽 번호.  0쪽 부터 시작
    $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;	  	  
  
    // $result = mysqli_query($conn, "SELECT * FROM ".$G_table_appitems." ORDER BY created_date DESC LIMIT ".$crrPage*$LIMIT_PER_PAGE.", ".$LIMIT_PER_PAGE);

	$sql = "SELECT ".$G_table_appitems.".id, title, loginID, description, user_id, url_gglply, created_date, updated_date, UNIX_TIMESTAMP(updated_date) AS updated_ux_ts, img_file FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id"." ORDER BY created_date DESC LIMIT ".$crrPage*$LIMIT_PER_PAGE.", ".$LIMIT_PER_PAGE;
	$result = mysqli_query($conn, $sql);

    
  	while( $row = mysqli_fetch_assoc($result) ){
  	  $G_row_id = isset($row[$sql_id]) ? $row[$sql_id] : "";
  	  echo "<li><a style='color: #414141;' href='index.php?".$sql_id."=".$G_row_id."&bgnpage=".$crrPage."'>";

  	  if($row['img_file'] == "")
  		echo "<img id='launcher_icon_img' src='./defaulcon512x512_empty.png' width='25' height='25' />";
  	  else
  		echo "<img id='launcher_icon_img' src='./jQuery-File-Upload/server/php/files/".htmlspecialchars($row['img_file'])."' width='25' height='25' />";

  	  echo "&nbsp;&nbsp;".htmlspecialchars($row['title']);
  	  echo "<span style='float:right; color:gray'>".htmlspecialchars($row['loginID'])."</span></a></li>"."\n";
  	}
  ?>
</ol>
	
<div class="center_tag">
	<?php
	  $rslt = mysqli_query($conn, 'SELECT count(*) as total FROM '.$G_table_appitems.";");
	  $row = mysqli_fetch_assoc($rslt);
	  $totalPagesRemain = ($row['total'] % $LIMIT_PER_PAGE);
	  $totalPages = (int)($row['total'] / $LIMIT_PER_PAGE);
	  $totalPages = $totalPagesRemain > 0 ? $totalPages +1 : $totalPages;
	  
	  
	  // $PAGE_PER_GROUP = 4;
	  
	  //현재 쪽 포함한 그룹 번호. 번호는 0 그룹 부터 시작
	  $crrPgGrp = (int)($crrPage /$PAGE_PER_GROUP);

	  
	  // 접두어 ttl~ = total~
	  // 전체 쪽수는 원소(여기서는 목록이고 차후 앱)가 1개 이상이면 1쪽이라 계산.
	  // 5쪽은 목록이 가득하고 그 다음쪽 목록이 반만 있을 때 전체 쪽 수는 6쪽이다.
	  
	  
	  // 접두어 bgn~ = begin~
	  // 접두어 crr~ = current~
	  // 현재 위치 변수는 0 부터 시작한다
	  
		  

	  echo "<br>";
	  echo '<nav aria-label="Page navigation">';
	  echo '<ul class="pagination pagination-sm">';
	  $leftArrow = $crrPgGrp*$PAGE_PER_GROUP -1;
	  if($leftArrow >= 0) {
			echo "<li><a href='index.php'>&#32;&lt;&lt;&#32</a></li>";
			echo "<li><a href='index.php?bgnpage=".$leftArrow."'>&#32;&lt;</a></li>";
	  }else {
			// echo "<li><span>&#32;&lt;&lt;&#32</span></li>";
			// echo "<li><span>&#32;&lt;</span></li>";
	  }
	  echo "&#32;";
			
	  $i = 0;
	  $result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT ".$crrPage.", ".$LIMIT_PER_PAGE);	  
	  for($i=$crrPgGrp*$PAGE_PER_GROUP ; $i < $crrPgGrp*$PAGE_PER_GROUP +$PAGE_PER_GROUP; $i++) {
			if($i > $totalPages-1) {	// 마지막 쪽을 넘길 경우 링크 삭제
				// echo "<li><span>".($i +1)."</span></li>";  
			} else {	// 마지막 쪽 이하일 경우 링크 연결
				if($i != $crrPage)
					echo "<li><a href='index.php?bgnpage=$i'>".($i +1)."</a></li>";
				else
					echo "<li class='active'><a>".($i +1)."</a></li>";	
			}	  
			echo "&#32;";
	  }
	  
	  if($i <= $totalPages-1) {	// 마지막 쪽을 넘길 경우 링크 삭제
		echo "<li><a href='index.php?bgnpage=$i'>"."&gt;"."</a></li>"; $tmp = $totalPages-1;
		echo "<li><a href='index.php?bgnpage=$tmp'>&#32;&gt;&gt;</a></li>";
	  }else {	// 마지막쪽 이하일 경우 링크 연결
		// echo "<li><span>&gt;</span></li>";		  
		// echo "<li><span>&#32;&gt;&gt;</span></li>";
	  }
	  echo '</ul>';
	  echo '</nav>';
		
		
	  if(GLOBAL_TST) {	
		  echo "<br><br><br><span class='dev_val_color'>";
		  echo "<span id='tstResult'>[*******]</span>"." | ttlItems= ".$row['total']."<br>";
		  echo "ttlPages=".$totalPages." | ttlPagesRmn=".$totalPagesRemain."<br>";
		  echo "crrPage= ".$crrPage." | crrPgGrp= ".$crrPgGrp."<br></span>";
	  }
	?>
</div>
			
<script type="text/javascript">
	$(document).ready(function(){	// XxX
		var varStr;
		$(".ajax_li_a").each(function(){			
			
			$(this).click(function(){
				varStr = $(this).attr("ajx_href");
				
				$.ajax({
					type: 'GET',
					url: varStr,
					dataType : 'text',
					error : function() {
					  dlgAlrtPlgn('Fail!!');
					},
					success: function(data) {
						$('article').html(data);
					}
				});
			})
			
		});
	});
</script>