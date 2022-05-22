<?php
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    include "chk_login.php";


    /*$idx = $_POST["idx"];
    echo "$idx";*/
    $idx='711';

    //개발용 임시 세션 넣어둔 것
    $_SESSION["userID"] = 'testID10';
    $_SESSION["userPW"] = 'testID10';
    $_SESSION["userName"] = 'testID10';
    $userID = $_SESSION['userID'];

    if ( !$userID )
    {
        echo("
                    <script>
                    alert('게시판 수정은 로그인 후 이용해 주세요!');
                    location.href = 'user_board_list.php';
                    </script>
        ");
                exit;
    }

    $title = $_POST["title"]; //form에서 제목 가져오기
    $content = $_POST["content"]; // 내용 가져오기

    $title = htmlspecialchars($title, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $date = date("Y-m-d");  // 현재의 '년-월-일'을 저장

    $sql = "update post set title=$title, content=$content, date=$date WHERE idx=$idx";

    mysqli_query($conn, $sql); 

    mysqli_close($conn);  // DB 연결 끊기

    echo "
       <script>
        location.href = 'user_board_list.php';
       </script>
    ";
?>

  

    <!-- $title = $_POST["title"];
    $content = $_POST["content"];
          
    $sql = "update post set title='$title', content='$content' ";
    $sql .= " where idx=$idx";
    mysqli_query($conn, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'user_board_list.php?page=$page';
	      </script>
	  ";
?> -->

   
