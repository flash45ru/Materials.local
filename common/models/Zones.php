<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zones".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $comment
 * @property integer $user_id
 * @property integer $order_id
 */
class Zones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'comment', 'user_id', 'order_id'], 'required'],
            [['comment'], 'string'],
            [['user_id', 'order_id'], 'integer'],
            [['name', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'comment' => 'Comment',
            'user_id' => 'User ID',
            'order_id' => 'Order ID',
        ];
    }
}
