<?php

namespace evolun\post\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use evolun\post\models\Post;

/**
 * PostSearch represents the model behind the search form of `app\models\Post`.
 */
class PostSearch extends Post
{
    public $searchString;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['searchString'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // elkerjuk a felhasznalo role-jait (es az alatta levoket is)
        $roles = ArrayHelper::getColumn(Yii::$app->authmanager->getChildRoles(Yii::$app->user->identity->role), 'name');

        $query->where(['or',
            ['is', 'role', null],
            ['in', 'role', $roles],
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ],
            'sort' => [
                'defaultOrder' => ['title' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['or',
            ['like', 'content', $this->searchString],
            ['like', 'lead', $this->searchString],
            ['like', 'title', $this->searchString]]);

        return $dataProvider;
    }
}
