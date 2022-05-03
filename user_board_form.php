<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    
?>

<!DOCTYPE html>
<html>
<title>꿀템공유사이트 - 글 쓰기</title>

<head><?php include "include/head.php"; ?></head>

<body>
	<?php
		include "include/sidenav.php";
	?>
    <section>
        <div id="board_box">
            <h1 id="board_title">
                게시판 > 글 쓰기
            </h1>
            <form  name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
                <ul id="board_form">	
	    		    <li>
	    			    <span class="col1">제목 : </span>
	    			    <span class="col2"><input name="subject" type="text"></span>
	    		    </li>	    	
	    		    <li id="text_area">	
	    			    <span class="col1">내용 : </span>
	    			    <span class="col2">
	    				    <textarea name="content"></textarea>
	    			    </span>
	    		    </li>
	    		    <li>
			            <span class="col1"> 첨부 파일</span>
			            <span class="col2"><input type="file" name="upfile"></span>
			        </li>
	    	        </ul>
	    	    <ul class="buttons">
				    <li><button type="button" onclick="check_input()">완료</button></li>
				    <li><button type="button" onclick="location.href='user_board_view.php'">목록</button></li>
			    </ul>
	        </form>
        </div> 
    </section> 
    <?php include "include/footer.php" ?>
</body>

</html>

<?php
mysqli_close($conn);
?>
