<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TestResult]].
 *
 * @see TestResult
 */
class TestResultQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TestResult[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TestResult|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $id
     * @return TestResultQuery
     */
    public function byUserId($id)
    {
        return $this->andWhere(['user_id' => $id]);
    }

    /**
     * @param $id
     * @return TestResultQuery
     */
    public function byTestId($id)
    {
        return $this->andWhere(['test_id' => $id]);
    }
}
