<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    
?>

<!DOCTYPE html>
<html>
<head><?php include "include/head.php"; ?></head>
<body>
<?php
	include "include/nav_main.php"; 
	include "include/sidenav.php";
?>
    <div>
        작성
    </div>
    <?php include "include/footer.php" ?>
</body>
</html>

<?php
mysqli_close($conn);
?>