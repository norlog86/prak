<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drv_vhcl_lnk".
 *
 * @property string $drv_id
 * @property string $vhcl_id
 *
 * @property DictDrv $drv
 * @property DictVhcl $vhcl
 */
class DrvVhclLnk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drv_vhcl_lnk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['drv_id', 'vhcl_id'], 'string'],
            [['drv_id', 'vhcl_id'], 'unique', 'targetAttribute' => ['drv_id', 'vhcl_id']],
            [['drv_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictDrv::class, 'targetAttribute' => ['drv_id' => 'drv_id']],
            [['vhcl_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictVhcl::class, 'targetAttribute' => ['vhcl_id' => 'vhcl_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'drv_id' => 'Drv ID',
            'vhcl_id' => 'Vhcl ID',
        ];
    }

    /**
     * Gets query for [[Drv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrv()
    {
        return $this->hasOne(DictDrv::class, ['drv_id' => 'drv_id']);
    }

    /**
     * Gets query for [[Vhcl]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVhcl()
    {
        return $this->hasOne(DictVhcl::class, ['vhcl_id' => 'vhcl_id']);
    }
}
