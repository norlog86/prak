<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fact_tickets".
 *
 * @property string $order_id
 * @property string $ticket_id
 * @property string $drv_id
 * @property string|null $status
 *
 * @property DictDrv $drv
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fact_tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'ticket_id', 'drv_id'], 'string'],
            [['ticket_id'], 'required'],
            [['status'], 'string', 'max' => 50],
            [['ticket_id'], 'unique'],
            [['drv_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictDrv::class, 'targetAttribute' => ['drv_id' => 'drv_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Индивидуальный номер заказа',
            'ticket_id' => 'Номер индивид. поездки',
            'drv_id' => 'Drv ID',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Drv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrv()
    {
        return $this->hasOne(DictDrv::class, ['drv_id' => 'drv_id']);
    }
}
