<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "str_whs_lnk".
 *
 * @property string $str_id
 * @property string $whs_id
 *
 * @property DictStr $str
 * @property DictWhs $whs
 */
class StrWhsLnk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'str_whs_lnk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['str_id', 'whs_id'], 'string'],
            [['str_id', 'whs_id'], 'unique', 'targetAttribute' => ['str_id', 'whs_id']],
            [['str_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictStr::class, 'targetAttribute' => ['str_id' => 'str_id']],
            [['whs_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictWhs::class, 'targetAttribute' => ['whs_id' => 'whs_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'str_id' => 'Str ID',
            'whs_id' => 'Whs ID',
        ];
    }

    /**
     * Gets query for [[Str]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStr()
    {
        return $this->hasOne(DictStr::class, ['str_id' => 'str_id']);
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
