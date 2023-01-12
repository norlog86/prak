<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tickets $model */

$this->title = $model->ticket_id;
$this->params['breadcrumbs'][] = ['label' => 'Запланированная поездка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tickets-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            'ticket_id',
            'drv.drv_name',
            'status',
        ],
    ]) ?>

</div>
