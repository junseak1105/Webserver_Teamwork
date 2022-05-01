
<!DOCTYPE html>
<html lang="en">
<!-- header-->
<head><?php include "include/head.php"; ?></head>


<body>
<div id="lnb_area">
    <div class="lnb">
        <ul role="menu" class="tabnav">
            <li id="nid" role="presentation" class="on" aria-current="true"><a href="#tab01"> 내 프로필 </a></li>
            <li id="security" role="presentation" class=""><a href="#tab02"> 개인 정보 변경 </a></li>
            <li id="manageHistory" role="presentation" class=""><a href="#tab03"> 이력 관리 </a></li>
        </ul>
    </div>
</div>

<div class="tabcontent">
    <div id="tab01">tab1 content</div>
    <div id="tab02">tab2 content</div>
    <div id="tab03">tab3 content</div>
</div>
<hr>


<!-- footer -->
<?php include "include/footer.php" ?>

</body>
<script>
    $(function(){
        $('.tabcontent > div').hide();
        $('.tabnav a').click(function () {
            $('.tabcontent > div').hide().filter(this.hash).fadeIn();
            $('.tabnav a').removeClass('active');
            $(this).addClass('active');
            return false;
        }).filter(':eq(0)').click();
    });
</script>
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