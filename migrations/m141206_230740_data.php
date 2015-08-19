<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m141206_230740_data
 */
class m141206_230740_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert('{{%positions}}', ['id', 'name'], [
            [
                1,
                'Программист',
            ],
            [
                2,
                'Дизайнер',
            ],
            [
                3,
                'Руководитель проекта',
            ],
            [
                4,
                'Тестировщик',
            ],
            [
                5,
                'Архитектор баз данных',
            ],
            [
                6,
                'Пиарщик',
            ],
            [
                7,
                'Парень, который ничего не делает',
            ],
        ]);


        $this->batchInsert('{{%projects}}', ['id', 'name', 'description', 'status', 'time_create', 'time_update'], [
            [
                1,
                'Сайт-Визитка',
                'Разработать Сайт-Визитку',
                1,
                time(),
                time(),
            ],
            [
                2,
                'Корпоративный сайт',
                'Разработать Корпоративный сайт',
                1,
                time(),
                time(),
            ],
            [
                3,
                'Лендинг',
                'Разработать продающий лендинг',
                1,
                time(),
                time(),
            ],
            [
                4,
                'Сайт-Визитка',
                'Разработать Сайт-Визитку',
                1,
                time(),
                time(),
            ],
            [
                5,
                'Стартап',
                'Разработать Стартап',
                1,
                time(),
                time(),
            ],
        ]);



        $security = Yii::$app->security;


        $this->batchInsert('{{%users}}', ['id', 'name', 'auth_key', 'secure_key'], [
            [
                1,
                'Вася',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                2,
                'Игорь',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                3,
                'Игнат',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                4,
                'Наташа',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                5,
                'Оля',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                6,
                'Костя',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                7,
                'Катя',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                8,
                'Вика',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                9,
                'Олег',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
            [
                10,
                'Инокентий',
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return false;
    }
}
