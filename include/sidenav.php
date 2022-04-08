<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a id="sidenav_1" href="#"></a>
  <a id="sidenav_2" href="#"></a>
  <a id="sidenav_3" href="#"></a>
  <a id="sidenav_4" href="#"></a>
</div>

<!-- Use any element to open the sidenav -->
<script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
            $("#sidenav_1").text("대시보드");
            $("#sidenav_1").attr("href","admin_main.php");
            $("#sidenav_2").text("사용자 관리");
            $("#sidenav_2").attr("href","admin_member.php");
            $("#sidenav_3").text("게시글 관리");
            $("#sidenav_3").attr("href","admin_post.php");
            $("#sidenav_4").text("문의사항 관리");
            $("#sidenav_4").attr("href","admin_inquiry.php?cb_ans=All");
        document.getElementById("mySidenav").style.width = "250px";
    }

/* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>