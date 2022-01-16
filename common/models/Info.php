<?php

namespace common\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "info".
 *
 * @property int $id
 * @property string $title
 * @property string $short_desc
 * @property int $type
 * @property int $created_at
 * @property int $updated_at
 */
class Info extends \yii\db\ActiveRecord
{
    const BASTY_BET = 1;
    const BIZ_TURALY = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'info';
    }

    public static function getStatusList()
    {
        return [
            self::BASTY_BET => 'Басты бет',
            self::BIZ_TURALY => 'Біз туралы',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_desc', 'type', 'created_at', 'updated_at'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['short_desc'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Тақырып',
            'short_desc' => 'Мәтін',
            'type' => 'Түрі',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->title = StringHelper::mb_ucfirst($this->title, 'UTF-8');
        $this->short_desc = StringHelper::mb_ucfirst($this->short_desc, 'UTF-8');
        $this->updated_at = time();
        return true;
    }
}
