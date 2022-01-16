<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Teacher */

$this->title = 'Мұғалім қосу';
$this->params['breadcrumbs'][] = ['label' => 'Мұғалімдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
