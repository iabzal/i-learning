<?php

/* @var $this yii\web\View */
/* @var $lesson Section */
/* @var $title string */
/* @var $tests TestQuestions[] */
/* @var $form yii\widgets\ActiveForm */

use common\models\Section;
use common\models\TestQuestions;
use yii\widgets\ActiveForm;

$this->title = $lesson->name;
?>

<!-- Start Banner Area -->
<section class="banner-area relative">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?= $lesson->name ?>
                </h1>
                <div class="link-nav">
						<span class="box">
							<a href="/">Басты бет </a>
							<i class="lnr lnr-arrow-right"></i>
							<a href="/course">Пәндер</a>
							<i class="lnr lnr-arrow-right"></i>
							<a href=""><?= $lesson->name ?></a>
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


<section class="pt-90 pb-90">
    <div class="container">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active w-50" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab"
                       aria-controls="tab-1" aria-selected="false">
                        <span class="text-center">
                            <i class="ti-control-play" style="font-size: 25px"></i> <br>
                            Видео
                        </span>
                    </a>
                    <a class="nav-link w-50" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab"
                       aria-controls="tab-2" aria-selected="false">
                        <span class="text-center">
                            <i class="ti-help-alt" style="font-size: 25px"></i> <br>
                            Квиз
                        </span>
                    </a>
                    <a class="nav-link w-50" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab"
                       aria-controls="tab-3" aria-selected="false">
                        <span class="text-center">
                            <i class="ti-files" style="font-size: 25px"></i> <br>
                            Оқу-әдістеме
                        </span>
                    </a>
                    <a class="nav-link w-50" id="tab-4-tab" data-toggle="pill" href="#tab-4" role="tab"
                       aria-controls="tab-4" aria-selected="false">
                        <span class="text-center">
                            <i class="ti-book" style="font-size: 25px"></i> <br>
                            Cөздік
                        </span>
                    </a>
                    <!--<a class="nav-link w-50 text-center" id="tab-5-tab" data-toggle="pill" href="#tab-5" role="tab"
                       aria-controls="tab-5" aria-selected="true">
                        <span class="text-center">
                            <i class="ti-list" style="font-size: 25px"></i> <br>
                            Жұмыс парағы
                        </span>
                    </a>-->
                    <a class="nav-link w-50 text-center" id="tab-6-tab" data-toggle="pill" href="#tab-6" role="tab"
                       aria-controls="tab-6" aria-selected="true">
                        <span class="text-center">
                            <i class="ti-harddrives" style="font-size: 25px"></i> <br>
                            Практикалық жұмыс
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                         aria-labelledby="tab-1-tab">
                        <video width="100%" controls>
                            <source src="<?= $lesson->videoUrl ?>" type="video/<?= $lesson->file_ext ?>">
                            Your browser does not support HTML5 video.
                        </video>
                    </div>
                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                        <?php if (count($lesson->testList) > 0) { ?>
                            <h5 class="mb-2">Тестті өту уақыты: <?= $lesson->testList[0]->duration ?> минут</h5>
                            <h5 class="mb-2">Тестті өту баллы: <?= $lesson->testList[0]->min_score ?>% </h5>
                            <div class="d-flex justify-content-center row">
                                <div class="col-12">
                                    <?php if (count($tests) > 0) { ?>
                                        <div class="border">
                                            <div class="question bg-white p-3 border-bottom">
                                                <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                                    <h4>Квиз сұрақтары</h4><span>(1 / <?= count($tests) ?>)</span>
                                                </div>
                                            </div>
                                            <?php $form = ActiveForm::begin(['action' =>['test/result']]); ?>
                                                <?php foreach ($tests as $test) { ?>
                                                    <input type="hidden" name="test_id" value="<?=$test->test_id?>">
                                                    <div class="question bg-white p-3 border-bottom">
                                                        <div class="d-flex flex-row align-items-center question-title mb-3">
                                                            <h3 class="text-danger">С.</h3>
                                                            <h5 class="mt-1 ml-2"><?= $test->text ?>?</h5>
                                                        </div>
                                                        <?php if (count($test->answers) > 0) ?>
                                                            <?php foreach ($test->answers as $answer) { ?>
                                                                <div class="ans ml-2">
                                                                    <label class="radio">
                                                                        <input type="radio" name="result[<?=$test->id?>]" value="<?= $answer->id ?>">
                                                                        <span><?= $answer->text ?></span>
                                                                    </label>
                                                                </div>
                                                            <?php }  ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                                                    <button class="btn btn-primary border-success align-items-center btn-success"
                                                            type="submit">Аяқтау
                                                    </button>
                                                </div>
                                            <?php ActiveForm::end(); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } else {?>
                            <i>Әзірше квиз жүктелмеген... </i>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                        <?php if (count($lesson->fileList) > 0) { ?>
                        <ul class="list-group">
                            <?php foreach ($lesson->fileList as $file) { ?>
                                <li class="list-group-item">
                                    <a href="<?= $file->fileUrl ?>" download="<?= $file->name . '.' . $file->file_ext ?>" class="d-flex justify-content-between align-items-center">
                                        <?= $file->name ?>
                                        <!--<span class="badge badge-primary badge-pill">14</span>-->
                                        <i class="fa fa-download"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php } else {?>
                            <i>Әзірше оқу-әдістеме жүктелмеген... </i>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
                        <?php if (count($lesson->dictionaryList) > 0) { ?>
                            <ul class="list-group">
                                <?php foreach ($lesson->dictionaryList as $dictionary) { ?>
                                    <li class="list-group-item">
                                        <a href="<?= $dictionary->fileUrl ?>" download="<?= $dictionary->name . '.' . $dictionary->file_ext ?>" class="d-flex justify-content-between align-items-center">
                                            <?= $dictionary->name ?>
                                            <!--<span class="badge badge-primary badge-pill">14</span>-->
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else {?>
                            <i>Әзірше сөздік жүктелмеген... </i>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="tab-5" role="tabpanel" aria-labelledby="tab-5-tab">

                    </div>
                    <div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="tab-5-tab">
                        <?php if (count($lesson->pWorkList) > 0) { ?>
                            <ul class="list-group">
                                <?php foreach ($lesson->pWorkList as $practicalWork) { ?>
                                    <li class="list-group-item">
                                        <a href="<?= $practicalWork->fileUrl ?>" download="<?= $practicalWork->name . '.' . $practicalWork->file_ext ?>" class="d-flex justify-content-between align-items-center">
                                            <?= $practicalWork->name ?>
                                            <!--<span class="badge badge-primary badge-pill">14</span>-->
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else {?>
                            <i>Әзірше практикалық жұмыс жүктелмеген... </i>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
