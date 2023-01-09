<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drivers".
 *
 * @property int $id_driver
 * @property string $full_name
 * @property string $schedule
 *
 * @property DriveCar[] $driveCars
 */
class Drivers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drivers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_driver', 'full_name', 'schedule'], 'required'],
            [['id_driver'], 'default', 'value' => null],
            [['id_driver'], 'integer'],
            [['full_name', 'schedule'], 'string', 'max' => 200],
            [['id_driver'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_driver' => 'Id Driver',
            'full_name' => 'Full Name',
            'schedule' => 'Schedule',
        ];
    }

    /**
     * Gets query for [[DriveCars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriveCars()
    {
        return $this->hasMany(DriveCar::class, ['id_driver' => 'id_driver']);
    }
}
