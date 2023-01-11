<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */

$this->title = $model->order_date;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
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
                [45.089668, 38.991060],
                "Ростовское шоссе, 24/1"
            ],
        }, {
            // Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
            boundsAutoApply: true
        });
        // Создаем карту с добавленными на нее кнопками.
        var myMap = new ymaps.Map('map', {
            center: [45.089668, 38.991060],
            zoom: 7
        }, {
            buttonMaxWidth: 300
        });

        // Добавляем мультимаршрут на карту.
        myMap.geoObjects.add(multiRoute);
    }

    ymaps.ready(init);

</script>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'order_date' => $model->order_date], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'order_date' => $model->order_date], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            'emp.login',
            'emp.security_lvl',
            'art.volume',
            'art.stack_volume',
            'art.cnt_in_stack',
            'str.address',
            'amount',
        ],
    ]) ?>
    <body>
    <div id="map" style="width:400px; height:300px"></div>
    </body>

</div>
