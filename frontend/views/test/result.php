<?php

/* @var $this yii\web\View */
/* @var $score integer */
/* @var $question integer */
/* @var $correct integer */

$this->title = 'Результат';
?>


<!-- Start Banner Area -->
<section class="banner-area relative" style="min-height: 385px">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Тест нәтижесі
                </h1>
            </div>
        </div>
    </div>
    <div class="rocket-img">
        <img src="/images/rocket.png" alt="">
    </div>
</section>
<!-- End Banner Area -->


<!--Start Feature Area -->
<section class="feature-area">
    <div class="container">
        <ul class="text-center">
            <li><h2>Сұрақтар саны: <?= $question ?></h2></li>
            <li><h2>Дұрыс жауаптар саны: <?= $correct ?></h2></li>
            <li><h2>Сіздің алған бағаңыз: <span style="color: green;font-size: 1.25em"><?= $score ?>%</span></h2></li>
        </ul>
    </div>
</section>
<!-- End Feature Area -->
