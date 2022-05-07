<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include "include/db.php";
include "include/common_function.php";

$user_ID = isset($_POST['userID']) ? $_POST['userID'] : "";

$sql_user = "select * from member where userID = '$user_ID'";
$result_user = mysqli_query($conn, $sql_user);

echo "$sql_user";
?>

    <!DOCTYPE html>
    <html>
    <head><?php include "include/head.php"; ?></head>
    <body>
    <?php
    include "include/nav_main.php";
    include "include/sidenav.php";
    ?>
    <h2> 아이디 변경</h2>
    <div>
        <form method="post" action="">
            <table border="1" style="border-collapse: collapse" width="70%">
                <?php
                while ($row = mysqli_fetch_array($result_user)) {
                    //중복검사 있어야될듯
                    echo "<tr><td> 아이디 : </td><td><input type='text' name='user_id' placeholder='아이디를 입력하세요.'></td></tr>";
                    echo "<tr><td> 이메일 : </td><td><input type='text' name='user_id' placeholder='이메일을 입력하세요.'></td></tr>";
                    echo "<tr><td> 비밀번호 : </td><td><input type='text' name='user_id' placeholder='변경할 비밀번호를 입력하세요.'></td></tr>";
                    echo "<tr><td> 비밀번호 확인 : </td><td><input type='text' name='user_id' placeholder='한번 더 입력하세요.'></td></tr>";
                }
                ?>
            </table>
            <input type="submit" value="가입하기"/>
        </form>
    </div>
    <?php include "include/footer.php" ?>
    </body>
    </html>

<?php
mysqli_close($conn);
?>