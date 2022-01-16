<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = 'Пікірді өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пікірлер', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="review-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
