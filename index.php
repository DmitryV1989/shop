<?
require_once($_SERVER['DOCUMENT_ROOT']."/core/index.php"); // ядро (движок проекта)
// поиск адреса
if(array_key_exists($_SERVER['REQUEST_URI'],$CORE['ROUTES'])) { // проверка на существование ключей
    // $_SERVER['REQUEST_URI'] содержит адрес и имя файла
    $CORE['SECTION'] = $CORE['ROUTES'][$_SERVER['REQUEST_URI']];
}
else {
    $CORE['SECTION'][] = '404.php';
}

// подключение шаблона страницы
require_once($_SERVER['DOCUMENT_ROOT']."/core/templates/design.php");



?>
