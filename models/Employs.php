<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employs".
 *
 * @property int $id_employ
 * @property string $access
 * @property string $login
 * @property string $pass
 *
 * @property EmployShop[] $employShops
 * @property Orders[] $orders
 */
class Employs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employ', 'access', 'login', 'pass'], 'required'],
            [['id_employ'], 'default', 'value' => null],
            [['id_employ'], 'integer'],
            [['access', 'login'], 'string', 'max' => 50],
            [['pass'], 'string', 'max' => 32],
            [['id_employ'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_employ' => 'Id Employ',
            'access' => 'Access',
            'login' => 'Login',
            'pass' => 'Pass',
        ];
    }

    /**
     * Gets query for [[EmployShops]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployShops()
    {
        return $this->hasMany(EmployShop::class, ['id_employ' => 'id_employ']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id_employ' => 'id_employ']);
    }
}
