<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "include/head.php"; ?>
    </head>
    <body>
        <div>
            <h2 class="h_title">최신 게시글</h2>
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
                    $i=1;
                    while($i<11) {
                        echo "  <tr>       
                                    <td>$i</td>
                                    <td >[category]</td>
                                    <td class='main_post_title'><a href='#'><b>제목$i</b></a></td> 
                                    <td >작성자</td>
                                    <td >시간</td>
                                    <td >$i</td>
                                    <td >$i</td>
                              </tr> ";
                        $i++;
                    }
                ?>
            </table>
        </div>
        <div>
            <h2 class="h_title">추천 아이템</h2>
            <ul class="recommend_list">
                <?php
                $i = 0;
                while ($i<12) {
                    echo "<li class='img_wrapper'> <a href='#'> <img src='images/test$i.jpg'> <b> 제목 </b> </a> </li>";
                    $i++;
                } 
            ?>
            </ul>
        </div>

        <?php include "include/footer.php"; ?>
    </body>
</html>