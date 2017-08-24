<?php
  require(__DIR__."/misc/config.php");// require("./misc/config.php");
  require(__DIR__."/misc/db.php");// require("lib/db.php");
 
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
    
   
  $G_table_appitems = "appitems";
  $G_table_users = "users";

  // echo "is_int($ _GET[id])="; is_int($_GET["id"]); echo "<br>";
  // echo "$ _GET[id]=".$_GET["id"]."<br>";
  // echo "gettype($ _GET[id])=".gettype($_GET["id"])."<br>";
  // echo "is_int() =".is_int($_GET["id"])."<br>";
  
  if(empty($_GET["id"]) && $_GET["id"]!=0){ // "!=="" NOT working.
    echo "<br><a class='error_red'>[X] Accessing a article is WRONG.</a>".$_GET["id"]."<br>";
    exit;
  }
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;

  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  
  
  $sql_id = "id";

  ini_set("session.gc_probability", 1);
  ini_set("session.gc_divisor", 1);
  ini_set("session.cache_expire", 60); 
  ini_set("session.gc_maxlifetime", 90);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!-- TW-Bootstrap -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <link href="./misc/style.css" rel="stylesheet" type="text/css" >
  <!-- :::4me Generic page styles -->
  <!-- <link rel="stylesheet" href="jQuery-File-Upload/css/style.css"> -->
  <!-- :::4me CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link href="./jQuery-File-Upload/css/jquery.fileupload.css" rel="stylesheet">
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <script src="./misc/ckeditor/ckeditor.js"></script> 


  
</head>
<body id="target">
  <div class="container-fluid">      
    <header class="row">
      <?php require(__DIR__."/part/header.php"); ?>
    </header>


    <!-- Start. row 4 TW-Bootstrap -->
    <div class="row">
      <div class='col-sm-8'>
      <article>


<!-- <form class="" action="write_process.php" method="post"> -->
<form class="" name="whatForm" action="./write_act.php" method="post">
  <img id="launcher_icon_img" src="./defaulcon512x512_empty.png" width="75" height="75" alt=" Upload image"/>
  <input type="hidden" name="imgFile" id="form-imgFile" />
  
  <input type="hidden" name="loginID" id="form-loginID" value=<?php echo "'".$loginID."'"?> class="form-control" />
  <label id="id_float_center" for="form-loginID"> <?php echo "@".$loginID?></label>
  
  <div>
    <!-- <label for="form-title">제목:</label> -->
    <input type="text" name="title" id="form-title" placeholder="앱 이름." class="form-control" />
  </div>

  <div>
    <!-- <label for="form-description">본문:</label> -->
    <!-- <textarea class="form-control" name="description" id="form-description" rows="10" placeholder="앱 설명을 적으세요."></textarea> -->
    <input type="hidden" name="description" id="form-description">
    <textarea name="editor1" id="editor1" rows="10" cols="80" style="width:100%; resize:none">
    </textarea>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
  </div>
  
  <div>
    <input class="form-control" type="text" name="urlGglPly" id="form-urlGglPly" placeholder="앱 주소."><br>
  </div>
  
  <!-- <input type="hidden" role="uploadcare-uploader" /> -->
  <!-- <input type="submit" value="쓰기 완료" class="btn btn-success" onClick="theOriginImg=null;submitWhatForm('control/write_act.php');"> -->
  <input type="submit" value="쓰기 완료" class="btn btn-success">
  <!-- <input type="submit" value="쓰기 완료" class="btn btn-success" onClick="theOriginImg=null; var dataWS = CKEDITOR.instances.editor1.getData(); alert(dataWS); document.getElementById('form-description').value = dataWS;"> -->

  <!-- <a class="btn btn-success" href="index.php">취소</a> -->
  <?php echo "<a class='btn btn-success' href='index.php?id=".$GET_ID."&bgnpage=".$crrPage."'>취소</a>" ?>
  <!-- <input type="button" value="취소" class="btn btn-success" onClick="theOriginImg=null;document.getElementById('form-imgFile').value ? returnBackTheArticle3in(<?php //echo $GET_ID?>, <?php //echo $crrPage ?>, document.getElementById('form-imgFile').value ) : returnBackTheArticle2in(<?php //echo $GET_ID?>, <?php //echo $crrPage ?>)"> -->
</form>

<?php
  require("./file_uploader.php");
?>




        </article>
        <br><br><br>
      </div>


      <nav
        <?php 
        if(isset($_GET["id"]))
          echo "class='col-sm-4'";
        else
          echo "class='col-sm-offset-4 col-sm-4'";
        ?> id='mymy'>
        <?php require(__DIR__.'/part/nav.php'); ?>
      </nav>    
    </div>
    

  </div>

  <script src="./misc/jsIndex.js"></script>
  <!-- End. row 4 TW-Bootstrap -->

  

  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="./bootstrap/plugins/bootbox.min.js"></script>
  <!-- <script src="./misc/ckeditor/ckeditor.js"></script>  -->
  
</body>
</html>
