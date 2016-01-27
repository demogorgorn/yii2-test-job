<?php

namespace app\models\node;

use yii\db\ActiveRecord;
use Yii;

/**
 * Связь между книгами и категроиями
 * @package app\models\node
 */
class BooksCategories extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%books_categories}}';
    }
}