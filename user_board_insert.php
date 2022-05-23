<meta charset="utf-8">
<?php
	error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";

    //개발용 임시 세션 넣어둔 것
    $_SESSION["userID"] = 'userid1';
    $_SESSION["userPW"] = 'userpw1';
    $_SESSION["userName"] = 'userName1';
    $userID = $_SESSION['userID'];
    $userName = $_SESSION['userName'];

    if (isset($_SESSION["userID"])) $userid = $_SESSION["userID"];
    else $userID = "";
    if (isset($_SESSION["userName"])) $username = $_SESSION["userName"];
    else $userName = "";

    if ( !$userID )
    {
        echo("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
                exit;
    }

    $title = $_POST["title"]; //form에서 제목 가져오기
    $content = $_POST["content"]; // 내용 가져오기

	$title = htmlspecialchars($title, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);

	$date = date("Y-m-d");  // 현재의 '년-월-일'을 저장

	$upload_dir = './data/'; // 파일 서버 저장 경로
	
	$sql = "insert into post (title, content, date, hit, recommend_Y, recommend_N, writer_id, image) "; //DB 순서대로
	$sql .= "values('$title', '$content', '$date', 0, 0, 0, '$userName', 0)";

	mysqli_query($conn, $sql); 

	mysqli_close($conn);  // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'user_board_list.php';
	   </script>
	";
?>

  
