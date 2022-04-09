<?php
    include "db.php";

	if(!isset($_SESSION)) { session_start(); } 

	date_default_timezone_set('Asia/Seoul');

	$currdt = date("Y-m-d H:i:s"); 
	$userip = $_SERVER['REMOTE_ADDR'];
	if(isset($_SERVER['HTTP_REFERER'])) 
		$referer = $_SERVER['HTTP_REFERER'];  
	else 
		$referer = ""; 
	if($conn){
		// 처음 방문했는지 검사
		if(!isset($_SESSION['visit'])) { 
			$_SESSION['visit'] = "1";
			$query = "insert into stat_visit (regdate, regip, referer) values('$currdt','$userip','$referer')";
			$result = $conn->query($query);
		}
	}
	

?>  

