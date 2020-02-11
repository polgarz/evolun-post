<?php
namespace evolun\post\widgets;

use Yii;
use evolun\post\models\Post;
use yii\data\ActiveDataProvider;

class PostListWidget extends \yii\bootstrap\Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy('updated_at DESC')->limit(3),
            'pagination' => false
        ]);

        return $this->render('post-list', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
