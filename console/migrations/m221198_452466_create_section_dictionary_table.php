<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section}}`.
 */
class m221198_452466_create_section_dictionary_table extends Migration
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

        $this->createTable('{{%section_dictionary}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'course_id' => $this->integer()->notNull(),
            'section_id' => $this->integer()->notNull(),
            'file_name' => $this->string(),
            'file_mime_type' => $this->string(),
            'file_ext' => $this->string(),
            'file_size' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-section_dictionary-course_id',
            'section_dictionary',
            'course_id'
        );
        $this->addForeignKey(
            'fk-section_dictionary-course_id',
            'section_dictionary',
            'course_id',
            'course',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-section_dictionary-section_id',
            'section_dictionary',
            'section_id'
        );
        $this->addForeignKey(
            'fk-section_dictionary-section_id',
            'section_dictionary',
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
        $this->dropTable('{{%section_dictionary}}');
    }
}
