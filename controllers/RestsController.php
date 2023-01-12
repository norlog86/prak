<?php

namespace app\controllers;

use app\models\Rests;
use app\models\RestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestsController implements the CRUD actions for Rests model.
 */
class RestsController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Rests models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RestsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rests model.
     * @param string $rests_date Rests Date
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rests_date)
    {
        return $this->render('view', [
            'model' => $this->findModel($rests_date),
        ]);
    }

    /**
     * Creates a new Rests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rests();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'rests_date' => $model->rests_date]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $rests_date Rests Date
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rests_date)
    {
        $model = $this->findModel($rests_date);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rests_date' => $model->rests_date]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rests model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $rests_date Rests Date
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rests_date)
    {
        $this->findModel($rests_date)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $rests_date Rests Date
     * @return Rests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rests_date)
    {
        if (($model = Rests::findOne(['rests_date' => $rests_date])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
