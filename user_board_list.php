<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    
?>

<!DOCTYPE html>
<html>
<title>꿀템공유사이트 - 글목록</title>
<link rel="stylesheet" type="text/css" href="style.css">
<head><?php include "include/head.php"; ?></head>
<body>
    <?php
        include "include/sidenav.php";
    ?>
    <section>
        <div id="user_board_box">
            <h1 id="user_board_title">
                게시판 > 글 목록
            </h1>
            <ul id="user_board_list">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">제목</span>
                    <span class="col3">글쓴이</span>
                    <span class="col4">첨부</span>
                    <span class="col5">등록일</span>
                    <span class="col6">조회</span>
                </li>
                <li>
                    <span class="col1"><?=$number?></span>
                    <span class="col2"><a href="user_board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                    <span class="col3"><?=$name?></span>
                    <span class="col4"><?=$file_image?></span>
                    <span class="col5"><?=$regist_day?></span>
                    <span class="col6"><?=$hit?></span>
                </li>   
            </ul>

            <ul id="page_num">  
            </ul> <!-- page -->      

            <ul class="buttons">
                <li><button onclick="location.href='user_board_list.php'">목록</button></li>
                <li><button onclick="location.href='user_board_form.php'">글쓰기</button>
                    <a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
                </li>
            </ul>
            
            </form>
        </div> 
    </section> 
    <?php include "include/footer.php" ?>
</body>
</html>

<?php
mysqli_close($conn);
?>