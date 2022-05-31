<!DOCTYPE html>
<html lang="en">
<head>
<?php 
        include "include/head.php";
        //session_start();

        if($_COOKIE["userID"]!= ""){
            Header("Location: ./index.php");
        }
?>
</head>
    <body>
        <div class="login_form">
            <h2 class="login_title">Login</h2>
            <form action="chk_login.php" method="POST">
                <div class="login_inputbox">
                    <input class="login_input" id="userID" type="text" name="userID" placeholder="아이디">
                    <label class="label_id:" for="userID">아이디</label>
                </div>
                <div class="login_inputbox">
                    <input class="login_input" id="userPW" type="password" name="userPW" placeholder="비밀번호">
                    <label class="label_pw" for="userPW">비밀번호</label>
                </div>
                <div class="login_register"><a href="register.php">회원가입</a></div>
                <input class="btn_login" type="submit" onclick="login_(this.form)" value="로그인">
            </form>
        </div>
    </body>
</html>
<script>
    function login_(form_) {
			if (form_.userID.value == "") {
				alert("아이디를 입력하시오");
				form_.userID.focus();
				return false;
			} else if (form_.userPW.value == "") {
				alert("비밀번호를 입력하시오");
				form_.userPW.focus();
				return false;
			}
			form_.submit();
		}
</script>