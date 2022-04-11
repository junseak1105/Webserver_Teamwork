<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <form method="post" action="">
        <h1> 회원가입 </h1>
        <fieldset>
            <legend> 입력사항 </legend>
            <table>
                <tr>
                    <td>아이디 : </td>
                    <td>
                        <input type="text" name="user_id" placeholder="아이디를 입력하세요.">
                    </td>
                </tr>
                <tr>
                    <td>비밀번호 : </td>
                    <td>
                        <input type="text" name="user_pw" placeholder="비밀번호를 입력하세요.">
                    </td>
                </tr>
                <tr>
                    <td>추가할 데이터 : </td>
                    <td>
                        <input type="text" name="" placeholder="추가할 데이터">
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>관심 품목</legend>
                    <input type="radio" name="" value=""> item1
                    <input type="radio" name="" value=""> item2
                    <input type="radio" name="" value=""> item3
                    <input type="radio" name="" value=""> item4
                    <input type="radio" name="" value=""> item5
                    <input type="radio" name="" value=""> item6
        </fieldset>
        <input type="submit" value="가입하기" />
    </form>
    
</body>
</html>