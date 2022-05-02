<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include "include/db.php";
include "include/common_function.php";


$query_where = "";

//페이지 설정
$member_page_no_selected = intval(isset($_GET['member_page_no_selected']) ? $_GET['member_page_no_selected'] : ""); //선택된 페이지 숫자
$list_length = 20; //페이지당 출력 길이
list($list_page_no_selected, $list_page_no, $list_less_then_length) = page_count("post", $list_length, $member_page_no_selected, $query_where);


//페이지 하나 이하 처리
if ($list_less_then_length == "true") {
    $sql = "select * from post $query_where order by idx";
} else {
    $sql = "select * from post order by idx limit $list_page_no_selected,$list_length;";
}

echo $sql;
//5자리에 받아올 거 넣으면 됨
$sql_user = "select * from member where idx = 5";

$result_user = mysqli_query($conn, $sql_user);

$result_write = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<!-- header-->
<head><?php include "include/head.php"; ?></head>


<body>
<div id="lnb_area">
    <div class="lnb">
        <ul role="menu" class="tabnav">
            <li id="nid" role="presentation" class="on" aria-current="true"><a href="#tab01"> 내 프로필 </a></li>
            <li id="security" role="presentation" class=""><a href="#tab02"> 이력 관리 </a></li>
        </ul>
    </div>
</div>
<div class="tabcontent">
    <div id="tab01">
        <table border="1" style="border-collapse: collapse" width="70%">
            <?php
            while ($row = mysqli_fetch_array($result_user)) {
                echo "<tr><td>이름</td><td>" . $row['userName'] . "</td></tr>";
                echo "<tr><td>아이디</td><td>" . $row['userID'] . "</td></tr>";
                echo "<tr><td>이메일</td><td>" . $row['userEmail'] . "</td></tr>";
                echo "<tr><td>비밀번호</td><td>" . $row['userPW'] . "</td></tr>";
            }
            ?>
        </table>
    </div>

    <div id="tab02">
        <div id="lnb_area">
            <div class="lnb">
                <ul role="menu" class="tabnav2">
                    <li id="nid" role="write" class="on" aria-current="true"><a href="#tab11"> 내가 쓴 글 </a></li>
                    <li id="security" role="list" class=""><a href="#tab12"> 문의 사항 </a></li>
                    <!--<li id="ask" role="list" class=""><a href="#tab13"> 문의 사항 </a></li>-->
                </ul>
            </div>
        </div>


        <div class=tabcontent2>
            <div id="tab11">
                <table border="1" style="border-collapse: collapse" width="70%">
                    <?php
                    while ($row = mysqli_fetch_array($result_write)) {
                        echo "<tr><td>제목</td><td>" . $row['title'] . "</td></tr>";
                        echo "<tr><td>내용</td><td>" . $row['content'] . "</td></tr>";
                    }
                    ?>
                </table>

                <table>
                    <tr>
                        <?php
                        $i = 0;
                        while ($i < $list_page_no) {
                            echo '<td><a href="my_page.php?member_page_no_selected=' . $i . '">' . $i + 1 . '</a></td>';
                            $i++;
                        }
                        ?>
                    </tr>
                </table>
            </div>
            <div id="tab12"> test2</div>
            <!--<div id="tab13"> test3</div>-->
        </div>
    </div>

</body>
<?php include "include/footer.php"; ?>
<script>
    $(function () {
        $('.tabcontent > div').hide();
        $('.tabnav a').click(function () {
            $('.tabcontent > div').hide().filter(this.hash).fadeIn();
            $('.tabnav a').removeClass('active');
            $(this).addClass('active');
            return false;
        }).filter(':eq(0)').click();
    });

    $(function () {
        $('.tabcontent2 > div').hide();
        $('.tabnav2 a').click(function () {
            $('.tabcontent2 > div').hide().filter(this.hash).fadeIn();
            $('.tabnav2 a').removeClass('active');
            $(this).addClass('active');
            return false;
        }).filter(':eq(0)').click();
    });
</script>
<style>
    #lnb_area {
        height: 39px;
        margin-top: -1px;
        border-top: 1px solid #00af35;
        border-bottom: 1px solid #e5e5e5;
        background-color: #fff;
        list-style: none;

    .lnb {
        max-width: 914px;
        margin: 0 auto;
        padding: 0 20px;
    }

    }

    li {
        margin: 0 20px 0 0;
        padding: 0 0 0 0;
        border: 0;
        float: left;
    }

    ul {
        list-style: none;
    }

    #container {
        position: relative;
        z-index: 20;
        max-width: 954px;
        height: 100%;
        margin: 0 auto;
    }

    #content {
        position: relative;
        padding: 32px 51px 95px;
    }

    table {
        background: white;
        padding: 5%;
    }
</style>
</html>
