<?php

namespace frontend\models;

use common\models\Product;
use common\models\ProductCategoryList;
use common\models\ProductColor;
use common\models\ProductColorList;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * @property string $sort
 * @property array $price
 * @property string $color
 */
class ProductSearch extends Product
{
    public $sort;
    public $price;
    public $color;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'price', 'color'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @param ProductDTO $dto
     * @return ActiveDataProvider
     */
    public function search(ProductDTO $dto) {
        $query = Product::find()
            ->where(['status' => Product::STATUS_ACTIVE]);

        $this->load($dto->getParam());
        $productIds = ProductCategoryList::find()
            ->select('product_id')
            ->distinct();
        if ($dto->getCategoryId()){
            $productIds
                ->andWhere(['category_id' => $dto->getCategoryId()]);

            if ($dto->getSubcategoryId()) {
                $productIds->
                    andWhere(['product_sub_category_id' => $dto->getSubcategoryId()] );
            }

            if ($dto->getSecondSubcategoryId()) {
                $productIds->
                    andWhere(['product_second_sub_category_id' => $dto->getSecondSubcategoryId()] );
            }

            if ($dto->getThirdSubcategoryId()) {
                $productIds->
                    andWhere(['product_third_sub_category_id' => $dto->getThirdSubcategoryId()] );
            }

            if ($dto->getFourthSubcategoryId()) {
                $productIds->
                    andWhere(['product_fourth_sub_category_id' => $dto->getFourthSubcategoryId()] );
            }
        }

        $productIds = $productIds->column();

        if ($this->color) {
            $colorId = ProductColor::getIdByName($this->color);
            if ($colorId) {
                $productColorList = ProductColorList::find()
                    ->select('product_id')
                    ->distinct()
                    ->where(['color_id' => $colorId])
                    ->column();

                $merged  = array_merge($productIds, $productColorList);

                $countParams = 2;
                $countDuplicatesIds = array_count_values($merged);

                $sortProductsByParam = [];
                foreach ($countDuplicatesIds as $value => $count) {
                    if ($count === $countParams) {
                        $sortProductsByParam[] = $value;
                    }
                }
                $productIds = [];
                if (count($sortProductsByParam) > 0) {
                    foreach ($sortProductsByParam as $item) {
                        $productIds[] = $item;
                    }
                }
            } else {
                $productIds = [];
            }
        }
        $query->andWhere(['in', 'id', $productIds]);

        if ($dto->getCategoryNews()) {
            $query
                ->andWhere(['is_new' => true])
                ->andWhere(['old_price' => null]);
        } elseif ($dto->getCategorySales()) {
            $query->andWhere(['not', ['old_price' => null]]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if ($this->price) {
            $query
                ->andWhere(['>', 'price', $this->price[0]]);
            if (count($this->price) == 2) {
                $query
                    ->andWhere(['<', 'price', $this->price[1]]);
            }
        }

        if ($this->sort) {
            if ($this->sort === self::POPULAR) {
                $query->orderBy([
                    'views' => SORT_DESC,
                    'created_at' => SORT_DESC
                ]);
            }
            if ($this->sort === self::NOVELTY) {
                $query->orderBy(['created_at' => SORT_DESC]);
            }
            if ($this->sort === self::DESCPRICE) {
                $query->orderBy([
                    'price' => SORT_DESC,
                    'created_at' => SORT_DESC
                ]);
            }
            if ($this->sort === self::ASCPRICE) {
                $query->orderBy([
                    'price' => SORT_ASC,
                    'created_at' => SORT_DESC
                ]);
            }
        } else {
            $query->orderBy(['created_at' => SORT_DESC]);
        }

        if ($dto->getNotProductId()) {
            $query
                ->andWhere(['<>', 'id', $dto->getNotProductId()])
                ->limit(8);
        }

        if ($dto->getCompany()) {
            $query
                ->andWhere(['company_id' => $dto->getCompany()]);
        }

        return $dataProvider;
    }
}
