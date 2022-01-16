<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Квиздер';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .tests-index table td{
        white-space: pre-wrap;
        word-break: break-all;
    }
</style>
<div class="tests-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Квиз қосу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'format' => 'Raw',
                'value' => function($model){
                    return '<a href="/admin/test/update?id='.$model->id.'">'.$model->name.'</a>';
                },
                'headerOptions' => ['width' => '30%']
            ],
            [
                'attribute' => 'duration',
                'headerOptions' => ['width' => '20%']
            ],
            [
                'attribute' => 'min_score',
                'headerOptions' => ['width' => '20%']
            ],
            [
                'attribute' => 'created_at',
                'headerOptions' => ['width' => '20%']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/admin/test/update?id='.$model->id);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/admin/test/delete?id='.$model->id,
                            ["aria-label" =>"Жою", "data-pjax" => "0", "data-confirm" => "Бұл элементті жойғыңыз келеді ме?", "data-method" => "post"]);
                    },
                ],
                'headerOptions' => ['width' => '5%']
            ],

        ],
    ]); ?>
</div>
