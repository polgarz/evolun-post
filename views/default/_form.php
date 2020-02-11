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

        <?= $form->field($model, 'lead')->textarea(['maxlength' => 300])->hint(Yii::t('post', 'This will be shown in the lists, below the title. Max. 300 characters')) ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6, 'id' => 'summernote']) ?>

        <?= $form->field($model, 'role')->dropdownList(ArrayHelper::map(Yii::$app->authmanager->getChildRoles(Yii::$app->user->identity->role), 'name', 'description'), ['prompt' => Yii::t('post', 'Everybody')])->hint(Yii::t('post', 'If the user is lower in the role-hierarchy, they will not be able to see this post')) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('post', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
