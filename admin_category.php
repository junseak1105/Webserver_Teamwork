<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    $db_name = "commoncode";//사용db명

    //검색값 설정
    $sb_val = isset($_GET['sb_val']) ? $_GET['sb_val'] : "";
    if($sb_val == ""){
        $query_where="";
    }else{
        $query_where = "where co_code like '%$sb_val%' or co_name like '%$sb_val%'";
    };
    //페이지 설정
    $member_page_no_selected = intval(isset($_GET['member_page_no_selected']) ? $_GET['member_page_no_selected'] : ""); //선택된 페이지 숫자
    $list_length = 20; //페이지당 출력 길이
    list($list_page_no_selected,$list_page_no,$list_less_then_length) = page_count($db_name,$list_length,$member_page_no_selected,$query_where);

    //페이지 하나 이하 처리
    if($list_less_then_length == "true"){
        $sql = "select * from $db_name $query_where order by idx";
    }else{
        $sql = "select * from $db_name order by idx limit $list_page_no_selected,$list_length;";
    }
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
    <div>
    <div>
        <input id="searchbox"/>
        <button id="btn_sb">검색</button>
    </div>
    <table >
        <thead>
            <tr>
                <th >공통코드</th>
                <th >코드내용</th>
                <th >버튼</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td><input id="co_code_add"></td>
            <td><input id="co_name_add"></td>
            <td><button class="btn_add">추가</button></td>
        </tr>
        <?php
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td><input id="code_row_'.$row['idx'].'" value=' . $row[ 'co_code' ] . '></td><td><input id=name_row_'.$row['idx'].' value='. $row[ 'co_name' ] . '></td><td>
            <button class="btn_edit" value='.$row['idx'].'>수정</button><button class="btn_delete" value='.$row['idx'].'>삭제</button>
            </td></tr>';
        }
        ?>

        </tbody>
    </table>
    <table>
        <tr>
            <?php
                $i = 0;
                while($i<$list_page_no){
                    echo '<td><a href="admin_member.php?member_page_no_selected='.$i.'">' . $i+1 . '</a></td>';
                    $i++;
                }
            ?>
        </tr>
    </table>
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