<?php

namespace app\helpers;

use yii\helpers\Html;

/**
 * Book Helper
 * @package app\helpers
 */
class BookHelper
{
    /**
     * @param array $books
     * @return array|null
     */
    public static function getList(array $books)
    {
        if (empty($books) || !is_array($books)) {
            return null;
        }
        $result = [];
        foreach ($books as $book) {
            $result[] = Html::a(Html::encode($book['name']), ['/book/view', 'id' => $book['id']]);
        }
        return $result;
    }
}