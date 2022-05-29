<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include "include/db.php";
include "include/common_function.php";

$query_where = "";
//echo $_SESSION['userID'];
//페이지 설정
$member_page_no_selected = intval(isset($_GET['member_page_no_selected']) ? $_GET['member_page_no_selected'] : ""); //선택된 페이지 숫자
$list_length = 10; //페이지당 출력 길이
list($list_page_no_selected, $list_page_no, $list_less_then_length) = page_count("post", $list_length, $member_page_no_selected, $query_where);

//5자리에 받아올 거 넣으면 됨
$sql_user = "select * from member where userID = 'testID1'";
$result_user = mysqli_query($conn, $sql_user);

$sql_inquiry = "select * from inquiry where userID = 'testID1'";
$result_inquiry = mysqli_query($conn, $sql_inquiry);

?>

<!DOCTYPE html>
<html lang="en">
<!-- header-->
<head><?php include "include/head.php"; ?></head>


<body>
<table border="1" style="border-collapse: collapse" width="70%">
    <tr>
        <th>글번호</th>
        <th>질문 유형</th>
        <th>제목</th>
        <th>답변 여부</th>
    </tr>
    <?php
    $count = 1;
    while ($row = mysqli_fetch_array($result_inquiry)) {
        echo "<tr><td>" . $count . "</td><td>" . $row['qa_category'] . "</td><td>" . $row['qa_subject'] . "</td><td>" . $row['qa_status'] . "</td></tr>";
        $count++;
    }
    ?>
</table>
<input type="button" value="문의하기">
<!--<div id="tab13"> test3</div>-->

</body>
<?php include "include/footer.php"; ?>

</html>
