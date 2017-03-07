<?php //echo __DIR__."<br>"
  require(__DIR__."/../config/config.php");
  require(__DIR__."/../lib/db.php");
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  
  $G_table_appitems = "appitems";
  //$G_table_users = "users";
  
  
  $sql_id = "id";
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; }
?>
	
<script>
$(function(){
	// $("#tstButton").click(function(){
	$("#tstResult").click(function(){
		$.ajax({
			type: 'GET',
			url: 'part/nav_test.php?test=[- span -]',
			dataType : 'text',
			error : function() {
			  alert('Fail!!');
			},
			success: function(data) {
				// $('#tstResult').load("nav_test.txt #tstScript");
				// $('#tstResult').css('color', 'red').load("nav_test.php #script");
				// $('#tstResult').html("nav_test.txt #tstScript");
				// $('#tstResult').html(data);
				$('#tstResult').html(data);
			}
		});
	})
});
</script>

<!-- <nav class="col-md-3"> -->
	
    <ol class="nav nav-pills nav-stacked">

    <?php
	  $refreshHdr = true;
	  require_once(__DIR__."/../isLogged.php");
	
	  // 현재 쪽 번호 @nav 하단 쪽 번호.  0쪽 부터 시작
	  // echo "_GET[bgnpage]= ".$_GET["bgnpage"]."<br>";
	  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
	  // echo "<div class='center_tag'>"."crrPage= ".$crrPage."</div><br>";
	  // if(empty($crrPage)) $crrPage = 0;
	
	  $LIMIT_PER_PAGE = 8; //===> @ index.php //nav에서 한쪽 당 보여줄 아이템 개수
	  	  
	
	  $result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT ".$crrPage*$LIMIT_PER_PAGE.", ".$LIMIT_PER_PAGE);
	  // $result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC");
	  
      while( $row = mysqli_fetch_assoc($result) ){
		$G_row_id = isset($row[$sql_id]) ? $row[$sql_id] : "";
		echo "<li><a class='ajax_li_a' ajx_href='part/article.php?".$sql_id."=".$G_row_id."&bgnpage=".$crrPage."'>".htmlspecialchars($row['title'])."</a></li>"."\n";
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
	  
	  
	  $PAGE_PER_GROUP = 4;
	  
	  //현재 쪽 포함한 그룹 번호. 번호는 0 그룹 부터 시작
	  $crrPgGrp = (int)($crrPage /$PAGE_PER_GROUP);
	  
	  // echo "<br>";
	  // echo "<span id='tstResult'>[*******]</span>"." | ttlItems= ".$row['total']."<br>";
	  // echo "ttlPages=".$totalPages." | ttlPagesRmn=".$totalPagesRemain."<br>";
	  // echo "crrPage= ".$crrPage." | crrPgGrp= ".$crrPgGrp."<br>";

	  
	  // 접두어 ttl~ = total~
	  // 전체 쪽수는 원소(여기서는 목록이고 차후 앱)가 1개 이상이면 1쪽이라 계산.
	  // 5쪽은 목록이 가득하고 그 다음쪽 목록이 반만 있을 때 전체 쪽 수는 6쪽이다.
	  
	  
	  // 접두어 bgn~ = begin~
	  // 접두어 crr~ = current~
	  // 현재 위치 변수는 0 부터 시작한다
	  
		  
		  
	  $leftArrow = $crrPgGrp*$PAGE_PER_GROUP -1;
	  if($leftArrow >= 0) {
		// echo "<br><span>&#32;&lt;&lt;&#32</span>";
		echo "<br><a onClick='refreshNavMy(0);'>&#32;&lt;&lt;&#32</a>";
		echo "<a onClick='refreshNavMy($leftArrow);'>&#32;&lt;</a>";
	  }else {
		echo "<br><span>&#32;&lt;&lt;&#32</span>";
		echo "<span>&#32;&lt;</span>";	  
	  }
	  echo "&#32;";
			
	  $i = 0;
	  $result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems." ORDER BY created_date DESC LIMIT ".$crrPage.", ".$LIMIT_PER_PAGE);	  
	  for($i=$crrPgGrp*$PAGE_PER_GROUP ; $i < $crrPgGrp*$PAGE_PER_GROUP +$PAGE_PER_GROUP; $i++) {
		if($i > $totalPages-1) {	// 마지막 쪽을 넘길 경우 링크 삭제
		  echo "<span>".($i +1)."</span>";		  
		} else {	// 마지막 쪽 이하일 경우 링크 연결
			if($i != $crrPage)
			  echo "<a onClick='refreshNavMy($i)'>".($i +1)."</a>";
			else
			  echo "<a><b>".($i +1)."</b></a>";	
		}	  
		echo "&#32;";
	  }
	  
	  // echo "<a href='./part/nav.php?".$sql_id."=".$G_row_id."&bgnitem=".$i*$LIMIT_PER_PAGE."&lcr=r"."'>"."&gt;"."</a>"."<br>";
	  // echo "<a onClick='refreshNavMy(111)'>"."&gt;"."</a>"."<br>";
	  // echo "<a onClick='alert($i);refreshNavMy($i)'>"."&gt;"."</a>"."<br>";
	  
	  if($i <= $totalPages-1) {	// 마지막 쪽을 넘길 경우 링크 삭제
		echo "<a onClick='refreshNavMy($i);'>"."&gt;"."</a>"; $tmp = $totalPages-1;
		echo "<a onClick='refreshNavMy($tmp);'>&#32;&gt;&gt;</a>";
		// echo "<span>&#32;&gt;&gt;</span><br>";
	  }else {	// 마지막쪽 이하일 경우 링크 연결
		echo "<span>&gt;</span>";		  
		echo "<span>&#32;&gt;&gt;</span><br>";
	  }
	  
	  if(GLOBAL_TST) {	
		  echo "<br><br><br><span class='dev_val_color'>";
		  echo "<span id='tstResult'>[*******]</span>"." | ttlItems= ".$row['total']."<br>";
		  echo "ttlPages=".$totalPages." | ttlPagesRmn=".$totalPagesRemain."<br>";
		  echo "crrPage= ".$crrPage." | crrPgGrp= ".$crrPgGrp."<br></span>";
	  }
	  
	  // if($i > $totalPages-1) {	// 마지막 쪽을 넘길 경우 링크 삭제
		// echo "<span>&gt;</span>";		  
		// echo "<span>&#32;&gt;&gt;</span><br>";
	  // }else {	// 마지막쪽 이하일 경우 링크 연결
		// echo "<a onClick='refreshNavMy($i);alert($i)'>"."&gt;"."</a>";
		// echo "<span>&#32;&gt;&gt;</span><br>";
	  // }
	?>
	</div>
			
	<script type="text/javascript">
	$(document).ready(function(){
		var varStr;
		$(".ajax_li_a").each(function(){
			// varStr = $(this).attr("ajx_href");
			// $(this).append(" | "+varStr);
			// $(this).html("[" +$(this).html() +"]");
			
			
			$(this).click(function(){
				varStr = $(this).attr("ajx_href");
				
				$.ajax({
					type: 'GET',
					url: varStr,
					dataType : 'text',
					error : function() {
					  alert('Fail!!');
					},
					success: function(data) {
						$('article').html(data);
					}
				});
			})

			
		});
	});
    </script>
	
<!-- </nav> -->