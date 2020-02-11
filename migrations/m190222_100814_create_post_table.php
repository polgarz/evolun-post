<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m190222_100814_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string(255),
            'lead'       => $this->text(),
            'content'    => $this->text(),
            'role'       => $this->string(64),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci');

        $this->addForeignKey('fk_post_created_by', 'post', 'created_by', 'user', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_post_updated_by', 'post', 'updated_by', 'user', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_post_role', 'post', 'role', 'auth_item', 'name', 'SET NULL', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
