<?php

namespace common\modules\videoBlock\controllers;

use yii\web\Controller;
use common\modules\videoBlock\models\Video;

/**
 * Default controller for the `videoBlock` module
 */
class VideoController extends Controller
{
    public $defaultAction = 'update';

    public function actionUpdate()
    {
        $model = $this->findModel();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {

            \Yii::$app->session->setFlash('alert', [
                'body' => \Yii::t('backend', 'Data successfully saved'),
                'options' => ['class' => 'alert-success'],
            ]);


            return $this->redirect(['update']);
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
    protected function findModel()
    {
        if (($model = Video::find()->one()) !== null) {
            return $model;
        } else {
            return new Video();
        }
    }
}
