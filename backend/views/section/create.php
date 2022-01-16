<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Section */

$this->title = 'Сабақтар';
$this->params['breadcrumbs'][] = ['label' => 'Сабақтар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
