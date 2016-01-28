<?php

namespace app\models\form;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Profile Form
 * @package app\models\form
 */
class ProfileForm extends Model
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $repassword;

    /**
     * @var string
     */
    public $avatar;

    /**
     * @var string
     */
    public $about_me;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge((new User)->attributeLabels(), [
            'repassword' => 'Повторить пароль',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'repassword'],'required'],

            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ['avatar','required'],
            ['about_me','required'],
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }



    /**
     * Обновить профиль
     *
     * @return User|null
     */
    public function update()
    {
        if (!$this->validate()) {
            return null;
        }

        echo 'profile';

        die();

    }
}