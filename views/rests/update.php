<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rests $model */

$this->title = 'Изменить: ' . $model->str->address;
$this->params['breadcrumbs'][] = ['label' => 'Фактический остаток товара в магазине', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rests_date, 'url' => ['view', 'rests_date' => $model->rests_date]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="rests-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
