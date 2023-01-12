<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fact_str_rests".
 *
 * @property string $str_id
 * @property string $art_id
 * @property string|null $rests_date
 * @property float|null $rests
 *
 * @property DictArt $art
 * @property DictStr $str
 */
class Rests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fact_str_rests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['str_id', 'art_id'], 'string'],
            [['rests_date'], 'safe'],
            [['rests'], 'number'],
            [['str_id', 'art_id', 'rests_date'], 'unique', 'targetAttribute' => ['str_id', 'art_id', 'rests_date']],
            [['art_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictArt::class, 'targetAttribute' => ['art_id' => 'art_id']],
            [['str_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictStr::class, 'targetAttribute' => ['str_id' => 'str_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'str_id' => 'Str ID',
            'art_id' => 'Art ID',
            'rests_date' => 'Дата остатка',
            'rests' => 'Остаток',
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
     * Gets query for [[Str]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStr()
    {
        return $this->hasOne(DictStr::class, ['str_id' => 'str_id']);
    }
}
