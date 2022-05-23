<!DOCTYPE html>
<html lang="en">
<head>
<?php 
        include "include/head.php";
        session_start();
        if($_SESSION['userID']!=""){
            Header("Location: ./index.php");
        }

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
                        <button id="login_form_submit"> 로그인 </button>
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
     $('#login_form_submit').click(function(e){
        e.preventDefault();
        
        let userID = $('#userID').val();
        let userPW = $('#userPW').val();

        login_chk(userID,userPW);
    });

    function login_chk(userID,userPW){
        location.href="chk_login.php?userID="+userID+"&userPW="+userPW+"";
    }
</script>