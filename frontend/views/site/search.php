<?php

/* @var $this yii\web\View */

/* @var $products common\models\Product[] */
/* @var $title string */
/* @var $text string */
/* @var $pages \yii\data\Pagination */

$this->title = 'Поиск по запросу';

use common\services\MyPager;
use yii\bootstrap\Html;
$favoriteList = [];
if (Yii::$app->session->get('favoriteList')) {
    $favoriteList = Yii::$app->session->get('favoriteList');
}
$cartList = [];
if (Yii::$app->session->get('cartList')) {
    $cartList = Yii::$app->session->get('cartList');
}
?>
    <!-- Product -->
    <div class="bg0  p-t-120 p-b-140">
        <div class="container">
            <div class="p-b-30">
                <h6 class="ltext-108 cl5">
                    Товары по запросу «<?= $text ?>»
                </h6>
                <h6 class="ltext-110 cl3">
                    Найдено товаров: <?= count($products) ?>
                </h6>
            </div>
            <div class="row isotope-grid">
                <?php if (count($products) > 0) { ?>
                    <?php foreach ($products as $product) { ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic product-img">
                                    <img src="/uploads/product-images/<?= $product->bg_image ?>" alt="img-product">
                                    <?= Html::a('Посмотреть',
                                        ['/' . $product->categorySlug . '/product/' . $product->slug],
                                        ['class' => 'block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04',]);
                                    ?>
                                    <?php if ($product->old_price) { ?>
                                        <div class="ribbon ribbon-top-right"><span><?= $product->salePercent; ?></span>
                                        </div> <?php } ?>
                                </div>


                                <div class="block2-txt">
                                    <a href="/<?= $product->categorySlug . '/product/' . $product->slug ?>"
                                       class="block2-txt-child1">
                                        <div class="stext-119 cl6 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            <?= $product->title ?>
                                        </div>
                                        <div class="stext-105 cl3">
                                            <?php if ($product->old_price) { ?>
                                                <span class="old-price"><?= number_format($product->old_price, 0, '.', ' '); ?> тг </span>
                                            <?php } ?>
                                            <?= number_format($product->price, 0, '.', ' '); ?> тг
                                        </div>
                                    </a>

                                    <div class="block2-txt-child2 d-flex">
                                        <a href="#" class="d-flex flex-c flex-m btn-addwish-b2 js-addwish-b2 <?php if (in_array($product->id, $favoriteList)) { echo " js-addedwish-b2";} ?>" data-id="<?= $product->id ?>">
                                            <div class="dis-inline-block pos-relative">
                                                <img class="icon-heart1 dis-block trans-04" src="/images/icons/heart.png" alt="icon">
                                                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="/images/icons/heart2.png" alt="icon">
                                            </div>
                                        </a>
                                        <div class="vr"></div>
                                        <a href="#" class="d-flex flex-c flex-m btn-addwish-b2 js-addcart-detail <?php if (in_array($product->id, $cartList)) {
                                               echo " js-addedcart-b2";
                                           } ?>" data-id="<?= $product->id ?>">
                                            <div class="dis-inline-block  pos-relative">
                                                <img class="icon-heart1 dis-block trans-04" src="/images/icons/cart.png" alt="icon">
                                                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="/images/icons/cart2.png" alt="icon">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>

            <!-- Pagination -->
            <div class="flex-c-m flex-w w-full p-t-38">
                <?= MyPager::widget(['pagination' => $pages, 'maxButtonCount' => 5,]); ?>
            </div>
        </div>
    </div>