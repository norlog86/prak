<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dict_art".
 *
 * @property string $art_id
 * @property float|null $volume
 * @property float|null $stack_volume
 * @property float|null $cnt_in_stack
 *
 * @property FactOrders[] $factOrders
 * @property FactStrRests[] $factStrRests
 */
class DictArt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dict_art';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['art_id'], 'required'],
            [['art_id'], 'string'],
            [['volume', 'stack_volume', 'cnt_in_stack'], 'number'],
            [['art_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'art_id' => 'Art ID',
            'volume' => 'Объем',
            'stack_volume' => 'Объем упаковки',
            'cnt_in_stack' => 'Количество в упаковке',
        ];
    }

    /**
     * Gets query for [[FactOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['art_id' => 'art_id']);
    }

    /**
     * Gets query for [[FactStrRests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFactStrRests()
    {
        return $this->hasMany(FactStrRests::class, ['art_id' => 'art_id']);
    }

    public static function getArt()
    {
        $query = (new Query())
            ->select(['art_id', 'volume'])
            ->from(['dict_art']);
        return ArrayHelper::map($query->all(), 'art_id', 'volume');

    }
}
