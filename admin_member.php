<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";


    $member_page_no_selected = intval(isset($_GET['member_page_no_selected']) ? $_GET['member_page_no_selected'] : ""); //선택된 페이지 숫자
    $query_where = "";
    $list_length = 20; //페이지당 출력 길이
    list($list_page_no_selected,$list_page_no,$list_less_then_length) = page_count("member",$list_length,$member_page_no_selected,"",$query_where);

    $sql = "select * from member order by idx limit $list_page_no_selected,$list_length;";
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
    <?php
	    include "include/nav_main.php"; 
	    include "include/sidenav.php";
    ?>
    <div>
    <table border="1">
        <tr>
            <th>이름</th>
            <th>ID</th>
            <th>PW</th>
            <th>Email</th>
            <th>삭제</th>
        </tr>
        
        <?php
        while($row = mysqli_fetch_array($result)){
            echo '<tr><td>' . $row[ 'userName' ] . '</td><td>'. $row[ 'userID' ] . '</td><td>'. $row['userPW']. '</td><td>'. $row['userEmail'] . '</td><td>
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
            delete_user(idx);
        })
    })

    function delete_user(idx){
        if(confirm("사용자를 삭제하시겠습니까??")==true){
            location.href="include/common_function.php?func=db_delete&db=member&idx="+idx;
        }else{
            return;
        }
        
    };
</script>