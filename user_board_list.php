<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    
    $category_val = isset($_POST["category_val"])? $_POST["category_val"] : "";
    $sb_val =isset($_POST["sb_val"])? $_POST["sb_val"] : "";

    $query = "select count(*) as count from post";
    $data = $conn->query($query)->fetch_array();
    $num = $data['count']; //조회된 값 갯수
    // //페이징,검색 끝
    /* paging : 한 페이지 당 데이터 개수 */
    $list_num = 20;

    /* paging : 한 블럭 당 페이지 수 */
    $page_num = 10;

    /* paging : 현재 페이지 */
    $page = isset($_GET["page"])? $_GET["page"] : 1;

    /* paging : 전체 페이지 수 = 전체 데이터 / 페이지당 데이터 개수, ceil : 올림값, floor : 내림값, round : 반올림 */
    $total_page = ceil($num / $list_num);
    // echo "전체 페이지 수 : ".$total_page;

    /* paging : 전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수 */
    $total_block = ceil($total_page / $page_num);

    /* paging : 현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수 */
    $now_block = ceil($page / $page_num);

    /* paging : 블럭 당 시작 페이지 번호 = (해당 글의 블럭번호 - 1) * 블럭당 페이지 수 + 1 */
    $s_pageNum = ($now_block - 1) * $page_num + 1;
    // 데이터가 0개인 경우
    if($s_pageNum <= 0){
        $s_pageNum = 1;
    };

    /* paging : 블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수 */
    $e_pageNum = $now_block * $page_num;
    // 마지막 번호가 전체 페이지 수를 넘지 않도록
    if($e_pageNum > $total_page){
        $e_pageNum = $total_page;
    };

    /* paging : 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 데이터 수 */
    $start = ($page - 1) * $list_num;

    /* paging : 쿼리 작성 - limit 몇번부터, 몇개 */
    $sql = "select * from post ";
    if($category_val != "" && $sb_val != ""){
        $sql = $sql."where category = '$category_val' and (content like '%$sb_val%' or title like '%$sb_val%') ";
    }else if($category_val != ""){
        $sql = $sql."where category = '$category_val' ";
    }else{
        $sql = $sql."where content like '%$sb_val%' or title like '%$sb_val%' ";
    }
    $sql = $sql."order by idx desc limit $start, $list_num ;";

    /* paging : 쿼리 전송 */
    $result = mysqli_query($conn, $sql);

    /* paging : 글번호 */
    $cnt = $start + 1;
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
            
            <form class="user_board_searchbox" id="search_box" method="post" action="user_board_list.php"> <!-- 게시글 검색 창 -->
                <select name="category_val" id = "select_box">
                    <option value="">전체</option>
                    <?php
                        $sql_ca = "select * from category where co_code = 'ca_Post';";
                        $result_ca = mysqli_query($conn,$sql_ca);
                        while($row_ca=mysqli_fetch_array($result_ca)){
                            echo '<option value="'.$row_ca['ca_name'].'">'.$row_ca['ca_name'].'</option>';
                        }
                    ?>
                </select>
                <input id="searchbox" name="sb_val" value="<?=$sb_val?>"/>
                <button type="submit" class="btn_search" id="btn_sb">검색</button>
            </form>
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
                    ?>
                    <tr>
                        <td><?php echo $row[ 'idx' ]; ?></td>
                        <td><?php echo $row[ 'category' ]; ?></td>
                        <th class="title"><a href="user_board_view.php?idx='<?php echo $row['idx']?>'"><?php echo $row[ 'title' ]?></th>
                        <td><?php echo $row['writer_id']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['recommend_Y']; ?></td>
                        <td><?php echo $row['hit']; ?></td>
                    </tr>
                    <?php  
                        /* $i++; */
                        /* paging */
                        $cnt++;
                    }; 
                    ?>
                    </tbody>
                </table>
            </form>
            <div class="btn_wirte_area">
                <button class="btn_write"onclick="location.href='user_board_form.php'">글쓰기</button>
            </div>
            <div class="paper">
                <p>
                    <?php
                        /* paging : 이전 페이지 */
                        if($page <= 1){
                    ?>
                    <a href="user_board_list.php?page=1">이전</a>
                    <?php } else{ ?>
                    <a href="user_board_list.php?page=<?php echo ($page-1); ?>">이전</a>
                    <?php };?>

                    <?php
                    /* pager : 페이지 번호 출력 */
                    for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
                    ?>
                    <a href="user_board_list.php?page=<?php echo $print_page; ?>"><?php echo $print_page; ?></a>
                    <?php };?>

                    <?php
                    /* paging : 다음 페이지 */
                    if($page >= $total_page){
                    ?>
                    <a href="user_board_list.php?page=<?php echo $total_page; ?>">다음</a>
                    <?php } else{ ?>
                    <a href="user_board_list.php?page=<?php echo ($page+1); ?>">다음</a>
                    <?php };?>
                </p>
            </div>
                
            

        </div>
    </section>
    <?php include "include/footer.php" ?>
</body>
</html>
<?php
mysqli_close($conn);
?>