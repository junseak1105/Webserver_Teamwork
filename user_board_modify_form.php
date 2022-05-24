<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
?>
<?php
	//개발용 임시 세션 넣어둔 것
	$_SESSION["userID"] = 'testID10';
	$_SESSION["userPW"] = 'testID10';
	$_SESSION["userName"] = 'testID10';
	$userID = $_SESSION['userID'];

	$idx = $_POST['idx'];

	$userName = $_SESSION['userName']; //세션에서 닉네임 가져오기

	$sql = "select * from post where idx=$idx";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($result);

	$title = $row[1];
	$writer_id = $row[8];
	$data = $row[4];
	$recommend_Y = $row[6];
	$content = $row[3];
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
					document.user_board_modify.submit();
				}
	</script>
</head>

</head>
<body> 
<section>
   	<div class="user_board">
	    <h1 id="user_board_title">게시판 > 글 수정하기</h1>
	    <form class="user_board_form" name="user_board_modify_form" method="post" action="user_board_modify.php" enctype="multipart/form-data">
			<div class="user_board_title">
                <select class="user_board_category">
                    <option value="">카테고리 선택</option>
                    <option value="recommend_PD">추천 제품</option>
                    <option value="sale">특가 정보</option>
                </select>
                <input class="user_board_input" name="title" type="text" placeholder="제목" value="<?=$title?>">
            </div>
            <div class="text_area">
                <b>첨부 파일</b>
                <input type="file" name="upfile">
                <br>
	    		<textarea class="user_board_content" name="content" rows="30" placeholder="내용"><?=$content?></textarea>
				<button>취소</button>
				<button type="button" onclick="check_input()">수정</button>	 
			</div>
		</form>
	    
	</div> <!-- board_box -->

</section> 
    <?php include "include/footer.php";?>
</body>
</html>

<?php
mysqli_close($conn);
?>
