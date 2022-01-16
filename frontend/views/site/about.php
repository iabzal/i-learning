<?php

/* @var $this yii\web\View */
/* @var $info \common\models\Info */
/* @var $teachers \common\models\Teacher[] */
/* @var $reviews \common\models\Review[] */

$this->title = 'Біз туралы';
?>

<!-- Start Banner Area -->
<section class="banner-area relative">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Біз туралы
                </h1>
                <div class="link-nav">
						<span class="box">
							<a href="/">Басты бет</a>
							<i class="lnr lnr-arrow-right"></i>
							<a href="/about">Біз туралы</a>
						</span>
                </div>
            </div>
        </div>
    </div>
    <div class="rocket-img">
        <img src="/images/rocket.png" alt="">
    </div>
</section>
<!-- End Banner Area -->


<!-- Start About Area -->
<?php if ($info) { ?>
    <section class="about-area section-gap">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5 col-md-6 about-left">
                    <img class="img-fluid" src="/images/about.jpg" alt="">
                </div>
                <div class="offset-lg-1 col-lg-6 offset-md-0 col-md-12 about-right">
                    <h1><?= $info->title ?></h1>
                    <div class="wow fadeIn" data-wow-duration="1s">
                        <p><?= $info->short_desc ?></p>
                    </div>
                    <a href="/course" class="primary-btn">Пәндерге өту</a>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!-- End About Area -->


<!-- Start Faculty Area -->
<section class="faculty-area section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h1>Мұғалімдер</h1>
                </div>
            </div>
        </div>
        <?php if (count($teachers) > 0) { ?>
            <div class="row justify-content-start d-flex align-items-center">
                <?php foreach ($teachers as $teacher) { ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-faculty">
                        <div class="thumb d-flex justify-content-center">
                            <img class="img-fluid" src="/uploads/teacher/<?=$teacher->image?>" alt="">
                        </div>
                        <div class="meta-text text-center">
                            <h4><?= $teacher->name ?></h4>
                            <div class="info wow fadeIn mt-2" data-wow-duration="1s" data-wow-delay=".1s">
                                <p><?= $teacher->position ?></p>
                            </div>
                            <div class="align-items-center justify-content-center d-flex">
                                <?= $teacher->email ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
<!-- End Faculty Area -->

<!-- Start Testimonials Area -->
<?php if (count($reviews) > 1) { ?>
<section class="testimonials-area section-gap">
    <div class="container">
        <div class="testi-slider owl-carousel" data-slider-id="1">
            <?php foreach ($reviews as $review) { ?>
                <div class="item">
                    <div class="testi-item">
                        <img src="/images/quote.png" alt="">
                        <h4><?= $review->name ?></h4>
                        <ul class="list">
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                        </ul>
                        <div class="wow fadeIn" data-wow-duration="1s">
                            <p><?= $review->text ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
            <?php foreach ($reviews as $review) { ?>
                <div class="owl-thumb-item">
                    <div>
                        <img class="img-fluid" src="/uploads/review/<?= $review->image ?>" alt="" style="width: 4em">
                    </div>
                    <div class="overlay overlay-grad"></div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
<!-- End Testimonials Area -->
