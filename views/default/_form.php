<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use evolun\post\assets\PostAsset;

/* @var $this yii\web\View */
/* @var $model evolun\post\models\Post */
/* @var $form yii\widgets\ActiveForm */

PostAsset::register($this);
?>

<div class="box box-default">

    <div class="box-body">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lead')->textarea(['maxlength' => 300])->hint('Ez jelenik meg a listákban, a cím alatt. Maximum 300 karakter.') ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6, 'id' => 'summernote']) ?>

        <?= $form->field($model, 'role')->dropdownList(ArrayHelper::map(Yii::$app->authmanager->getChildRoles(Yii::$app->user->identity->role), 'name', 'description'), ['prompt' => 'Mindenki'])->hint('Az itt beállított jogosultsággal, és a hierarchiában felette lévőkkel lehet megtekinteni a posztot.') ?>

        <div class="form-group">
            <?= Html::submitButton('Mentés', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
