<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include "include/db.php";
include "include/common_function.php";

$sql_user = "select * from member where idx = 5";
$result_user = mysqli_query($conn, $sql_user);
$user_PW = isset($_POST['userPW']) ? $_POST['userPW'] : "";

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
        <form method="post" action="pw_change_check.php">
            <table border="1" style="border-collapse: collapse" width="70%">
                <tr>
                    <td> 현재 비밀번호 :</td>
                    <td><input type='text' name='userPW' placeholder='비밀번호를 입력하세요.'></td>
                </tr>
                <tr>
                    <td> 변경할 비밀번호 :</td>
                    <td><input type='text' name='new_userPW' placeholder='비밀번호를 입력하세요.'></td>
                </tr>

                <tr>
                    <td> 비밀번호 확인 :</td>
                    <td><input type='text' name='new_userPW_confirm' placeholder='한번 더 입력하세요.'></td>
                </tr>
            </table>
            <?php
            while ($row = mysqli_fetch_array($result_user)) {
                $idx = $row['idx'];
                echo "<input type='hidden' name= 'idx' value='$idx'>";
                echo "$idx";
            }
            ?>
            <input type='submit' value='수정하기'/>
        </form>
    </div>
    <?php include "include/footer.php" ?>
    </body>
    </html>
<?php
mysqli_close($conn);
?>
