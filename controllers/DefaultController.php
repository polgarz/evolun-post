<?php

namespace evolun\post\controllers;

use Yii;
use evolun\post\models\Post;
use evolun\post\models\PostSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\helpers\Inflector;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;

/**
 * DefaultController implements the CRUD actions for Post model.
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'delete', 'create', 'view', 'download', 'print'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow'   => true,
                        'roles'   => ['managePosts'],
                    ],
                    [
                        'actions' => ['view', 'index', 'download', 'print'],
                        'allow' => true,
                        'roles' => ['showPosts'],
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'textOnly' => false,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Letolt egy posztot pdf formatumban
     * @param  integer $id a poszt id-ja
     * @return void
     */
    public function actionDownload($id)
    {
        $model = $this->findModel($id);
        $post  = $this->renderPartial('view', [
            'model'    => $model,
            'textOnly' => true,
            ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD,
            'content' => $post,
            'filename' => Inflector::slug($model->title) . '.pdf',
            'cssFile' => '@bower/bootstrap/dist/css/bootstrap.min.css',
            'cssInline' => '',
            'options' => ['title' => $model->title],
            'methods' => [
                'SetHeader' => [$model->title],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    public function actionPrint($id)
    {
        $model = $this->findModel($id);
        return $this->renderAjax('view', [
            'model'    => $model,
            'textOnly' => true,
            ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            // megnezzuk, hogy van-e ra jogosultsaga
            $roles = ArrayHelper::getColumn(Yii::$app->authmanager->getChildRoles(Yii::$app->user->identity->role), 'name');

            if (empty($model->role) || in_array($model->role, $roles)) {
                return $model;
            }
        }

        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
