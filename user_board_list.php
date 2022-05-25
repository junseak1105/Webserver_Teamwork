<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";

    
    //검색값 설정
    $sb_val = isset($_GET['sb_val']) ? $_GET['sb_val'] : "";
    $ca_val = isset($_GET['category']) ? $_GET['category'] : "";
    if($sb_val == ""){
        $query_where="";
    }else{
        $query_where = "where title like '%$sb_val%' or content like '%$sb_val%' or writer_id like '%$sb_val%'";
    };
    if($ca_val != "ALL"){
        $query_where = "where category = '$ca_val'";
    }

    //페이지 설정
    $post_page_no_selected = intval(isset($_GET['post_page_no_selected']) ? $_GET['post_page_no_selected'] : ""); //선택된 페이지 숫자

    if(isset($_GET['startPage'])){
        $startPage = (Int)$_GET['startPage'];
        if ($startPage<0){
            $startPage=1;
        }
    }else{
        $startPage=1;
    }

    $endPage = $startPage+10;

    $list_length = 20;//페이지당 출력 길이
    list($list_page_no_selected,$list_page_no,$list_less_then_length) = page_count("post",$list_length,$post_page_no_selected,$query_where);
    
    //페이지 하나 이하 처리
    if($list_less_then_length == "true"){
        $sql = "select * from post $query_where order by idx ";
    }else if($post_page_no_selected != null){
        $sql = "select * from post $query_where order by idx desc limit $post_page_no_selected,$list_page_no; ";
    }else{
        $sql = "select * from post $query_where order by idx desc limit $startPage,$list_page_no; ";
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
            
            <div class="user_board_searchbox" id="search_box"> <!-- 게시글 검색 창 -->
                <select id = "select_box">
                    <option value="ALL">전체</option>
                    <?php
                        $sql_ca = "select * from category where co_code = 'ca_Post';";
                        $result_ca = mysqli_query($conn,$sql_ca);
                        while($row_ca=mysqli_fetch_array($result_ca)){
                            echo '<option value="'.$row_ca['ca_name'].'">'.$row_ca['ca_name'].'</option>';
                        }
                    ?>
                </select>
                <input id="searchbox"/>
                <button class="btn_search" id="btn_sb">검색</button>
            </div>
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
                            $i = $startPage;
                            echo '<td><a href="user_board_list.php?startPage='.($startPage-10).'">이전</a></td>';
                            while($i<$endPage){
                                echo '<td><a href="user_board_list.php?post_page_no_selected='.$i.'&startPage='.$startPage.'">' . $i . '</a></td>';
                                $i++;
                            }
                            echo '<td><a href="user_board_list.php?startPage='.($endPage+10).'">다음</a></td>';
                            
                        ?>
                    </tr>
                </table>
            </div>
                
            

        </div>
    </section>
    <?php include "include/footer.php" ?>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#btn_sb").on("click",function(){
            var sb_val = $('#searchbox').val();
            var category_val = $("#select_box option:selected").val();
            search(sb_val,category_val);
        });
    });

    function search(sb_val,category_val){
        location.href="user_board_list.php?startPage=<?php echo $startPage?>&sb_val="+sb_val+"&category="+category_val+"";
    }
</script>
<?php
mysqli_close($conn);
?>