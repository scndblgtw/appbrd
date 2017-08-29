<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

  $G_table_appitems = "appitems";

  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
   
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}  

  $img_file_old = isset($_GET["fl_ld"]) && $_GET["fl_ld"]!==''? $_GET["fl_ld"] : null;
  if(GLOBAL_TST) {	echo ", fl_ld=".$fl_ld;	echo "</span>"; }
	
	
	
	echo "<br><br><br>";

	$url = '../jQuery-File-Upload/server/php/files/';	// Default
	$urlThumb = 'thumbnail/';
	


	$handle  = opendir($url);	 
	$files = array();
	$extPttrn = '/^.*\.([^.]+)$/D';
	 
	while (false !== ($filename = readdir($handle))) {
	    if($filename == "." || $filename == ".."){
	        continue;
	    }
	 
	    if(is_file($url . "/" . $filename)){
	      if( preg_replace($extPttrn, '$1', $filename) === "gif"
	      	|| preg_replace($extPttrn, '$1', $filename) === "jpg"
	      	|| preg_replace($extPttrn, '$1', $filename) === "png"
	      	|| preg_replace($extPttrn, '$1', $filename) === "tga"
	      	) {
	          $files[] = $filename;
	      }
	    }
	}
	 
	closedir($handle);



  $imgStatus = "";
  echo "<br>=============== fff ==============<br>";
  echo "Number of Total file = ".count($files)."<br><br>";
	 
  sort($files);	// Use resort() for reverse sorting

  $num = 0;
  $numDeleted = 0;
  $tmp = "";
	 
  foreach ($files as $f) {
    $sql = "SELECT "."id, img_file FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".img_file='".$f."'";
    $result = mysqli_query($conn, $sql);

    // echo "sql="; var_dump($sql); echo ", result="; var_dump($result); echo "<br>";

    if($result->num_rows == 0) {// No img file in DB so that should be deleted
      $tmp = $url.$f;
	  // unlink($url."/" .$f);
	  unlink($tmp);

	  $tmp = $url.$urlThumb.$img_file_old;
	  unlink($tmp);
	  
	  $numDeleted++;
	  $img_file = "xxx <~- Deleted(".$numDeleted.")";

    } else {	// Should Not be deleted because of inDB
      $row = mysqli_fetch_assoc($result);
  	  $img_file = $row['img_file'];
  	  // echo "{".$img_file."} ";

   	  if($img_file === $f) {
  	    $img_file = $img_file." :inDB(===)";
   	  } else
  	    $img_file = $img_file." :inDB"; // Delete on some day in future 
    }

    echo "".($num+1)."|f=".$f.", [id=".$row['id']."]img_file=".$img_file."<br>";
    $num++;
  }


  echo "<br>";
  echo "Number of Deleted file = ".$numDeleted."<br>";
  echo "Number of Remaining file = ".(count($files) - $numDeleted)."<br>";
?>
