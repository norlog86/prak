<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RestsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rests-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'str_id') ?>

    <?= $form->field($model, 'art_id') ?>

    <?= $form->field($model, 'rests_date') ?>

    <?= $form->field($model, 'rests') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
