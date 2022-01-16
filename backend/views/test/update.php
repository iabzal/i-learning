<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tests */

$this->title = 'Квизді өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Квиздер', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="tests-update">
    <div class="box content">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
