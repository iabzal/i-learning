<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = 'Пәнді өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пәндер', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="course-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
