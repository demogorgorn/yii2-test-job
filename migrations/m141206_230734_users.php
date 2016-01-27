
<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m141206_230734_users
 */
class m141206_230734_users extends Migration
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

        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'avatar' => $this->string()->defaultValue(null),
            'about_me' => $this->text()->defaultValue(null),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'date_create' => $this->timestamp()->defaultValue(null) . ' COMMENT "Дата регистрации"',
            'date_update' => $this->timestamp()->defaultValue(null) . ' COMMENT "Дата редактирования"',
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
