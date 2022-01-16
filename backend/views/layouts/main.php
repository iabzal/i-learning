<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;

if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$bundle = \hail812\adminlte3\assets\PluginAsset::register($this);
$bundle->css[] = 'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css';
$bundle->js[] = 'sweetalert2/sweetalert2.min.js';
AppAsset::register($this);

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" sizes="16x16">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- Navbar -->
        <?php
        if (!Yii::$app->user->isGuest) {
            echo $this->render('navbar', ['assetDir' => $assetDir]);
        }
         ?>
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        <?php
        if (!Yii::$app->user->isGuest) {
            echo $this->render('sidebar', ['assetDir' => $assetDir]);
        }
        ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?= $this->render('footer') ?>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
<?php } ?>
