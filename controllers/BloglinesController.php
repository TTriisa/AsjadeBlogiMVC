<?php

namespace app\controllers;

use Yii;
use app\models\BlogLines;
use app\models\BloglinesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BloglinesController implements the CRUD actions for BlogLines model.
 */
class BloglinesController extends Controller
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
        ];
    }

    /**
     * Lists all BlogLines models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BloglinesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogLines model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlogLines model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new BlogLines();

        if ($model->load(Yii::$app->request->post())) {
			$model->blogID = $id;
			if(!$model->title) {
				$model->title = '';
			}
			$model->save();
            return $this->redirect(['//blogs/update', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
	
	public function actionSavePic($id)
	{
		$img = $_POST['img']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents('images/'.$id.'.jpeg', $data);
	}

    /**
     * Updates an existing BlogLines model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $blogID)
    {
        $model = $this->findModel($id);
        $model->blogID = $blogID;
		
        if ($model->load(Yii::$app->request->post())) {
			if(!$model->title) {
				$model->title = '';
			}
			$model->save();
            return $this->redirect(['//blogs/update', 'id' => $blogID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BlogLines model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the BlogLines model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogLines the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogLines::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
