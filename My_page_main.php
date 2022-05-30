<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include "include/db.php";
$query_where = "";
//echo $_SESSION['userID'];

//echo $sql;
//5자리에 받아올 거 넣으면 됨
$sql_user = "select * from member where idx = 5";
$result_user = mysqli_query($conn, $sql_user);

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
    <div class="my_page_main">
        <h2>내 프로필</h2>
        <table class="my_page_info">
            <?php
            while ($row = mysqli_fetch_array($result_user)) {
                echo "<tr><th>이름</th><td>" . $row['userName'] . "</td></tr>";
                echo "<tr><th>아이디</th><td>" . $row['userID'] . "</td></tr>";
                echo "<tr><th>이메일</th><td>" . $row['userEmail'] . "</td></tr>";
                echo "<tr><th>비밀번호</th><td>" . $row['userPW'] . "</td></tr>";
                $userPW = $row['userPW'];
                $idx = $row['idx'];
            }
            ?>
        </table>
        <div class="my_page_main_revise">
            <form action="revise.php" method="post">
                <?php
                /*echo "$idx"; 없어도 되는 부분같은데 체크 바람*/
                echo "<input type='hidden' name= 'idx' value='$idx'>";
                echo "<input type='hidden' name= 'userPW' value='$userPW'>";
                ?>
                <input type="submit" value="비밀번호 수정">
            </form>
        </div>
    </div>


</body>
<?php include "include/footer.php"; ?>
</html>
