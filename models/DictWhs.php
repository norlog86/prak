<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dict_whs".
 *
 * @property string $whs_id
 * @property string|null $address
 * @property float|null $latitude
 * @property float|null $longitude
 *
 * @property StrWhsLnk[] $strWhsLnks
 * @property DictStr[] $strs
 * @property DictVhcl[] $vhcls
 * @property WhsVhclLnk[] $whsVhclLnks
 */
class DictWhs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dict_whs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['whs_id'], 'required'],
            [['whs_id'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['address'], 'string', 'max' => 255],
            [['whs_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'whs_id' => 'Whs ID',
            'address' => 'Адресс',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
        ];
    }

    /**
     * Gets query for [[StrWhsLnks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrWhsLnks()
    {
        return $this->hasMany(StrWhsLnk::class, ['whs_id' => 'whs_id']);
    }

    /**
     * Gets query for [[Strs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrs()
    {
        return $this->hasMany(DictStr::class, ['str_id' => 'str_id'])->viaTable('str_whs_lnk', ['whs_id' => 'whs_id']);
    }

    /**
     * Gets query for [[Vhcls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVhcls()
    {
        return $this->hasMany(DictVhcl::class, ['vhcl_id' => 'vhcl_id'])->viaTable('whs_vhcl_lnk', ['whs_id' => 'whs_id']);
    }

    /**
     * Gets query for [[WhsVhclLnks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhsVhclLnks()
    {
        return $this->hasMany(WhsVhclLnk::class, ['whs_id' => 'whs_id']);
    }
}
