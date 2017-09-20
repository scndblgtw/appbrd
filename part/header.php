<?php  
  $GET_action = isset($_GET["action"]) ? $_GET["action"] : "";
?> 

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
      </ul>
	  
	  
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
								echo '<li><a class="btn btn-success" href="login_whl.php">로그인</a></li>';
								echo '<li><a class="btn btn-info" href="register_whl.php">회원가입</a></li>';
							}
						}
					?>
				</li>

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
			
    </div>
  </div>
</nav>