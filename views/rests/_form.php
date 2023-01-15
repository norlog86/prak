<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Rests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'str_id')->label('Адрес доставки')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\DictStr::getStr(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите',
        ],
        'pluginOptions' => [],
    ]); ?>

    <?= $form->field($model, 'art_id')->label('Объем')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\DictArt::getArt(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите',
        ],
        'pluginOptions' => [],
    ]); ?>
    <?= $form->field($model, 'rests_date')->widget(\kartik\date\DatePicker::classname(), [
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите дату',
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy',
            'todayHighlight' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'rests')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
