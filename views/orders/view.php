<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<script
    src="https://api-maps.yandex.ru/2.0/?load=package.standard,package.route&amp;lang=ru-RU&amp;apikey=0b88befe-f4d0-482f-93db-e6c55b0f88ab"
    type="text/javascript"></script>
<script src="https://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=0b88befe-f4d0-482f-93db-e6c55b0f88ab"
        type="text/javascript"></script>
<style>
    html, body, #map {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }
</style>
<script>
    function init() {
        var multiRoute = new ymaps.multiRouter.MultiRoute({
            // Описание опорных точек мультимаршрута.
            referencePoints: [
                [<?= $whs_lat ?>, <?= $whs_long ?>],
                [<?= $model->str->latitude?>, <?= $model->str->longitude?>]
            ],
        }, {
            // Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
            boundsAutoApply: true
        });
        // Создаем карту с добавленными на нее кнопками.
        var myMap = new ymaps.Map('map', {
            center: [<?= $whs_lat ?>, <?= $whs_long ?>],
            zoom: 7
        });

        // Добавляем мультимаршрут на карту.
        myMap.geoObjects.add(multiRoute);
    }

    ymaps.ready(init);

</script>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'emp.login',
            'emp.security_lvl',
            'art.volume',
            'art.stack_volume',
            'art.cnt_in_stack',
            'str.address',
            'amount',
        ],
    ]) ?>
    <div style="padding-left:30%; padding-right: 30%">
        <p>Заказ из <?= $whs_ad?> на <?= $model->str->address?></p>
        <div  id="map" style="width:400px; height:300px;"></div>
    </div>

</div>
