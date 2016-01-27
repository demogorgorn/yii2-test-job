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
        $security = Yii::$app->security;
        $currentDate = date('Y-m-d H:i:s');

        $users = [
            2 => 'Борис Поплавский',
            3 => 'Василий Вялый',
            4 => 'Марина Цветаева',
            5 => 'Ивлин Во',
            6 => 'Андрей Вознесенский',
            7 => 'Максим Кононенко',
            8 => 'Джеймс Блиш',
            9 => 'Генрих Альтов',
            10 => 'Эдуард Лимонов',
            11 => 'Антон Дельвиг',
            12 => 'Александр Пушкин',
            13 => 'Нина Молевая',
        ];

        $newUsers = [];
        foreach ($users as $id => &$user) {
            $name = explode(' ', $user);
            $newUsers[] = [
                $id,
                md5(uniqid(true)) . '@mail.ru',
                $name[0],
                $name[1],
                $security->generateRandomString(),
                $security->generateRandomString(),
                $security->generatePasswordHash('123456q'),
                $currentDate,
                $currentDate
            ];
        }

        $this->batchInsert('{{%users}}', ['id', 'email', 'name', 'surname', 'auth_key', 'password_reset_token',  'password_hash', 'date_create', 'date_update'], array_merge([
            [
                1,
                'nepsterxxx@mail.ru',
                'Admin',
                'Admin',
                $security->generateRandomString(),
                $security->generateRandomString(),
                $security->generatePasswordHash('123456q'),
                $currentDate,
                $currentDate
            ],
        ], $newUsers) );


        // Категории
        $this->batchInsert('{{%categories}}', ['id', 'name'], [
            [1, 'Проза'],
            [2, 'Поэзия',],
            [3, 'Детективы',],
            [4, 'Фантастика',],
            [5, 'Любовные романы',],
            [6, 'Бизнес-литература',],
            [7, 'Детские книги',],
            [8, 'Приключения и путешествия',],
            [9, 'Документальная литература',],
            [10, 'Дом и семья',],
            [11, 'Компьютеры, Технологии, Интернет',],
            [12, 'Научно-образовательная литература',],
            [13, 'Пьесы и драматургия',],
            [14, 'Религиозная литература',],
            [15, 'Энциклопедии',],
            [16, 'Техника',],
            [17, 'Творчество и фольклор',],
            [18, 'Юмор',],
        ]);


        // Книги
        $this->batchInsert('{{%books}}', ['id', 'name', 'description', 'cover', 'file', 'date_create', 'date_update'], [
            [
                1,
                'А. Г. Орлов-Чесменский',
                'Новый роман известной писательницы историка Нины Молевой посвящен графу Алексею Григорьевичу Орлову. Участие в дворцовом перевороте 28 июня 1762 года, командование русским флотом во время победного сражения с турками под Чесмой, похищение самозваной «принцессы Елизаветы» — вот лишь немногие эпизоды его бурной жизни. Особенность этого романа заключается в том, что в нем приведены подлинные исторические документы, например письма «принцессы Елизаветы» из Петропавловской крепости к Екатерине II, и многие другие.',
                'http://bookscafe.net/books/237/237765/cover.jpg',
                'http://bookscafe.net/download/moleva_nina-a_g_orlov_chesmenskiy-237765.html.zip',
                $currentDate,
                $currentDate,
            ],
            [
                2,
                'Авось',
                'Описание в сентиментальных документах, стихах и молитвах славных злоключений Действительного Камер-Герра Николая Резанова, доблестных Офицеров Флота Хвастова и Довыдова, их быстрых парусников "Юнона" и "Авось", сан-францисского Коменданта Дон Хосе Дарио Аргуэльо, любезной дочери его Кончи с приложением карты странствий необычайных.',
                'http://bookscafe.net/books/226/226656/cover.jpg',
                'http://bookscafe.net/download/voznesenskiy_andrey-avos-226656.html.zip',
                $currentDate,
                $currentDate,
            ],
            [
                3,
                'Автоматические стихи',
                'Эта книга Бориса Поплавского (1903–1935), одного из самых ярких поэтов русского зарубежья — современники называли его «царевичем монпарнасского царства», — была подготовлена к печати самим автором, но так и не увидела света. И вот, спустя 65 лет после создания, «Автоматические стихи» (1930–1933), о существовании которых до недавнего времени не знали даже специалисты, обнаружены в парижском архиве друзей поэта Д. и Н. Татищевых. Публикуется впервые.',
                'http://bookscafe.net/books/201/201969/cover.jpg',
                'http://bookscafe.net/download/poplavskiy_boris-avtomaticheskie_stihi-201969.html.zip',
                $currentDate,
                $currentDate,
            ],
            [
                4,
                'Агитлубки (1923)',
                'Полное собрание сочинений в тринадцати томах.Том пятый. Март-декабрь 1923. Реклама 1923-1925',
                'http://bookscafe.net/books/19/19588/cover.jpg',
                'http://bookscafe.net/download/mayakovskiy_vladimir-agitlubki_1923-19588.html.zip',
                $currentDate,
                $currentDate,
            ],
            [
                5,
                'Базы данных: конспект лекций',
                'Конспект лекций соответствует требованиям Государственного образовательного стандарта высшего профессионального образования РФ и предназначен для освоения студентами вузов специальной дисциплины «Базы данных».Лаконичное и четкое изложение материала, продуманный отбор необходимых тем позволяют быстро и качественно подготовиться к семинарам, зачетам и экзаменам по данному предмету.',
                'http://bookscafe.net/books/155/155980/cover.jpg',
                'http://bookscafe.net/download/uchebnik-bazy_dannyh_konspekt_lekciy-155980.html.zip',
                $currentDate,
                $currentDate,
            ],
        ]);



        $this->batchInsert('{{%books_categories}}', ['book_id', 'category_id'], [
            [
                1,
                1
            ],
            [
                1,
                13
            ],
            [
                2,
                2
            ],
            [
                3,
                1
            ],
            [
                3,
                2
            ],
            [
                3,
                4
            ],
            [
                4,
                2
            ],
            [
                5,
                16
            ],
            [
                5,
                9
            ],
        ]);

        $this->batchInsert('{{%books_users}}', ['user_id', 'book_id'], [
            [
                3,
                1
            ],
            [
                13,
                1
            ],
            [
                6,
                2
            ],
            [
                2,
                3
            ],
            [
                7,
                3
            ],
            [
                10,
                4
            ],
            [
                11,
                4
            ],
            [
                11,
                5
            ],
            [
                12,
                5
            ],
            [
                13,
                5
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
