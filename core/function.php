<?
/*
форматированный вывод массива, строки или числа
p($text, 'pr', __FILE__, __LINE__);
*/
function p($text, $flag = 'pr', $FILE = '', $LINE = '') {
    global $CORE;
    // если режим разработки выключен (DEV_MODE в значении ноль), то дебаг не будет работать
    if(!$CORE['CONFIG']['DEV_MODE']) return false;
	echo "<pre style=\"white-space: pre-wrap; background:#ececec;padding:10px;margin:10px 0;\">";
    if(!empty($FILE) AND !empty($LINE)) {
        echo "<div style='background: #98c5f3; padding: 5px; margin-bottom: 5px;'>".$FILE." (строка: ".$LINE.")</div>";
    }
    switch ($flag) {
        case 'pr': print_r($text); break;
        case 'vd': var_dump($text); break;
    }
	echo "</pre>";
}


/*
очистка входной строки
удаляет из содержимого переменной HTML-сущности, пробелы в начале и в конце строки и экранирующие символы ("\"):
check($_POST['name']);
*/
function check($field) { 
	return htmlspecialchars(trim(stripcslashes($field)));
}

/*
сниппет для запроса SELECT
print_r(SELECT("SELECT * FROM `categories` WHERE `id`=1"));

возвращает многомерный массив:
Array
(
    [1] => Array
        (
            [id] => 1
            [name] => Детская посуда
            [active] => 1
            [created_at] => 2022-12-11 14:02:35
        )

)
*/
function SELECT($select_query, $type = "rows") {
	global $sqlConnect;
    $arList = [];
	$sqlResult = mysqli_query($sqlConnect,$select_query);
	while($row = mysqli_fetch_assoc($sqlResult)) {
		$arList[$row['id']] = $row;	
	}
	if($type == "row" AND !empty($arList)){
		$arList = $arList[array_key_first($arList)];
	}
	return $arList;
}




?>