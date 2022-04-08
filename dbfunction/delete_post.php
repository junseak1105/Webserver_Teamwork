<?php
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "../include/db.php";
    
    $prevPage = $_SERVER['HTTP_REFERER'];
    $post_idx = isset($_GET['post_idx']) ? $_GET['post_idx'] : "";

    //게시글 삭제 idx로 식별
    $sql = "delete from post where idx = $post_idx;";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header('location:'.$prevPage);
        $conn->close();
    } else {
        echo "Error deleting record: " . $conn->error;
        header('location:'.$prevPage);
        $conn->close();
    }
    
    
?>