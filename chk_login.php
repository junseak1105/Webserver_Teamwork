<?
    include("./include/db.php");

    header("Content-Type: application/json"); // json 으로 return 할 것이기 때문에

    $userId = $_POST["userID"];
    $userPwd = $_POST["userPW"];
    
    // ... userId, userPwd 로 인증
    
    $statement = mysqli_prepare($conn, "SELECT IF( EXISTS(
        SELECT userID,userPW
        FROM member
        WHERE userID=? and userPW = ?), 'true', 'false') as returnMsg;");
    mysqli_stmt_bind_param($statement, "ss", $userID, $userPW);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $RESULT);

    $response = array();

    while(mysqli_stmt_fetch($statement)) {
        $response["returnMsg"] = $returnMsg;
        $response["userID"] = $userID;
    }
    mysqli_close($conn); 
    
    echo json_encode($response); // json 형식으로 echo 함.
?>