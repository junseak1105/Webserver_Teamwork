<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "include/head.php";
    ?>
</head>
<body>
    <div>
        <h1 class="register_header">회원가입</h1>
        <form method="post" action="register_function.php">
            <div class="register_inputbox">
                <input id="userID" type="text" name="userID" placeholder="아이디">
                <label for="userID"> 아이디 </label>
            </div>
            <div class="register_inputbox">
                <input id="userPW" type="password" name="userPW" placeholder="비밀번호">
                <label for="userPW">비밀번호</label>
            </div>
            <div class="register_inputbox">
                <input id="userName" type="text" name="userName" placeholder="이름">
                <label for="userName">이름</label>
            </div>
            <input class="btn_register" type="submit" value="가입하기" />
        </form>
    </div>
</body>
</html>