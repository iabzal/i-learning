<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = 'Добавить администратора';
$this->params['breadcrumbs'][] = ['label' => 'Администраторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
