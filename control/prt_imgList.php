<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);


  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
   
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}  

  $img_file_old = isset($_GET["fl_ld"]) && $_GET["fl_ld"]!==''? $_GET["fl_ld"] : null;
  if(GLOBAL_TST) {	echo ", fl_ld=".$fl_ld;	echo "</span>"; }
	
	

  $url = '../jQuery-File-Upload/server/php/files/';	// Default
  $urlThumb = 'thumbnail/';
  $tpath = $url;  

  echo $tpath."<br>";

  $handle  = opendir($tpath);	 
  $files = array();
  $extPttrn = '/^.*\.([^.]+)$/D';
   
  while (false !== ($filename = readdir($handle))) {
    if($filename == "." || $filename == ".."){
        continue;
    }
    
    // if(is_file($tpath."/".$filename)){
    if(is_file($tpath.$filename)){
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

  echo "<br>=============== tpath noSlash ==============<br>";
  echo "Total file number = ".count($files)."<br><br>";
	 
  sort($files);	// Use resort() for reverse sorting
  $num = 0;
	 
	foreach ($files as $f) {
	    echo "&nbsp".($num+1)."&nbsp&nbsp".$f;
	    echo "<br />";
	    $num = $num +1;
	}


 //  echo "<br><br>";
 //  echo "<br>============={jpg  } ================<br>";

 // $j = 1;
 // foreach(glob($url."/"."*.jpg") as $value){
 // // foreach(glob($url."{*.jpg, *.png, *.gif}", GLOB_BRACE) as $value){ // XxX
 // // foreach(glob("{{$url}.*.jpg, {$url}.*.png}", GLOB_BRACE) as $value){ // XxX
 //     echo "${j}| $value<br/>";
 //     $j++;
 // } 

?>
