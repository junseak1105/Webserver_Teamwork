<?php
$conn = mysqli_connect(
    'localhost', // IP
    'root', // 아이디
    '1234', // 비밀번호
    'webserver_classprj' // 데이터베이스
    
);

// $conn = mysqli_connect(
//     'localhost',
//     'root',
//     '',
//     'dgnr'
// );
// 한글깨짐 현상 관련
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
?>