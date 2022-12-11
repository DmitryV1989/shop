<?
// include("data.php"); // относительный путь
include($_SERVER['DOCUMENT_ROOT']."/data.php"); // абсолютный путь
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Shop</title>
	<link rel="stylesheet" href="static/custom.css">	
</head>
<body>
	<header>
		<a href="">Главная</a>
		<a href="">Каталог</a>
		<a href="">Контакты</a>
	</header>
	<div class="container">

		<div id="catalog_list" class="bimg">
			<? foreach($arCatalog as $item): if(!$item['active']) continue; ?>
			<div class="item">	
				<img src="static/images/upload/image<?=$item['id']?>.png" alt="">
				<div class="inner">
					<div class="title"><?=$item['name']?></div>
					<div class="price"><?=$item['price']?> руб.</div>					
					<a href="" class="more">Подробнее</a>
				</div>	
			</div>
			<? endforeach; ?>
		</div>
		<div class="sidebar">
			<div class="title">Категории</div>
			<? foreach ($arCategories as $item ): ?>
				<div class="content"><?=$item['name']?></div>
			<? endforeach; ?>	
		</div>
		<!-- <? p($arCatalog) ?> -->

	</div>	
	<footer>
		<p>&copy</p>
		<p>2022. Магазин барахла</p>
	</footer>
</body>
</html>