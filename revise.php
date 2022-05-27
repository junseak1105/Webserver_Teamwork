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
<head>
    <?php 
        include "include/head.php"; 
    ?>
</head>   
<body>
    <div class="revise">
        <h2> 비밀번호 변경</h2>
        <form class="revise_info" method="post" action="pw_change_check.php">
            <?php
                while ($row = mysqli_fetch_array($result_user)) {
                    $idx = $row['idx'];
                    echo "<input type='hidden' name= 'idx' value='$idx'>";
                    /* echo "$idx"; 없어도 되는 부분같은데 체크 바람 */
                } ?>
            <div class="revise_inputbox">
                <input type='password' name='userPW' placeholder='현재 비밀번호'>
                <label for="userPW">현재 비밀번호</label>
            </div>
            <div class="revise_inputbox">
                <input type='password' name='new_userPW' placeholder='새 비밀번호'>
                <label for="new_userPW">새 비밀번호</label>
            </div>
            <div class="revise_inputbox">
                <input type='password' name='new_userPW_confirm' placeholder='새 비밀번호 확인'>
                <label for="new_userPW_confirm">새 비밀번호 확인</label>
            </div>
            <input class="btn_revise" type='submit' value='수정하기'/>
        </form>
    </div>
<?php include "include/footer.php" ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
