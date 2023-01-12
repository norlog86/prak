pip install psycopg2
pip install schedule

import psycopg2
import schedule
import time
import sys

print(sys.argv)

x = sys.argv[1]

conn = psycopg2.connect(dbname='DD', user='postgres',
                        password='admin', host='localhost')

def job(x):
    cursor = conn.cursor()
    cursor.execute("""insert into public.fact_tickets
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
	where fo.order_date = %(x)s
	and ftc.order_id is null
),
order_stacks as
(
	select
	  fo.order_id
	, fo.str_id
	, fo.art_id
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
	, stacks_num*stack_volume as volume
	from order_stacks
),
str_volume as
(
	select
	  order_id
	, str_id
	, sum(volume) as str_vlm
	from order_volume
	group by 1,2
),
order_rank as
(
	select
	  order_id
	, str_id
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
	, pra.vhcl_id
	from order_rank ora
	join park_rank pra
		on pra.str_id = ora.str_id
		and pra.rn = ora.rn
)
select
  pt.order_id
, (pt.order_id || '-' || dd.drv_id)::uuid as ticket_id
, dd.drv_id
, 'Оформлено'
from pre_tickets pt
join drv_vhcl_lnk dvl
	on dvl.vhcl_id = pt.vhcl_id
join dict_drv dd
	on dd.drv_id = dvl.drv_id
	and drv_schedule like '%' || extract (dow from %(x)s) || '%'
	""")
    cursor.close()
    conn.close()
    schedule.every(1).day.do(job)

while True:
    schedule.run_pending()
    time.sleep(1)