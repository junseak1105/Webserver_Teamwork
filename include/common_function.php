<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
include "db.php";
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

// 오늘 방문자수 fetch 시작
function visit_today(){
    include "db.php";
    $currdt = date("Y-m-d H:i:s"); 
	$query = "select count(*) as count from stat_visit where DATE(regdate) = DATE('$currdt')";
	$data = $conn->query($query)->fetch_array();
	$today_visit_count = $data['count'];
    echo $today_visit_count;
};
// 오늘 방문자수 fetch 끝

// 전체 방문자수 fetch 시작
function visit_total(){
    include "db.php";
    $currdt = date("Y-m-d H:i:s"); 
    $query = "select count(*) as count from stat_visit";
    $data = $conn->query($query)->fetch_array();
    $total_visit_count = $data['count'];
    echo $total_visit_count;
}
// 전체 방문자수 fetch 끝

// 문의사항 처리 완료 수 fetch 시작
function inquiry_Y_count(){
    include "db.php";
	$query = "select count(*) as count from inquiry where qa_status = 'Y'";
	$data = $conn->query($query)->fetch_array();
	$inquiry_Y_count = $data['count'];
    echo $inquiry_Y_count;
};
// 오늘 방문자수 fetch 끝

// 문의사항 처리 미완료 수 fetch 시작
function inquiry_N_count(){
    include "db.php";
    $query = "select count(*) as count from inquiry where qa_status = 'N'";
    $data = $conn->query($query)->fetch_array();
    $inquiry_N_count = $data['count'];
    echo $inquiry_N_count;
}
// 전체 방문자수 fetch 끝

// 삭제 처리문 모음
function db_delete($func,$idx){
    include "db.php";
    if($func == "post"){
        $sql = "delete from post where idx = $idx;";
    }elseif($func == "member"){
        $sql = "delete from member where idx = $idx;";
    }
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header('location:'.$prevPage);
        $conn->close();
    } else {
        echo "Error deleting record: " . $conn->error;
        header('location:'.$prevPage);
        $conn->close();
    }
}

?>
