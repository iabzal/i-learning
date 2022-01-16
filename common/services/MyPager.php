<?php

namespace common\services;

use Yii;
use yii\helpers\Html;
use yii\widgets\LinkPager;

class MyPager extends LinkPager
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Change the location and size of block
        // https://v4-alpha.getbootstrap.com/components/pagination/#alignment
        // https://v4-alpha.getbootstrap.com/components/pagination/#sizing
        $this->options['class'] = 'pagination justify-content-center mt-3';


        // Default div for links
        $this->linkOptions['class'] = 'flex-c-m how-pagination1 trans-04 m-all-7';
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }

        if ($this->pagination->getPageCount() > 1) {
            echo Html::tag('nav', $this->renderPageButtons());
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => empty($class) ? 'page-item' : $class];
        $linkOptions = $this->linkOptions;

        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }

        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            $linkOptions['tabindex'] = '-1';
        }

        return Html::tag('li', Html::a($label, $this->pagination->createUrl($page), $linkOptions), $options);
    }
}