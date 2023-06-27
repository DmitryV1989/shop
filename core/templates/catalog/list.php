<?
$arProduct = SELECT("SELECT * FROM `product`");
//p($CORE);
?>
<div id="catalog_list">
    <? foreach ($arProduct as $item ): ?>
    <div class="item">
        <img src="/static/images/upload/catalog/image<?=$item['id']?>.png" alt="" class="preview bimg">
        <div class="inner">
            <div class="name"><?=$item['name']?></div>
            <div class="price"><?=$item['price']?> руб</div>
            <div class="more_area">
                <a href="" class="more">Подробнее</a>
                <? // if($CORE['CURRENT']['USER']['CART']['product_list']): ?>
                <? if(array_key_exists($item['id'], $CORE['CURRENT']['USER']['CART']['product_list'])): ?>
                    <span>Добавлен</span>
                <? else: ?>
                <form action="/core/action.php" method="post">
                    <input type="hidden" name="product_id" value="<?=$item['id']?>">
                    <input type="hidden" name="CODE" value="in_cart">
                    <input type="submit" value="в корзину">
                </form>
                <? endif; ?>
                <? // endif; ?>
            </div>
        </div>
    </div>
    <? endforeach; ?>
</div>
