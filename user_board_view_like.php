<meta charset="utf-8">
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include "include/db.php";
include "include/common_function.php";
$prevPage = $_SERVER['HTTP_REFERER'];
//개발용 임시 세션 넣어둔 것
$_SESSION["userID"] = 'userid1';
$_SESSION["userPW"] = 'userpw1';
$_SESSION["userName"] = 'userName1';
$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];
$title = $_POST["_title"];
$recommend_type = null;

$userID = $_COOKIE["userID"];

$sql_recommend = "select * from recommend where userID = '$userID' AND title = '$title'";
$result_recommend = mysqli_query($conn, $sql_recommend);

$sql_post = "select recommend_Y, recommend_N from post where title = '$title'";
$result_post = mysqli_query($conn, $sql_post);



while ($row = mysqli_fetch_array($result_recommend)) {
    $recommend_type = $row['recommedtype'];
}
while ($row = mysqli_fetch_array($result_post)) {
    $post_recommend = $row['recommend_Y'];
}



//isset에 if문 써서 있는 값만 가져오기
//DB 테이블 prefer에 useridx, 추천한 게시글idx 저장


if ($recommend_type == null) {

    if (isset($_POST['recommend_Y'])) {
        $like = $_POST['recommend_Y'];
        $post_recommend++;
        echo "$post_recommend";
        $sql_insert_recommend = "insert into recommend value('$userID','$title','$like')";
        mysqli_query($conn, "update post set recommend_Y= '$post_recommend' where title = '$title'");
        echo "추천이 추가된거";
        echo"<script> document.location.href='$prevPage'</script>";

    } elseif (isset($_POST['recommend_N'])) {
            $unlike = $_POST['recommend_N'];
            $sql_insert_recommend = "insert into recommend value('$userID','$title','$unlike')";
            echo "비추이 추가된거";
    }
    $result_recommend = mysqli_query($conn, $sql_insert_recommend);

}
else{
    if (isset($_POST['recommend_Y'])) {
        if ($recommend_type == $_POST['recommend_Y']) {
            $post_recommend--;
            echo "$post_recommend";
            $sql_del_recommend = "DELETE FROM recommend WHERE userID = '$userID' AND title = '$title'";
            $sql_update_post = "update post set recommend_Y= '$post_recommend' where title = '$title'";
            mysqli_query($conn, "update post set recommend_Y= '$post_recommend' where title = '$title'");
            echo"<script> document.location.href='$prevPage'</script>";
            echo "추천이 삭제된거";
        }else{
            echo "비추한적 있는글";
        }
    }
    if (isset($_POST['recommend_N'])) {
        if ($recommend_type == $_POST['recommend_N']) {
            $del_result_recommend = mysqli_query($conn, $sql_del_recommend);
            echo "비추가 삭제된거";
        }else{
            echo "추천한적 있는글";
        }
    }
    $del_result_recommend = mysqli_query($conn, $sql_del_recommend);
}
?>