<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emp_str_lnk".
 *
 * @property string $emp_id
 * @property string $str_id
 *
 * @property DictEmployee $emp
 * @property DictStr $str
 */
class EmpStrLnk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emp_str_lnk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'str_id'], 'string'],
            [['emp_id', 'str_id'], 'unique', 'targetAttribute' => ['emp_id', 'str_id']],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictEmployee::class, 'targetAttribute' => ['emp_id' => 'emp_id']],
            [['str_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictStr::class, 'targetAttribute' => ['str_id' => 'str_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'str_id' => 'Str ID',
        ];
    }

    /**
     * Gets query for [[Emp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(DictEmployee::class, ['emp_id' => 'emp_id']);
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
}
