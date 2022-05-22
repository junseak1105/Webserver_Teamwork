<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    include "chk_login.php";

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

<?php 
    //개발용 임시 세션 넣어둔 것
    $_SESSION["userID"] = 'testID10';
    $_SESSION["userPW"] = 'testID10';
    $_SESSION["userName"] = 'testID10';
    $userID = $_SESSION['userID'];
?>

<!DOCTYPE html>
<html>
<title>꿀템공유사이트 - 글 쓰기</title>

<head><?php include "include/head.php"; ?>
<script>
  function check_input() {
      if (!document.user_board_form.title.value)
      {
          alert("제목을 입력하세요!");
          document.user_board_form.title.focus();
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
                <h1>
                    추천 게시판 > 글 쓰기
                </h1>
            </table>

            <form  name="user_board_form" method="post" action="user_board_insert.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <?php
                            $userName = $_SESSION['userName']; //세션에서 닉네임 가져오기
                        ?>
                        <th>닉네임 : </th>
                        <th><?=$userName?></th> <!-- 닉네임 넣기 --> 
                    </tr>
	    		    <tr>
	    			    <th class="col1">제목 : </th>
	    			    <th class="col2"><input name="title" type="text"></th>
	    		    </tr>	

	    		    <tr id="text_area">	
	    			    <th class="col1">내용 : </th>
	    			    <th class="col2"> <textarea name="content" rows="10" cols="60"></textarea> </th>
	    		    </tr>
                    <tr>
                        <th class="col1">첨부 파일</th>
                        <th class="col2"><input type="file" name="upfile"></th>
                    </tr>
	    	       </table>

	    	    <table class="buttons">
				    <tr><button type="summit" onclick="check_input()">등록</button></tr> <!-- 게시물 등록 버튼 -->
                    <tr><button type="button" onclick="location.href='user_board_list.php'">목록</button></tr>
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
