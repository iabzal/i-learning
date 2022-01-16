<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SectionFile */

$this->title = 'Оқу-әдістемені өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Оқу-әдістеме', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="section-file-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
