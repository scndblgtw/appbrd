<?php
  // require_once(__DIR__."/../misc/config.php");
  
  $GET_action = isset($_GET["action"]) ? $_GET["action"] : "";	// Required this?
  // $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  // session_start();
  // $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  // $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  
  // $sql_id = "id";
?> 

<!-- <nav class="navbar navbar-inverse"> -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo $entry_ip ?>\index.php">
        <img alt="Qrvit" src="./appbrd_p72.png" width="20" height="20">
      </a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $entry_ip ?>\index.php"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Qrvit<span class="sr-only">(current)</span></a></li> -->
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
	  
			<!-- <p class="navbar-text">Signed in as Mark Otto</p> -->
		
      <!-- <form class="navbar-form navbar-left"> -->
        <!-- <div class="form-group"> -->
          <!-- <input type="text" class="form-control" placeholder="Search"> -->
        <!-- </div> -->
        <!-- <button type="submit" class="btn btn-default">Submit</button> -->
      <!-- </form> -->
	  
      <ul class="nav navbar-nav navbar-right">
        <li>		
					<a><?php if(GLOBAL_TST) {	echo "<span class='dev_val_color'> [HEADER]isLogined="; var_dump($isLogined); echo ", loginID="; var_dump($loginID); echo "</span>"; } ?></a>	
				</li>
				
        <li class="active">
					<a href="#">
					<?php
						require_once(__DIR__."/../isLogged.php");

						if($isLogined == true) {
							echo "[$loginID]";
						} else {
							echo "[-]";				
						}
					?>
					</a>
				</li>
        <li>
					<?php
						if($isLogined == true) {
						echo '<li><a class="btn btn-warning" href="logout_act.php">Logout</a></li>';
						} else {
							if($GET_action == 1) {
								
							}else if($GET_action == 2){
					
							}else {
								echo '<li><a class="btn btn-success" href="login_whl.php">Login</a></li>';
								echo '<li><a class="btn btn-info" href="register_whl.php">Register</a></li>';
							}
						}
					?>
				</li>
        <!-- <li><a href="#">Link</a></li> -->
        <!-- <li><a href="#">Link</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li role="separator" class="divider"></li>
						<li><a type="button" value="white" class="btn btn-default" onClick="setWhiteBG();">white</a></li>
						<li><a type="button" value="gray" class="btn btn-default" onClick="setGrayBG();">gray</a></li>
						<li><a type="button" value="black" class="btn btn-default" onClick="setBlackBG();">black</a></li>
						<li role="separator" class="divider"></li>
					</ul>
        </li>
				
      </ul>
			
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>