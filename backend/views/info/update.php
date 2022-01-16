<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Info */

$this->title = 'Мәтінді өзгерту: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Мәтін', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="info-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
