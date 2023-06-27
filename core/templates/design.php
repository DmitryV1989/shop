<?
// выход
if(isset($_GET['exit'])) {
    setcookie("user","",['path'=>'/','expires'=>-1]);
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>Магазин</title>
    <link rel="stylesheet" href="/static/custom.css">
</head>
<body>
<div "wrapper">
    <div class="container">
        <header>
            <div class="row c1">
                <a href="index.html" id="logo"><img src="/static/images/logo.png" alt=""></a>
                <div class="contact_area">
                    <a href="" class="phone">+7 900 123-45-67</a>
                    <a href="" class="email">reply@shop.ru</a>
                </div>
                <div class="user_area">
                    <? if(isset($_COOKIE['user'])): ?>
                        <div>Вы вошли как:
                            <strong style="color:<?=$CORE['CURRENT']['USER']['color']?>"><?=$CORE['CURRENT']['USER']['name']?></strong>, <a href="?exit">выйти</a>
                        </div>
                    <? else: ?>
                        <a href="/auth">Log In</a> | <a href="/reg">Sign Up</a>
                    <? endif; ?>
                </div>
            </div>
            <div class="row c2">
                <nav>
                    <a href="/">Главная</a>
                    <a href="/catalog">Каталог</a>
                    <a href="#">Текст</a>
                </nav>
                <div class="cart_area">
<!--                    <a href="/favorite" class="ico favorite"></a>-->
                    <a href="/cart" class="ico cart has"><span class="count"><?=$CORE['CURRENT']['USER']['CART']['count']?></span></a>
                </div>
            </div>
        </header>

        <div id="inner_wrap">
            <section>
                <?
//                p($CORE);
                // подключение файлов раздела
                foreach ($CORE['SECTION'] as $block_file) {
                    require_once($_SERVER['DOCUMENT_ROOT']."/core/templates/".$block_file);
                }
                ?>
            </section>
            <aside>
                <?
                $arCategories = SELECT("SELECT * FROM `categories`");
                ?>
                <div class="categories_link">
                    <? foreach ($arCategories as $item ): ?>
                        <a href=""><?=$item['name']?></a>
                    <? endforeach; ?>
                </div>
            </aside>
        </div>

    </div>
</div>
<footer>
    <div class="container">© 2022. Магазин барахла</div>
</footer>
</body>
</html>
