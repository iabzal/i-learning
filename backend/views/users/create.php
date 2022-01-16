<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Добавить пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box content">
    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div>
</div>
