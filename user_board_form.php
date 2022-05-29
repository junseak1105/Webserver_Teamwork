<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";

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
                    <select id = "user_board_category" name = "category">
                    <?php
                        $sql_ca = "select * from category where co_code = 'ca_Post';";
                        $result_ca = mysqli_query($conn,$sql_ca);
                        while($row_ca=mysqli_fetch_array($result_ca)){
                            echo '<option value="'.$row_ca['ca_name'].'">'.$row_ca['ca_name'].'</option>';
                        }
                    ?>
                    </select>
                    <input class="user_board_input" name="title" type="text" placeholder="제목">
                </div>
                <div class="text_area">
                    <b>첨부 파일</b>
                    <input type="file" name="imgFile">
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
<?php
mysqli_close($conn);
?>
