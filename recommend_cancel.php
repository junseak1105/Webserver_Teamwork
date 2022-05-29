<?php
$prevPage = $_SERVER['HTTP_REFERER'];
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("./include/db.php");

$userID = $_COOKIE["userID"];
$title = $_GET['title'];

$sql = "delete from recommend where userID = '$userID' and title = '$title'";
//echo $sql;

mysqli_query($conn, $sql);

echo "<script> document.location.href='$prevPage'</script>";
