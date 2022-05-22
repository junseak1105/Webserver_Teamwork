<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    include "chk_login.php";

    //$idx = $_POST['idx'];
    //idx 받아오는 건 됌, list에서 가져오는게 문제
    $idx = '711';

	$sql = "select * from post where idx=$idx"; //idx에 행만 가져옴
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($result);

	$title = $row[1];
	$writer_id = $row[8];
	$data = $row[4];
	$recommend_Y = $row[7];
	$content = $row[3];
?>

<!DOCTYPE html>
<html>
<title>꿀템공유사이트 - 내용 보기</title>

<head><?php include "include/head.php"; ?></head>

<body>
	<?php
		include "include/sidenav.php";
	?>
<section>
   	<div id="user_board_box">
   		
	    <table id="user_board_title">
	    	<h1>
	    		추천 게시판 > 내용 보기
	    	</h1>
	    </table>

	    <table id="view_content">
			<tr>
				<th class="col1"><b>제목 :</b> <?=$title?></th>
				<th class="col2"> | <?=$writer_id?> | <?=$data?> | 추천 <?=$recommend_Y?> </th>
			</tr>
			<tr>
				<th><?=$content?></th>
			</tr>		
	    </table>
	    
		<table class="buttons">
				<input type="hidden" name="idx" value = "<?=$idx?>">
				<tr><button onclick="location.href='user_board_modify_form.php'">수정</button></tr>
				<tr><button onclick="location.href='user_board_list.php'">목록</button></tr>
		</table>
	</div> <!-- board_box -->
</section> 
    <?php include "include/footer.php";?>
</html>

<?php
mysqli_close($conn);
?>