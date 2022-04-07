<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

//게시글 페이지 갯수 연산 시작
function page_count($tablename,$list_length,$list_no_selected){ //파라미터는 테이블 명, 페이지당 원하는 게시글 수,선택된 페이지 숫자
    include "db.php";
    $sql = "select count(*) from $tablename";
    $result = mysqli_query($conn,$sql);
    $list_count = mysqli_fetch_array($result);
    $list_per_page = $list_length; //페이지당 원하는 게시글 수;
    $list_page_no_selected = $list_no_selected * $list_per_page; 
    
    $list_page_no = $list_count[0]/20; //게시글 페이지 갯수
    return array($list_page_no_selected,$list_page_no);
};
//게시글 페이지 갯수 연산

?>