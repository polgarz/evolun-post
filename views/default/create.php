<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model evolun\post\models\Post */

$this->title = 'Új bejegyzés';
$this->params['breadcrumbs'][] = ['label' => 'Bejegyzések', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = ['title' => $this->title];

?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>