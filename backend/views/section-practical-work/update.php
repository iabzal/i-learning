<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SectionPracticalWork */

$this->title = 'Практикалық жұмысты өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Практикалық жұмыс', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="section-practical-work-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
