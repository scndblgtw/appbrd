<?php
  $last = isset($_SESSION['loginTime']) ? $_SESSION['loginTime'] : -1;
  
  $current = time();
  $sss_duration = 60*30;
  if(GLOBAL_TST) {	
	  echo "<span class='dev_val_color'>[]".$last."(lst)+".$sss_duration."=".($last +$sss_duration).", crr".$current;
  }
  
  
  // session_start(); //Require this where the php file including this one.
  
  if( $current < ($last +$sss_duration) && $isLogined === true) {
        $_SESSION['loginTime'] = time();
		echo "</span>";
  } else {
		if(GLOBAL_TST){	echo ", Sssn xprd, none.</span><br>";	}
		$_SESSION['isLogined'] = false;
		$isLogined = $_SESSION['isLogined'];
		
        $_SESSION['loginID'] = null;
		$loginID = $_SESSION['loginID'];
		
        $_SESSION['loginTime'] = null;
		
		
		$goLoginScr = isset($goLoginScr) ? $goLoginScr : false;
		$refreshHdr = isset($refreshHdr) ? $refreshHdr : false;
		
		if($goLoginScr)
			echo "<script>refreshHeader();goLoginForm('login.php');</script>";
		else if($refreshHdr)
			echo "<script>refreshHeader();</script>";
  }
?>