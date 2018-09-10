<?php

namespace backend\modules\system\controllers;

use Yii;
use yii\web\Controller;
use common\traits\FormAjaxValidationTrait;
use common\modules\keyStorage\models\KeyStorageItem;
use common\modules\keyStorage\models\search\KeyStorageItemSearch;
use yii\web\NotFoundHttpException;

/**
 * KeyStorageController implements the CRUD actions for KeyStorageItem model.
 */
class KeyStorageController extends Controller
{
    use FormAjaxValidationTrait;

    /**
     * Lists all KeyStorageItem models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new KeyStorageItem();

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $searchModel = new KeyStorageItemSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->sort = [
                'defaultOrder' => ['key' => SORT_DESC],
            ];

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KeyStorageItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the KeyStorageItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return KeyStorageItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KeyStorageItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
