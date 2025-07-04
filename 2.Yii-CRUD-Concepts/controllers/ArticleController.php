<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Articles;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\ArticleSearch;
use yii\web\NotFoundHttpException;

/**
 * ArticleController implements the CRUD actions for Articles model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(), // to define allowed HTTP methods for actions
                    'actions' => [
                        'index' => ['GET'],
                        'view' => ['GET'],
                        'create' => ['GET', 'POST'],
                        'update' => ['GET', 'POST'],
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Articles models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articles model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Articles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Articles();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            // var_dump($model->getAttributes()); // Debugging line to check attributes
            // exit; // Remove this line in production

            $uploadedImage = UploadedFile::getInstance($model, 'image');

            if ($uploadedImage) {
                // Define upload directory and filename
                $uploadDir = \Yii::getAlias('@webroot/uploads/');
                $fileName = uniqid('img_') . '.' . $uploadedImage->extension;
                $uploadPath = $uploadDir . $fileName;

                // ✅ Check if directory exists, create if not
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);  // 0755 is secure for production
                }

                // Save the uploaded image
                if ($uploadedImage->saveAs($uploadPath)) {
                    $model->image = 'uploads/' . $fileName; // Save relative path to DB
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                \Yii::error($model->getErrors(), __METHOD__);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Updates an existing Articles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
