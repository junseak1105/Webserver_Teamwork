<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
include "db.php";
$func = isset($_GET['func']) ? $_GET['func'] : "";

if($func == "db_delete"){
    db_delete($func,$_GET['db'],$_GET['idx'],$_SERVER['HTTP_REFERER']);
}else if($func == "db_update"){
    db_update($func,$_GET['db'],$_GET['idx'],$_SERVER['HTTP_REFERER']);
}else if($func == "db_insert"){
    db_insert($func,$_GET['db'],$_SERVER['HTTP_REFERER']);
}else if($func =="login"){
    login();
};

//로그인 시작

//로그인 끝
//회원가입 시작
//회원가입 끝
//게시글 페이지 갯수 연산 시작
function page_count($tablename,$list_length,$list_no_selected,$list_where){ //파라미터는 테이블 명, 페이지당 원하는 게시글 수,선택된 페이지 숫자,조건값where
    include "db.php";
    $sql = "select count(*) from $tablename $list_where";
    //echo $sql;
    $result = mysqli_query($conn,$sql);
    $list_count = mysqli_fetch_array($result);
    $list_page_no_selected = $list_no_selected * $list_length; 
    
    $list_page_no = $list_count[0]/$list_length; //게시글 페이지 갯수
    if($list_count[0]<$list_length){ //지정한 페이지당 게시글 수보다 적은 경우 식별용 데이터
        $list_less_then_length = "true";
    }else{
        $list_less_then_length = "false";
    }
    return array($list_page_no_selected,floor($list_page_no),$list_less_then_length); //선택된 페이지 숫자, 페이지 갯수, 페이지 숫자 1이하
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

// 삭제 처리문 모음 시작
function db_delete($func,$db,$idx,$prevPage){
    include "db.php";
    $sql = "delete from $db where idx = $idx;";
    
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
//삭제 처리문 모음 끝

//update 수정 처리문 시작
function db_update($func,$db,$idx,$prevPage){
    include "db.php";
    if($db == "commoncode"){
        $co_code = $_GET['co_code'];
        $co_name = $_GET['co_name'];
        $sql = "update $db set co_code = '$co_code',co_name = '$co_name' where idx = $idx";
        echo $sql;
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
//update 수정 처리문 끝
//insert 추가 처리문 시작
function db_insert($func,$db,$prevPage){
    include "db.php";
    if($db == "commoncode"){
        $co_code = $_GET['co_code'];
        $co_name = $_GET['co_name'];
        $sql = "insert into commoncode(co_code,co_name) values('$co_code','$co_name')";
        echo $sql;
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
//insert 추가 처리문 끝

?>
