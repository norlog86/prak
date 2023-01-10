<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dict_drv".
 *
 * @property string $drv_id Код водителя
 * @property string|null $drv_name ФИО водителя
 * @property string|null $drv_schedule График работы
 *
 * @property DrvVhclLnk[] $drvVhclLnks
 * @property FactTickets[] $factTickets
 * @property DictVhcl[] $vhcls
 */
class DictDrv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dict_drv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['drv_id'], 'required'],
            [['drv_id'], 'string'],
            [['drv_name'], 'string', 'max' => 100],
            [['drv_schedule'], 'string', 'max' => 50],
            [['drv_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'drv_id' => 'Drv ID',
            'drv_name' => 'Drv Name',
            'drv_schedule' => 'Drv Schedule',
        ];
    }

    /**
     * Gets query for [[DrvVhclLnks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrvVhclLnks()
    {
        return $this->hasMany(DrvVhclLnk::class, ['drv_id' => 'drv_id']);
    }

    /**
     * Gets query for [[FactTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFactTickets()
    {
        return $this->hasMany(FactTickets::class, ['drv_id' => 'drv_id']);
    }

    /**
     * Gets query for [[Vhcls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVhcls()
    {
        return $this->hasMany(DictVhcl::class, ['vhcl_id' => 'vhcl_id'])->viaTable('drv_vhcl_lnk', ['drv_id' => 'drv_id']);
    }
}
