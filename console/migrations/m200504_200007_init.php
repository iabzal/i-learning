<?php

use yii\db\Migration;

/**
 * Class m200504_200007_init
 */
class m200504_200007_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'avatar' => $this->text()->null(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'city' => $this->string()->null(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(9),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
