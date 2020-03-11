<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model evolun\post\models\Post */

$this->title = Yii::t('post', 'New post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = ['title' => $this->title];

?>

<?= $this->render('_form', [
    'model' => $model,
]);
