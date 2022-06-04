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
                <?php
                    include "include/db.php";
                    $sql_ca = "select * from category where co_code = 'ca_Post';";
                    $result_ca = mysqli_query($conn,$sql_ca);
                    while($row_ca=mysqli_fetch_array($result_ca)){
                        echo '<li value="'.$row_ca['ca_name'].'"><a href = "./user_board_list.php?category_val='.$row_ca['ca_name'].'"><b>'.$row_ca['ca_name'].'</b></a></li>';
                    }
                    mysqli_close($conn);
                ?>
            </ul>
        </div>
    </div>
</nav>