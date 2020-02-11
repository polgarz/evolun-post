<?php
namespace evolun\post\widgets;

use Yii;
use evolun\post\models\Post;
use yii\data\ActiveDataProvider;

class PostListWidget extends \yii\bootstrap\Widget
{
    public $limit = 3;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy('updated_at DESC')->limit($this->limit),
            'pagination' => false
        ]);

        return $this->render('post-list', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
