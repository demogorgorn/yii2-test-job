<?php

namespace app\models\form;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup Form
 * @package app\models\form
 */
class SignupForm extends Model
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $repassword;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge((new User)->attributeLabels(), [
            'repassword' => 'Повторить пароль'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::className()],

            //TODO: усложнить валидацию имени
            [['name', 'surname'], 'required'],
            [['name', 'surname'], 'string', 'min' => 2],

            //TODO: усложнить допустимый ввод пароля
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['repassword', 'required'],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Регистрация
     *
     * @return User|null
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->email = $this->email;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->status = User::STATUS_ACTIVE;
        $user->date_create = date('Y-m-d H:i:s');
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}