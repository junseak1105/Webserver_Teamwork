
<meta charset="utf-8">
<?php
    //session_start();
	error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";

    $userID = $_COOKIE["userID"];

    if (isset($_COOKIE["userID"])) $userid = $_COOKIE["userID"];
    else $userID = "";

    $title = $_POST["title"]; //form에서 제목 가져오기
    $category = $_POST["category"]; //form에서 제목 가져오기
    $content = $_POST["content"]; // 내용 가져오기
	$idx = $_GET['idx'];

	$title = htmlspecialchars($title, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);

	$date = date("Y-m-d");  // 현재의 '년-월-일'을 저장

	

	//$_FILES에 담긴 배열 정보 구하기.
    if($_FILES['imgFile']['name']!=""){
        // php 내부 소스에서 html 태그 적용 - 선긋기
    echo "<hr>";

    /*********************************************
    * 실제로 구축되는 페이지 내부.
    **********************************************/
    $timestamp = time();
    // 임시로 저장된 정보(tmp_name)
    $tempFile = $_FILES['imgFile']['tmp_name'];
    // 파일타입 및 확장자 체크
    $fileTypeExt = explode("/", $_FILES['imgFile']['type']);
    // 파일 타입 
    $fileType = $fileTypeExt[0];
    // 파일 확장자
    $fileExt = $fileTypeExt[1];
    // 확장자 검사
    $extStatus = false;

    switch($fileExt){
	    case 'jpeg':
	    case 'jpg':
            $extStatus = true;
	    case 'gif':
	    case 'bmp':
	    case 'png':
		    $extStatus = true;
		break;
	
	default:
		echo "이미지 전용 확장자(jpg, bmp, gif, png)외에는 사용이 불가합니다."; 
		exit;
		break;
    }

    // 이미지 파일이 맞는지 검사. 
    if($fileType == 'image'){
	    // 허용할 확장자를 jpg, bmp, gif, png로 정함, 그 외에는 업로드 불가
	    if($extStatus){
		    // 임시 파일 옮길 디렉토리 및 파일명
		    $resFile = "./uploads/".$timestamp.$_FILES['imgFile']['name'];
		    // 임시 저장된 파일을 우리가 저장할 디렉토리 및 파일명으로 옮김
		    $imageUpload = move_uploaded_file($tempFile, $resFile);
		
		    // 업로드 성공 여부 확인
		    if($imageUpload == true){
			    echo "파일이 정상적으로 업로드 되었습니다. <br>";
			    echo "<img src='{$resFile}' width='100' />";
		    }else{
			    echo "파일 업로드에 실패하였습니다.";
		    }
	    }	// end if - extStatus
		// 확장자가 jpg, bmp, gif, png가 아닌 경우 else문 실행
	else {
		echo "파일 확장자는 jpg, bmp, gif, png 이어야 합니다.";
		exit;
	}	
    }	// end if - filetype
	    // 파일 타입이 image가 아닌 경우 
    else {
	    echo "이미지 파일이 아닙니다.";
	    exit;
    }
        $sql = "update post set title='$title', category='$category', content='$content', date='$date', image='$resFile' WHERE idx=$idx";
    }else{
        $sql = "update post set title='$title', category='$category', content='$content', date='$date' WHERE idx=$idx";
    };

    echo $sql;

	mysqli_query($conn, $sql); 

	mysqli_close($conn);  // DB 연결 끊기

	
    $prevPage = $_SERVER['HTTP_REFERER'];
    // header('location:'.$prevPage);
    Header("Location: ./user_board_view.php?idx=".$idx);
?>

  

