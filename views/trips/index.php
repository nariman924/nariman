<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Trips');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trip-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['method' => 'get']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($searchModel, 'airport')->textInput()->label(false) ?>
        </div>
        <div class="col-sm-6">
            <?= Html::submitButton(Yii::t('app','search'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'corporate_id',
            'number',
            'user_id',
            'created_at',
            'updated_at',
            'coordination_at',
            'saved_at',
            'tag_le_id',
            'trip_purpose_id',
            'trip_purpose_parent_id',
            'trip_purpose_desc:ntext',
            'status',
        ],
    ]); ?>
</div>
