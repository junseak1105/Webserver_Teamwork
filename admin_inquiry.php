<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";

    //검색값 설정
    $cb_ans = isset($_GET['cb_ans']) ? $_GET['cb_ans'] : "";
    if($cb_ans == "All"){
        $query_where = "where 1=1";
    }else if($cb_ans == ""){
        $cb_ans ="N";
        $query_where = "where qa_status = '$cb_ans'";
    }else{
        $query_where = "where qa_status = '$cb_ans'";
    }
    //페이지설정
    $list_length = 20;//페이지당 출력 길이
    $inquiry_page_no_selected = intval(isset($_GET['inquiry_page_no_selected']) ? $_GET['inquiry_page_no_selected'] : ""); //선택된 페이지 숫자
    list($list_page_no_selected,$list_page_no,$list_less_then_length) = page_count("inquiry",$list_length,$inquiry_page_no_selected,$query_where);
    
    //페이지 하나 이하 처리
    if($list_less_then_length == "true"){
        if($cb_ans == "All"){
            $sql = "select * from inquiry order by idx desc;";
        }else{
            $sql = "select * from inquiry where qa_status = '$cb_ans' order by idx desc;";
        }
    }else{
        if($cb_ans == "All"){
            $sql = "select * from inquiry order by idx desc limit $list_page_no_selected,$list_page_no;";
        }else{
            $sql = "select * from inquiry where qa_status = '$cb_ans' order by idx desc limit $list_page_no_selected,$list_page_no;";
        }
    }
    //쿼리 실행
    $result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head><?php include "include/head.php"; ?></head>
<body>
    <div>
    <span>
        <select id="cb_ans" value = "N" onChange="refresh(this.value);">
            <option value="All">전체</option>
            <option value="N">답변미완료</option>
            <option value="Y">답변완료</option>
        </select>
    <input type="hidden" id="cb_ans_val" value='<?php echo $_GET["cb_ans"]; ?>'/>
    <table border="1">
        <tr>
            <th>작성자</th>
            <th>질문유형</th>
            <th>제목</th>
            <th>문의 일자</th>
            <th>답변여부</th>
            <th>답변하기</th>
        </tr>
        
        <?php
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>' . $row[ 'userID' ] . '</td><td>'. $row[ 'qa_category' ] . '</td><td>'. $row['qa_subject']. '</td><td>'. $row['qa_datetime'] 
            . '</td><td>'. $row['qa_status']. ' </td><td><button class="btn_qa_ans" value='.$row['idx'].'>답변하기</button></td></tr>';
        }
        ?>
    </table>
    <table>
        <tr>
            <?php
                $i = 0;
                while($i<$list_page_no){
                    echo '<td><a href="admin_inquiry.php?inquiry_page_no_selected='.$i.'&cb_ans='.$cb_ans.'">' . $i+1 . '</a></td>';
                    $i++;
                }
            ?>
        </tr>
    </table>
    </div>
    <!--팝업 레이어-->
    <div class="qa_ans_popup_layer" id="qa_ans_popup_layer" style="display: none;">
        <div class="popup_box">
            <div style="height: 10px; width: 375px; float: top;">
            <a href="javascript:closePop();"><img src="/images/ic_close.svg" class="m_header-banner-close" width="50px" height="50px"  ;></a>
            </div>
            <!--팝업 컨텐츠 영역-->
            <div class="popup_cont">
                <textarea id="qa_ans" value=""></textarea>
                <button id="btn_qa_ans_submit">전송</button>
            </div>
        </div>
    </div>
    <!--팝업 레이어-->
    <?php include "include/footer.php" ?>
</body>
</html>
<?php
    mysqli_close($conn);
?>

<script>
    var qa_idx = '';
    $(document).ready(function(){
        $(".btn_qa_ans").on("click",function(){
            qa_idx = this.value;
            openPop(qa_idx);
        })
        $("#btn_qa_ans_submit").on("click",function(){
            var qa_ans = $("#qa_ans").val();
            submit_qa_ans(qa_idx,qa_ans);
        })
        $("#cb_ans").val($("#cb_ans_val").val()); //답변 완료, 미완료 콤보박스 선택 후 새로고침됨, 선택값 재지정
    })
    function openPop(qa_idx){
        document.getElementById("qa_ans_popup_layer").style.display = "block";
    }
    function closePop() {
        document.getElementById("qa_ans_popup_layer").style.display = "none";
    }
    function submit_qa_ans(qa_idx,qa_ans){
        if(confirm("답변을 작성하시겠습니까?")==true){
            location.href="include/subimt_inquiry_answer.php?qa_idx="+qa_idx+"&qa_ans="+qa_ans;
        }else{
            return;
        }
    }
    function refresh(cb_ans){
        location.href="admin_inquiry.php?cb_ans="+cb_ans;
    }
</script>