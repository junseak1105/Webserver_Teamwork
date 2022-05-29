<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    include("./include/db.php");
    $arr = array();

    $userID = $_POST["userID"];
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPW"];

    $sql = "call register('$userName','$userID','$userPassword')";
    //echo $sql;
    $result_set = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_assoc($result_set)) {
        $returnMsg = $result['returnMsg'];
    }
    if($returnMsg=='success'){
        Header("Location: ./Login.php");
    }else{
        Header("Location: ./register.php");
    }
?>