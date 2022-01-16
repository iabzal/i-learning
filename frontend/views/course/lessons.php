<?php

/* @var $this yii\web\View */
/* @var $lessons \common\models\Section[] */
/* @var $title string */
/* @var $courses \common\models\Course[] */
/* @var $info \common\models\Info */

$this->title = $title;
?>


<!-- Start Banner Area -->
<section class="banner-area relative">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?= $title ?>
                </h1>
                <div class="link-nav">
						<span class="box">
							<a href="/">Басты бет </a>
							<i class="lnr lnr-arrow-right"></i>
							<a href="/course">Пәндер</a>
							<i class="lnr lnr-arrow-right"></i>
							<a href=""><?= $title ?></a>
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


<section class="top-category-widget-area pt-90 pb-90 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center" style="padding-bottom: 30px">
                    <h1>Сабақтар</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if (count($lessons) > 0) {
                foreach ($lessons as $lesson) {
            ?>
                <a href="/course/show-lesson?id=<?= $lesson->id ?>" class="col-lg-3 mb-4">
                    <div class="single-cat-widget">
                        <div class="content relative">
                            <div class="overlay overlay-bg"></div>
                            <div class="thumb" style="width: 100%; height: 10rem; background: #CCCCCC"></div>
                            <div class="content-details">
                                <h6 class="content-title mx-auto text-uppercase"><?= $lesson->name ?></h6>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Start Courses Area -->
<?php if ($info) { ?>
    <section class="courses-area section-gap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 about-right">
                    <h1><?= $info->title ?></h1>
                    <div class="wow fadeIn" data-wow-duration="1s">
                        <p><?= $info->short_desc ?></p>
                    </div>
                </div>
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
<?php } ?>
<!-- End Courses Area -->
