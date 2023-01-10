<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fact_orders".
 *
 * @property string $order_id
 * @property string $str_id
 * @property string $emp_id
 * @property string $art_id
 * @property string|null $order_date
 * @property float|null $amount
 *
 * @property DictArt $art
 * @property DictEmployee $emp
 * @property DictStr $str
 */
class FactOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fact_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'str_id', 'emp_id', 'art_id'], 'string'],
            [['order_date'], 'safe'],
            [['amount'], 'number'],
            [['str_id', 'emp_id', 'order_date'], 'unique', 'targetAttribute' => ['str_id', 'emp_id', 'order_date']],
            [['art_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictArt::class, 'targetAttribute' => ['art_id' => 'art_id']],
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
            'order_id' => 'Order ID',
            'str_id' => 'Str ID',
            'emp_id' => 'Emp ID',
            'art_id' => 'Art ID',
            'order_date' => 'Order Date',
            'amount' => 'Amount',
        ];
    }

    /**
     * Gets query for [[Art]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArt()
    {
        return $this->hasOne(DictArt::class, ['art_id' => 'art_id']);
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