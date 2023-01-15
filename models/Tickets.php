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


    /**
     * @throws \yii\db\Exception
     */
    public function getCreatTicket()
    {
        $sql = "insert into public.fact_tickets
(
	  order_id
	, ticket_id
	, drv_id
	, status
)
with
    meta as
        (
            select
                fo.order_id
                 , fo.str_id
                 , fo.art_id
                 , fo.order_date
                 , fo.amount
            from public.fact_orders fo
                     left join public.fact_orders ftc
                               on ftc.order_date = fo.order_date
                                   and ftc.str_id = fo.str_id
                                   and ftc.art_id = fo.art_id
                                   and ftc.order_id <> fo.order_id
                     left join public.fact_tickets ftk
                               on ftk.order_id = fo.order_id
            where fo.order_date::date <= '2023-01-12'
              and ftc.order_id is null
              and ftk.order_id is null
        ),
order_stacks as
(
	select
	  fo.order_id
	, fo.str_id
	, fo.art_id
	, fo.order_date
	, da.stack_volume
	, ceil(fo.amount/da.cnt_in_stack) as stacks_num
	from meta fo
	join public.dict_art da
		on da.art_id = fo.art_id
),
order_volume as
(
	select
	  order_id
	, str_id
	, art_id
	, order_date
	, stacks_num*stack_volume as volume
	from order_stacks
),
str_volume as
(
	select
	  order_id
	, str_id
	, order_date
	, sum(volume) as str_vlm
	from order_volume
	group by 1,2,3
),
order_rank as
(
	select
	  order_id
	, str_id
	, order_date
	, row_number() over (partition by str_id order by str_vlm desc) as rn
	from str_volume
),
park_rank as
(
	select
	  swl.str_id
	, wvl.whs_id
	, wvl.vhcl_id
	, row_number() over (partition by swl.str_id order by vhcl.vhcl_vlm desc) as rn
	from whs_vhcl_lnk wvl
	join str_whs_lnk swl
		on swl.whs_id = wvl.whs_id
	join dict_vhcl vhcl
		on vhcl.vhcl_id = wvl.vhcl_id
),
pre_tickets as
(
	select
	  ora.order_id
	, ora.str_id
	, ora.order_date
	, pra.vhcl_id
	from order_rank ora
	join park_rank pra
		on pra.str_id = ora.str_id
		and pra.rn = ora.rn
)
select
  pt.order_id
, md5(pt.order_id || '-' || dd.drv_id)::uuid as ticket_id
, dd.drv_id
, 'Оформлено'
from pre_tickets pt
join drv_vhcl_lnk dvl
	on dvl.vhcl_id = pt.vhcl_id
join dict_drv dd
	on dd.drv_id = dvl.drv_id
	and drv_schedule like '%' || extract (dow from pt.order_date::date) || '%'";
        return Tickets::getDb()->createCommand($sql)->execute();
    }
}
