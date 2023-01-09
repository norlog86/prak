<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "storage_car".
 *
 * @property int $id_stgcr
 * @property int $id_storage
 * @property int $id_car
 */
class StorageCar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'storage_car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_stgcr', 'id_storage', 'id_car'], 'required'],
            [['id_stgcr', 'id_storage', 'id_car'], 'default', 'value' => null],
            [['id_stgcr', 'id_storage', 'id_car'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_stgcr' => 'Id Stgcr',
            'id_storage' => 'Id Storage',
            'id_car' => 'Id Car',
        ];
    }
}
