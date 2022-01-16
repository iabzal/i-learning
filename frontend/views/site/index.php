<?php

/* @var $this yii\web\View */
/* @var $info \common\models\Info */

$this->title = 'Главная';
?>


<!-- Start Banner Area -->
<section class="home-banner-area relative">
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-center">
            <div class="banner-content col-lg-8 col-md-12">
                <h1 class="wow fadeIn" data-wow-duration="4s">Барлық бағыттағы Пәндер</h1>

                <div class="input-wrap">
                    <form action="" class="form-box d-flex justify-content-between">
                        <input type="text" placeholder="Пән іздеу" class="form-control" name="username">
                        <button type="submit" class="btn search-btn">Іздеу</button>
                    </form>
                </div>
                <h4 class="text-white">Үздік Пәндер</h4>

                <div class="courses pt-20">
                    <a href="#" data-wow-duration="1s" data-wow-delay=".3s"
                       class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Информатика</a>
                    <a href="#" data-wow-duration="1s" data-wow-delay=".6s"
                       class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Математика</a>
                    <a href="#" data-wow-duration="1s" data-wow-delay=".9s"
                       class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Физика</a>
                    <a href="#" data-wow-duration="1s" data-wow-delay="1.2s"
                       class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Химия</a>
                    <a href="#" data-wow-duration="1s" data-wow-delay="1.5s"
                       class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Биология</a>
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
    <section class="courses-area section-gap">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5 col-md-6 about-left">
                    <img class="img-fluid" src="/images/about.jpg" alt="">
                </div>
                <div class="offset-lg-1 col-lg-6 offset-md-0 col-md-12 about-right">
                    <h1>
                        <?= $info->title ?>
                    </h1>
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

<!--Start Feature Area -->
<section class="feature-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h1>Біздің ерекшелігіміз</h1>
                </div>
            </div>
        </div>
        <div class="feature-inner row">
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <i class="ti-crown"></i>
                    <h4>Сәулет</h4>
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
                        <p>
                            Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt
                            labore.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <i class="ti-briefcase"></i>
                    <h4>Интерьер Дизайны</h4>
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                        <p>
                            Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt
                            labore.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <i class="ti-medall-alt"></i>
                    <h4>Концептуалды Дизайн</h4>
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
                        <p>
                            Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt
                            labore.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <i class="ti-key"></i>
                    <h4>Қолжетімділік</h4>
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
                        <p>
                            Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt
                            labore.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <i class="ti-files"></i>
                    <h4>Бастапқы Файл Қосулы</h4>
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                        <p>
                            Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt
                            labore.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <i class="ti-headphone-alt"></i>
                    <h4>Тікелей Қолдау</h4>
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
                        <p>
                            Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt
                            labore.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Feature Area -->


