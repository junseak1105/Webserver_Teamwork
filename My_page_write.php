<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include "include/db.php";
include "include/common_function.php";
include "include/head.php";
$query_where = "";
//echo $_SESSION['userID'];
//페이지 설정
$member_page_no_selected = intval(isset($_GET['member_page_no_selected']) ? $_GET['member_page_no_selected'] : ""); //선택된 페이지 숫자
$list_length = 10; //페이지당 출력 길이
list($list_page_no_selected, $list_page_no, $list_less_then_length) = page_count("post", $list_length, $member_page_no_selected, $query_where);


//페이지 하나 이하 처리
if ($list_less_then_length == "true") {
    $sql = "select * from post $query_where order by idx";
} else {
    $sql = "select * from post order by idx limit $list_page_no_selected,$list_length;";
}
//5자리에 받아올 거 넣으면 됨
$sql_user = "select * from member where idx = 5";
$result_user = mysqli_query($conn, $sql_user);

$sql_inquiry = "select * from inquiry where idx = 5";
$result_inquiry = mysqli_query($conn, $sql_user);

$result_write = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<body>
<table border="1" style="border-collapse: collapse" width="70%">
    <?php
    $count = 1;
    echo "<tr><td>글 번호</td><td> 제목 </td><td> 작성일 </td><td> 좋아요 </td></tr>";
    while ($row = mysqli_fetch_array($result_write)) {

        echo "<tr><td>" . $row['idx'] . "</td><td>" . $row['title'] . "</td><td>" . $row['date'] . "</td><td>" . $row['recommend_Y'] . "</td></tr>";
        $count++;
    }
    ?>
</table>

<table>
    <tr>
        <?php
        $i = 0;
        while ($i < $list_page_no) {
            echo '<td><a href="my_page_write.php?member_page_no_selected=' . $i . '">' . $i + 1 . '</a></td>';

            $i++;
        }
        ?>
    </tr>
</table>
</body>
<?php include "include/footer.php"; ?>
</html>