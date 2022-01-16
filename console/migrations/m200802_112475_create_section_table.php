<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section}}`.
 */
class m200802_112475_create_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%section}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'course_id' => $this->integer()->notNull(),
            'quarter' => $this->integer()->notNull(),
            'file_name' => $this->string(),
            'file_mime_type' => $this->string(),
            'file_ext' => $this->string(),
            'file_size' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-course_id',
            'section',
            'course_id'
        );
        $this->addForeignKey(
            'fk-course_id',
            'section',
            'course_id',
            'course',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%section}}');
    }
}
