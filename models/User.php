<?php

namespace app\models;

use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\db\Query;
use Yii;

/**
 * Class User
 * @package app\models
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
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
            ->where(['name' => $username])
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
     * Auth Key validation.
     *
     * @param string $authKey
     * @return boolean
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Кол-во проектов в которых присутствует пользователь
     * @return int
     */
    public function getCountProjects()
    {
        return $this->hasMany(Project::className(), ['id' => 'project_id'])->viaTable(\app\models\node\ProjectPositionUser::tableName(), ['user_id' => 'id'])->count();
    }
}
