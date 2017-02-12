<?php
  require_once(__DIR__."/../config/config.php");
  
  $Gget_action = isset($_GET["action"]) ? $_GET["action"] : "";
  // echo "'".__DIR__."/../login.php?action=1'<br>";
  // echo "'".__DIR__."\..\login.php?action=1'" ;
  
  $Gget_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  //$Gget_ID = $_GET["id"];
  //echo "[@header, *]Gget_ID=";  var_dump($Gget_ID);
  
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  echo $crrPage;
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  // echo "[@header, *]isLogined=";  var_dump($isLogined);
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  // echo "[@header, *]loginID=";  var_dump($loginID);
  
  
  $sql_id = "id";
?>

  <!-- Bootstrap -->
  <!-- <link href="./bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> -->
  

  
  <!-- <script src="./script.js">  </script> -->



<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo $entry_ip ?>\index.php">Qrvit<span class="sr-only">(current)</span></a></li>
        <!-- <li><a href="#">Link</a></li> -->
        <!-- <li class="dropdown"> -->
          <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a> -->
          <!-- <ul class="dropdown-menu"> -->
            <!-- <li><a href="#">mAction</a></li> -->
            <!-- <li><a href="#">mAnother action</a></li> -->
            <!-- <li><a href="#">mSomething else here</a></li> -->
            <!-- <li role="separator" class="divider"></li> -->
            <!-- <li><a href="#">mSeparated link</a></li> -->
            <!-- <li role="separator" class="divider"></li> -->
            <!-- <li><a href="#">mOne more separated link</a></li> -->
          <!-- </ul> -->
        <!-- </li> -->
      </ul>
	  
      <!-- <form class="navbar-form navbar-left"> -->
        <!-- <div class="form-group"> -->
          <!-- <input type="text" class="form-control" placeholder="Search"> -->
        <!-- </div> -->
        <!-- <button type="submit" class="btn btn-default">Submit</button> -->
      <!-- </form> -->
	  
      <ul class="nav navbar-nav navbar-right">
        <li>
		
			  <a><?php echo "[]isLogined=";  var_dump($isLogined); echo ",loginID=";  var_dump($loginID); ?></a>
			  <div class="btn-group" roll="group">
				<!-- <a class='btn btn-default'><?php //echo "[, *]Gget_ID=";  var_dump($Gget_ID);?></a> -->
				<!-- <input type="button" value="white" id="white_btn" class="btn btn-default" /> -->
				
				<!-- <a class='btn btn-default'><?php //echo "[@header, *]isLogined=";  var_dump($isLogined); ?></a> -->
				<!-- <a class='btn btn-default'><?php //echo "[@header, *]loginID=";  var_dump($loginID); ?></a> -->
			  </div>
		
		</li>
        <!-- <li><a href="#">Link</a></li> -->
        <!-- <li><a href="#">Link</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

			<?php
				if($isLogined == true) {
					echo "[$loginID]";
				} else {
					echo "[- - - -]";				
				}
			?>

		  <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
			
			  <div class="btn-group" roll="group">
			  <?php
				// if(isset($isLogined)) {
				if($isLogined == true) {
					// echo "<a class='btn btn-default'>[$loginID]</a>";
					echo '<a class="btn btn-warning" onClick="logoutSession();">Logout</a>';
					// echo '<a href="./logout_process.php" class="btn btn-warning">Logout</a>';
				} else {
				  if($Gget_action == 1) {
					//echo '<li><a href="./login.php?action=1" class="btn btn-info">Login</a></li>';
				  }else if($Gget_action == 2){
					//echo '<li><a href="./register.php?action=2" class="btn btn-info">회원가입</a></li>';
				  }else {
					echo '<a id="ax_login" class="btn btn-success">Login</a>';
					// echo '<li><a href="./login.php?action=1" class="btn btn-info">Login</a></li>';
					// echo '<a href="./register.php?action=2" class="btn btn-info">회원가입</a>';
					echo '<a id="ax_register" class="btn btn-info">회원가입</a>';
				  }
				}
			  ?>
			  </div>			
			
			</li>
            <!-- <li><a href="#">Another action</a></li> -->
            <!-- <li><a href="#">Something else here</a></li> -->
            <li role="separator" class="divider"></li>
            <li>
			
			  <div class="btn-group" roll="group">
				<input type="button" value="white" id="white_btn" class="btn btn-default" />
				<input type="button" value="gray" id="gray_btn" class="btn btn-default"/>
				<input type="button" value="black" id="black_btn" class="btn btn-default"/>
			  </div>
			
			</li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  
  
  <!-- <script src="./script/jsHeader.js">  </script> -->

<script>

//alert("jsHeader.js@header");


function logoutSession(){
	$.ajax({
		type: 'GET',
		// url: <?php echo "'".__DIR__."\..\login.php?action=1'" ?>,
		url: <?php echo "'./logout_process.php'" ?>,
		dataType : 'text',
		error : function() {
		  alert('Loading a process of LOGOUT failed!');
		},
		success: function(data) {
			$('article').html(data);
			refreshHeader();
		}
	});
}

$(function(){
	$("#ax_register").click(function(){
		$.ajax({
			type: 'GET',
			// url: <?php echo "'".__DIR__."\..\login.php?action=1'" ?>,
			url: <?php echo "'./register.php?{$sql_id}={$Gget_ID}'" ?>,
			//url: <?php echo "'./register.php?{$sql_id}={$Gget_ID}&action=1'" ?>,
			dataType : 'text',
			error : function() {
				alert('Loading a process page of REGISTER failed!');
			},
			success: function(data) {
				$('article').html(data);
			}
		});
	})
})

$(function(){
	$("#ax_login").click(function(){
		$.ajax({
			type: 'GET',
			// url: <?php echo "'".__DIR__."\..\login.php?action=1'" ?>,
			url: <?php echo "'./login.php?{$sql_id}={$Gget_ID}'" ?>,
			//url: <?php echo "'./login.php?{$sql_id}={$Gget_ID}&action=1'" ?>,
			dataType : 'text',
			error : function() {
			  alert('Loading a process page of LOGIN failed!');
			},
			success: function(data) {
				$('article').html(data);
			}
		});
	})
})



wbtn = document.getElementById('white_btn');
wbtn.addEventListener('click', function() {
  document.getElementById("target").className='white';
})

gbtn = document.getElementById('gray_btn');
gbtn.addEventListener('click', function() {
  document.getElementById("target").className='gray';
})

bbtn = document.getElementById('black_btn');
bbtn.addEventListener('click', function() {
  document.getElementById("target").className='black';
})


</script>