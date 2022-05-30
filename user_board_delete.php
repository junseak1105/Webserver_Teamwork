<?php
    //session_start();
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );
    include("./include/db.php");

    $idx = $_GET["idx"];
    
    $sql = "delete from post where idx = '$idx'";
    //echo $sql;
    
    mysqli_query($conn,$sql);

    Header("Location: ./user_board_list.php");
    ?>