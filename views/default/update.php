<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model evolun\post\models\Post */

$this->title = 'Bejegyzés módosítása: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Bejegyzések', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['pageHeader'] = ['title' => $this->title];
$this->params['breadcrumbs'][] = 'Módosítás';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
