<?php

namespace app\models\query;

use app\models\Category;
use yii\db\ActiveQuery;

/**
 * Category Query
 * @package app\models\query
 */
class CategoryQuery extends ActiveQuery
{
    /**
     * @param int $state
     * @return $this
     */
    public function status($state = Category::STATUS_ACTIVE)
    {
        $this->andWhere([Category::tableName() . '.status' => $state]);
        return $this;
    }
}