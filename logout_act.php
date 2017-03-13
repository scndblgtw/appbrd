<?php
	require(__DIR__."/misc/config.php");
	require(__DIR__."/misc/db.php");
	$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  


	session_start();
	session_destroy();

	header("Location:$entry_ip/part/article.php");
?>
