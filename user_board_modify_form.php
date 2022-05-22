<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>꿀템공유사이트 - 글 수정</title>

<head><?php include "include/head.php"; ?></head>

<script>
  function check_input() {
      if (!document.board_form.title.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.title.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.user_board_modify.submit();
   }
</script>
</head>
<body> 
<section>
   	<div id="board_box">
	    <h1 id="board_title">
	    		게시판 > 글 수정하기
		</h1>
	    <form  name="user_board_form" method="post" action="user_board_modify.php" enctype="multipart/form-data">
	    	 <table id="user_board_form">
						<tr>
							<?php
								//개발용 임시 세션 넣어둔 것
						    $_SESSION["userID"] = 'testID10';
						    $_SESSION["userPW"] = 'testID10';
						    $_SESSION["userName"] = 'testID10';
						    $userID = $_SESSION['userID'];

						    $idx = '711';
						    echo($idx);

								$userName = $_SESSION['userName']; //세션에서 닉네임 가져오기

								$title = 'test';
								$content = 'test';
              ?>
							<th class="col1">이름 : </th>
							<th class="col2"><?=$userName?></th>
						</tr>		
			    	<tr>
			    		<th class="col1">제목 : </th>
			    		<th class="col2"><input name="title" type="text" value="<?=$title?>"></th>
			    	</tr>	    	
			    	<tr id="text_area">	
			    		<th class="col1">내용 : </th>
			    		<th class="col2">
			    			<textarea name="content" rows="10" cols="60"><?=$content?></textarea>
			    		</th>
			    	</tr>
	    	</table>
	    	<table class="buttons">
					<tr><button type="summit" onclick="check_input()">수정하기</button></tr>
					<tr><button type="button" onclick="location.href='user_board_list.php'">목록</button></tr>
				</table>
	    </form>
	</div> <!-- board_box -->
</section> 
    <?php include "include/footer.php";?>
</body>
</html>

<?php
mysqli_close($conn);
?>