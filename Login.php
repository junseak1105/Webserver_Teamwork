<!DOCTYPE html>
<html lang="en">
<head>
<?php 
        include "include/head.php";
?>
</head>
<body>
    <div>
        <h1 align="center">로그인</h1>
        <form id = "login_form">
            <table align="center" border="0" cellspacing="0" width="300">
                <tr>
                    <td width="150" colspan="1">
                        <input type="text" name="user_id" class="inph" id="userID">
                    </td>
                    <td rowspan="2" align="center">
                        <button type="submit" id="login_form_submit"> 로그인 </button>
                    </td>
                </tr>
                <tr>
                    <td width="150" colspan="1">
                        <input type="password" name="user_pw" class="inph" id="userPW">
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
    $('#login_form button[type=submit]').click(function(e){
        e.preventDefault();
        
        let userId = $('#userID').val();
        let userPW = $('#userPW').val();
        $.ajax({
            url: './chk_login.php',
            data: {
                userId: userId,
                userPwd: userPW
            },
            type: "POST",
            dataType: "json",
            success: function(data){
                if(data.returnMsg)
                	alert("로그인 성공");
                    $_SESSION['userID']=data.userID;
                    location.href="./index.php";
                else
                    alert("로그인 실패");
            }, 
            error: function(err){
				alert(err);
            }
        });
    })

</script>