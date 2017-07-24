<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $secondname
 * @property string $phone
 * @property string $role
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'firstname', 'lastname', 'secondname', 'phone', 'role'], 'required'],
            [['username', 'firstname', 'lastname', 'secondname', 'phone', 'role'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'secondname' => 'Secondname',
            'phone' => 'Phone',
            'role' => 'Role',
        ];
    }
}
