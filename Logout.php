<?php 
    setcookie("userID", "", time() - 3600, "/"); 
    setcookie("class", "", time() - 3600, "/");
    Header("Location:./index.php");
?>