<?php
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "../include/db.php";
    
    $prevPage = $_SERVER['HTTP_REFERER'];
    $qa_idx = isset($_GET['qa_idx']) ? $_GET['qa_idx'] : "";
    $qa_ans = isset($_GET['qa_ans']) ? $_GET['qa_ans'] : "";

    //게시글 삭제 idx로 식별
    $sql = "update inquiry set qa_status='Y',qa_answer='$qa_ans' where idx = '$qa_idx'";
    if ($conn->query($sql) === TRUE) {
        echo "답변이 완료되었습니다.";
        header('location:'.$prevPage);
        $conn->close();
    } else {
        echo "답변 전송중 오류가 발생하였습니다.: " . $conn->error;
        header('location:'.$prevPage);
        $conn->close();
    }
    
    
?>