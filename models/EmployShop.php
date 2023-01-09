<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employ_shop".
 *
 * @property int $id_empshp
 * @property int $id_employ
 * @property int $id_shop
 *
 * @property Employs $employ
 * @property Shop $shop
 */
class EmployShop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employ_shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empshp', 'id_employ', 'id_shop'], 'required'],
            [['id_empshp', 'id_employ', 'id_shop'], 'default', 'value' => null],
            [['id_empshp', 'id_employ', 'id_shop'], 'integer'],
            [['id_employ'], 'exist', 'skipOnError' => true, 'targetClass' => Employs::class, 'targetAttribute' => ['id_employ' => 'id_employ']],
            [['id_shop'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::class, 'targetAttribute' => ['id_shop' => 'id_shop']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_empshp' => 'Id Empshp',
            'id_employ' => 'Id Employ',
            'id_shop' => 'Id Shop',
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
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id_shop' => 'id_shop']);
    }
}
