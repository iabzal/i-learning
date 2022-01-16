<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, maximum-scale=1"/>
    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" sizes="16x16">
    <meta name="description" content="Независимый аналитический портал">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>

<body>

<!-- Start Header Area -->
<header id="header">
    <div class="container">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="/"><img src="/images/logo.png" alt="" title=""/></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="/">Басты бет</a></li>
                    <li><a href="/about">Біз туралы</a></li>
                    <li><a href="/course">Пәндер</a></li>
                    <li><a href="/news">Жаңалықтар</a></li>
                    <li><a href="/contact">Байланыс</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header>
<!-- End Header Area -->

<?= Alert::widget() ?>
<?= $content ?>


<!-- Start Footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="footer-bottom row align-items-center">
            <p class="footer-text m-0 col-lg-8 col-md-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Барлық құқықтар қорғалған &copy;<script>document.write(new Date().getFullYear());</script>
            <div class="col-lg-4 col-md-12 footer-social">
                <a href="#"><i class="fa fa-whatsapp"></i></a>
                <a href="#"><i class="fa fa-telegram"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->

<!-- ####################### Start Scroll to Top Area ####################### -->
<div id="back-top">
    <a title="Go to Top" href="#">
        <img src="/images/up.png" alt="">
    </a>
</div>
<!-- ####################### End Scroll to Top Area ####################### -->

<script src="/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="/js/easing.min.js"></script>
<script src="/js/hoverIntent.js"></script>
<script src="/js/superfish.min.js"></script>
<script src="/js/jquery.ajaxchimp.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/owl-carousel-thumb.min.js"></script>
<script src="/js/jquery.sticky.js"></script>
<script src="/js/jquery.nice-select.min.js"></script>
<script src="/js/parallax.min.js"></script>
<script src="/js/waypoints.min.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>
<script src="/js/mail-script.js"></script>
<script src="/js/main.js"></script>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
