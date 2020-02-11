<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Információk';
$this->params['pageHeader'] = ['title' => $this->title];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-default">

    <div class="box-header">
        <div class="box-tools">
            <?= $this->render('_tools', ['searchModel' => $searchModel]) ?>
        </div>
    </div>

    <div class="box-body table-responsive">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'showHeader' => false,
            'tableOptions' => ['class' => 'table table-hover'],
            'layout' => '{items}{summary}{pager}',
            'columns' => [
                [
                    'attribute' => 'title',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Html::a($model->title, ['view', 'id' => $model->id], ['class' => 'col-link text-default']);
                    },
                ],
            ],
        ]); ?>
    </div>
</div>
