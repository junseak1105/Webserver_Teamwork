<?php
    session_start();
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );
    include("./include/db.php");
 
    header("Content-Type: application/json"); // json 으로 return 할 것이기 때문에

    $userID = $_GET["userID"];
    $userPW = $_GET["userPW"];
    
    $sql = "SELECT IF( EXISTS(
        SELECT userID,userPW
        FROM member
        WHERE userID='$userID' and userPW = '$userPW'), 'true', 'false') as returnMsg, userID from member where userID='$userID' and userPW='$userPW';";
    
    
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        $ReturnMsg=$row[0];
        $userID=$row[1];
    }
    mysqli_close($conn);
    if ($ReturnMsg){
        $_SESSION['userID']=$userID;
        Header("Location: ./index.php");
    }else{
        Header("Location: ./Login.php");
    }
    //echo json_encode($response); // json 형식으로 echo 함.
?>