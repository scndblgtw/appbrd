<?php
  // if(!defined('_DOOR_OPEN_')) { echo "_DOOR_OPEN_ is NO!"; exit; }
  
  require_once(__DIR__."/../config/config.php");
  
  $Gget_action = isset($_GET["action"]) ? $_GET["action"] : "";
  // echo "'".__DIR__."/../login.php?action=1'<br>";
  // echo "'".__DIR__."\..\login.php?action=1'" ;
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  //$GET_ID = $_GET["id"];
  //echo "[@header, *]GET_ID=";  var_dump($GET_ID);
  
  // $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  // if(GLOBAL_TST) { echo $crrPage;	}
  
  
  
  // ini_set("session.gc_probability", 1);
  // ini_set("session.gc_divisor", 1);
  // ini_set("session.cache_expire", 10); 
  // ini_set("session.gc_maxlifetime", 10);
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  
  
  $sql_id = "id";
?> 


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
		
			  <a><?php if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []isLogined="; var_dump($isLogined); echo ", loginID="; var_dump($loginID); echo "</span>"; } ?></a>
			  <div class="btn-group" roll="group">
				<!-- <a class='btn btn-default'><?php //echo "[, *]GET_ID=";  var_dump($GET_ID);?></a> -->
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
				require_once(__DIR__."/../isLogged.php");
  
  
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
				if($isLogined == true) {
					echo '<a class="btn btn-warning" onClick="goLoginForm('."'logout_act.php'".');">Logout</a>';
				} else {
				  if($Gget_action == 1) {
					  
				  }else if($Gget_action == 2){

				  }else {
					echo '<a class="btn btn-success" onClick="goLoginForm('."'login.php'".')">Login</a>';
					echo '<a class="btn btn-info" onClick="goLoginForm('."'register.php'".');">회원가입</a>';
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
				<input type="button" value="white" class="btn btn-default" onClick="setWhiteBG();"/>
				<input type="button" value="gray" class="btn btn-default" onClick="setGrayBG();"/>
				<input type="button" value="black" class="btn btn-default" onClick="setBlackBG();"/>
			  </div>
			
			</li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  <!-- <script src="./script/jsHeader.js">  </script> -->