<?php

namespace app\models\node;

use yii\db\ActiveRecord;
use Yii;

/**
 * Связь между книгами и авторами
 * @package app\models\node
 */
class BooksUsers extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%books_users}}';
    }
}