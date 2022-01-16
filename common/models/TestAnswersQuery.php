<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TestAnswers]].
 *
 * @see TestAnswers
 */
class TestAnswersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TestAnswers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TestAnswers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $id
     * @return TestAnswersQuery
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $id
     * @return TestAnswersQuery
     */
    public function byQuestionId($id)
    {
        return $this->andWhere(['question_id' => $id]);
    }

    /**
     * @return TestAnswersQuery
     */
    public function correct()
    {
        return $this->andWhere(['is_correct' => 1]);
    }
}
