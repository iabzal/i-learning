<?php

/* @var $this yii\web\View */

/* @var $products common\models\Product[] */
/* @var $title string */
/* @var $text string */
/* @var $pages \yii\data\Pagination */

$this->title = 'Поиск по запросу';

use common\models\Product;
use common\services\MyPager;
use yii\bootstrap\Html;
use yii\web\View;

?>
<style>
    .form-group {margin-bottom: 0;width: 100%;}
</style>
<!-- Product -->
<div class="bg0  p-t-120 p-b-140">
    <div class="container">
        <div class="p-b-30">
            <h6 class="ltext-108 cl5">
                По вашему запросу ничего не найдено <br>
            </h6>
            <h6 class="ltext-110 cl3">
               - Попробуйте ввести синоним или схожий запрос
            </h6>
        </div>
        <?php use yii\widgets\ActiveForm;
        $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['/search'],
        ]); ?>
        <div class="dis-none panel-search w-full p-t-10 p-b-15" style="display: block;">
            <div class="bor8 dis-flex p-l-15">
                <?= $form->field(new \frontend\models\Search(), 'query')
                    ->widget(keygenqt\autocompleteAjax\AutocompleteAjax::class, [
                        'url' => ['site/search-product'],
                        'options' => [
                            'class' => 'w-100 mtext-107 cl2 size-114 plh2 p-r-15 search-txt-input',
                            'placeholder' => 'Поиск...'
                        ]
                    ])->label(false) ?>
                <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>