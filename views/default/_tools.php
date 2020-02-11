<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php if (Yii::$app->user->can('managePosts')): ?>
    <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('post', 'New post'), ['create'], ['class' => 'btn btn-success pull-left', 'style' => 'margin-right: 10px']) ?>
<?php endif ?>

<?php $form = ActiveForm::begin(['method' => 'get']); ?>
    <div class="input-group">
        <?= $form->field($searchModel, 'searchString', ['options' => ['tag' => false], 'inputOptions' => ['placeholder' => Yii::t('post', 'Search post by title, or content')]])->label(false) ?>
        <div class="input-group-btn">
            <?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

