<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id_order
 * @property int $id_car
 * @property string $application_status
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order', 'id_car', 'application_status'], 'required'],
            [['id_order', 'id_car'], 'default', 'value' => null],
            [['id_order', 'id_car'], 'integer'],
            [['application_status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'id_car' => 'Id Car',
            'application_status' => 'Application Status',
        ];
    }
}
