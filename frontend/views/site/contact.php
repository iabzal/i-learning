<?php

/* @var $this yii\web\View */

$this->title = 'Байланыс';
?>
<!-- Start Banner Area -->
<section class="banner-area relative">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Кері байланыс
                </h1>
                <div class="link-nav">
						<span class="box">
							<a href="/">Басты бет </a>
							<i class="lnr lnr-arrow-right"></i>
							<a href="/contact">Байланыс</a>
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

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap pt-50" style="padding-top: 100px">
    <div class="container">
        <div class="row">
            <!--<div class="map-wrap" style="width:100%; height: 445px;" id="map"></div>-->
            <div class="col-lg-4 d-flex flex-column address-wrap">
                <div class="single-contact-address d-flex flex-row">
                    <div class="icon">
                        <span class="lnr lnr-home"></span>
                    </div>
                    <div class="contact-details">
                        <h5>Алматы</h5>
                        <p>
                            әл-Фараби даңғылы, 71
                        </p>
                    </div>
                </div>
                <div class="single-contact-address d-flex flex-row">
                    <div class="icon">
                        <span class="lnr lnr-phone-handset"></span>
                    </div>
                    <div class="contact-details">
                        <h5>Байланыс-орталығы</h5>
                        <p>+7 (777) 777-77-77</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <form class="form-area contact-form text-right" id="myForm" action="mail.php" method="post">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <input name="name" placeholder="Аты-жөні" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Аты-жөні'"
                                   class="common-input mb-20 form-control" required="" type="text">

                            <input name="email" placeholder="Email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'Email'" class="common-input mb-20 form-control" required="" type="email">

                            <input name="subject" placeholder="Курс" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Курс'"
                                   class="common-input mb-20 form-control" required="" type="text">
                        </div>
                        <div class="col-lg-6 form-group">
								<textarea class="common-textarea form-control" name="message" placeholder="Мәтін" onfocus="this.placeholder = ''"
                                          onblur="this.placeholder = 'Мәтін'" required=""></textarea>
                        </div>
                        <div class="col-lg-12">
                            <div class="alert-msg" style="text-align: left;"></div>
                            <button class="primary-btn" style="float: right;">Жіберу</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End contact-page Area -->
