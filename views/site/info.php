<?php

/* @var $this yii\web\View */
/* @var $model \app\models\XmlFile */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Info');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped table-bordered">
        <tr><th><?= Yii::t('app', 'Tag Name')?></th><th><?= Yii::t('app', 'Entries')?></th></tr>
        <?php foreach ($model->getTagsForView() as $item) : ?>
            <tr><td><?= $item['tag_name']?></td><td><?= $item['entries']?></td></tr>
        <?php endforeach; ?>
    </table>
</div>
