<?php

namespace app\models\query;

use app\models\Book;
use yii\db\ActiveQuery;

/**
 * Book Query
 * @package app\models\query
 */
class BookQuery extends ActiveQuery
{
    /**
     * @param int $state
     * @return $this
     */
    public function status($state = Book::STATUS_ACTIVE)
    {
        $this->andWhere([Book::tableName() . '.status' => $state]);
        return $this;
    }
}