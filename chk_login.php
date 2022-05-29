<?php
    session_start();
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );
    include("./include/db.php");
 
    header("Content-Type: application/json"); // json 으로 return 할 것이기 때문에

    $userID = $_POST["userID"];
    $userPW = $_POST["userPW"];
    
    $sql = "SELECT IF( EXISTS(
        SELECT userID,userPW
        FROM member
        WHERE userID='$userID' and userPW = md5('$userPW')), 'true', 'false') as returnMsg,(select co_code from member
        WHERE userID='$userID' and userPW = md5('$userPW')) as co_code;";
    
    
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        $ReturnMsg=$row[0];
        $co_code=$row[1];
    }
    mysqli_close($conn);
    //echo $ReturnMsg;
    if ($ReturnMsg=="true"){
        // $_SESSION['userID']=$userID;
        // $_SESSION['class']=$co_code;
        setcookie("userID", $userID, time() + 3600, "/");
        setcookie("class", $co_code, time() + 3600, "/");
        Header("Location: ./index.php");
    }else{
        Header("Location: ./Login.php");
    }
    //echo json_encode($response); // json 형식으로 echo 함.
    ?>