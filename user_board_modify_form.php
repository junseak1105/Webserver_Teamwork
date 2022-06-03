<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
?>
<?php
	$userID = $_COOKIE["userID"];

	$idx = $_POST['idx'];

	$sql = "select * from post where idx=$idx";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($result);

	$title = $row[1];
	$category = $row[2];
	$content = $row[3];
	$data = $row[4];
	$hit = $row[5];
	$recommend_Y = $row[6];
	$writer_id = $row[8];
	$image = $row[9];
?>
<!DOCTYPE html>
<html>
<head><?php include "include/head.php"; ?>
	
</head>

</head>
<body> 
<section>
   	<div class="user_board">
	    <h1 id="user_board_title">글 수정하기</h1>
	    <form class="user_board_form" name="user_board_modify_form" method="post" action="user_board_modify.php?idx=<?=$idx?>" enctype="multipart/form-data">
			<div class="user_board_title">
                <select class="user_board_category" name = "category" value = "<?=$category?>">
					<?php
                        $sql_ca = "select * from category where co_code = 'ca_Post';";
                        $result_ca = mysqli_query($conn,$sql_ca);
                        while($row_ca=mysqli_fetch_array($result_ca)){
                            echo '<option value="'.$row_ca['ca_name'].'">'.$row_ca['ca_name'].'</option>';
                        }
                    ?>
                </select>
                <input class="user_board_input" name="title" type="text" placeholder="제목" value="<?=$title?>">
            </div>
            <div class="text_area">
                <b>첨부 파일</b>
                <input type="file" name="imgFile">
                <br>
	    		<textarea class="user_board_content" name="content" rows="30" placeholder="내용"><?=$content?></textarea>
				<button>취소</button>
				<button class="btn_user_board" type="submit">수정</button> <!-- 게시물 등록 버튼 -->
			</div>
		</form>
	    
	</div> <!-- board_box -->

</section> 
    <?php include "include/footer.php";?>
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
					document.user_board_modify.submit();
				}
	</script>
<?php
mysqli_close($conn);
?>
