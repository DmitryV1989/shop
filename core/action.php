<?
if (!empty($_POST)) {
    require_once($_SERVER['DOCUMENT_ROOT']."/core/index.php");
    switch ($_POST['CODE']) {
        // добавление в корзину
        case 'in_cart' : {
            if($CORE['CURRENT']['USER']['id']) {
                $user_cart = SELECT("SELECT * FROM `cart` WHERE `user_id`=".$CORE['CURRENT']['USER']['id'],"row"); // TODO: повторить
                if($user_cart) {
                    echo "в корзину";
                }
                else {
                    $product_list[$_POST['product_id']] = 1;
                    $cart_create = mysqli_query($sqlConnect,"INSERT INTO `cart` VALUES(0,'".serialize($product_list)."', ".$CORE['CURRENT']['USER']['id'].", NOW()) ");
                    if($cart_create) {
                        header("Location: ".$_SERVER['HTTP_REFERER']);
                    }
                }
            }
        } break;

    }
}
else {
    echo "no";
}

?>