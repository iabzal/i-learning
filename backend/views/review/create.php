<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = 'Пікір қосу';
$this->params['breadcrumbs'][] = ['label' => 'Пікірлер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
