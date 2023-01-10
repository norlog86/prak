<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "whs_vhcl_lnk".
 *
 * @property string $whs_id
 * @property string $vhcl_id
 *
 * @property DictVhcl $vhcl
 * @property DictWhs $whs
 */
class WhsVhclLnk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'whs_vhcl_lnk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['whs_id', 'vhcl_id'], 'string'],
            [['whs_id', 'vhcl_id'], 'unique', 'targetAttribute' => ['whs_id', 'vhcl_id']],
            [['vhcl_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictVhcl::class, 'targetAttribute' => ['vhcl_id' => 'vhcl_id']],
            [['whs_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictWhs::class, 'targetAttribute' => ['whs_id' => 'whs_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'whs_id' => 'Whs ID',
            'vhcl_id' => 'Vhcl ID',
        ];
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

    /**
     * Gets query for [[Whs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhs()
    {
        return $this->hasOne(DictWhs::class, ['whs_id' => 'whs_id']);
    }
}
