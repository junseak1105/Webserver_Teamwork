<?php

include "include/db.php";

include "include/common_function.php";

 

$sql_user = "select * from member where idx = 5";

$userID = $_COOKIE['userID'];

$userPW = $_POST['userPW'];

$new_userPW = $_POST['new_userPW'];

$new_userPW_confirm = $_POST['new_userPW_confirm'];

$sql_user = "select * from member where userID = '$userID'";

$query = "select md5('$userPW') as newpw";
    $data = $conn->query($query)->fetch_array();
    $inquiry_N_count = $data['newpw']; 

$result_user = mysqli_query($conn, $sql_user);

 

 

while ($row = mysqli_fetch_array($result_user)) {

    if($row['userPW'] != $inquiry_N_count){

        echo "<script>alert('현재 비밀번호가 틀립니다');";

        echo "window.location.href='../revise.php';</script>";

    }else{

        if($userPW == $new_userPW){

            echo "<script>alert('동일한 비밀번호로 변경할 수 없습니다.');";

            echo "window.location.href='../revise.php';</script>";

        }else{

            if($new_userPW != $new_userPW_confirm) {
                echo "<script>alert('변경할 비밀번호가 다릅니다.');";

                echo "window.location.href='../revise.php';</script>";

            }else{

                echo "<script>alert('비밀번호 변경이 완료되었습니다..');";

                mysqli_query($conn, "update member SET userPW = md5('$new_userPW') WHERE userID = '$userID'");

                echo "window.location.href='/my_page_main.php';</script>";

 

            }

        }

    }

}

 

?>