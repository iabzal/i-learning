<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Teacher */

$this->title = 'Мұғалімді өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мұғалімдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="teacher-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
