<a href="./admin_main.php">어드민페이지</a>
<a href="./Login.php">로그인페이지</a>


<?php
session_start();
echo $_SESSION['userID'];

?>

<html>
    <link href="style.css" rel = "stylesheet">
    <body>
        <ul>
            <li><img src="<?=$img_path?>"></li>
            <li><?=$_POST["comment"]?></li>
        </ul>
        <form name = "form1" method = "post" action="view8.php" enctype=>

        </form>
    </body>
</html>
