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
        $sql = "select * from post $query_where order by idx";
    }elseif($post_page_no_selected != null){
        $sql = "select * from post $query_where order by idx limit $post_page_no_selected,$list_page_no;";
    }else{
        $sql = "select * from post $query_where order by idx limit $startPage,$list_page_no;";
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
        include "include/admin_head_side.php"?>
</head>
<body>
        <table class="admin_table" border="1">
        <thead>    
            <tr>   
                <th class="admin_table_title">글제목</th>
                <th class="admin_table_id">작성자</th>
                <th class="admin_table_date">작성일자</th>
                <th class="admin_table_hit">조회수</th>
                <th class="admin_table_delete">삭제</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_array($result)){
                echo '<tr class="table_hober">
                        <th>' . $row[ 'title' ] . '</th>
                        <td>'. $row['writer_id'] . '</td>
                        <td>'. $row['date']. '</td>
                        <td>'. $row[ 'hit' ] . '</td>
                        <td class="post_delete">
                        <button class="btn_admin_delete" value='.$row['idx'].'><img class="ic_close" src="images/ic_close.png"></button>
                        </td>
                    </tr>';
            }
            ?>
        </tbody>
        </table>
        <div class="paper">
            <p>
                <?php
                    $i = $startPage;
                    echo '<a href="admin_post.php?startPage='.($startPage-10).'">이전</a>';
                    while($i<$endPage){
                        echo '<a href="admin_post.php?post_page_no_selected='.$i.'&startPage='.$startPage.'">' . $i . '</a>';
                        $i++;
                    }
                    echo '<a href="admin_post.php?startPage='.($endPage+10).'">다음</a>';
                ?>
            </p>
        </div>
        <div class="post_searchbox">
            <input id="searchbox"/>
            <button class="btn_search" id="btn_sb">검색</button>
        </div>
    
    <?php include "include/footer.php"; ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
<script>
    $(document).ready(function(){
        $(".btn_delete").on("click",function(){
            var idx = this.value;
            delete_post(idx);
        });
        $("#btn_sb").on("click",function(){
            var sb_val = $('#searchbox').val();
            search(sb_val);
        });
    });

    function delete_post(idx){
        if(confirm("게시글을 삭제하시겠습니까??")==true){
            location.href="include/common_function.php?func=db_delete&db=post&idx="+idx;
        }else{
            return;
        }
    };

    function search(sb_val){
        location.href="admin_post.php?sb_val="+sb_val;
    }
</script>