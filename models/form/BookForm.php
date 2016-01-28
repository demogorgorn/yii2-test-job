<?php

namespace app\models\form;

use app\models\Book;
use app\models\Category;
use app\models\node\BooksCategories;
use app\models\node\BooksUsers;
use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Book Form
 * @package app\models\form
 */
class BookForm extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $cover;

    /**
     * @var string
     */
    public $file;

    /**
     * @var array
     */
    public $categories;

    /**
     * @var array
     */
    public $users;

    /**
     * @var array
     */
    private $categoriesValid;

    /**
     * @var array
     */
    private $usersValid;

    /**
     * @var array
     */
    private $categoriesCurrent;

    /**
     * @var array
     */
    private $usersCurrent;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge((new Book())->attributeLabels(), [
            'categories' => 'Категории',
            'users' => 'Авторы',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'create' => ['name', 'description', 'cover', 'file', 'categories', 'users'],
            'update' => ['name', 'description', 'cover', 'file', 'categories', 'users'],
            'delete' => [],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 64],
            ['name', 'match', 'pattern' => '/^([а-яА-ЯЁёa-zA-Z0-9\s_.-]+)$/u'],

            ['description', 'required'],
            ['description', 'string'],

            ['cover', 'required'],
            ['cover','url'],

            ['file', 'required'],
            ['file','url'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->scenario == 'update') {

            $data = Book::find()
                ->where([Book::tableName() . '.id' => $this->id])
                ->joinWith([
                    'categories' => function ($query) {
                        $query->select(['id', 'name']);
                        $query->asArray();
                    },
                    'users' => function ($query) {
                        $query->select(['id', 'name', 'surname']);
                        $query->asArray();
                    }])
                ->one();

            $this->categories = [];
            $this->users = [];

            if ($data && $data->categories) {
                foreach ($data->categories as $category) {
                    $this->categories[] = $category['id'];
                    $this->categoriesCurrent[$category['id']] = $category['name'];
                }
            }

            if ($data && $data->users) {
                foreach ($data->users as $user) {
                    $this->users[] = $user['id'];
                    $this->usersCurrent[$user['id']] = $user['name'] . ' ' .  $user['surname'];
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if ($this->scenario == 'create' || $this->scenario == 'update') {
            $this->categoriesValid = Category::findAll($this->categories);
            $this->usersValid = User::findAll($this->users);
        }

        return true;
    }

    /**
     * Создать
     *
     * @return bool|null
     */
    public function create()
    {
        $model = new Book();
        $model->name = $this->name;
        $model->description = $this->description;
        $model->cover = $this->cover;
        $model->file = $this->file;
        $model->status = Book::STATUS_ACTIVE;
        $model->date_create = date('Y-m-d H:i:s');
        $model->date_update = date('Y-m-d H:i:s');
        $model->save();

        $this->saveNodes($model->id);

        return true;
    }

    /**
     * Редактировать
     *
     * @param Book $model
     * @return null
     */
    public function update(Book $model)
    {
        $model->name = $this->name;
        $model->description = $this->description;
        $model->cover = $this->cover;
        $model->file = $this->file;
        $model->date_update = date('Y-m-d H:i:s');
        $model->save();

        BooksCategories::deleteAll(['book_id' => $model->id]);
        BooksUsers::deleteAll(['book_id' => $model->id]);

        $this->saveNodes($model->id);

        return true;
    }

    /**
     * Удалить
     *
     * @param Book $model
     * @return null
     */
    public function delete(Book $model)
    {
        $model->status = Book::STATUS_DELETE;

        return $model->save();
    }

    /**
     * @return array
     */
    public function getCategoriesData()
    {
        return $this->categoriesCurrent;
    }

    /**
     * @return array
     */
    public function getUsersData()
    {
        return $this->usersCurrent;
    }

    /**
     * Сохранить связи
     *
     * @param $book_id
     */
    private function saveNodes($book_id)
    {
        if ($this->categoriesValid) {
            foreach ($this->categoriesValid as $category) {
                $BooksCategories = new BooksCategories();
                $BooksCategories->book_id = $book_id;
                $BooksCategories->category_id = $category->id;
                $BooksCategories->save();
            }
        }

        if ($this->usersValid) {
            foreach ($this->usersValid as $user) {
                $BooksUsers = new BooksUsers();
                $BooksUsers->book_id = $book_id;
                $BooksUsers->user_id = $user->id;
                $BooksUsers->save();
            }
        }
    }

}