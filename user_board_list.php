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
<title>꿀템공유사이트 - 글목록</title>
<link rel="stylesheet" type="text/css" href="style.css">
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
        <div id="user_board_box">
            <table id="user_board_title">
                <h1>
                추천 게시판 > 글 목록
                </h1>
            </table>
            <form method="POST" action="user_board_view">
                <table border="1">
                    <tr>
                        <th>글제목</th>
                        <th>작성자</th>
                        <th>작성일자</th>
                        <th>추천수</th>
                        <th>조회수</th>
                        <input type="hidden" name="idx" value="<?=$idx?>">
                    </tr>
                    <?php
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>
                                <td class="title"><a href="user_board_view.php?idx='. $row['idx'] .'">' . $row[ 'title' ] .'</td>
                                <td>'. $row['writer_id'] . '</td>
                                <td>'. $row['date']. '</td>
                                <td>'. $row['recommend_Y']. '</td>
                                <td>'. $row['hit'] .'</td>
                            </tr>';
                            //idx 넘기는 것 안뎀
                    }
                    ?>
                </table>
            </form>
            
            <table id="page">
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

            <table id="page_num"> 
            </table> <!-- page -->    

            <table class="buttons">
                <tr><button onclick="location.href='user_board_form.php'">글쓰기</button></tr>
                <tr><button onclick="location.href='user_board_list.php'">목록</button></tr>
            </table>

        </div> 
    </section> 
    <?php include "include/footer.php" ?>
</body>
</html>

<?php
mysqli_close($conn);
?>