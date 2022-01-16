<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_result}}`.
 */
class m210629_113527_create_test_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_result}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer(),
            'user_id' => $this->integer(),
            'score' => $this->integer(),
            'status' => $this->integer(),
            'begin_date' => $this->dateTime(),
            'end_date' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_result}}');
    }
}
