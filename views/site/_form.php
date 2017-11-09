<?php
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
use yii\widgets\Pjax;

$this->registerJs(
        '$("document").ready(function(){
                $("#new-file").on("pjax:end", function() {
                $.pjax.reload({container:"#file-list"});
            });
        });'
    );
?>

<div class="row">
    <div class="col-lg-6">
    <?php Pjax::begin(['id' => 'new-file']) ?>
        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'uploadedFile')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app','Submit'), ['class' => 'btn btn-primary', 'name' => 'button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
    </div>
</div>
