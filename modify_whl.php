<?php
  require("./misc/config.php");
  require("./misc/db.php");
 
  
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
    
   
  $G_table_appitems = "appitems";
  $G_table_users = "users";


  if(empty($_GET["id"])){
    echo "<br><a class='error_red'>[X] Accessing a article is WRONG.</a><br>";
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

<?php
    $sql = "SELECT ".$G_table_appitems.".id, title, description, created_date, updated_date, img_file, url_gglply, UNIX_TIMESTAMP(updated_date) AS updated_ux_ts FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".id=".$GET_ID;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>


<!-- <?php //echo "<form name='whatForm' action='control/modify_act.php?id=".$GET_ID."&bgnpage=".$crrPage."' method='post'>" ?> -->
<?php echo "<form name='whatForm' action='control/modify_act.php?bgnpage=".$crrPage."' method='post'>" ?>
<!-- <form class="" name="whatForm" action="control/modify_act.php" method="post">  -->
  <div class="form-group">
    <!-- <label for="form-title">제목:</label> -->
    <input type="text" class="form-control" name="title" id="form-title" value=<?php echo '"'.htmlspecialchars($row['title']).'"'?>>
  </div>
  
  <!-- <img id="launcher_icon_img" src="" width="75" height="75"/> -->

  <?php
    if($row['img_file'] == "")
      echo "<img id='launcher_icon_img' src='./defaulcon512x512_empty.png' width='75' height='75' />";
    else 
      echo '<img id="launcher_icon_img" src="./jQuery-File-Upload/server/php/files/thumbnail/'.htmlspecialchars($row['img_file']).'" width="75" height="75" />';
  ?>


  <input type="hidden" name="imgFile" id="form-imgFile" value="<?php echo htmlspecialchars($row['img_file'])?>" />
  <input type="hidden" name="imgFileOld" id="form-imgFile-old" value="<?php echo htmlspecialchars($row['img_file'])?>" />
  
  <label id="id_float_center" for="form-loginID"> <?php echo "@".$loginID?></label>
  <input type="hidden" class="form-control" name="loginID" id="form-loginID" value=<?php echo $loginID?>>
  
  <!-- <span id="article_date_float"> -->
  <span>
  | c: <span><?php echo htmlspecialchars($row['created_date'])?></span>
  | u: <span><?php echo htmlspecialchars($row['updated_date'])?></span>
  | ux: <span><?php echo htmlspecialchars($row['updated_ux_ts'])?></span>
  </span>
  
  <?php
    if(GLOBAL_TST) {  echo "<span class='dev_val_color'> []img_file=";  echo htmlspecialchars($row['img_file']);  echo "</span>"; }
  ?>
  
  <!-- <div class="form-group"> -->
    <!-- <label for="form-description">본문:</label> -->
    <!-- <textarea class="form-control" name="description" id="form-description" rows="10"><?php //echo strip_tags($row['description'], "")?> </textarea> -->
  <!-- </div> -->
  <input type="hidden" name="description" id="form-description">
  <textarea name="editor1" id="editor1" rows="10" cols="80">
    <?php echo strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>")?>
  </textarea>
  <script>
      CKEDITOR.replace( 'editor1' );
  </script>
    
  <div class="form-group">
    <input type="text" class="form-control" name="urlGglPly" id="form-urlGglPly" value=<?php echo '"'.htmlspecialchars($row['url_gglply']).'"'?>>
  </div>
  
  <?php
    echo '<input type="hidden" size="2" name="willUpdateId" value="'.$GET_ID.'">'."\n";
  ?>
  
  <!-- <input type="hidden" role="uploadcare-uploader" /> -->
  <input type="submit" value="수정 완료" class="btn btn-success">
  <!-- <input type="button" value="수정 완료" class="btn btn-success" onClick="theOriginImg=null;var dataWS = CKEDITOR.instances.editor1.getData();alert(dataWS);document.getElementById('form-description').value = dataWS;submitWhatForm('control/modify_act.php', <?php //echo $crrPage ?>);"> -->


  <!-- <a class="btn btn-success" href="index.php">취소</a> -->
  <?php echo "<a class='btn btn-success' href='index.php?id=".$GET_ID."&bgnpage=".$crrPage."'>취소</a>" ?>
  <!-- <input type="button" value="취소" class="btn btn-success" onClick="theOriginImg=null;document.getElementById('form-imgFile').value !== document.getElementById('form-imgFile-old').value ? returnBackTheArticle3in(<?php //echo $GET_ID?>, <?php //echo $crrPage ?>, document.getElementById('form-imgFile').value ) : returnBackTheArticle2in(<?php //echo $GET_ID?>, <?php //echo $crrPage ?>)"> -->
</form>



<?php
  require(__DIR__."/control/file_uploader.php");
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
