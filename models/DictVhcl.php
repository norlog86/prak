<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dict_vhcl".
 *
 * @property string $vhcl_id
 * @property float|null $vhcl_vlm
 *
 * @property DrvVhclLnk[] $drvVhclLnks
 * @property DictDrv[] $drvs
 * @property DictWhs[] $whs
 * @property WhsVhclLnk[] $whsVhclLnks
 */
class DictVhcl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dict_vhcl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vhcl_id'], 'required'],
            [['vhcl_id'], 'string'],
            [['vhcl_vlm'], 'number'],
            [['vhcl_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vhcl_id' => 'Vhcl ID',
            'vhcl_vlm' => 'Vhcl Vlm',
        ];
    }

    /**
     * Gets query for [[DrvVhclLnks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrvVhclLnks()
    {
        return $this->hasMany(DrvVhclLnk::class, ['vhcl_id' => 'vhcl_id']);
    }

    /**
     * Gets query for [[Drvs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrvs()
    {
        return $this->hasMany(DictDrv::class, ['drv_id' => 'drv_id'])->viaTable('drv_vhcl_lnk', ['vhcl_id' => 'vhcl_id']);
    }

    /**
     * Gets query for [[Whs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhs()
    {
        return $this->hasMany(DictWhs::class, ['whs_id' => 'whs_id'])->viaTable('whs_vhcl_lnk', ['vhcl_id' => 'vhcl_id']);
    }

    /**
     * Gets query for [[WhsVhclLnks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhsVhclLnks()
    {
        return $this->hasMany(WhsVhclLnk::class, ['vhcl_id' => 'vhcl_id']);
    }
}
