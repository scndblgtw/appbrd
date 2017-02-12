<?php
  // echo __DIR__."<br>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  // echo __FILE__."<BR>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd\index.php
  // echo dirname(__FILE__)."<BR>";	// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  require(__DIR__."/config/config.php");
  require(__DIR__."/lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);


  
  session_start();
  
 
	$loginID = $_POST['loginID'];
	$nameNic = $_POST['nameNic'];
	$loginPW = $_POST['loginPW'];
	$loginPWcf = $_POST['loginPWcf'];
	
    $G_table_users = "users";

	
	// $sql = "SELECT id, nameNic, loginPW FROM ".$G_table_users." WHERE loginID='$loginID'";  //????????
	$sql = "SELECT id, nameNic, loginPW FROM ".$G_table_users." WHERE loginID='".$loginID."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	  
	  
	  
	
	if(empty($row)) {
	  echo "<br>The ID ".$loginID." OK.<br>";
	  
		if($loginPW == $loginPWcf) {
		  echo "<br>[OK]Two passwords are the same.<br>";			
		  $sql = "INSERT INTO ".$G_table_users."(loginID, nameNic, loginPW, joined_date) VALUES('".$loginID."', '".$nameNic."', '".$loginPW."', now())";
		  mysqli_query($conn, $sql);
  
		  header("Location:$entry_ip/login.php?again=1");
		  exit;
		
		} else {
		  // echo "<br>[X]Two passwords are the different.<br>";
		  header("Location:$entry_ip/register.php?again=-1");
		  exit;
		}
	} else {
		header("Location:$entry_ip/register.php?again=-2&loginID=$loginID");
		exit;
	}
	
header("Location:$entry_ip/register.php?id=".$id);
?>


















<?php
	// if($getID['id']) {
		//아이디를 바탕으로 그 아이디가 가진 곳의 비밀번호를 가져온다
		// $getPASS = "SELECT password FROM MEMBERS WHERE id='$id'";
		// $getPASS = mysql_query($getPASS);
		// $getPASS = mysql_result($getPASS, 0);
		
		//데이터베이스에서 가져온 비밀번호가 입력받은 비밀번호와 같다면,
		// if($getPASS == $pass) {
			//64자리의 무작위 문자열을 생성한다.
			//이 64자리의 임의의 수가 바로 토큰으로 로그인 대조에 사용할 키 값.
			// $key = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789^/';
			// for($i=0;$i<=63;$i++)
				// $token .= $key[rand(0,63)];
			
			//방금 만든 토큰을 데이터베이스에 업데이트한다.
			//입력받은 아이디가 있는 위치에 업데이트.
			// $updateToken = "UPDATE MEMBERS SET token='$token' WHERE id='$id'";
			// $updateToken = mysql_query($updateToken);
		
			//세션에 토큰 즉 키 값을 등록한다.
			// $_SESSION['token'] = $token;
		
			// return 0;
		// }
		// else {
			// echo "PASSWORD ERROR";
			// return 1;
		// }
	// }
	
	// else {
		// echo "ID DOESN'T EXIST";
		// return 1;
	// }
?>
