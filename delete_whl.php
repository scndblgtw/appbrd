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

  


  if(GLOBAL_TST) {  echo "<span class='dev_val_color'> [article::]GET_ID=";  var_dump($GET_ID); }
  
  if(GLOBAL_TST) {  echo ", bgnpage=".$crrPage; }
  if(GLOBAL_TST) {  echo ", isLogined=";  var_dump($isLogined); }
  if(GLOBAL_TST) {  echo ", loginID=";  var_dump($loginID); echo "<br></span>"; }
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
  if(empty($GET_ID) === false){ // '===' is better than '=='
    $sql = "SELECT ".$G_table_appitems.".id, title, created_date, updated_date, img_file, description FROM ".$G_table_appitems." WHERE ".$G_table_appitems.".id=".$GET_ID;
    // $sql = "SELECT ".$G_table_appitems.".id, title, loginID, description FROM ".$G_table_appitems." LEFT JOIN ".$G_table_users." ON ".$G_table_appitems.".user_id=".$G_table_users.".id WHERE ".$G_table_appitems.".id=".$GET_ID;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
    
    // echo '<img id="launcher_icon_img" src="" width="75" height="75" onCLick="loadThumbnail('."'".htmlspecialchars($row['img_file'])."'".')"/>';
    if($row['img_file'] == "")
      echo "<img id='launcher_icon_img' src='./defaulcon512x512_empty.png' width='75' height='75' />";
    else 
      echo '<img id="launcher_icon_img" src="./jQuery-File-Upload/server/php/files/thumbnail/'.htmlspecialchars($row['img_file']).'" width="75" height="75" />';
    echo '<span>  <span> loginID</span>';
    echo '<span id="article_date_float">c: <span>'.htmlspecialchars($row['created_date']).'</span> <br> u: <span>'.htmlspecialchars($row['updated_date']).'</span></span>  </span>';
    if(GLOBAL_TST) {  echo "<span class='dev_val_color'> []img_file=";  echo htmlspecialchars($row['img_file']);  echo "</span>"; }
    
    echo "<pre>".strip_tags($row['description'], "<a><h1><h2><h3><h4><h5><ul><ol><li><p><br>")."</pre>";
  } else {
    echo 'No article!';
  }
  
  // $goLoginScr = true;
  // require_once(__DIR__."/../isLogged.php");
?>

<br><br>  

<!-- <form class="" action="delete_process.php" method="post"> -->
<!-- <form class="" name="whatForm" action="control/delete_act.php" method="post"> -->
<?php echo "<form name='whatForm' action='delete_act.php?bgnpage=".$crrPage."' method='post'>" ?>
  <div class="form-group">
      <label for="form-title">이 아이템을 삭제할까요 (</label>
      <label class='error_red' for="form-title">삭제된 아이템은 복구할 수 없습니다.</label>
      <label for="form-title">) ?</label>
  </div>
  
  <?php
    echo '<input type="hidden" size="2" name="willDeleteId"  value="'.$GET_ID.'">'."\n";
    echo '<input type="hidden" name="imgFile"  value="'.htmlspecialchars($row['img_file']).'">'."\n";
  ?>
  
  <input type="submit" value="예" class="btn btn-success">
  <?php echo "<a class='btn btn-success' href='index.php?id=".$GET_ID."&bgnpage=".$crrPage."'>취소</a>" ?>
</form>




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
