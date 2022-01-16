<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%info}}`.
 */
class m201540_124420_create_info_table extends Migration
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

        $this->createTable('{{%info}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'short_desc' => $this->string(512)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%info}}');
    }
}
