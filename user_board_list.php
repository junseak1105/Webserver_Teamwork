<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";

    
    //검색값 설정
    $sb_val = isset($_GET['sb_val']) ? $_GET['sb_val'] : "";
    if($sb_val == ""){
        $query_where="";
    }else{
        $query_where = "where title like '%$sb_val%' or content like '%$sb_val%' or writer_id like '%$sb_val%'";
    };

    //페이지 설정
    $post_page_no_selected = intval(isset($_GET['post_page_no_selected']) ? $_GET['post_page_no_selected'] : ""); //선택된 페이지 숫자
    $list_length = 20;//페이지당 출력 길이
    list($list_page_no_selected,$list_page_no,$list_less_then_length) = page_count("post",$list_length,$post_page_no_selected,$query_where);
    
    //페이지 하나 이하 처리
    if($list_less_then_length == "true"){
        $sql = "select * from post $query_where order by idx ";
    }else{
        $sql = "select * from post $query_where order by idx desc limit $list_page_no_selected,$list_page_no; ";
    }
    //echo $sql;
    //쿼리 실행
    $result = mysqli_query($conn,$sql);
  
?>
<!DOCTYPE html>
<html>
<head>
    <?php 
        include "include/head.php"; 
    ?>
</head>
<body>
    <?php
        include "include/sidenav.php";
    ?>
    <section>
        <div class="user_board_list" id="user_board_box">
            <h1>추천 게시판 > 글 목록</h1>
            
            <form method="POST" action="user_board_view">
                <table class="board_list">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th class="category">카테고리</th>
                            <th class="title">제목</th>
                            <th>작성자</th>
                            <th class="date">작성일</th>
                            <th>추천수</th>
                            <th>조회수</th>
                            <input type="hidden" name="idx" value="<?=$idx?>">
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>
                                <td>번호</td>
                                <td>카테고리</td>
                                <th class="title"><a href="user_board_view.php?idx='. $row['idx'] .'">' . $row[ 'title' ] .'</th>
                                <td>'. $row['writer_id'] . '</td>
                                <td>'. $row['date']. '</td>
                                <td>'. $row['recommend_Y']. '</td>
                                <td>'. $row['hit'] .'</td>
                            </tr>';
                            //idx 넘기는 것 안뎀
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <div class="btn_wirte_area">
                <button class="btn_write"onclick="location.href='user_board_form.php'">글쓰기</button>
            </div>
            <div class="page1">
                <table class="page2" id="page">
                    <tr>
                        <?php
                            $i = 0;
                            while($i<=$list_page_no){
                                echo '<td><a href="user_board_list.php?post_page_no_selected='.$i.'">' . $i . '</a></td>';
                                $i++;
                            }
                        ?>
                    </tr>
                </table>
            </div>
            <div class="user_board_searchbox" id="search_box"> <!-- 게시글 검색 창 -->
                <select>
                    <option value="">전체</option>
                    <option value="1">가전제품</option>
                    <option value="2">생활용품</option>
                    <option value="3">생필품</option>
                </select>
                <select>
                    <option value="title">제목</option>
                    <option value="name">글쓴이</option>
                </select>
                <input type="text" name="search" required="required">
                <button>검색</button>
            </div>
                
            

        </div>
    </section>
    <?php include "include/footer.php" ?>
</body>
</html>

<?php
mysqli_close($conn);
?>