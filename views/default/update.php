<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model evolun\post\models\Post */

$this->title = Yii::t('post', 'Edit post: {title}', ['title' => $model->title]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['pageHeader'] = ['title' => $this->title];
$this->params['breadcrumbs'][] = Yii::t('post', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
