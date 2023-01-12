<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Rests $model */

$this->title = $model->str->address;
$this->params['breadcrumbs'][] = ['label' => 'Фактический остаток товара в магазине', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rests-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'rests_date' => $model->rests_date], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'rests_date' => $model->rests_date], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Хотите удалить ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'str.address',
            'art.volume',
            'rests_date',
            'rests',
        ],
    ]) ?>

</div>
