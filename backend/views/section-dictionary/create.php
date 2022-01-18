<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SectionDictionary */

$this->title = 'Сөздік қосу';
$this->params['breadcrumbs'][] = ['label' => 'Сөздік', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-dictionary-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
