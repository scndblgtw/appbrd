<?php
  
  
  $last = isset($_SESSION['loginTime']) ? $_SESSION['loginTime'] : -1;
  
  $current = time();
  $sss_duration = 30;
  if(GLOBAL_TST) {	
	  echo "lst".$last."+".$sss_duration."(drtn)=".($last +$sss_duration)."<br>";
	  echo " | crr".$current."|";
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
		echo "<script>refreshHeader();</script>";
  }
?>