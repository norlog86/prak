<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dict_str".
 *
 * @property string $str_id
 * @property string|null $address
 * @property float|null $latitude
 * @property float|null $longitude
 *
 * @property EmpStrLnk[] $empStrLnks
 * @property DictEmployee[] $emps
 * @property FactOrders[] $factOrders
 * @property FactStrRests[] $factStrRests
 * @property StrWhsLnk[] $strWhsLnks
 * @property DictWhs[] $whs
 */
class DictStr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dict_str';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['str_id'], 'required'],
            [['str_id'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['address'], 'string', 'max' => 255],
            [['str_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'str_id' => 'Str ID',
            'address' => 'Адрес доставки',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
        ];
    }

    /**
     * Gets query for [[EmpStrLnks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpStrLnks()
    {
        return $this->hasMany(EmpStrLnk::class, ['str_id' => 'str_id']);
    }

    /**
     * Gets query for [[Emps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmps()
    {
        return $this->hasMany(DictEmployee::class, ['emp_id' => 'emp_id'])->viaTable('emp_str_lnk', ['str_id' => 'str_id']);
    }

    /**
     * Gets query for [[FactOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFactOrders()
    {
        return $this->hasMany(FactOrders::class, ['str_id' => 'str_id']);
    }

    /**
     * Gets query for [[FactStrRests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFactStrRests()
    {
        return $this->hasMany(FactStrRests::class, ['str_id' => 'str_id']);
    }

    /**
     * Gets query for [[StrWhsLnks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrWhsLnks()
    {
        return $this->hasMany(StrWhsLnk::class, ['str_id' => 'str_id']);
    }

    /**
     * Gets query for [[Whs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhs()
    {
        return $this->hasMany(DictWhs::class, ['whs_id' => 'whs_id'])->viaTable('str_whs_lnk', ['str_id' => 'str_id']);
    }
}
