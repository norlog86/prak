<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lefts".
 *
 * @property int $id_shop
 * @property int $id_goods
 * @property string $date
 * @property int $lefts
 *
 * @property Goods $goods
 * @property Shop $shop
 */
class Lefts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lefts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_shop', 'id_goods', 'date', 'lefts'], 'required'],
            [['id_shop', 'id_goods', 'lefts'], 'default', 'value' => null],
            [['id_shop', 'id_goods', 'lefts'], 'integer'],
            [['date'], 'safe'],
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
            'id_shop' => 'Id Shop',
            'id_goods' => 'Id Goods',
            'date' => 'Date',
            'lefts' => 'Lefts',
        ];
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
