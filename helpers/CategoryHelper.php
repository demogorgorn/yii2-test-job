<?php

namespace app\helpers;

use yii\helpers\Html;

/**
 * Category Helper
 * @package app\helpers
 */
class CategoryHelper
{
    /**
     * @param array $categories
     * @return array|null
     */
    public static function getList(array $categories)
    {
        if (empty($categories) || !is_array($categories)) {
            return null;
        }
        $result = [];

        foreach ($categories as $category) {
            $result[] = Html::a(Html::encode($category['name']), ['/category/view', 'id' => $category['id']], ['class' => 'ajax']);
        }
        return $result;
    }
}