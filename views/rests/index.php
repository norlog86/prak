<?php

use app\models\Rests;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Фактический остаток товара в магазине';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'str.address',
            'art.volume',
            'rests_date',
            'rests',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rests $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'rests_date' => $model->rests_date]);
                 }
            ],
        ],
    ]); ?>


</div>
