<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        include "include/head.php";
        include "include/db.php"; 
        include "include/common_function.php";
    ?>
</head>
<body style="overflow-x:hidden; overflow-y:auto;">
<div>
        <h2 class="h_title">최신 게시글</h2>
        <div class="post_list">
            <table class="main_post">
                <tr class='main_post_tr'>
                    <th >번호</th>
                    <th class='main_post_category'>카테고리</th>
                    <th class='main_post_title'>제목</th>
                    <th class='main_post_writer'>작성자</th>
                    <th class='main_post_date'>작성일</th>
                    <th >조회수</th>
                    <th >추천수</th>
                </tr>
                <?php
                    $sql = 'select * from post order by idx desc limit 0,10';
                    $result = mysqli_query($conn,$sql);
                    $i = 1;
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>
                        <td>' .$i. '</td>
                        <td>'. $row[ 'category' ] . '</td>
                        <td class="main_post_td_title"><a href="user_board_view.php?idx='. $row['idx'] .'"><b>'. $row['title']. '</b></a></td>
                        <td>'. $row['writer_id'] . '</td>
                        <td class="main_post_td_date">'. $row['date']. '</td>
                        <td>'. $row['hit']. '</td>
                        <td>'. $row['recommend_Y']. '</td>
                        </tr>';
                        $i++;
                    }
                ?>
            </table>
            <div class="main_post_more">
                <a href="./user_board_list.php">더보기</a>
            </div>
        </div>
        <h2 class="h_title">추천 아이템</h2>
        <ul class="recommend_list">
            <?php
                $sql = 'select * from post order by recommend_Y desc limit 0,10';
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_array($result)){
                    echo '<li class="img_wrapper"> <a href="user_board_view.php?idx='. $row['idx'] .'"> <img src=images/'.$row['image'].'> <b> '.$row['title'].' </b> </a> </li>';
                }
            ?>
        </ul>
    </div>
    
    <?php include "include/footer.php"; ?>
</body>
</html>