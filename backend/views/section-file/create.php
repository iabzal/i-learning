<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SectionFile */

$this->title = 'Оқу-әдістеме қосу';
$this->params['breadcrumbs'][] = ['label' => 'Оқу-әдістеме', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-file-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
