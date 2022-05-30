<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    $db_name = "commoncode";//사용db명

    //검색값 설정
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
    $sql = "select * from commoncode ";

    if($sb_val != ""){
        $sql = $sql."where co_code like '%$sb_val%'";
    }
    $sql = $sql."order by idx desc limit $start, $list_num ;";
    //echo $sql;
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
        include "include/admin_head_side.php"?>
</head>
<body>
    <div>
    
    <div class="category_searchbox">
         <form class="searchbox" id="search_box" method="post" action="admin_category.php"> <!-- 게시글 검색 창 -->
                <input id="searchbox" name="sb_val" value="<?=$sb_val?>"/>
                <button type="submit" class="btn_search" id="btn_sb">검색</button>
            </form>
    <table>
            <tr>
                <th >공통코드</th>
                <th >코드내용</th>
                <th >버튼</th>
            </tr>
        <div>
            <tr>
                <td><input class="category_inputbox" id="co_code_add"></td>
                <td><input class="category_inputbox" id="co_name_add"></td>
                <td><button class="btn_add">추가</button></td>
            </tr>
            <?php
            while($row = mysqli_fetch_array($result)){
                echo '<tr><td><input class="category_inputbox" id="code_row_'.$row['idx'].'" value=' . $row[ 'co_code' ] . '></td><td><input class="category_inputbox" id=name_row_'.$row['idx'].' value='. $row[ 'co_name' ] . '></td><td>
                <button class="btn_edit" value='.$row['idx'].'>수정</button><button class="btn_delete" value='.$row['idx'].'>삭제</button>
                </td></tr>';
            }
            ?>
        </div>
    </table>
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
    
    <?php include "include/footer.php" ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
<script>
    $(document).ready(function(){
        $(".btn_delete").on("click",function(){
            var idx = this.value;
            delete_code(idx);
        });
        $(".btn_edit").on("click",function(){
            var idx = this.value;
            var co_code = $("#code_row_"+idx).val();
            var co_name = $("#name_row_"+idx).val();
            edit_code(idx,co_code,co_name);
        });
        $(".btn_add").on("click",function(){
            var co_code_add = $("#co_code_add").val();
            var co_name_add = $("#co_name_add").val();
            add_code(co_code_add,co_name_add);
        });
        $("#btn_sb").on("click",function(){
            var sb_val = $('#searchbox').val();
            search(sb_val);
        });
    })

    function delete_code(idx){
        if(confirm("공통코드를 삭제하시겠습니까?")==true){
            location.href="include/common_function.php?func=db_delete&db=commoncode&idx="+idx;
        }else{
            return;
        }
    };
    function edit_code(idx,co_code,co_name){
        if(confirm("공통코드를 수정하시겠습니까?")==true){
            location.href="include/common_function.php?func=db_update&db=commoncode&idx="+idx+"&co_code="+co_code+"&co_name="+co_name;
        }else{
            return;
        }
    };
    function add_code(co_code,co_name){
        if(confirm("공통코드를 추가하시겠습니까?")==true){
            location.href="include/common_function.php?func=db_insert&db=commoncode&co_code="+co_code+"&co_name="+co_name;
        }else{
            return;
        }
    };
    function search(sb_val){
        location.href="admin_category.php?sb_val="+sb_val;
    }
</script>