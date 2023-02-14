<?
include($_SERVER['DOCUMENT_ROOT']."/core/index.php"); // ядро (движок проекта)

if($CORE['CURRENT']['USER']['group']!=3){
	header("Location: /");
}
// if($CORE['CURRENT']['USER']['name']){

// }
// 


$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `categories`");
while($row = mysqli_fetch_assoc($sqlResult)) {
	$arCategories[$row['id']] = $row;
}
$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `product`"); // запрашиваем все записи из product
// p($sqlResult); // промежуточный отчёт по запросу
while($row = mysqli_fetch_assoc($sqlResult)) { // преобразование отчёта в ассоциативный массив ( с записями из таблицы )
	// echo "row";
	// p($row); // row каждую итерацию удаляет в себе предыдущую запись и получает очередную новую
	$arProduct[$row['id']] = $row; // накапливаем результат в arProduct, который на следующей итерации пропадёт в row, но в arProduct останется
	// break;
}
// echo "arProduct";
// p($arProduct); // цикл завершён, все записи накоплены в arProduct
?>



<table id="list_product" border="1">
	<tr>
		<td>id</td>
		<td>название</td>
		<td>цена</td>
		<td>категория</td>
		<td>активный</td>
		<td>дата создания</td>
	</tr>
	<!-- $arProduct -->

	<? foreach ($arProduct as $item ): ?>
	<tr>
		<td><?=$item['id']?></td>
		<td><?=$item['name']?></td>
		<td><?=$item['price']?></td>
		<td><?=@$arCategories[$item['cat_id']]['name']?></td>
		<td><?=$item['active']?></td>
		<td><?=$item['created_at']?></td>
		<td><a href="/admin?id=<?=$item['id']?>&code=edit">edit</a></td>
		<td><a href="/admin?id=<?=$item['id']?>&code=delete">delete</a></td>
	</tr>
	<? endforeach; ?>
</table>

<?
if (isset($_GET['code'])) {
	switch ($_GET['code']) {
		case 'edit': { 
			$product_edit = SELECT("SELECT * FROM `product` WHERE `id`=".$_GET['id'],"row"); // в sql запросе переменная $_GET['id'] распознаётся как строка, для присвоения её значения необходима конкатенация
?>
			<form enctype="multipart/form-data" method="post" id="create_product">
				<h2>редакция товара</h2>		
				<div>
					<input type="text" id="product_name" name="product_name" value="<?=$product_edit['name']?>" required>
					<label for="product_name">название товара</label>
				</div>
				<div>
					<input type="text" id="price" name="price" value="<?=$product_edit['price']?>" required>
					<label for="price">цена</label>
				</div>
				<div>
					<textarea name="descr" id="descr" cols="30" rows="10" ><?=$product_edit['descr']?></textarea>
					<label for="descr">описание</label>
				</div>
				<div>
					<label for="category">выберите категорию</label>
					<select name="category" id="category">
						<? foreach ($arCategories as $item ): ?>
						<option value="<?=$item['id']?>" <?=($item['id'] == $product_edit['cat_id']?" selected":"")?>><?=$item['name']?></option>
						<? endforeach; ?>
					</select>				
				</div>
				<div>
					<label for="product_pict">выберите картинку товара</label>
					<input type="file" name="product_pict" id="product_pict">		
				</div>
				<div>
					<input type="checkbox" id="active" checked name="active" value="1">
					<label for="active">активность</label>
				</div>
				<div>
					<input type="submit" name="edit" value="редактировать">
				</div>
			</form>
			<?
			if(isset($_POST['edit'])) {
				p($_POST);
				// TODO: выполнить UPDATE
			}
			?>	
		<? } break;
		case 'delete': {
			$sqlResult=mysqli_query($sqlConnect,"DELETE FROM `product` WHERE `id`=".$_GET['id']);
			// p("DELETE FROM `product` WHERE `id`=".$_GET['id']);
		} break;
		
	}
}
?>

<form enctype="multipart/form-data" method="post" id="create_product">
	<h2>создание нового товара</h2>
	<div>
		<input type="text" id="product_name" name="product_name" required>
		<label for="product_name">название товара</label>
	</div>
	<div>
		<input type="text" id="price" name="price" required>
		<label for="price">цена</label>
	</div>
	<div>
		<textarea name="descr" id="descr" cols="30" rows="10" ></textarea>
		<label for="descr">описание</label>
	</div>
	<div>
		<label for="category">выберите категорию</label>
		<select name="category" id="category">
			<? foreach ($arCategories as $item ): ?>
			<option value="<?=$item['id']?>"><?=$item['name']?></option>
			<? endforeach; ?>
		</select>				
	</div>
	<div>
		<label for="product_pict">выберите картинку товара</label>
		<input type="file" name="product_pict" id="product_pict">		
	</div>
	<div>
		<input type="checkbox" id="active" checked name="active" value="1">
		<label for="active">активность</label>
	</div>
	<div>
		<input type="submit" name="create" value="создать товар">
	</div>
</form>


<?

// if(!empty($_POST)) {
if(isset($_POST['create'])) {
	// p($_POST);
	// проверка входных данных
	if (is_int($_POST['price']) OR is_string($_POST['price'])) $_POST['price'] = (float)$_POST['price'];
	if (!is_float($_POST['price'])) die("неверная цена"); 

	// отправка данных в БД
	$sqlResult = mysqli_query($sqlConnect,"INSERT INTO `product` VALUES (
		0,
		'".$_POST['product_name']."',
		'".$_POST['price']."',
		'".$_POST['descr']."',
		'".$_POST['category']."',
		'".$_POST['active']."',
		NOW()
	);");
	p($sqlResult ? "создано".$sqlConnect->insert_id : "не создано");
	// загрузка изображения товара
	// p($_FILES);
	switch ($_FILES["product_pict"]["type"]) {
		case 'image/jpeg':
			$extention=".jpg";
			break;
		case 'image/png':
			$extention=".png";
			break;
	}
	// p('static/images/upload/'.$sqlConnect->insert_id.$extention);

	echo move_uploaded_file($_FILES['product_pict']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/static/images/upload/image'.$sqlConnect->insert_id.$extention) ? "файл загружен" : "ошибка загрузки файла";

}




