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
list($list_page_no_selected, $list_page_no, $list_less_then_length) = page_count("prefer", $list_length, $member_page_no_selected, $query_where);


//페이지 하나 이하 처리
if ($list_less_then_length == "true") {

    $sql_prefer = "select post.idx, title, writer_id from prefer, post where prefer.postidx = post.idx and prefer.useridx = 5";
} else {
    $sql_prefer = "select post.idx, title, writer_id from prefer, post 
                                  where prefer.postidx = post.idx and prefer.useridx = 5
                                  limit $list_page_no_selected,$list_length;";
}

$result_prefer = mysqli_query($conn, $sql_prefer);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include "include/head.php";
        include "include/mypage_sidemenu.php"; 
    ?>
</head>
<body>
<!-- 내가 좋아요 누른 글 조회 -->
<table border="1" style="border-collapse: collapse" width="70%">
    <?php
    echo "<tr><td>번호</td><td> 글 제목 </td> <td> 작성자 </td></tr>";
    while ($row = mysqli_fetch_array($result_prefer)) {

        echo "<tr><td>" . $row['idx'] . "</td><td>" . $row['title'] . "</td><td>" . $row['writer_id'] . "</td></tr>";

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
