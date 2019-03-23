<?php

class Cart
{
    public static function addProduct($id)
    {
        $id = intval($id);

        $productCount = !empty($_POST['count']) ? $_POST['count'] : 1;

        // Пустой массив для товаров в корзине
        $productsInCart = [];

        // Если в корзине уже есть товары (они хранятся в сессии)
        if (isset($_SESSION['products'])) {
            // То заполним массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар есть в корзине, но был добавлен еще раз, увеличим количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] += $productCount;
        } else {
            // Добавляем новый товар в корзину
            $productsInCart[$id] = $productCount;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    public static function countItems()
    {

        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }

    }

    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();
        $total = 0;

        if ($productsInCart) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }

    public static function clearItem($id)
    {
        $productsInCart = self::getProducts();

        $count = !empty($_POST['count']) ? $_POST['count'] : 0;
        $productsInCart[$id] = $count;
        if ($productsInCart[$id] <= 0) {
            unset($productsInCart[$id]);
        }
        $_SESSION['products'] = $productsInCart;
    }

    public static function clearCart()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }


}