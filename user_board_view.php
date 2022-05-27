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
	$writer_id = $row[8];
	$data = $row[4];
	$recommend_Y = $row[6];
	$content = $row[3];

	//개발용 임시 세션 넣어둔 것
	$_SESSION["userID"] = 'userid1';
    $_SESSION["userPW"] = 'userpw1';
    $_SESSION["userName"] = 'userName1';
    $userID = $_SESSION['userID'];
    $userName = $_SESSION['userName'];
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
		<div class="btn_modify_area">
			<form method="post" action="user_board_modify_form.php">
				<button class="btn_modify" type='submit' value="<?=$idx?>" name='idx'>수정</button>
			</form>
			<button class="btn_list" onclick="location.href='user_board_list.php'">목록</button>
		</div>
		<table class="view_board_title">
			<b>[카테고리]</b> 
			<b> <?=$title?></b>
			<tr class="view_board_title_tr">
				<td class="id"><?=$writer_id?></td>
				<td class="data"><?=$data?></td>
				<td class="hit">조회 32</td>
				<td class="recommend">추천 <?=$recommend_Y?></td>
			</tr>
		</table>
		<div class="view_board_content">
			<span> <?=$content?></span>
		</div>
		<div class="user_board_updown">
    		<form method="post" action="user_board_view_like.php">
                <input type="hidden" value ="<?=$title?>" name="_title">
    			<button class="btn_down" type='submit' value='추천' name='recommend_Y' ><img src="images/up.png"></button>
				<button class="btn_down" type='submit' value='비추' name='recommend_N'><img src="images/down.png"></button>
			</form>
		</div>
	</div> <!-- board_box -->
</section> 
    <?php include "include/footer.php";?>
</html>

<?php
mysqli_close($conn);
?>