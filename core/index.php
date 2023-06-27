<?
// подключение конфигурации сайта
$CORE['CONFIG'] = require_once($_SERVER['DOCUMENT_ROOT'] . "/core/config.php");

// управление отображением ошибок
ini_set('display_errors', $CORE['CONFIG']['DEV_MODE']);

// вспомогательные функции
require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php"); //  абсолютный путь (путь начиная от корня файловой системы (диск С), либо от домена)
//В переменной $_SERVER['DOCUMENT_ROOT'] хранится путь от корня до папки проекта(сайта), альтернатива - константа __DIR__

// подключение к БД
$sqlConnect = mysqli_connect(
    $CORE['CONFIG']['DB']['server'],
    $CORE['CONFIG']['DB']['user'],
    $CORE['CONFIG']['DB']['password'],
    $CORE['CONFIG']['DB']['name']
);
mysqli_set_charset($sqlConnect,'utf8');

// если пользователь аутентифицирован, запрашиваем о нём информацию
if(isset($_COOKIE['user'])) {
    // TODO: применить функцию SELECT
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
    // корзина
    $CORE['CURRENT']['USER']['CART'] = SELECT("SELECT * FROM `cart` WHERE `user_id`=".$CORE['CURRENT']['USER']['id'],"row");
//    if(!empty($CORE['CURRENT']['USER']['CART'])) {
        $CORE['CURRENT']['USER']['CART']['product_list'] = $CORE['CURRENT']['USER']['CART'] ? unserialize($CORE['CURRENT']['USER']['CART']['product_list']) : [];
//    }
    $CORE['CURRENT']['USER']['CART']['count'] = $CORE['CURRENT']['USER']['CART'] ? count($CORE['CURRENT']['USER']['CART']['product_list']) : 0;
}

// адреса
$CORE['ROUTES'] = require_once($_SERVER['DOCUMENT_ROOT']."/core/routes.php");
/* Включает(запускает) указанный файл (_once означает однократный запуск файла).
  * В случае возникновения ошибки выдаст фатальную ошибку E_COMPILE_ERROR, которая остановит выполение скрипта.
 * Этим данная функция отличается от include, в которой ошибка выдаёт warning и продолжает скрипт
  * */
?>