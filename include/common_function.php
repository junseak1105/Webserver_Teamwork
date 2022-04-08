<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

//게시글 페이지 갯수 연산 시작
function page_count($tablename,$list_length,$list_no_selected,$list_where){ //파라미터는 테이블 명, 페이지당 원하는 게시글 수,선택된 페이지 숫자,조건값where
    include "db.php";
    $sql = "select count(*) from $tablename $list_where";
    $result = mysqli_query($conn,$sql);
    $list_count = mysqli_fetch_array($result);
    $list_per_page = $list_length; //페이지당 원하는 게시글 수;
    $list_page_no_selected = $list_no_selected * $list_per_page; 
    
    $list_page_no = $list_count[0]/20; //게시글 페이지 갯수
    if($list_count[0]<$list_length){ //지정한 페이지당 게시글 수보다 적은 경우 식별용 데이터
        $list_less_then_length = "true";
    }else{
        $list_less_then_length = "false";
    }
    return array($list_page_no_selected,floor($list_page_no),$list_less_then_length);
};
//게시글 페이지 갯수 연산 끝

?>