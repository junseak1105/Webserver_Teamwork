<meta charset="utf-8">
<?php
	error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";

    $userID = $_COOKIE["userID"];
    $userName = $_SESSION['userName'];

    if (isset($_SESSION["userID"])) $userid = $_SESSION["userID"];
    else $userID = "";
    if (isset($_SESSION["userName"])) $username = $_SESSION["userName"];
    else $userName = "";


    //isset에 if문 써서 있는 값만 가져오기
    //DB 테이블 prefer에 useridx, 추천한 게시글idx 저장

    if (isset($_POST['recommend_Y'])) {
    	$like = $_POST['recommend_Y'];
    	echo($like);
    }
    if (isset($_POST['recommend_N'])) {
    	$unlike = $_POST['recommend_N'];
    	echo($unlike);
    }


?>