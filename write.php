<?php
  // echo __DIR__."<br>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  // echo __FILE__."<BR>";				// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd\index.php
  // echo dirname(__FILE__)."<BR>";	// C:\Bitnami\wampstack-5.6.28-1\apache2\htdocs\appbrd
  require(__DIR__."/config/config.php");
  require(__DIR__."/lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  // $conn = db_init("localhost", "root", "987654321", "opentutorials");
  // $conn = db_init();
  
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
  
  
  $G_table_appitems = "appitems";
  // $G_table_users = "users";
  
  
  $LIMIT_PER_PAGE = 4; // from nav.php
  
  $sql_id = "id";
  
  
  // ini_set("session.gc_probability", 1);
  // ini_set("session.gc_divisor", 1);
  // ini_set("session.cache_expire", 10); 
  // ini_set("session.gc_maxlifetime", 10);
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; }
  // $result = mysqli_query($conn, 'SELECT * FROM '.$G_table_appitems);
  // $row = mysqli_fetch_assoc($result);
  // var_dump($row);
  // echo '---';
  
  $goLoginScr = true;
  require_once(__DIR__."/./isLogged.php");
?>


    <!-- <form class="" action="write_process.php" method="post"> -->
    <form class="" name="whatForm">
      <div class="form-group">
        <label for="form-title">제목:</label>
        <input type="text" class="form-control" name="title" id="form-title" placeholder="Type title here">
      </div>

      <div class="form-group">
        <label for="form-loginID">작성자: <?php echo $loginID?></label>
        <!-- <input type="text" class="form-control" name="author" id="form-author" placeholder="Type author here" value=<?php //echo $loginID?>> -->
		<input type="hidden" class="form-control" name="loginID" id="form-loginID" value=<?php echo $loginID?>>
      </div>

      <div class="form-group">
        <label for="form-description">본문:</label>
        <textarea class="form-control" name="description" id="form-description" rows="10" placeholder="Type description here"></textarea>
      </div>


      <input type="hidden" role="uploadcare-uploader" />
      <!-- <input type="submit" value="쓰기 완료" name="name" class="btn btn-success"> -->
      <input type="button" value="쓰기 완료" class="btn btn-success" onClick="submitWhatForm('write_act.php');">
	  <input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $GET_ID?>, <?php echo $crrPage ?>);">
    </form>
	
	
<div>
    <br>
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <br>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> -->
<!-- :::4me x <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="jQuery-File-Upload/js/jquery.fileupload.js"></script>
<!-- :::4me x Bootstrap JS is not required, but included for the responsive demo navigation -->
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    //var url = window.location.hostname === 'blueimp.github.io' ?
    //            '//jquery-file-upload.appspot.com/' : 'server/php/';
    var url = 'jQuery-File-Upload/server/php/';	// Default example.
				// 'uploads/';	// Not working without suffixed slash!.
				// '/uploads/';	// Not working with prefixed slash!.
				// 'uploads/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css('width', progress + '%');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>