<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rests $model */

$this->title = 'Create Rests';
$this->params['breadcrumbs'][] = ['label' => 'Rests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
