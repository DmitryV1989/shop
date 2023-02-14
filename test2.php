<pre><?
$sqlConnect = mysqli_connect('localhost','root','','shop');

// print_r($sqlConnect); // вывод результата соединения с БД "shop".

$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `categories`");
while($row = mysqli_fetch_assoc($sqlResult)) {
	$arCategories[$row['id']] = $row;

	// print_r($row); // вывод КОНКРЕТНОЙ СТРОКИ (записи) из БД.

}

// print_r($sqlResult); // вывод результата запроса конкретной записи (WHERE `id`=1) из БД.

// print_r($arCategories); // вывод накопленных результатов запросов (ВСЕ СТРОКИ) из таблицы в виде многомерного массива. В данном случае содержит только один вложенный массив.

function SELECT($select_query) {
	global $sqlConnect;
	$sqlResult = mysqli_query($sqlConnect,$select_query);
	while($row = mysqli_fetch_assoc($sqlResult)) {
		$arList[$row['id']] = $row;	
	}
	return $arList;
}

print_r(SELECT("SELECT * FROM `categories` WHERE `id`=1"));
die;
// 	print_r($sqlResult);
// while($row = mysqli_fetch_assoc(a())) {
// 	$arCategories[$row['id']] = $row;
// print_r($row);
// }
// $test="Dmitry";

// function love ($str){
// 	echo $str . " " . $test; // переменной $test внутри контекста функции love не существует
// }

// function love ($str){
// 	$test = "Alex";
// 	// echo $test  . " love " . $str; // переменная $test обьявлена внутри функции love и не существует вне этой функции
// } 
// echo $test; // переменная #test не существует вне функции love, если она не обьявлена за её пределами
// 
// function love ($str){
// 	global $test;
// 	echo $test  . " love " . $str; 
// } // функция $test глобализирована, поэтому существует даже если не объявлена внутри функции love

// $love1 = "beer, ";
// $love2 = "snowbord, ";
// $love3 = "php, ";

// love($love1);
// love($love2);
// love($love3);
// 


// sql запросы

// SELECT (выбор)
 mysqli_query($sqlConnect,"SELECT * FROM `product`");
$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `product`"); // запрос всех данных из таблицы product

$sqlResult = mysqli_query($sqlConnect,"SELECT `descr` FROM `product` WHERE `id`='1'");

print_r($sqlResult); // запрос конкретной записи из таблицы product


// INSERT INTO (создание)
mysqli_query($sqlConnect,"INSERT INTO `product`(`id`,`name`,`price`,`descr`,`cat_id`,`active`,`created_at`) VALUES('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')"); // подробный шаблон для создания новой записи в таблице product

mysqli_query($sqlConnect,"INSERT INTO `product` VALUES (96,'чашка',1001,'test96',9,1,NULL)"); // пример создания новой записи в таблице product


// UPDATE (обновление,изменение)
 mysqli_query($sqlConnect,"UPDATE `product` SET `id`='[value-1]',`name`='[value-2]',`price`='[value-3]',`descr`='[value-4]',`cat_id`='[value-5]',`active`='[value-6]',`created_at`='[value-7]' WHERE `id`=");

mysqli_query($sqlConnect,"UPDATE `product` SET `name`='кружка' WHERE `id`=96"); // пример изменения


// DELETE (удаление)
mysqli_query($sqlConnect,"DELETE FROM `product` WHERE `id`=96"); // пример удаления конкретной записи
?>