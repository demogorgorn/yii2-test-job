<?php

namespace app\models;

use app\models\node\BooksUsers;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\db\Query;
use Yii;

/**
 * User
 * @package app\models
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * Статус пользователя
     *  - активный
     */
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'EMAIL',
            'password' => 'Пароль',
            'avatar' => 'Аватар',
            'about_me' => 'О себе'
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Поиск пользователя по логину
     *
     * @param string $username Username
     *
     * @return array|\yii\db\ActiveRecord[] User
     */
    public static function findByUsername($username)
    {
        return static::find()
            ->where(['email' => $username])
            ->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['api_key' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return $this
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable(BooksUsers::tableName(), ['user_id' => 'id']);
    }

    /**
     * Путь к аватаркам
     *
     * @param bool|false $web
     * @return bool|string
     */
    public static function getAvatarPath($web = false)
    {
        if ($web) {
            return Yii::getAlias("@web/avatars/");
        }
        return Yii::getAlias("@app/web/avatars/");
    }

    /**
     * Получит ьаватар
     *
     * @return string
     */
    public function getAvatar()
    {
        if (!empty($this->avatar)) {
            return $this->getAvatarPath(true) . $this->avatar;
        }
        return $this->getAvatarPath(true) . '..' . DIRECTORY_SEPARATOR . 'no-avatar.jpg';
    }
}
