<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Tests]].
 *
 * @see Tests
 */
class TestsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tests[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tests|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $id
     * @return TestsQuery
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $id
     * @return TestsQuery
     */
    public function byLessonId($id)
    {
        return $this->andWhere(['section_id' => $id]);
    }
}
