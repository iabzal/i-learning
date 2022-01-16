<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = 'Профиль';
?>
<div class="admin-update">
    <div class="box content">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
