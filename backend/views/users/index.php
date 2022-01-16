<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    table td:nth-child(2) {
        width: 2em;
    }
</style>
<div class="user-index">
    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(
                        '<i class="fa fa-qrcode"></i>',
                        ['/users/generate-qrcode', 'link' => $model->unique_link],
                        [
                            'class' => 'btn btn-success',
                        ]
                    );
                }
            ],
            'linkPage',
            'fullName',
            'email:email',
            [
                'attribute' => 'type',
                'value' => 'typeName'
            ],
            [
                'attribute' => 'status',
                'value' => 'statusName'
            ],
            [
                'attribute' => 'ambassador_id',
                'value' => 'ambassadorName'
            ],
            [
                'attribute' => 'employer_id',
                'value' => 'employerName'
            ],
            //'created_at',
            //'updated_at',
            //'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
