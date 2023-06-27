<?php
// регистрация
if(isset($_POST['REG'])) {
    // обработка входящей информации (очистка от посторонних символов):
    $name = check($_POST['NAME']);
    $password = check($_POST['PSWD']);
    $retype_password = check($_POST['RETYPE_PSWD']);

    $email = check($_POST['EMAIL']);
    if(!filter_var($_POST['EMAIL'],FILTER_VALIDATE_EMAIL)){
        die("неправильная почта");
    }
    $bio = check($_POST['BIO']);
    // сравнение паролей:
    if($password==$retype_password) {
        // поиск пользователей с введённым именем(исключаем дубли польвателей):
        $match_user=mysqli_query($sqlConnect, "SELECT * FROM `users` WHERE `name`='$name'");
        if($match_user->num_rows) { // при значении num_rows TRUE (не ноль), т.е. пользователь с таким именем найден:
            echo "выберите другое имя";
        }
        else { // при значении num_rows ноль, т.е. пользователь не найден и такое имя можно использовать:
            // шифрование пароля:
            $cryptPSWD = password_hash($password, PASSWORD_ARGON2I);
            // создание нового пользователя:
            $create_user = mysqli_query($sqlConnect, "INSERT INTO `users` VALUES(0,'$name','$cryptPSWD',1,1,'$email','$bio',NOW())");
            // попутная аутентификация:
            setcookie("user",$sqlConnect->insert_id , ['path'=>'/']);
            header("Location: /auth");
        }
    }
    else {
        echo "пароли не совпадают";
    }
}
?>
<form action="" method="post">
    <h2>Регистрация</h2>
    <table>
        <tr>
            <td>Ваше имя</td>
            <td><input type="text" name="NAME"></td>
        </tr>
        <tr>
            <td>Пароль</td>
            <td><input type="password" name="PSWD"></td>
        </tr>
        <tr>
            <td>Повторите пароль</td>
            <td><input type="password" name="RETYPE_PSWD"></td>
        </tr>
        <tr>
            <td>Ваш email</td>
            <td><input type="text" name="EMAIL"></td>
        </tr>
        <tr>
            <td>Расскажите о себе</td>
            <td><textarea name="BIO" cols="39" rows="8" maxlength="300"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Зарегистрироваться" name="REG"></td>
        </tr>
    </table>
</form>
