<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin}}`.
 */
class m200504_200319_create_admin_table extends Migration
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

        $this->createTable('{{%admin}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(),
            'email' => $this->string()->notNull()->unique(),
            'role' => $this->string()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(10),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('admin',[
            'full_name'=>'Супер Админ',
            'email' =>'admin@admin.com',
            'role' => \backend\models\Admin::ROLE_ADMIN,
            'status' => 10,
            'auth_key' => 'nZs6Nl6hgxXiqP5oxIIIOdk5VqlpyesP',
            'password_hash' => '$2y$13$pBmIlxsNwaylx96yWt5W9ealu.GeAbJeXP/yDzYuUVEusJ2MAFcrC',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin}}');
    }
}
