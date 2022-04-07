<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    // //게시글 페이지 갯수 연산, 20개당 한페이지
    // $sql = "select count(*) from post";
    // $result = mysqli_query($conn,$sql);
    // $post_count = mysqli_fetch_array($result);
    // $post_per_page = 20; //페이지당 원하는 게시글 수
    // $post_page_no_selected = intval(isset($_GET['post_page_no_selected']) ? $_GET['post_page_no_selected'] : "");
    // $post_page_no_selected = $post_page_no_selected * $post_per_page; 

    // $post_page_no = $post_count[0]/20; //게시글 페이지 갯수


    $post_page_no_selected = intval(isset($_GET['post_page_no_selected']) ? $_GET['post_page_no_selected'] : ""); //선택된 페이지 숫자
    list($list_page_no_selected,$list_page_no) = page_count("post",20,$post_page_no_selected);

    $sql = "select * from post order by idx limit $list_page_no_selected,$list_page_no;";
    //echo $sql;
    $result = mysqli_query($conn,$sql);
    
    
?>

<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<title>
</title>
</head>
<body>
    <div>
    <table border="1">
        <tr>
            <th>글제목</th>
            <th>조회수</th>
            <th>작성일자</th>
            <th>작성자</th>
            <th>삭제</th>
        </tr>
        
        <?php
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>' . $row[ 'title' ] . '</td><td>'. $row[ 'hit' ] . '</td><td>'. $row['date']. '</td><td>'. $row['writer_id'] . '</td><td>
            <button class="btn_delete" value='.$row['idx'].'></button>
            </td></tr>';
        }
        ?>
    </table>
    <table>
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
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>
<script>
    $(document).ready(function(){
        $(".btn_delete").on("click",function(){
            var post_idx = this.value;
            delete_post(post_idx);
        })
    })

    function delete_post(post_idx){
        if(confirm("게시글을 삭제하시겠습니까??")==true){
            location.href="delete_post.php?post_idx="+post_idx;
        }else{
            return;
        }
        
    };
</script>