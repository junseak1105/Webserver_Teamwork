<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include "include/db.php";
include "include/head.php";
$query_where = "";
//echo $_SESSION['userID'];

//echo $sql;
//5자리에 받아올 거 넣으면 됨
$sql_user = "select * from member where idx = 5";
$result_user = mysqli_query($conn, $sql_user);

?>

<!DOCTYPE html>
<html lang="en">

<body>
<table border="1" style="border-collapse: collapse" width="70%">
    <?php
    while ($row = mysqli_fetch_array($result_user)) {
        echo "<tr><td>이름</td><td>" . $row['userName'] . "</td></tr>";
        echo "<tr><td>아이디</td><td>" . $row['userID'] . "</td></tr>";
        echo "<tr><td>이메일</td><td>" . $row['userEmail'] . "</td></tr>";
        echo "<tr><td>비밀번호</td><td>" . $row['userPW'] . "</td></tr>";
        $userPW = $row['userPW'];
        $idx = $row['idx'];
    }
    ?>
</table>
<form action="revise.php" method="post">
    <?php
    echo "$idx";
    echo "<input type='hidden' name= 'idx' value='$idx'>";
    echo "<input type='hidden' name= 'userPW' value='$userPW'>";
    ?>

    <input type="submit" value="비밀번호 수정">
</form>

</body>
<?php include "include/footer.php"; ?>
</html>
