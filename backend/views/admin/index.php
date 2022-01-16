<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Администраторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Добавить администратора', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'full_name',
            'email:email',
            [
                'attribute' => 'status',
                'value' => 'statusName'
            ],
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'headerOptions' => ['width' => '5%']
            ],
        ],
    ]); ?>
</div>
