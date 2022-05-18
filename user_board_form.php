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
<title>꿀템공유사이트 - 글 쓰기</title>

<head><?php include "include/head.php"; ?>
<script>
  function check_input() {
      if (!document.user_board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.user_board_form.subject.focus();
          return;
      }
      if (!document.user_board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.user_board_form.content.focus();
          return;
      }
      document.user_board_form.submit();
   }
</script>
</head>

<body>
	<?php
		include "include/sidenav.php";
	?>
    <section>
        <div>
            <table id="user_board_title">
                <tr>
                    게시판 > 글 쓰기
                </tr>
            </table>

            <script> /* 세션에서 닉네임 가져오기 */
                echo $_SESSION['userName'];
                /*if (isset($_SESSION['userName']) == false){
                }*/
            </script>

            <form  name="user_board_form" method="post" action="user_board_insert.php">
                <table id="user_board_form">
                    <tr>
                        <th>닉네임 : </th>
                        <th><?=$userName?></th>
                    </tr>
	    		    <tr>
	    			    <th>제목 : </th>
	    			    <th><input name="title" type="text"></th>
	    		    </tr>	

	    		    <tr id="text_area">	
	    			    <th>내용 : </th>
	    			    <th> <textarea name="content"></textarea> </th>
	    		    </tr>
	    	    </table>

	    	    <table class="buttons">
				    <tr><button type="button" onclick="check_input()">등록</button></tr>
			    </table>

	        </form>
        </div> 
    </section> 
    <?php include "include/footer.php" ?>
</body>

</html>

<?php
mysqli_close($conn);
?>
