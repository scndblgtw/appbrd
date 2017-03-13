
function refreshHeader(){
	$('header').load('part/header.php');
}

function returnBackTheArticle2in(idx, bp){
	// alert(idx +"  " +bp);
	$.ajax({
		type: 'GET',
		url: 'part/article.php?id='+idx+'&bgnpage='+bp,
		dataType : 'text',
		error : function() {
		  alert('Fail!!');
		},
		success: function(data) {
			$('article').html(data);	//load()는 반응 없음.
		}
	});
}

function submitWhatForm(whatProcess, cPg){
	// sUrl= './' +whatProcess +'?bgnpage=' +cPg;
	// alert(sUrl);
	
	if(whatProcess === 'register_act.php') {
		txloginID = document.getElementById("form-loginID").value;
		txnameNic = document.getElementById("form-nameNic").value;
		txloginPW = document.getElementById("form-loginPW").value;
		txloginPWcf = document.getElementById("form-loginPWcf").value;
		
		// alert(txloginID +" | " +txnameNic +" | " +txloginPW +" | " +txloginPWcf);
		
		if(txloginID  ==="" || txloginID===null) { alert("필수: ID"); return; }
		if(txnameNic  ==="" || txnameNic===null) { alert("필수: 별명"); return; }
		if(txloginPW  ==="" || txloginPW===null) { alert("필수: 암호"); return; }
		if(txloginPWcf==="" || txloginPWcf===null) { alert("필수: 암호 학인"); return; }
	}
	
	var queryString = $("form[name=whatForm]").serialize();
	
	$.ajax({
		type: 'POST',
		url: './' +whatProcess +'?bgnpage=' +cPg,
		data: queryString,
		dataType : 'text',
		error : function() {
		  alert('Fail!!');
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
		  alert('Loading a process page of ' +whatProcess +' failed!');
		},
		success: function(data) {
			$('article').html(data);
			if(whatProcess === 'logout_act.php') refreshHeader();
		}
	});
}

function showControl(idx, crrPage){
	// alert("showControl(" +idx +",  " +crrPage +")");
	$.ajax({
		type: 'GET',
		url: 'part/control.php?id=' +idx +"&bgnpage=" +crrPage,
		dataType : 'text',
		error : function() {
		  alert('Loading a process of control failed!');
		},
		success: function(data) {
			$('#control').html(data);
		}
	});
}

function refreshNavMy(nextHori){
	$.ajax({
		type: 'GET',
		url: "part/nav.php?bgnpage=" +nextHori,
		dataType : 'text',
		error : function() {
		alert('Loading article failed!');
		},
		success: function(data) {
			$('nav#mymy').html(data);
		}
	});
}

refreshHeader();
$('article').load("part/article.php?");	
refreshNavMy();

function setWhiteBG(){
	document.getElementById("target").className='white';
}	
function setGrayBG(){
	document.getElementById("target").className='gray';
}
function setBlackBG(){
	document.getElementById("target").className='black';
}
