<?php

namespace app\models;

use app\models\node\BooksCategories;
use app\models\query\CategoryQuery;
use yii\db\ActiveRecord;
use Yii;

/**
 * Категория
 * @package app\models
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'name' => 'Название',
        ];
    }

    /**
     * @return $this
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable(BooksCategories::tableName(), ['book_id' => 'id']);
    }

    /**
     * Поиск по идентификатуру
     *
     * @param $id
     * @return array|null|ActiveRecord
     */
    public static function findById($id)
    {
        $query = static::find();
        $query->where(['id' => $id]);
        return $query->one();
    }
}