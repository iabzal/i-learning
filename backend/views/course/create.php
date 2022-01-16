<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = 'Пән қосу';
$this->params['breadcrumbs'][] = ['label' => 'Пәндер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
