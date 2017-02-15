<?php
  // echo __DIR__."<br>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  // echo __FILE__."<BR>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd\index.php
  // echo dirname(__FILE__)."<BR>";	// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  require(__DIR__."/config/config.php");
  require(__DIR__."/lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  // $conn = db_init("localhost", "root", "987654321", "opentutorials");
  // $conn = db_init();

  
  // $Gget_AGAIN = $_GET[again];
  $G_table_appitems = "appitems";
  $G_table_users = "users";
  
  
  session_start();
  
  
  
  //--------------
  	// $sql = "SELECT * FROM topic WHERE id=";
	// $sql = "SELECT topic.id, title, name, description, user_id FROM topic LEFT JOIN user ON topic.user_id=user.id WHERE topic.id=".$_GET['id'];
	// $result = mysqli_query($conn, $sql);
	// $row = mysqli_fetch_assoc($result);
	// echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
	// echo '<p>'.htmlspecialchars($row['name']).'</p>';
	// echo strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>");
	// $user_id = $row['user_id'];
  //--------------
  
  
  
  
  
  
	$loginID = mysqli_real_escape_string($conn, $_POST['loginID']);
	$loginPW = mysqli_real_escape_string($conn, $_POST['loginPW']);
	
	
	echo $loginID."<br>";
	echo $loginPW;
	echo "<br>--------------<br>";
	var_dump($loginID);
	echo "<br>";
	var_dump($loginPW);
	
	echo "<br>--------------<br>";
	
	
	
	//입력받은 아이디가 존재하는지 체크하기 위해 데이터베이스에서 id를 가져옴
	$sql = "SELECT id, loginID, loginPW FROM ".$G_table_users." WHERE loginID='$loginID'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	var_dump($row);
	
	// exit;
	
	//아이디가 있다면
	if(!empty($row)) {
		
		
	  echo "ID ok";
	  // exit;
		//아이디를 바탕으로 그 아이디가 가진 곳의 비밀번호를 가져온다
		// $getPASS = "SELECT loginPW FROM MEMBERS WHERE id='$id'";
		// $getPASS = mysql_query($getPASS);
		// $getPASS = mysql_result($getPASS, 0);
		
		//데이터베이스에서 가져온 비밀번호가 입력받은 비밀번호와 같다면,
		if($row['loginPW'] == $loginPW) {
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
			
			
			
			// $_SESSION['isLogined'] = 1;	//0:logout,  1:login,  2:register	// true;
			$_SESSION['isLogined'] = true;
			$_SESSION['loginID'] = $loginID;
			// header("Location:$entry_ip/index.php?id=-1");
			header("Location:$entry_ip/part/article.php");
		
			return 0;
		}
		else {
			echo "PASSWORD ERROR";
			header("Location:$entry_ip/part/article.php?id=-2");
			return 1;
		}
	} else {
		echo "ID DOESN'T EXIST";
			header("Location:$entry_ip/part/article.php?id=-3");
		return 1;
	}
	
	
	
  
header("Location:$entry_ip/index.php?id=".$id);
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
