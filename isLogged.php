<?php
  $last = isset($_SESSION['loginTime']) ? $_SESSION['loginTime'] : -1;
  
  $current = time();
  $sss_duration = 30;
  if(GLOBAL_TST) {	
	  echo "".$last."(lst)+".$sss_duration."=".($last +$sss_duration)." | crr".$current."|";
  }
  
  
  
  if( $current < ($last +$sss_duration) && $isLogined === true) {
        $_SESSION['loginTime'] = time();
	
  } else {
		if(GLOBAL_TST){	echo "Sssn xprd|none.<br>";	}
		$_SESSION['isLogined'] = false;
		$isLogined = $_SESSION['isLogined'];
		
        $_SESSION['loginID'] = null;
		$loginID = $_SESSION['loginID'];
		
        $_SESSION['loginTime'] = null;
		
		
		$canLogin = isset($canLogin) ? $canLogin : false;
		if($canLogin)
			echo "<script>refreshHeader();goToLoginForm();</script>";
  }
?>