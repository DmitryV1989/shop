<?
/*
форматированный вывод массива, строки или числа
*/
function p($text) {
	echo "<pre style=\"white-space: pre-wrap; background:#fafafa;padding:10px;margin:10px 0;\">";
	print_r($text);
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
	$sqlResult = mysqli_query($sqlConnect,$select_query);
	while($row = mysqli_fetch_assoc($sqlResult)) {
		$arList[$row['id']] = $row;	
	}
	if($type == "row"){
		$arList = $arList[array_key_first($arList)];
	}
	return $arList;
}




?>