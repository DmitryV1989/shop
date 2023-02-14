<?
include($_SERVER['DOCUMENT_ROOT']."/core/index.php"); // ядро (движок проекта)

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
// аутентификация
if(isset($_POST['AUTH'])) {
	// обработка входящей информации:
	$name = check($_POST['NAME']);
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

// выход
if(isset($_GET['exit'])) {
	setcookie("user","",['path'=>'/','expires'=>-1]);
	header("Location: /");
}

// $a = "Сегодня хорошая погода";
// echo(htmlspecialchars($a,ENT_QUOTES)); 
// echo(htmlspecialchars("<div>Сегодня хорошая погода</div>",ENT_QUOTES));
// echo($a);
// echo trim("$a","Са");
?>


<? if(isset($_COOKIE['user'])): ?>

<div>Вы вошли как: 
	<?/*
		<strong style="color:
		<? if($currentUser['group']==1){
			 echo "red";
		} 
		elseif($currentUser['group']==2) {
			 echo "green";
		} 
		echo $currentUser['name']</strong>, <a href="?exit">выйти</a>
	*/
	?>		
	<strong style="color:<?=$CORE['CURRENT']['USER']['color']?>"><?=$CORE['CURRENT']['USER']['name']?></strong>, <a href="?exit">выйти</a>
</div>

<? else: ?>

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

<? endif; ?>