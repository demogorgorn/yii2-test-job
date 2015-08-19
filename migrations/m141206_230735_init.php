<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m141206_230735_init
 */
class m141206_230735_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Проекты
        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull() . ' COMMENT "Название"',
            'description' => $this->text() . ' COMMENT "Описание"',
            'status' => $this->smallInteger()->notNull()->defaultValue(1) . ' COMMENT "Статус"',
            'time_create' => $this->integer() . ' COMMENT "Дата создания"',
            'time_update' => $this->integer() . ' COMMENT "Дата редактирования"',
        ], $tableOptions . ' COMMENT = "Проекты"');

        // Index
        $this->createIndex('{{%projects_status}}', '{{%projects}}', 'status');
        $this->createIndex('{{%projects_time_create}}', '{{%projects}}', 'time_create');


        // Пользователи
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull() . ' COMMENT "Название"',
            'auth_key' => $this->string()->notNull() . ' COMMENT "Секретный ключ авторизации"',
            'secure_key' => $this->string()->notNull() . ' COMMENT "Секретный ключ"',
        ], $tableOptions . ' COMMENT = "Пользователи"');

        // Index
        $this->createIndex('{{%users_name}}', '{{%users}}', 'name', true);


        // Должности
        $this->createTable('{{%positions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull() . ' COMMENT "Название"',
        ], $tableOptions . ' COMMENT = "Должности"');

        // Index
        $this->createIndex('{{%positions_name}}', '{{%positions}}', 'name', true);


        // Отношения
        $this->createTable('{{%projects_positions}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull(),
        ], $tableOptions . ' COMMENT = "Отношение Проекты-Должности"');

        $this->addForeignKey('{{projects_positions_project_id}}', '{{%projects_positions}}', 'project_id', '{{%projects}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{projects_positions_user_id}}', '{{%projects_positions}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{projects_positions_position_id}}', '{{%projects_positions}}', 'position_id', '{{%positions}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%projects_positions}}');
        $this->dropTable('{{%positions}}');
        $this->dropTable('{{%projects}}');
        $this->dropTable('{{%users}}');
    }
}
