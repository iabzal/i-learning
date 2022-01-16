<?php
/**
 * Created by PhpStorm.
 * User: Adlet
 * Date: 05.03.2019
 * Time: 17:12
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this \yii\web\View */
/* @var $question \common\models\TestQuestions */
/* @var $form ActiveForm */
/* @var $seconds int */
/* @var $lessonId int */
/* @var $qNum int */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lectures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<style>
    .test-questions-form ol.test > li {
        font-weight: bold;
    }

    .test-questions-form label.answer {
        font-weight: 100;
    }
</style>
<!-- Start Banner Area -->
<section class="banner-area relative">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Тест
                </h1>
            </div>
        </div>
    </div>
    <div class="rocket-img">
        <img src="/images/rocket.png" alt="">
    </div>
</section>
<!-- End Banner Area -->

<section class="pt-90 pb-90">
    <div class="container">

        <div>Тест закончится через <span id="time"></span> минут!</div>
        <script>
            window.onload = function () {

                var seconds = <?= $seconds - time() ?>;

                var display1 = document.querySelector('#time'),
                    timer = new CountDownTimer(seconds);

                timer.onTick(format1).start();

                function format1(minutes, seconds) {
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
                    display1.textContent = minutes + ':' + seconds;
                }
            };

            function CountDownTimer(duration, granularity) {
                this.duration = duration;
                this.granularity = granularity || 1000;
                this.tickFtns = [];
                this.running = false;
            }

            CountDownTimer.prototype.start = function () {
                if (this.running) {
                    return;
                }
                this.running = true;
                var start = Date.now(),
                    that = this,
                    diff, obj;

                (function timer() {
                    diff = that.duration - (((Date.now() - start) / 1000) | 0);

                    if (diff > 0) {
                        setTimeout(timer, that.granularity);
                    } else {
                        diff = 0;
                        that.running = false;
                        $('#timeout, .modal_overlay2').fadeIn();
                        $('#timeout .modal_content').css({opacity: 1}).addClass('animated zoomIn').fadeIn();
                        $('body').addClass('modal_open');
                    }

                    obj = CountDownTimer.parse(diff);
                    that.tickFtns.forEach(function (ftn) {
                        ftn.call(this, obj.minutes, obj.seconds);
                    }, that);
                }());
            };

            CountDownTimer.prototype.onTick = function (ftn) {
                if (typeof ftn === 'function') {
                    this.tickFtns.push(ftn);
                }
                return this;
            };

            CountDownTimer.prototype.expired = function () {
                return !this.running;
            };

            CountDownTimer.parse = function (seconds) {
                return {
                    'minutes': (seconds / 60) | 0,
                    'seconds': (seconds % 60) | 0
                };
            };
        </script>

        <div class="test-questions-form">
            <?php $form = ActiveForm::begin(['action' => ['/test/save-answer', 'id' => $lessonId]]); ?>
            <hr class="wht_ln">
            <?= Html::hiddenInput('test_id', $question->test_id) ?>
            <?= Html::hiddenInput('question_id', $question->id) ?>
            <?= Html::hiddenInput('iid', 1303) ?>
            <ol class="test" start="<?= $qNum ?>">
                <li>
                    <div class="testh flex">
                        <span> <?= $question->text ?> </span>
                    </div>
                    <div class="vopros flex_wrap">
                        <?php foreach ($question->answers as $answer) {
                            echo '
                                 <label class="answer otvet">
                                    <span class="otvt"> ' . $answer->text . ' </span>
                                    <input type="radio" name="answer_id" value="' . $answer->id . '">
                                    <span class="checkmark transformy"></span>
                                </label>
                            ';
                        } ?>
                    </div>
                </li>
            </ol>
            <?= Html::submitButton(Yii::t('app', 'Далее'),
                ['class' => 'anim_btn pol_dos btm']) ?>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</section>


<!--  Modal   -->

<div class="modal" id="timeout" data-id="timeout_modal">
    <div class="modal_content">
        <div class="modal_in">
            <div class="mmod">
                Тест окончен
            </div>
            <div class="test-questions-form">
                <?php $form = ActiveForm::begin(['action' => ['/test/save-answer', 'id' => $lessonId]]); ?>
                <hr class="wht_ln">
                <?= Html::hiddenInput('test_id', $question->test_id) ?>
                <?= Html::hiddenInput('question_id', $question->id) ?>
                <?= Html::hiddenInput('iid', 1303) ?>
                <div style="padding: 1.5em;color: #000000">
                    Ваше время истекло
                </div>
                <div class="btns flex" style="justify-content: center">
                    <?= Html::submitButton(Yii::t('app', 'Посмотреть результат'),
                        ['class' => 'close_modal z_modal anim_btn1']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
    <div class="modal_overlay2"></div>
</div>
<!--  /Modal  -->

