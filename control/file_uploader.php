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

var theOriginImg = null;
var theDeletedImg;

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
								
								if(!theOriginImg) {
									theOriginImg = document.getElementById("form-imgFile").value ? document.getElementById("form-imgFile").value : "no-image.nJpg";
									alert("theOriginImg = " +theOriginImg);
								}else {
									theDeletedImg = document.getElementById("form-imgFile").value;
									alert("theDeletedImg = " +theDeletedImg);
									deleteOldFileEveryTime( theDeletedImg );
								}
								
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

function deleteOldFileEveryTime(fl_ld){
	// alert(fl_ld);
	tmpUrl = 'control/mpty_fl_ld.php?fl_ld='+fl_ld;			
	// alert(tmpUrl);

	$.ajax({
		type: 'GET',
		url: tmpUrl,
		dataType : 'text',
		error : function() {
		  alert('Fail!!');
		},
		success: function(data) {
			// $('article').html(data);	//load()는 반응 없음.
			alert("Deleted : " +theDeletedImg);
		}
	});
}
</script>