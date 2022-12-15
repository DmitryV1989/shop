<? 
include($_SERVER['DOCUMENT_ROOT']."/db_connect.php"); // абсолютный путь
include($_SERVER['DOCUMENT_ROOT']."/function.php"); // абсолютный путь

$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `product` WHERE `id`=1");

$arItem = [];
while($row = mysqli_fetch_assoc($sqlResult)) {
	// print_r($row);
	$arItem = $row;
}
p($arItem);

// http://shop.loc/catalog/chashki/tramontina/?test1=10&user1=ivan
// p($_SERVER['REQUEST_URI']);
// p($_SERVER['HTTP_HOST']);
// p($_SERVER['SERVER_PROTOCOL']);
// p($_GET);
// ?>
