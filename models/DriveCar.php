<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drive_car".
 *
 * @property int $id_drcr
 * @property int $id_driver
 * @property int $id_car
 *
 * @property Cars $car
 * @property Drivers $driver
 */
class DriveCar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drive_car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_drcr', 'id_driver', 'id_car'], 'required'],
            [['id_drcr', 'id_driver', 'id_car'], 'default', 'value' => null],
            [['id_drcr', 'id_driver', 'id_car'], 'integer'],
            [['id_car'], 'exist', 'skipOnError' => true, 'targetClass' => Cars::class, 'targetAttribute' => ['id_car' => 'id_car']],
            [['id_driver'], 'exist', 'skipOnError' => true, 'targetClass' => Drivers::class, 'targetAttribute' => ['id_driver' => 'id_driver']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_drcr' => 'Id Drcr',
            'id_driver' => 'Id Driver',
            'id_car' => 'Id Car',
        ];
    }

    /**
     * Gets query for [[Car]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Cars::class, ['id_car' => 'id_car']);
    }

    /**
     * Gets query for [[Driver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Drivers::class, ['id_driver' => 'id_driver']);
    }
}
