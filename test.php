<pre><?
$sqlConnect = mysqli_connect('localhost','root','','shop'); //дескриптор подключения к БД

$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `categories`");
while($row = mysqli_fetch_assoc($sqlResult)) {
	$arCategories[$row['id']] = $row;
}
// print_r($arCategories[4]['name']);
$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `product`"); // запрос результата подключения к БД, затем 
// запрос полей(*) из таблицы product, "ВЫБРАТЬ все поля ИЗ {ТАБЛИЦЫ} `product`" 
while($row = mysqli_fetch_assoc($sqlResult)) {
	// print_r($row['cat_id']);
	// к каждой цене добавить постфикс руб 
	$row['cat_id'] = $row['cat_id']; // смотреть на 8-ю строку и 39-ю строку из правой рабочей области
	$arProduct[$row['id']] = $row; // заменить цифры в категории на их название
}

print_r($arProduct);



?>