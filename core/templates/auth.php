<?
// аутентификация
if(isset($_POST['AUTH'])) {
    // обработка входящей информации:
    $name = check($_POST['NAME']); // уточнить про check
    $password = check($_POST['PSWD']);
    // проверка существования запрашиваемого пользователя
    $user = mysqli_query($sqlConnect, "SELECT * FROM `users` WHERE `name`='$name' LIMIT 1");
    if($user->num_rows) {
        while($selectedUser = mysqli_fetch_assoc($user)) {
            // сравнение введённого пароля с паролем в базе у запрашиваемого пользователя для аутентификации
            if(password_verify($password,$selectedUser['password'])) {
                // назначение пользователя (аутентификация):
                setcookie("user",$selectedUser['id'],['path'=>'/']);
                header("Location: /"); // редирект (перенаправление на указанную страницу):
            }
            else {
                echo "пароли не совпадают";
            }
        }
    }
    else {
        echo "пользователь не найден";
    }
}



?>



    <form action="" method="post">
        <h2>Аутентификация</h2>
        <table>
            <tr>
                <td>Ваше имя</td>
                <td><input type="text" name="NAME"></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><input type="password"name="PSWD"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Аутентификация" name="AUTH"></td>
            </tr>
        </table>
    </form>





