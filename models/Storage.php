<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "storage".
 *
 * @property int $id_storage
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 */
class Storage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'storage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_storage', 'address', 'latitude', 'longitude'], 'required'],
            [['id_storage'], 'default', 'value' => null],
            [['id_storage'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['address'], 'string', 'max' => 200],
            [['id_storage'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_storage' => 'Id Storage',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
}
