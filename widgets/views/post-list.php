<?php
use yii\widgets\ListView;
use yii\helpers\Url;
?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['tag' => 'div', 'class' => 'list-group'],
    'itemOptions' => ['tag' => false],
    'itemView' => function($model) { return '
        <a href="' . Url::to(['post/default/view', 'id' => $model->id]) . '" class="list-group-item">
            <h4 class="list-group-item-heading">' . $model->title . '</h4>
            <p class="list-group-item-text">' . $model->lead . '</p>
        </a>
        '; },
    'summary' => '',
]) ?>


