function XxXrefreshHeader(){
	$('header').load('part/header.php');
}

function dlgAlrtPlgn(dlgMssg){
	if(!dlgMssg) dlgMssg="test";
    bootbox.alert(dlgMssg, function() {
        console.log(dlgMssg);
    });
}

function returnBackTheArticle2in(idx, bp){
	dlgAlrtPlgn(idx +"  " +bp);
	$.ajax({
		type: 'GET',
		url: 'part/article.php?id='+idx+'&bgnpage='+bp,
		dataType : 'text',
		error : function() {
		  dlgAlrtPlgn('Fail!!');
		},
		success: function(data) {
			$('article').html(data);	//load()는 반응 없음.
		}
	});
}

function XxXreturnBackTheArticle3in(idx, bp, fl_ld){
	// dlgAlrtPlgn(fl_ld);
	tmpUrl = 'control/mpty_fl_ld.php?id='+idx +'&bgnpage='+bp +'&fl_ld='+fl_ld;			
	// dlgAlrtPlgn(tmpUrl);

	$.ajax({
		type: 'GET',
		url: tmpUrl,
		dataType : 'text',
		error : function() {
		  dlgAlrtPlgn('Fail!!');
		},
		success: function(data) {
			$('article').html(data);	//load()는 반응 없음.
		}
	});
}

function submitWhatForm(whatProcess, cPg){
	// sUrl= './' +whatProcess +'?bgnpage=' +cPg;
	// dlgAlrtPlgn(sUrl);
	
	if(whatProcess === 'register_act.php') {
		txloginID = document.getElementById("form-loginID").value;
		txnameNic = document.getElementById("form-nameNic").value;
		txloginPW = document.getElementById("form-loginPW").value;
		txloginPWcf = document.getElementById("form-loginPWcf").value;
		
		// dlgAlrtPlgn(txloginID +" | " +txnameNic +" | " +txloginPW +" | " +txloginPWcf);
		
		if(txloginID  ==="" || txloginID===null) { dlgAlrtPlgn("필수: ID"); return; }
		if(txnameNic  ==="" || txnameNic===null) { dlgAlrtPlgn("필수: 별명"); return; }
		if(txloginPW  ==="" || txloginPW===null) { dlgAlrtPlgn("필수: 암호"); return; }
		if(txloginPWcf==="" || txloginPWcf===null) { dlgAlrtPlgn("필수: 암호 학인"); return; }
	}
	
	var queryString = $("form[name=whatForm]").serialize();
	
	$.ajax({
		type: 'POST',
		url: './' +whatProcess +'?bgnpage=' +cPg,
		data: queryString,
		dataType : 'text',
		error : function() {
		  dlgAlrtPlgn('Fail!!');
		},
		success: function(data) {
			//$('header').load("./part/header.php");
			$('article').html(data);
			refreshHeader();
		}
	});
}

function goLoginForm(whatProcess){	//goToLoginForm, gotoRegisterForm, logoutSession
	$.ajax({
		type: 'GET',
		url: './' +whatProcess,
		dataType : 'text',
		error : function() {
		  dlgAlrtPlgn('Loading a process page of ' +whatProcess +' failed!');
		},
		success: function(data) {
			$('article').html(data);
			if(whatProcess === 'logout_act.php') refreshHeader();
		}
	});
}

function showControl(idx, crrPage){
	// dlgAlrtPlgn("showControl(" +idx +",  " +crrPage +")");
	$.ajax({
		type: 'GET',
		url: 'part/control.php?id=' +idx +"&bgnpage=" +crrPage,
		dataType : 'text',
		error : function() {
		  dlgAlrtPlgn('Loading a process of control failed!');
		},
		success: function(data) {
			$('#control').html(data);
		}
	});
}

function XxXrefreshNavMy(nextHori){
	$.ajax({
		type: 'GET',
		url: "part/nav.php?bgnpage=" +nextHori,
		dataType : 'text',
		error : function() {
		dlgAlrtPlgn('Loading article failed!');
		},
		success: function(data) {
			$('nav#mymy').html(data);
		}
	});
}

	function XxXloadThumbnail(sName) {	
		if(sName == "") {
			var sTmp = "./defaulcon512x512_empty.png";
		} else {
			var sTmp = './jQuery-File-Upload/server/php/files/thumbnail/' +sName;
		}
		$("#launcher_icon_img").attr("src", sTmp);
	}

// refreshHeader();
// $('article').load("part/article.php?");	
// refreshNavMy();

function setWhiteBG(){
	document.getElementById("target").className='white';
}	
function setGrayBG(){
	document.getElementById("target").className='gray';
}
function setBlackBG(){
	document.getElementById("target").className='black';
}
