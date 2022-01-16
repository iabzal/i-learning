<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TestQuestions]].
 *
 * @see TestQuestions
 */
class TestQuestionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TestQuestions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TestQuestions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $id
     * @return TestQuestionsQuery
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $id
     * @return TestQuestionsQuery
     */
    public function byTestId($id)
    {
        return $this->andWhere(['test_id' => $id]);
    }
}
