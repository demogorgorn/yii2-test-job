<?php

namespace app\helpers;

use yii\helpers\Html;
use Yii;

/**
 * Должность
 * @package app\models
 */
class ProjectHelper
{
    /**
     * Название
     * @param $name
     * @return string
     */
    public static function getName($name)
    {
        if (empty($name)) {
            return 'Без названия';
        }

        return Html::encode($name);
    }

    /**
     * Описание
     * @param $desc
     * @return string
     */
    public static function getDescription($desc)
    {
        if (empty($desc)) {
            return 'Нет описания';
        }

        return Html::encode($desc);
    }

    /**
     * Список должностей
     * @param array $nodes
     * @return string
     */
    public static function getPositions(array $nodes)
    {
        if (empty($nodes)) {
            return Html::tag('small', 'Нет должностей', ['style' => 'color: silver']);
        }

        $result = [];
        foreach($nodes as &$node) {
            $result[] = Html::tag('small', $node['position']['name'], ['title' => $node['user']['name']]);
        }

        return Html::tag('span', implode(', ', $result));
    }

    /**
     * Статус
     * @param $status
     * @return string
     */
    public static function getStatus($status)
    {
        if ($status == 1) {
            return '<span class="label label-success">Активен</span>';
        }
        return '<span class="label label-default">Завершен</span>';
    }
}