<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property int $id_shop
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 *
 * @property EmployShop[] $employShops
 * @property Lefts[] $lefts
 * @property Orders[] $orders
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_shop', 'address', 'latitude', 'longitude'], 'required'],
            [['id_shop'], 'default', 'value' => null],
            [['id_shop'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['address'], 'string', 'max' => 200],
            [['id_shop'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_shop' => 'Id Shop',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * Gets query for [[EmployShops]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployShops()
    {
        return $this->hasMany(EmployShop::class, ['id_shop' => 'id_shop']);
    }

    /**
     * Gets query for [[Lefts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLefts()
    {
        return $this->hasMany(Lefts::class, ['id_shop' => 'id_shop']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id_shop' => 'id_shop']);
    }
}
