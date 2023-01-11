<?php

namespace app\controllers;

use app\models\DictWhs;
use app\models\Orders;
use app\models\OrdersSearch;
use app\models\StrWhsLnk;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param string $order_date Order Date
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($order_date)
    {
        $order = $this->findModel($order_date);
        $swl = StrWhsLnk::findOne(['str_id'=>$order->str_id]);

        $whs = DictWhs::findOne(['whs_id' => $swl->whs_id]);
        $whs_lat= $whs->latitude;
        $whs_long = $whs->longitude;
        $whs_ad = $whs->address;
        return $this->render('view', [
            'model' => $this->findModel($order_date),
            'whs_lat' => $whs_lat,
            'whs_long' => $whs_long,
            'whs_ad' => $whs_ad,
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'order_date' => $model->order_date]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $order_date Order Date
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($order_date)
    {
        $model = $this->findModel($order_date);


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'order_date' => $model->order_date]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $order_date Order Date
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($order_date)
    {
        $this->findModel($order_date)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $order_date Order Date
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($order_date)
    {
        if (($model = Orders::findOne(['order_date' => $order_date])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
