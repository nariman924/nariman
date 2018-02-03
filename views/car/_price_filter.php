<?php

use yii\bootstrap\Html;

/** @var $model \app\models\CarSearch */
?>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">от</span>
            <?= Html::input(
                'number',
                Html::getInputName($model, 'from_price'),
                Html::getAttributeValue($model, 'from_price'),
                ['class' => 'form-control']
            ) ?>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">до</span>
            <?= Html::input(
                'number',
                Html::getInputName($model, 'to_price'),
                Html::getAttributeValue($model, 'to_price'),
                ['class' => 'form-control']
            ) ?>
        </div>
    </div>

