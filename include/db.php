<?php
$conn = mysqli_connect(
    'jhk.n-e.kr', // IP
    'dsu_webserver_prj', // 아이디
    'webserver_prj_jhk', // 비밀번호
    'webserver_classprj' // 데이터베이스
);

// $conn = mysqli_connect(
//     'localhost',
//     'root',
//     '1234',
//     'dgnr'
// );
// 한글깨짐 현상 관련
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
?>