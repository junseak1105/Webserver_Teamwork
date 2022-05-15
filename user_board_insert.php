<meta charset="utf-8">
<?php
    session_start();
    /* 로그인 확인 용
    if (isset($_SESSION["userID"])) $userid = $_SESSION["userID"];
    else $userid = "";
    if (isset($_SESSION["userName"])) $username = $_SESSION["userName"];
    else $username = "";
    */

    //개발용 임시 세션
    $_SESSION["userID"] = 'testID10';
    $_SESSION["userPW"] = 'testID10';
    $_SESSION["userName"] = 'testID10';

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

    $title = $_POST["title"];
    $content = $_POST["content"];

	$title = htmlspecialchars($title, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);

	$date = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
	
	$sql = "insert into board (idx, title, content, date, hit, recommend_Y, recommend_N, writer_id) ";
	$sql .= "values('$idx', '$title', '$content', '$date', '$hit', '$recommend_Y', '$recommend_N', '$userID'";
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

	mysqli_close($con);  // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'user_board_list.php';
	   </script>
	";
?>

  
