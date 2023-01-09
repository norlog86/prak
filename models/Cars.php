<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cars".
 *
 * @property int $id_car
 * @property string $size
 *
 * @property DriveCar[] $driveCars
 */
class Cars extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_car', 'size'], 'required'],
            [['id_car'], 'default', 'value' => null],
            [['id_car'], 'integer'],
            [['size'], 'string', 'max' => 100],
            [['id_car'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_car' => 'Id Car',
            'size' => 'Size',
        ];
    }

    /**
     * Gets query for [[DriveCars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriveCars()
    {
        return $this->hasMany(DriveCar::class, ['id_car' => 'id_car']);
    }
}
