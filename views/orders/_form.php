<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'str_id')->label('Склад доставки')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\DictStr::getStr(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите',
        ],
        'pluginOptions' => [],
    ]); ?>

    <?= $form->field($model, 'emp_id')->label('Выбрать сотрудника')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\DictEmployee::getEmp(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите',
        ],
        'pluginOptions' => [],
    ]); ?>

    <?= $form->field($model, 'art_id')->label('Выбрать товар')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\DictArt::getArt(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите',
        ],
        'pluginOptions' => [],
    ]); ?>

    <?= $form->field($model, 'order_date')->widget(\kartik\date\DatePicker::classname(), [
        'value' => date('dd-mm-yyyy', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите дату',
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true,
        ],
        'language' => 'ru',
    ]); ?>

    <?= $form->field($model, 'amount')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
