<!-- <nav>
    <div class="nav_top">
        <div class="nav_top2">
            <?php if(isset($_COOKIE['class']) && ($_COOKIE['class']) == "admin") {?>
            <a href="./admin_main.php">관리페이지</a>
            <?php } if(isset($_COOKIE['userID']) && ($_COOKIE['userID']) !="") {?>        
            <a href="my_page_main.php">마이페이지</a>
            <a href="Logout.php">로그아웃</a>
            <?php } else { ?>
            <a href="./Login.php">로그인</a>
            <a href="./register.php">회원가입</a>
            <?php } ?>
        </div>
    </div>
<div class="topnav">
    <div class="topnav2">
        <ul class="category">
            <a class="active" href="index.php">Home</a>   
            <li class="category_contact"> 게시판
                <ul class="category_contact_item subitem">
                    <li><a href="user_board_list.php">전체 게시판</a></li>
                </ul>
            </li>
            <li class="category_about"> 마이페이지
                <ul class="category_about_item subitem">
                  <li><a href="my_page_main.php">내 프로필</a></li>
                  <li><a href="my_page_write.php">내 글 관리</a></li>
                  <li><a href="my_page_prefer.php">내 좋아요 목록</a></li>
                  <li><a href="my_page_inquiry.php">내 문의사항</a></li>
                </ul>
            </li>   
        </ul>
    </div>
</div>
</nav> -->

<nav>
    <div class="nav_top">
        <div class="nav_top2">
            <?php if(isset($_COOKIE['class']) && ($_COOKIE['class']) == "admin") {?>
            <a href="./admin_main.php">관리페이지</a>
            <?php } if(isset($_COOKIE['userID']) && ($_COOKIE['userID']) !="") {?>        
            <a href="my_page_main.php">마이페이지</a>
            <a href="Logout.php">로그아웃</a>
            <?php } else { ?>
            <a href="./Login.php">로그인</a>
            <a href="./register.php">회원가입</a>
            <?php } ?>
        </div>
    </div>

    <div class="nav_title">
        <div class="nav_title2">
            <a href="index.php"><img class="nav_title_img"src="images/logo.png"></a>
        </div>
    </div>

    <div class="nav_bottom">
        <div class="nav_bottom2">
            <ul class="nav_category">
                <li><b><a href="user_board_list.php">전체 게시판</a></b>
                </li>
                <li> <b>생활/리빙</b>
                    <ul class="subcategory">
                        <li>test1</li>
                    </ul>
                </li>
                <li><b>디지털/가전</b>
                    <ul class="subcategory">
                        <li>test1</li>
                    </ul>
                </li>
                <li><b>패션/잡화</b>
                    <ul class="subcategory">
                        <li>test1</li>
                        <li>test1</li>
                    </ul>
                </li>
                <li><b>음식</b>
                    <ul class="subcategory">
                        <li>test1</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>