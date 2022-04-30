
<!DOCTYPE html>
<html lang="en">
<!-- header-->
<head><?php include "include/head.php"; ?></head>


<body>
<div id="lnb_area">
    <div class="lnb">
        <ul role="menu">
            <li id="nid" role="presentation" class="on" aria-current="true"><a href=""> 내 프로필 </a></li>
            <li id="security" role="presentation" class=""><a href=""> 개인 정보 변경 </a></li>
            <li id="manageHistory" role="presentation" class=""><a href=""> 이력 관리 </a></li>
        </ul>
    </div>
</div>
<hr>


<!-- footer -->
<?php include "include/footer.php" ?>

</body>
<style>
    #lnb_area {
        height: 39px;
        margin-top: -1px;
        border-top: 1px solid #00af35;
        border-bottom: 1px solid #e5e5e5;
        background-color: #fff;
    }
    li {
        margin: 0 20px 0 0;
        padding: 0 0 0 0;
        border : 0;
        float: left;
    }
</style>
</html>