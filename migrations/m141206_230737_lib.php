<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m141206_230737_lib
 */
class m141206_230737_lib extends Migration
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

        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull() . ' COMMENT "Название"',
            'description' => $this->text() . ' COMMENT "Описание"',
            'cover' => $this->string() . ' COMMENT "Обложка"',
            'file' => $this->string() . ' COMMENT "Файл книги"',
            'status' => $this->smallInteger()->notNull()->defaultValue(1) . ' COMMENT "Статус"',
            'date_create' => $this->dateTime()->defaultValue(null) . ' COMMENT "Дата создания"',
            'date_update' => $this->dateTime()->defaultValue(null) . ' COMMENT "Дата редактирования"',
        ], $tableOptions . ' COMMENT = "Книги"');


        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull() . ' COMMENT "Название"',
            'status' => $this->smallInteger()->notNull()->defaultValue(1) . ' COMMENT "Статус"',
        ], $tableOptions . ' COMMENT = "Категории"');


        $this->createTable('{{%books_categories}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'category_id' => $this->integer(),
        ], $tableOptions . ' COMMENT = "Связь Книги - Категории"');


        $this->createTable('{{%books_users}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'user_id' => $this->integer(),
        ], $tableOptions . ' COMMENT = "Связь Книги - Авторы"');

        $this->addForeignKey('{{books_categories_book}}', '{{%books_categories}}', 'book_id', '{{%books}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{books_categories_category}}', '{{%books_categories}}', 'category_id', '{{%categories}}', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('{{books_users_book}}', '{{%books_users}}', 'book_id', '{{%books}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{books_users_user}}', '{{%books_users}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%books_categories}}');
        $this->dropTable('{{%categories}}');
        $this->dropTable('{{%books_users}}');
        $this->dropTable('{{%books}}');
    }
}
