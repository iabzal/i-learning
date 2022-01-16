<?php
/**
 * Created by PhpStorm.
 * User: Maks
 * Date: 30.08.2020
 * Time: 13:26
 */

namespace frontend\models;

use yii\base\Model;

/**
 * This is the model class for table "declaration".
 *
 * @property string $text
 * @property string $query
 */
class Search extends Model
{
    public $text;
    public $query;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'query'], 'string', 'max' => 255],
        ];
    }
}