<?php

use app\models\Car;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Car */

$this->title = $model->title;

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cars'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-view">

    <h1><?= Html::encode($this->title) ?></h1>
<!-- Не по ТЗ
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'status',
                'value' => $model->getStatus(),
            ],
            [
                'attribute' => 'categoryId',
                'format' => 'html',
                'value' => $model->getCategory(),
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(
                        Yii::getAlias(Car::UPLOAD_BASE_URL) . $data->image,
                        ['width' => '100px']
                    );
                },
            ],
            'price',
            [
                'attribute' => 'url',
                'format' => 'url',
                'value' => $model->getLink(),
            ],
            'year',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
