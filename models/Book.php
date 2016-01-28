<?php

namespace app\models;

use app\models\node\BooksCategories;
use app\models\node\BooksUsers;
use app\models\query\BookQuery;
use yii\db\ActiveRecord;
use Yii;

/**
 * Книга
 * @package app\models
 */
class Book extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%books}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'name' => 'Название',
            'description' => 'Описание',
            'cover' => 'Обложка',
            'file' => 'Файл',
            'date_create' => 'Дата создания',
            'date_update' => 'Дата редактирования',
        ];
    }

    /**
     * @return $this
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable(BooksCategories::tableName(), ['book_id' => 'id']);
    }

    /**
     * @return $this
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable(BooksUsers::tableName(), ['book_id' => 'id']);
    }

    /**
     * Поиск по идентификатору
     *
     * @param $id
     * @param null $status
     * @return array|null|ActiveRecord
     */
    public static function findById($id, $status = null)
    {
        $query = static::find();
        $query->where(['id' => $id]);
        if (!is_null($status)) {
            $query->status($status);
        }
        return $query->one();
    }
}