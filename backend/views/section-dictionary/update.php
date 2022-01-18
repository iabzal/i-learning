<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SectionDictionary */

$this->title = 'Сөздікті өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сөздік', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="section-dictionary-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
