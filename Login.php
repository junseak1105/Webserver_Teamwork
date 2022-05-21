<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
        include "include/head.php";
        ?>
    </head>
    <body>
        <div>
            <h2 class="login_header">Login</h2>
            <form class="login_form" action="" method="POST">
                <div class="login_inputbox">
                    <input id="userID" type="text" name="userID" placeholder="아이디">
                    <label for="userID">아이디</label>
                </div>
                <div class="login_inputbox">
                    <input id="userPW" type="password" name="userPW" placeholder="비밀번호">
                    <label for="userPW">비밀번호</label>
                </div>
                <div class="login_register"><a href="register.php">회원가입</a></div>
                <input class="btn_login" type="submit" value="로그인">
            </form>
        </div>
    </body>
</html>

<script>
    $('#login_form button[type=submit]').click(function (e) {
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
            success: function (data) {
                if (data.returnMsg) 
                    alert("로그인 성공");
                $_SESSION['userID'] = data.userID;
                location.href = "./index.php";
                else 
                    alert("로그인 실패");
                }
            ,
            error: function (err) {
                alert(err);
            }
        });
    })
</script>