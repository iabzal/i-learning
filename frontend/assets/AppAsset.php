<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Montserrat:300,500,600',
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500i',
        'https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css',
        'css/linearicons.css',
        'css/font-awesome.min.css',
        'css/bootstrap.css',
        'css/magnific-popup.css',
        'css/nice-select.css',
        'css/animate.min.css',
        'css/owl.carousel.css',
        'css/main.css',
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
}
