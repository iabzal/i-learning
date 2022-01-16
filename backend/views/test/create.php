<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tests */

$this->title = 'Квиз қосу';
$this->params['breadcrumbs'][] = ['label' => 'Квиздер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tests-create">
    <div class="box content">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
