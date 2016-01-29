<?php

namespace app\helpers;

use yii\helpers\Html;

/**
 * User Helper
 * @package app\helpers
 */
class UserHelper
{
    /**
     * @param array $users
     * @return array|null
     */
    public static function getList(array $users)
    {
        if (empty($users) || !is_array($users)) {
            return null;
        }
        $result = [];
        foreach ($users as $user) {
            $result[] = Html::a(Html::encode($user['name']) .' '. Html::encode($user['surname']), ['/user/view', 'id' => $user['id']], ['class' => 'ajax']);
        }
        return $result;
    }
}