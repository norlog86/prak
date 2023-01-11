<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dict_employee".
 *
 * @property string $emp_id
 * @property string $security_lvl
 * @property string $login
 * @property string $password
 *
 * @property EmpStrLnk[] $empStrLnks
 * @property Orders[] $Orders
 * @property DictStr[] $strs
 * @property string $token [varchar(100)]
 */
class DictEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dict_employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'security_lvl', 'login', 'password'], 'required'],
            [['emp_id'], 'string'],
            [['security_lvl', 'login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32],
            [['emp_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'security_lvl' => 'Должность',
            'login' => 'ФИО',
            'password' => 'Пароль',
        ];
    }

    /**
     * Gets query for [[EmpStrLnks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpStrLnks()
    {
        return $this->hasMany(EmpStrLnk::class, ['emp_id' => 'emp_id']);
    }

    /**
     * Gets query for [[FactOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['emp_id' => 'emp_id']);
    }

    /**
     * Gets query for [[Strs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrs()
    {
        return $this->hasMany(DictStr::class, ['str_id' => 'str_id'])->viaTable('emp_str_lnk', ['emp_id' => 'emp_id']);
    }

    public static function getEmp()
    {
        $query = (new Query())
            ->select(['emp_id', 'login'])
            ->from(['dict_employee']);
        return ArrayHelper::map($query->all(), 'emp_id', 'login');

    }
}
