<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";

    $idx = $_GET['idx'];

	$sql = "select * from post where idx=$idx"; //idx에 행만 가져옴
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
	mysqli_close($conn);

	$hit= $hit+1;
	include "include/db.php";
	$sql = "update post set hit = '$hit' where idx=$idx";
	mysqli_query($conn,$sql);

	$userID = $_COOKIE["userID"];

?>

<!DOCTYPE html>
<html>
<head><?php include "include/head.php"; ?></head>

<body>
	<?php
		include "include/sidenav.php";
	?>
<section>
   	<div class="user_board_box" id="user_board_box">
	    <h1> 추천 게시판 > 내용 보기 </h1>
		
		<table class="view_board_title">
			<b>[<?=$category?>]</b> 
			<b> <?=$title?></b>
			<tr class="view_board_title_tr">
				<td class="id">작성자: <?=$writer_id?></td>
				<td class="data">작성일: <?=$data?></td>
				<td class="hit">조회수<?=$hit?></td>
				<td class="recommend">추천 <?=$recommend_Y?></td>
			</tr>
		</table>
		<div class="view_board_content">
			<img src='<?=$image?>'>
			<span> <?=$content?></span>
		</div>
		<div class="btn_modify_area">
		<?php 
            if(isset($_COOKIE['userID']) && ($_COOKIE['userID']) == $writer_id) {
        ?>
			<form method="post" action="user_board_modify_form.php">
				<button class="btn_modify" type='submit' value="<?=$idx?>" name='idx'>수정</button>
			</form>
			<button class="btn_list" onclick="location.href='user_board_delete.php?idx=<?=$idx?>'">삭제</button>
		<?php }?>
			<button class="btn_list" onclick="location.href='user_board_list.php'">목록</button>
		</div>
		<div class="user_board_updown">
    		<form method="post" action="user_board_view_like.php">
    			<button class="btn_down" type='submit' value='추천' name='recommend_Y' ><img src="images/up.png"></button>
				<button class="btn_down" type='submit' value='비추' name='recommend_N'><img src="images/down.png"></button>
			</form>
		</div>
	</div> <!-- board_box -->
</section> 
    <?php include "include/footer.php";?>
</html>
<script>
</script>
