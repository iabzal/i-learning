<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tests}}`.
 */
class m210628_061212_create_tests_table extends Migration
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

        $this->createTable('{{%tests}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'course_id' => $this->integer()->notNull(),
            'section_id' => $this->integer()->notNull(),
            'duration' => $this->integer(),
            'min_score' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);

        $this->createIndex(
            'idx-test-course_id',
            'tests',
            'course_id'
        );
        $this->addForeignKey(
            'fk-test-course_id',
            'tests',
            'course_id',
            'course',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-section_id',
            'tests',
            'section_id'
        );
        $this->addForeignKey(
            'fk-section_id',
            'tests',
            'section_id',
            'section',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tests}}');
    }
}
