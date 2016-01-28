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
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

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