<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
$userID = $_COOKIE["userID"];
include "include/db.php";
include "include/common_function.php";

$category_val = isset($_POST["category_val"]) ? $_POST["category_val"] : "";
$sb_val = isset($_POST["sb_val"]) ? $_POST["sb_val"] : "";

$query = "select count(*) as count from post where writer_id = '$userID'";
$data = $conn->query($query)->fetch_array();
$num = $data['count']; //조회된 값 갯수
// //페이징,검색 끝
/* paging : 한 페이지 당 데이터 개수 */
$list_num = 20;

/* paging : 한 블럭 당 페이지 수 */
$page_num = 10;

/* paging : 현재 페이지 */
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

/* paging : 전체 페이지 수 = 전체 데이터 / 페이지당 데이터 개수, ceil : 올림값, floor : 내림값, round : 반올림 */
$total_page = ceil($num / $list_num);
// echo "전체 페이지 수 : ".$total_page;

/* paging : 전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수 */
$total_block = ceil($total_page / $page_num);

/* paging : 현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수 */
$now_block = ceil($page / $page_num);

/* paging : 블럭 당 시작 페이지 번호 = (해당 글의 블럭번호 - 1) * 블럭당 페이지 수 + 1 */
$s_pageNum = ($now_block - 1) * $page_num + 1;
// 데이터가 0개인 경우
if ($s_pageNum <= 0) {
    $s_pageNum = 1;
};

/* paging : 블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수 */
$e_pageNum = $now_block * $page_num;
// 마지막 번호가 전체 페이지 수를 넘지 않도록
if ($e_pageNum > $total_page) {
    $e_pageNum = $total_page;
};

/* paging : 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 데이터 수 */
$start = ($page - 1) * $list_num;

/* paging : 쿼리 작성 - limit 몇번부터, 몇개 */
$sql = "select * from post where writer_id = '$userID'";
if ($category_val != "" && $sb_val != "") {
    $sql = $sql . "where category = '$category_val' and (content like '%$sb_val%' or title like '%$sb_val%') ";
} else if ($category_val != "") {
    $sql = $sql . "where category = '$category_val' ";
} else {
    //$sql = $sql . "where content like '%$sb_val%' or title like '%$sb_val%' ";
}
$sql = $sql . "order by idx desc limit $start, $list_num ;";

/* paging : 쿼리 전송 */
$result = mysqli_query($conn, $sql);

/* paging : 글번호 */
$cnt = $start + 1;
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
<div class="my_page_write">
    <h2>마이페이지 > 게시글 관리</h2>
    <table class="my_page_write_list">
        <thead>
        <tr>
            <th class="idx">번호</th>
            <th class='title'>제목</th>
            <th class="date">작성일</th>
            <th class="recommend">추천</th>
        </tr>
        </thead>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $row['idx']; ?></td>
                <th class="title"><a
                            href="user_board_view.php?idx=<?php echo $row['idx'] ?>"><?php echo $row['title'] ?></th>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['recommend_Y']; ?></td>
                <td class="edit">
                    <form method="post" action="user_board_modify_form.php">
                        <button  type='submit' value="<?= $row['idx'] ?>" name='idx'>수정</button>
                    </form>
                </td>
                <td class="delete">
                    <button  onclick="location.href='user_board_delete.php?idx=<?= $row['idx'] ?>'">삭제
                    </button>
                </td>
            </tr>
            <?php
        };
        ?>
    </table>
    <div class="paper">
        <p>
            <?php
            /* paging : 이전 페이지 */
            if ($page <= 1) {
                ?>
                <a href="My_page_write.php?page=1">이전</a>
            <?php } else { ?>
                <a href="My_page_write.php?page=<?php echo($page - 1); ?>">이전</a>
            <?php }; ?>

            <?php
            /* pager : 페이지 번호 출력 */
            for ($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++) {
                ?>
                <a href="My_page_write.php?page=<?php echo $print_page; ?>"><?php echo $print_page; ?></a>
            <?php }; ?>

            <?php
            /* paging : 다음 페이지 */
            if ($page >= $total_page) {
                ?>
                <a href="My_page_write.php?page=<?php echo $total_page; ?>">다음</a>
            <?php } else { ?>
                <a href="My_page_write.php?page=<?php echo($page + 1); ?>">다음</a>
            <?php }; ?>
        </p>
    </div>
</div>
</body>
<?php include "include/footer.php"; ?>
</html>
<?php
mysqli_close($conn);
?>