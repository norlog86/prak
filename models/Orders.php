<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "fact_orders".
 *
 * @property string $order_id
 * @property string $str_id
 * @property string $emp_id
 * @property string s$art_id
 * @property string $order_date
 * @property float|null $amount
 *
 * @property DictArt $art
 * @property DictEmployee $emp
 * @property DictStr $str
 */
class Orders extends \yii\db\ActiveRecord
{
    public $whs_lat;
    public $whs_long;

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
            [['order_date'], 'required'],
            [['order_date'], 'safe'],
            [['amount'], 'number'],
            [['str_id', 'emp_id', 'order_date'], 'unique', 'targetAttribute' => ['str_id', 'emp_id', 'order_date']],
            [['order_date'], 'unique'],
            [
                ['art_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => DictArt::class,
                'targetAttribute' => ['art_id' => 'art_id'],
            ],
            [
                ['emp_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => DictEmployee::class,
                'targetAttribute' => ['emp_id' => 'emp_id'],
            ],
            [
                ['str_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => DictStr::class,
                'targetAttribute' => ['str_id' => 'str_id'],
            ],
            [
                ['str_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => StrWhsLnk::class,
                'targetAttribute' => ['str_id' => 'str_id'],
            ],
        ];
    }

    /**
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Индивидуальный номер заказа',
            'str_id' => 'Str ID',
            'emp_id' => 'Emp ID',
            'art_id' => 'Art ID',
            'order_date' => 'Дата Заказа',
            'amount' => 'Количество',
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArt()
    {
        return $this->hasOne(DictArt::class, ['art_id' => 'art_id']);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(DictEmployee::class, ['emp_id' => 'emp_id']);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStr()
    {
        return $this->hasOne(DictStr::class, ['str_id' => 'str_id']);
    }

}
