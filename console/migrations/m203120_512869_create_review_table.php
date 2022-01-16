<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 */
class m203120_512869_create_review_table extends Migration
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

        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'image' => $this->text()->notNull(),
            'name' => $this->string(255)->notNull(),
            'text' => $this->string(512)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%review}}');
    }
}
