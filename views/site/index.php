<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\XmlFile */
/* @var $dataProvider */
/* @var $filesCount integer*/

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Test task');
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('formSubmitted')): ?>
        <div class="alert alert-success">
            <?= Yii::t('app', 'Upload success!') ?>
        </div>
    <?php endif; ?>
    <?= $this->render('_form', compact('model')) ?>

    <?php Pjax::begin(['id' => 'file-list']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'upload_at:datetime',
                [
                     'attribute' => 'name',
                     'format' => 'raw',
                     'value' => function ($model) {
                           return Html::a($model->name, ['info', 'id' => $model->id]);
                     },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width:60px;'],
                    'header'=>false,
                    'template' => '{delete}',
                ]
            ],
        ]); ?>

        <div>
            <p><?= Yii::t('app', 'Count of files having over 20 unique tags entries: {n}', ['n' => $filesCount])?></p>
        </div>
    <?php Pjax::end() ?>
</div>
