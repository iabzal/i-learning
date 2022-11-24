<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Section]].
 *
 * @see Section
 */
class SectionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Section[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Section|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byCourseId($courseId)
    {
        return $this->andWhere(['course_id' => $courseId]);
    }

    public function byId(int $id)
    {
        return $this->andWhere(['id' => $id]);
    }

    public function byQuarter(int $quarter)
    {
        return $this->andWhere(['quarter' => $quarter]);
    }
}
