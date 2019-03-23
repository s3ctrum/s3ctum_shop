<?php

class ProductController
{
    public function actionView($productId)
    {

        $categories = Category::getCategoryList();

        $product = Product::getProductById($productId);

        $recommendedProducts = Product::getRecommendedProducts();

        require_once(ROOT . '/views/product/view.php');

        return true;
    }
}