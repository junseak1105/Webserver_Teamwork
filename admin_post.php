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
        $sql = "select * from post $query_where order by idx";
    }else{
        $sql = "select * from post $query_where order by idx limit $list_page_no_selected,$list_page_no;";
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
        <table class="type1" border="1">
        <thead>    
            <tr>   
                <th>글제목</th>
                <th>조회수</th>
                <th>작성일자</th>
                <th>작성자</th>
                <th>삭제</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_array($result)){
                echo '<tr><th>' . $row[ 'title' ] . '</th><td>'. $row[ 'hit' ] . '</td><td>'. $row['date']. '</td><td>'. $row['writer_id'] . '</td>
                <td class="post_delete">
                <button class="btn_delete" value='.$row['idx'].'></button>
                </td></tr>';
            }
            ?>
        </tbody>
        </table>
        <div class="page1">
            <table class="page2">
            <tr>
                <?php
                    $i = 0;
                    while($i<$list_page_no){
                        echo '<td><a href="admin_post.php?post_page_no_selected='.$i.'">' . $i+1 . '</a></td>';
                        $i++;
                    }
                ?>
            </tr>
            </table>
            <div class="post_searchbox">
                <input id="searchbox"/>
                <button class="btn_search" id="btn_sb">검색</button>
            </div>
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