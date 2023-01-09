<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id_order
 * @property int $id_shop
 * @property int $id_employ
 * @property int $id_goods
 * @property string $date
 * @property float $quantity
 *
 * @property Employs $employ
 * @property Goods $goods
 * @property Shop $shop
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order', 'id_shop', 'id_employ', 'id_goods', 'date', 'quantity'], 'required'],
            [['id_order', 'id_shop', 'id_employ', 'id_goods'], 'default', 'value' => null],
            [['id_order', 'id_shop', 'id_employ', 'id_goods'], 'integer'],
            [['date'], 'safe'],
            [['quantity'], 'number'],
            [['id_employ'], 'exist', 'skipOnError' => true, 'targetClass' => Employs::class, 'targetAttribute' => ['id_employ' => 'id_employ']],
            [['id_goods'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::class, 'targetAttribute' => ['id_goods' => 'id_goods']],
            [['id_shop'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::class, 'targetAttribute' => ['id_shop' => 'id_shop']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'id_shop' => 'Id Shop',
            'id_employ' => 'Id Employ',
            'id_goods' => 'Id Goods',
            'date' => 'Date',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Employ]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmploy()
    {
        return $this->hasOne(Employs::class, ['id_employ' => 'id_employ']);
    }

    /**
     * Gets query for [[Goods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::class, ['id_goods' => 'id_goods']);
    }

    /**
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id_shop' => 'id_shop']);
    }
}
