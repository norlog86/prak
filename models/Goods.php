<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id_goods
 * @property string $name_of_goods
 * @property float $size
 * @property float $packing_size
 * @property int $quantity
 *
 * @property Lefts[] $lefts
 * @property Orders[] $orders
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_goods', 'name_of_goods', 'size', 'packing_size', 'quantity'], 'required'],
            [['id_goods', 'quantity'], 'default', 'value' => null],
            [['id_goods', 'quantity'], 'integer'],
            [['size', 'packing_size'], 'number'],
            [['name_of_goods'], 'string', 'max' => 250],
            [['id_goods'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_goods' => 'Id Goods',
            'name_of_goods' => 'Name Of Goods',
            'size' => 'Size',
            'packing_size' => 'Packing Size',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Lefts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLefts()
    {
        return $this->hasMany(Lefts::class, ['id_goods' => 'id_goods']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id_goods' => 'id_goods']);
    }
}
