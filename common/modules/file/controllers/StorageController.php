<?php

namespace common\modules\file\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\{Controller, NotFoundHttpException};
use common\modules\file\models\{FileStorageItem, search\FileStorageItemSearch};
use trntv\filekit\actions\{DeleteAction, UploadAction};
use Intervention\Image\ImageManagerStatic;

class StorageController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'upload-delete' => ['delete'],
                ],
            ],
        ];
    }

    /** @inheritdoc */
    public function actions()
    {
        return [
            'upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'upload-delete',
                'on afterSave' => [$this, 'crop']
            ],
            'upload-delete' => [
                'class' => DeleteAction::class,
            ],
            'upload-imperavi' => [
                'class' => UploadAction::class,
                'fileparam' => 'file',
                'responseUrlParam' => 'filelink',
                'multiple' => false,
                'disableCsrf' => true,
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileStorageItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC],
        ];
        $components = ArrayHelper::map(
            FileStorageItem::find()->select('component')->distinct()->all(),
            'component',
            'component'
        );
        $totalSize = FileStorageItem::find()->sum('size') ?: 0;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'components' => $components,
            'totalSize' => $totalSize,
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     *
     * @return FileStorageItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileStorageItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * @param $event
     */
    public function crop($event) {
        $cropData = \Yii::$app->request->post('cropData');

        if(isset($cropData) && !empty($cropData)) {
            $file = $event->file;
            $img = ImageManagerStatic::make($file->read())->crop((int)$cropData['width'], (int)$cropData['height'], (int)$cropData['x'], (int)$cropData['y']);
            $file->put($img->encode());
        }
    }
}
