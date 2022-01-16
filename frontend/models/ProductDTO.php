<?php

namespace frontend\models;

use common\models\Product;
use common\models\ProductCategoryList;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * @property string $sort
 * @property string $price
 */
class ProductDTO
{
    public $param;

    public $categoryNews;

    public $categorySales;

    public $categoryId;

    public $subcategoryId;

    public $secondSubcategoryId;

    public $thirdSubcategoryId;

    public $fourthSubcategoryId;

    public $notProductId;

    public $company;

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @param mixed $param
     */
    public function setParam($param): void
    {
        $this->param = $param;
    }

    /**
     * @return mixed
     */
    public function getCategoryNews()
    {
        return $this->categoryNews;
    }

    /**
     * @param mixed $categoryNews
     */
    public function setCategoryNews($categoryNews): void
    {
        $this->categoryNews = $categoryNews;
    }

    /**
     * @return mixed
     */
    public function getCategorySales()
    {
        return $this->categorySales;
    }

    /**
     * @param mixed $categorySales
     */
    public function setCategorySales($categorySales): void
    {
        $this->categorySales = $categorySales;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getSubcategoryId()
    {
        return $this->subcategoryId;
    }

    /**
     * @param mixed $subcategoryId
     */
    public function setSubcategoryId($subcategoryId): void
    {
        $this->subcategoryId = $subcategoryId;
    }

    /**
     * @return mixed
     */
    public function getSecondSubcategoryId()
    {
        return $this->secondSubcategoryId;
    }

    /**
     * @param mixed $secondSubcategoryId
     */
    public function setSecondSubcategoryId($secondSubcategoryId): void
    {
        $this->secondSubcategoryId = $secondSubcategoryId;
    }

    /**
     * @return mixed
     */
    public function getThirdSubcategoryId()
    {
        return $this->thirdSubcategoryId;
    }

    /**
     * @param mixed $thirdSubcategoryId
     */
    public function setThirdSubcategoryId($thirdSubcategoryId): void
    {
        $this->thirdSubcategoryId = $thirdSubcategoryId;
    }

    /**
     * @return mixed
     */
    public function getFourthSubcategoryId()
    {
        return $this->fourthSubcategoryId;
    }

    /**
     * @param mixed $fourthSubcategoryId
     */
    public function setFourthSubcategoryId($fourthSubcategoryId): void
    {
        $this->fourthSubcategoryId = $fourthSubcategoryId;
    }

    /**
     * @return mixed
     */
    public function getNotProductId()
    {
        return $this->notProductId;
    }

    /**
     * @param mixed $notProductId
     */
    public function setNotProductId($notProductId): void
    {
        $this->notProductId = $notProductId;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }
}
