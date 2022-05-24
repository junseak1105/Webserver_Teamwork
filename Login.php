<!DOCTYPE html>
<html lang="en">
<head>
<?php 
        include "include/head.php";
        if($_SESSION['userID']!=""){
            Header("Location: ./index.php");
        }
?>
</head>
<body>
    <div>
        <h1 align="center">로그인</h1>
        <form id = "login_form" action="chk_login.php">
            <table align="center" border="0" cellspacing="0" width="300">
                <tr>
                    <td width="150" colspan="1">
                        <input type="text" name="userID" class="inph" id="userID">
                    </td>
                    <td rowspan="2" align="center">
                        <input type="button" id="login_form_submit" onclick="login_(this.form)" value="로그인"> </input>
                    </td>
                </tr>
                <tr>
                    <td width="150" colspan="1">
                        <input type="password" name="userPW" class="inph" id="userPW">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="register">
                        <a href="/Web/register.php">회원가입</a>
                    </td>
                </tr>
            </table>
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