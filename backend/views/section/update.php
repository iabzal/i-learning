<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Section */

$this->title = 'Тақырыпты өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сабақтар', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="section-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
