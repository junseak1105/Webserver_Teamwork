<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    
?>

<!DOCTYPE html>
<html>
<title>꿀템공유사이트 - 글 목록</title>

<head><?php include "include/head.php"; ?></head>

<body>
	<?php
		include "include/sidenav.php";
	?>
<section>
   	<div id="board_box">
	    <h3 class="title">
			게시판 > 내용보기
		</h3>

		<!-- db 연결 중 -->
		<?php
			$num  = $_GET["num"];
			$page  = $_GET["page"];

			$con = mysqli_connect("jhk.n-e.kr", "dsu_webserver_prj", "webserver_prj_jhk", "sample");
			$sql = "select * from board where num=$num";
			$result = mysqli_query($con, $sql);

			$row = mysqli_fetch_array($result);
			$title      = $row["title"]; //제목
			$content    = $row["content"]; //내용
			$date = $row["date"]; //날짜
			$hit          = $row["hit"]; //조회수
			$recommend_Y = $row["recommend_Y"]; //추천수
			$writer_id      = $row["writer_id"]; //아이디

			/*$file_name    = $row["file_name"]; //첨부파일
			$file_type    = $row["file_type"]; //파일 타입
			$file_copied  = $row["file_copied"];*/

			$content = str_replace(" ", "&nbsp;", $content);
			$content = str_replace("\n", "<br>", $content);

			$new_hit = $hit + 1;
			$sql = "update board set hit=$new_hit where num=$num";   
			mysqli_query($con, $sql);
		?>		

	    <table id="view_content">

			<tr>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</tr>

			<tr>
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				?>
				<?=$content?>
			</tr>		
	    </table>
	    <table class="buttons">
				<tr><button onclick="location.href='user_board_list.php?page=<?=$page?>'">목록</button></tr>
				<tr><button onclick="location.href='user_board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></tr>
				<tr><button onclick="location.href='user_board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></tr>
				<tr><button onclick="location.href='user_board_form.php'">글쓰기</button></tr>
		</table>
	</div> <!-- board_box -->
</section> 
    <?php include "footer.php";?>
</html>

<?php
mysqli_close($conn);
?>
