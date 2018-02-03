<?php

use app\models\Car;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Car'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'status',
                'filter' => Car::getStatuses(),
                'value' => function($data) {
                    return $data->getStatus();
                }
            ],
            [
                'attribute' => 'categoryId',
                'filter' => Car::getCategories(),
                'value' => function($data) {
                    return $data->getCategory();
                }
            ],
            'title',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(
                        Yii::getAlias(Car::UPLOAD_BASE_URL) . $data->image,
                        ['width' => '70px']
                    );
                },
            ],
            [
                'attribute' => 'price',
                'filter' => $this->render('_price_filter', ['model' => $searchModel]),
                'headerOptions' => ['class' => 'col-md-2']
            ],
            [
                'attribute' => 'url',
                'format' => 'url',
                'value' => function ($data) {
                    return $data->getLink();
                }
            ],
            [
                'attribute' => 'year',
                'filter' => $this->render('_year_filter', ['model' => $searchModel]),
                'headerOptions' => ['class' => 'col-md-2']
            ],
            'created_at:datetime',
            'updated_at:datetime',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
