<nav>
    <div class="index_head">
        <a href="./admin_main.php">어드민페이지</a>
        <a href="#" onclick ="<?php $_SESSION['userID']="";$_SESSION['class']="";?>">로그아웃</a>
        <a href="./Login.php">로그인</a>
        <a href="./register.php">회원가입</a>
    </div>
<div class="topnav">
    <div class="topnav2">
        <ul class="category">
            <a class="active" href="index.php">Home</a>   
            <li class="category_contact"> 게시판
                <ul class="category_contact_item subitem">
                    <li><a href="user_board_list.php">전체 게시판</a></li>
                    <li><a href="#news2">category</a></li>
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
</nav>