<?php
  $last = isset($_SESSION['loginTime']) ? $_SESSION['loginTime'] : -1;
  
  $current = time();
  $sss_duration = 60 *15;
  if(GLOBAL_TST) {	
	  echo "".$last."(lst)+".$sss_duration."=".($last +$sss_duration)." | crr".$current."|";
  }
  
  
  // session_start(); //Require this where the php file including this one.
  
  if( $current < ($last +$sss_duration) && $isLogined === true) {
        $_SESSION['loginTime'] = time();
	
  } else {
		if(GLOBAL_TST){	echo "Sssn xprd|none.<br>";	}
		$_SESSION['isLogined'] = false;
		$isLogined = $_SESSION['isLogined'];
		
        $_SESSION['loginID'] = null;
		$loginID = $_SESSION['loginID'];
		
        $_SESSION['loginTime'] = null;
		
		
		$goLoginScr = isset($goLoginScr) ? $goLoginScr : false;
		$refreshHdr = isset($refreshHdr) ? $refreshHdr : false;
		// $rfrshCtrlArcv = isset($rfrshCtrlArcv) ? $rfrshCtrlArcv : false;
		if($goLoginScr)
			echo "<script>refreshHeader();goToLoginForm();</script>";
		else if($refreshHdr)
			echo "<script>refreshHeader();</script>";
		// else if($rfrshCtrlArcv) {
			// $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
			// echo "<script>refreshHeader();showControl($GET_ID )</script>";	// infinite refeat for calling here
		// }
  }
?>