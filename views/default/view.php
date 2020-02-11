<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use evolun\post\assets\PostAsset;

/* @var $this yii\web\View */
/* @var $model evolun\post\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Információk', 'url' => ['index']];
$this->params['pageHeader'] = ['title' => $this->title];
$this->params['breadcrumbs'][] = $this->title;

PostAsset::register($this);
?>
<?php if ($textOnly): ?>
    <div class="container">
        <h1><?= $model->title ?></h1>
        <?= $model->content ?>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-lg-3 col-md-4">
             <!-- Profile Image -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Tulajdonságok</h3>
                </div>

                <div class="box-body">

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b><?= $model->getAttributeLabel('created_at') ?></b> <span class="pull-right"><?= Yii::$app->formatter->asDate($model->created_at, 'long') ?></span>
                        </li>
                        <?php if ($model->created_by): ?>
                            <li class="list-group-item">
                                <b><?= $model->getAttributeLabel('created_by') ?></b> <span class="pull-right"><?= Html::a($model->createdBy->name, ['/user/default/view', 'id' => $model->created_by]) ?></span>
                            </li>
                        <?php endif ?>
                        <li class="list-group-item">
                            <b><?= $model->getAttributeLabel('updated_at') ?></b> <span class="pull-right"><?= Yii::$app->formatter->asDate($model->updated_at, 'long') ?></span>
                        </li>
                        <?php if ($model->updated_by): ?>
                            <li class="list-group-item">
                                <b><?= $model->getAttributeLabel('updated_by') ?></b> <span class="pull-right"><?= Html::a($model->updatedBy->name, ['/user/default/view', 'id' => $model->updated_by]) ?></span>
                            </li>
                        <?php endif ?>
                        <li class="list-group-item">
                            <b><?= $model->getAttributeLabel('role') ?></b>
                            <?php if (!empty($model->role)): ?>
                                <span class="pull-right"><?= Yii::$app->authManager->getRole($model->role)->description ?></span>
                            <?php else: ?>
                                <span class="pull-right">Mindenki</span>
                            <?php endif ?>
                        </li>
                    </ul>
                    <?php if (Yii::$app->user->can('managePosts')): ?>
                        <div class="row">
                            <div class="col-xs-6">
                                <p><?= Html::a('<i class="fa fa-pencil"></i> Módosítás', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?></p>
                            </div>
                            <div class="col-xs-6">
                                <p><?= Html::a('<i class="fa fa-trash"></i> Törlés', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btn-block', 'data-confirm' => 'Biztosan törlöd ezt a bejegyzést? Minden hozzá tartozó adat törlődni fog!']) ?></p>
                            </div>
                        </div>
                    <?php endif ?>

                    <div class="row">
                        <div class="col-xs-6">
                            <?= Html::a('<i class="fa fa-print"></i> Nyomtatás', ['print', 'id' => $model->id], ['class' => 'btn btn-primary btn-block', 'target' => '_blank']) ?>
                        </div>
                        <div class="col-xs-6">
                            <?= Html::a('<i class="fa fa-download"></i> Letöltés', ['download', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-lg-9 col-md-8">
            <div class="box box-default">
                <!-- /.box-header -->
                <div class="box-body clearfix">
                    <?= $model->content ?>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
<?php endif ?>