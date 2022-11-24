<?php

/* @var $this yii\web\View */
/* @var $courses \common\models\Course[] */
/* @var $info \common\models\Info */
/* @var $reviews \common\models\Review[] */

$this->title = 'Пәндер';
?>


<!-- Start Banner Area -->
<section class="banner-area relative">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Пәндер
                </h1>
                <p>Барлық бағыттағы онлайн Пәндер</p>
                <div class="link-nav">
						<span class="box">
							<a href="/">Басты бет </a>
							<i class="lnr lnr-arrow-right"></i>
							<a href="/course">Пәндер</a>
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


<!--Start Feature Area -->
<section class="feature-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h1>Пән түрлері</h1>
                </div>
            </div>
        </div>
        <?php if (count($courses) > 0) { ?>
            <div class="feature-inner row">
                <?php foreach ($courses as $course) { ?>
                    <a href="/course/quarter?course_id=<?= $course->id ?>" class="col-lg-4 col-md-6">
                        <div class="feature-item">
                            <i class="fa fa-book"></i>
                            <h4><?= $course->name ?></h4>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
<!-- End Feature Area -->


<!-- Start Courses Area -->
<section class="courses-area section-gap">
    <div class="container">
        <div class="row align-items-center">
            <?php if ($info) { ?>
                <div class="col-lg-5 about-right">
                    <h1><?= $info->title ?></h1>
                    <div class="wow fadeIn" data-wow-duration="1s">
                        <p><?= $info->short_desc ?></p>
                    </div>
                </div>
            <?php } ?>
            <div class="offset-lg-1 col-lg-6">
                <?php if (count($courses) > 0) { ?>
                    <div class="courses-right">
                        <div class="row">
                            <?php foreach ($courses as $key=>$course) { ?>
                                <?php if ($key%2 == 0) { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <ul class="courses-list">
                                            <li>
                                                <a class="wow fadeInLeft" href="/course/lessons?course_id=<?= $course->id ?>"
                                                   data-wow-duration="1s" data-wow-delay=".1s">
                                                    <i class="fa fa-book"></i> <?= $course->name ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <ul class="courses-list">
                                            <li>
                                                <a class="wow fadeInRight" href="/course/lessons?course_id=<?= $course->id ?>"
                                                   data-wow-duration="1s" data-wow-delay="1.3s">
                                                    <i class="fa fa-book"></i> <?= $course->name ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- End Courses Area -->


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
