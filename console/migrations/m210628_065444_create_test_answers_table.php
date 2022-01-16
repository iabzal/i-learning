<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_answers}}`.
 */
class m210628_065444_create_test_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%test_answers}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'text' => $this->string()->notNull(),
            'is_correct' => $this->smallInteger(1)->defaultValue(0)
        ], $tableOptions);

        $this->createIndex(
            'idx-question_id',
            'test_answers',
            'question_id'
        );
        $this->addForeignKey(
            'fk-question_id',
            'test_answers',
            'question_id',
            'test_questions',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_answers}}');
    }
}
