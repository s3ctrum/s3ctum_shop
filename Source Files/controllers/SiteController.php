<?php

class SiteController
{
    public function actionIndex()
    {

        $categories = Category::getCategoryList();

        $latestProducts = Product::getLatestProducts(3);

        $recommendedProducts = Product::getRecommendedProducts();

//        $pagination = new Pagination(count($latestProducts), 1, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/site/index.php');

        return true;
    }

    public function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            if ($errors == false) {
                $result = User::sendEmail($userEmail, $userText);
                $result = true;
            }
        }

        require_once(ROOT . '/views/site/contact.php');

        return true;
    }

    public function actionBlog()
    {
        // Подключаем вид
        require_once(ROOT . '/views/blog/index.php');
        return true;
    }

    public function actionAbout()
    {
        // Подключаем вид
        require_once(ROOT . '/views/site/about.php');
        return true;
    }

}