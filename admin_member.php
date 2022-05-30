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
        $query_where = "where userID like '%$sb_val%' or userName like '%$sb_val%' or userEmail like '%$sb_val%'";
    };
    //페이지 설정
    $member_page_no_selected = intval(isset($_GET['member_page_no_selected']) ? $_GET['member_page_no_selected'] : ""); //선택된 페이지 숫자
    $list_length = 20; //페이지당 출력 길이
    list($list_page_no_selected,$list_page_no,$list_less_then_length) = page_count("member",$list_length,$member_page_no_selected,$query_where);

    //페이지 하나 이하 처리
    if($list_less_then_length == "true"){
        $sql = "select * from member $query_where order by idx";
    }else{
        $sql = "select * from member order by idx limit $list_page_no_selected,$list_length;";
    }
    //쿼리 실행
    $result = mysqli_query($conn,$sql);
    
?>

<!DOCTYPE html>
<html>
<head>
    <?php 
        include "include/head.php"; 
        include "include/admin_sidemenu.php";?>
</head>
<body>
    <table class="admin_table" border="1">
        <thead>
            <tr>
                <th class="admin_table_name">이름</th>
                <th class="admin_table_id">ID</th>
                <th class="admin_table_pw">PW</th>
                <th class="admin_table_delete">삭제</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = mysqli_fetch_array($result)){
            echo '<tr>
                    <td>' . $row[ 'userName' ] . '</td>
                    <td>'. $row[ 'userID' ] . '</td>
                    <td>'. $row['userPW']. '</td>
                    <td> <button class="btn_admin_delete" value='.$row['idx'].'><img class="ic_close" src="images/ic_close.png"></button> </td>
                </tr>';
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
                        echo '<td><a href="admin_member.php?member_page_no_selected='.$i.'">' . $i+1 . '</a></td>';
                        $i++;
                    }
                ?>
            </tr>
            <div class="member_searchbox">
                <input id="searchbox"/>
                <button class="btn_search" id="btn_sb">검색</button>
            </div>
        </table>
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
        $(".btn_admin_delete").on("click",function(){
            var idx = this.value;
            delete_user(idx);
        });
        $("#btn_sb").on("click",function(){
            var sb_val = $('#searchbox').val();
            search(sb_val);
        });
    })

    function delete_user(idx){
        if(confirm("사용자를 삭제하시겠습니까??")==true){
            location.href="include/common_function.php?func=db_delete&db=member&idx="+idx;
        }else{
            return;
        }
        
    };
    function search(sb_val){
        location.href="admin_member.php?sb_val="+sb_val;
    }
</script>