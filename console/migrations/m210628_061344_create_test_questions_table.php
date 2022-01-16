<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_questions}}`.
 */
class m210628_061344_create_test_questions_table extends Migration
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

        $this->createTable('{{%test_questions}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull(),
            'test_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-test_id',
            'test_questions',
            'test_id'
        );
        $this->addForeignKey(
            'fk-test_id',
            'test_questions',
            'test_id',
            'tests',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_questions}}');
    }
}
