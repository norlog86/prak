<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'str_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\DictStr::getStr(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите',
            'onchange' => 'stadart_changed(this)',
        ],
        'pluginOptions' => [],
    ]); ?>

    <?= $form->field($model, 'emp_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\DictEmployee::getEmp(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите',
            'onchange' => 'stadart_changed(this)',
        ],
        'pluginOptions' => [],
    ]); ?>

    <?= $form->field($model, 'art_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\DictArt::getArt(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите',
            'onchange' => 'stadart_changed(this)',
        ],
        'pluginOptions' => [],
    ]); ?>

    <?= $form->field($model, 'order_date')->widget(\kartik\date\DatePicker::classname(), [
        'value' => date('d-M-Y', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите дату',
        ],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'todayHighlight' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'amount')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
