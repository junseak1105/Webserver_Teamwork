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

<?php 
    //개발용 임시 세션 넣어둔 것
    $_SESSION["userID"] = 'userid1';
    $_SESSION["userPW"] = 'userpw1';
    $_SESSION["userName"] = 'userName1';
    $userID = $_SESSION['userID'];
    $userName = $_SESSION['userName'];
?>

<!DOCTYPE html>
<html>
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
      document.user_board_form.submit(); //form name="user_board_form"으로 서밋 그럼 폼에 액션이 동작
   }
</script>
</head>

<body>
	<?php
		include "include/sidenav.php";
	?>
    <section>
        <div class="user_board">
            <h1>추천 게시판 > 글 쓰기</h1>
            <form class="user_board_form" name="user_board_form" method="post" action="user_board_insert.php" enctype="multipart/form-data">
                <div class="user_board_title">
                    <select class="user_board_category">
                        <option value="">카테고리 선택</option>
                        <option value="recommend_PD">추천 제품</option>
                        <option value="sale">특가 정보</option>
                    </select>
                    <input class="user_board_input" name="title" type="text" placeholder="제목">
                </div>
                <div class="text_area">
                    <b>첨부 파일</b>
                    <input type="file" name="upfile">
                    <br>
	    			<textarea class="user_board_content" name="content" rows="30" placeholder="내용"></textarea>       
                    <button class="btn_user_board" type="button" onclick="check_input()">등록</button> <!-- 게시물 등록 버튼 -->
                    <button>취소</button>
                </div>
	        </form>
        </div> 
    </section> 
    <?php include "include/footer.php" ?>
</body>

</html>

<?php
mysqli_close($conn);
?>
