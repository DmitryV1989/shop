<?

//include("data.php"); // относительный путь (путь относительно текущего файла)
include($_SERVER['DOCUMENT_ROOT']."/core/db_connect.php"); // абсолютный путь (путь начиная от корня файловой системы (диск С), либо от домена)
include($_SERVER['DOCUMENT_ROOT']."/core/function.php"); // абсолютный путь
//В переменной $_SERVER['DOCUMENT_ROOT'] хранится путь от корня до папки проекта(сайта), альтернатива - константа __DIR__

$CORE = [];
// если пользователь аутентифицирован, запрашиваем о нём информацию
if(isset($_COOKIE['user'])) {
	$result = mysqli_query($sqlConnect,"SELECT * FROM `users` WHERE `id`='".$_COOKIE['user']."' LIMIT 1");
	while($selectedUser = mysqli_fetch_assoc($result)) {
		$CORE['CURRENT']['USER']=$selectedUser;
	}		
	switch ($CORE['CURRENT']['USER']['group']) {
		case 1:
			$CORE['CURRENT']['USER']['color']="red";
			break;
		case 2:
			$CORE['CURRENT']['USER']['color']="yellow";
			break;
		case 3:
			$CORE['CURRENT']['USER']['color']="green";
			break;
	}
}


?>