<?php
use app\models\Car;
use yii\bootstrap\Html;

/** @var $model \app\models\CarSearch */

?>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">от</span>
            <?= Html::dropDownList(
                Html::getInputName($model, 'from_year'),
                Html::getAttributeValue($model, 'from_year') ?? date('Y') - 30,
                Car::getYears(), ['class' => 'form-control']
            ) ?>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">до</span>
        <?= Html::dropDownList(
            Html::getInputName($model, 'to_year'),
            Html::getAttributeValue($model, 'to_year') ?? date('Y') + 3,
            Car::getYears(), ['class' => 'form-control']
        ) ?>
        </div>
    </div>

