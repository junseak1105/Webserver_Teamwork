<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    $sql = "select * from post";
    $result = mysqli_query($conn,$sql);
    
?>

<!DOCTYPE html>
<html>
<head>
<title>
</title>
</head>
<body>
    <table border="1">
        <th>글제목</th>
        <th>글내용</th>
        <?php
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>' . $row[ 'title' ] . '</td><td>'. $row[ 'content' ] . '</td></tr>';
        }
        ?>
    </table>
</body>
</html>
<?php
mysqli_close($conn);
?>