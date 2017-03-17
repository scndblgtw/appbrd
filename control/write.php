<?php
  require(__DIR__."/../misc/config.php");
  require(__DIR__."/../misc/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  
  $GET_ID = isset($_GET["id"]) ? $_GET["id"] : "-5";
  if(GLOBAL_TST) {	echo "<span class='dev_val_color'> []GET_ID=";  var_dump($GET_ID);	}
	
  $crrPage = isset($_GET["bgnpage"]) && $_GET["bgnpage"]!==0? $_GET["bgnpage"] : 0;
  if(GLOBAL_TST) {	echo ", bgnpage=".$crrPage;	}
  
  
  $G_table_appitems = "appitems";
  
  
  $LIMIT_PER_PAGE = 4; // from nav.php
  $sql_id = "id";
  
  
  session_start();
  $isLogined = isset($_SESSION['isLogined']) ? $_SESSION['isLogined'] : false;
  if(GLOBAL_TST) {	echo ", isLogined=";  var_dump($isLogined);	}
  $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
  if(GLOBAL_TST) {	echo ", loginID=";  var_dump($loginID);	echo "</span>"; }
  
  $goLoginScr = true;
  require_once(__DIR__."/../isLogged.php");
?>


<!-- <form class="" action="write_process.php" method="post"> -->
<form class="" name="whatForm">
	<img id="launcher_icon_img" src="./Pavicon512x512_empty.png" width="75" height="75" alt=" Upload image"/>
	<label id="id_float_center" for="form-loginID">작성자: <?php echo $loginID?></label>
	<input type="hidden" class="form-control" name="loginID" id="form-loginID" value=<?php echo $loginID?>>
	
  <div>
    <!-- <label for="form-title">제목:</label> -->
		<input class="form-control" type="text" name="title" id="form-title" placeholder="앱 타이틀을 여기에.">
  </div>

  <div>
    <!-- <label for="form-description">본문:</label> -->
    <textarea class="form-control" name="description" id="form-description" rows="10" placeholder="앱 설명을 적으세요"></textarea>
  </div>
	
	<input type="hidden" name="imgFile" id="form-imgFile" />
  <!-- <input type="hidden" role="uploadcare-uploader" /> -->
  <!-- <input type="submit" value="쓰기 완료" name="name" class="btn btn-success"> -->
  <input type="button" value="쓰기 완료" class="btn btn-success" onClick="submitWhatForm('control/write_act.php');">
	<input type="button" value="취소" class="btn btn-success" onClick="returnBackTheArticle2in(<?php echo $GET_ID?>, <?php echo $crrPage ?>);">
</form>
	
	
<div>
  <br>
  <!-- The fileinput-button span is used to style the file input field as button -->
  <span class="btn btn-success fileinput-button">
		<i class="glyphicon glyphicon-plus"></i>
		<span>Select files...</span>
		<!-- The file input field used as target for the file upload widget -->
		<input id="fileupload" type="file" name="files[]" >	<!-- '', multiple -->
  </span>
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
								// var sTmp = ".\\jQuery-File-Upload\\server\\php\\files\\" +file.name;	//oOo. require Double-rSlash(//).
								// var sTmp = './jQuery-File-Upload/server/php/files/' +file.name;		//oOo
								// var sTmp = '.\jQuery-File-Upload\server\\php\files\\' +file.name;	// xXx
								var sTmp = url + 'files/thumbnail/' +file.name;		//oOo
								// $('<p/>').text(sTmp).appendTo('#files');
								$("#launcher_icon_img").attr("src", sTmp);
								// alert(sTmp);
								// $('yourimageselector').attr('src', 'newsrc').load(function(){
										// this.width;   // Note: $(this).width() will not work for in memory images
								// });
								// http://stackoverflow.com/questions/554273/changing-the-image-source-using-jquery
								// http://plaboratory.org/archives/2999
								
								
								document.getElementById("form-imgFile").value = file.name;
             });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css('width', progress + '%');
        }
    }).on('fileuploaddone', function (e, data) {
        // $.each(data.result.files, function (index, file) {
            // if (file.url) {
                // var link = $('<a>')
                    // .attr('target', '_blank')
                    // .prop('href', file.url);
                // $(data.context.children()[index])
                    // .wrap(link);
            // } else if (file.error) {
                // var error = $('<span class="text-danger"/>').text(file.error);
                // $(data.context.children()[index])
                    // .append('<br>')
                    // .append(error);
            // }
        // });
				// alert("Done!");
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>