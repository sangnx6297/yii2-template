<?php

namespace lcssoft\report\controllers;

use lcssoft\report\helpers\Logger;
use Yii;
use lcssoft\report\entity\ReportConfig;
use lcssoft\report\models\search\ReportConfigSeach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ReportConfigController implements the CRUD actions for ReportConfig model.
 */
class ReportConfigController extends Controller
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
     * Lists all ReportConfig models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportConfigSeach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReportConfig model.
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
     * Creates a new ReportConfig model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReportConfig();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReportConfig model.
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
     * Deletes an existing ReportConfig model.
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
     * Finds the ReportConfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReportConfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReportConfig::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAssign()
    {
        $transaction = Yii::$app->db->beginTransaction();
        $type = Yii::$app->request->post('class');
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->load(['ReportConfig' => Yii::$app->request->post()])) {
                $model->assign();
                $transaction->commit();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            Logger::error($e);
        }
        return [
            'available' => $model->getAvailableAccess($type),
            'assigned' => $model->getAssignedAccess($type),
        ];
    }

    public function actionRemove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $type = Yii::$app->request->post('class');
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);

        if ($model->load(['ReportConfig' => Yii::$app->request->post()])) {
            $model->remove();
        }
        return [
            'available' => $model->getAvailableAccess($type),
            'assigned' => $model->getAssignedAccess($type),
        ];

    }
}
