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
        <form method="post" action="">
            <div class="register_inputbox">
                <input id="userID" type="text" name="userID" placeholder="아이디">
                <label for="userID"> 아이디 </label>
            </div>
            <div class="register_inputbox">
                <input id="userPW" type="password" name="userPW" placeholder="비밀번호">
                <label for="userPW">비밀번호</label>
            </div>
            <div class="register_inputbox">
                <input id="data" type="text" name="data" placeholder="data">
                <label for="data">Data</label>
            </div>
            <div class="register_item">
                <b>관심 품목 <br></b>   
                <div class="register_radiobox">
                    <input type="radio" name="" value=""> item1
                    <input type="radio" name="" value=""> item1
                    <input type="radio" name="" value=""> item1
                    <input type="radio" name="" value=""> item1 
                    <input type="radio" name="" value=""> item1
                </div>
            </div>
            <input class="btn_register" type="submit" value="가입하기" />
        </form>
    </div>
</body>
</html>