<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SectionPracticalWork */

$this->title = 'Практикалық жұмысты қосу';
$this->params['breadcrumbs'][] = ['label' => 'Практикалық жұмыс', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-practical-work-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
