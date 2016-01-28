<?php

namespace app\models\form;

use yii\validators\StringValidator;
use yii\validators\CompareValidator;
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
            ['password', 'validatePassword'],
            ['repassword', 'safe'],
            ['avatar', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ['about_me', 'string', 'max' => 1000],
        ];
    }

    /**
     * @param $attribute
     */
    public function validatePassword($attribute)
    {
        if (empty($this->password)) {
            return ;
        }

        $StringValidator = new StringValidator([
            'min' => 6
        ]);
        $StringValidator->validateAttribute($this, 'password');

        $CompareValidator = new CompareValidator([
            'compareAttribute' => 'password'
        ]);
        $CompareValidator->validateAttribute($this, 'repassword');
    }

    /**
     * Обновить профиль
     *
     * @return User|null
     */
    public function update(User $user)
    {
        if (!empty($this->avatar)) {
            $path = User::getAvatarPath();
            $avatarName =  $user->id . '.' . $this->avatar->extension;
            $this->avatar->saveAs($path . $avatarName);
            $user->avatar = $avatarName;
        }
        if (!empty($this->password)) {
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        }
        $user->about_me = $this->about_me;
        return $user->save();
    }
}