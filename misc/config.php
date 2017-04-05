<?php
	$entry_ip = ".";
	$config = array(
		"host"=>"localhost",
		"duser"=>"root",
		"dpw"=>"987654321",
		"dname"=>"appbbs"
	);

	define('GLOBAL_TST', false);
	
	/* navigation 영역에서 쪽 번호 */
	$LIMIT_PER_PAGE = 7; //nav에서 한쪽 당 보여줄 아이템 목록 개수
	$PAGE_PER_GROUP = 4; //nav에서 하단 가로로 보여질 번호
	
	
	
	$CHK_REFRESH_EXCEPT_JS = "result";
?>
