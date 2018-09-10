<?php

namespace backend\modules\system\controllers;

use Yii;
use yii\web\Controller;
use common\modules\keyStorage\components\FormModel;
use trntv\filekit\widget\Upload;

class SettingsController extends Controller
{
    private $maxFileSize = 500000; //10 MiB

    public function actionIndex()
    {
        $imageLogo = null;
        $logoPath = Yii::$app->keyStorage->get('frontend.image.logo');
        if(!empty($logoPath)) {
            $imageLogo = [[
                'path' => $logoPath,
                'type' => 'image/jpeg',
                'base_url' => Yii::$app->fileStorage->baseUrl,
            ]];
        }

        $model = new FormModel([
            'keys' => [
                'frontend.scripts.head' => [
                    'label' => Yii::t('backend', 'Google analytics script(head)'),
                    'type' => FormModel::TYPE_TEXTAREA,
                ],
                'frontend.scripts.body' => [
                    'label' => Yii::t('backend', 'Google analytics script(body)'),
                    'type' => FormModel::TYPE_TEXTAREA,
                ],
                'frontend.image.logo' => [
                    'label' => Yii::t('backend', 'Logo image'),
                    'type' => FormModel::TYPE_WIDGET,
                    'widget' => Upload::class,
                    'options' => [
                        'url' => ['/file/storage/upload'],
                        'maxFileSize' => $this->maxFileSize, // 10 MiB
                        'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(svg|png)$/i'),
                        'files' => $imageLogo,
                    ],
                ],
            ],
        ]);

        $data = Yii::$app->request->post();
        if (isset($data['FormModel']['frontendImageLogo']['path'])) {
            $data['FormModel']['frontendImageLogo'] = $data['FormModel']['frontendImageLogo']['path'];
        }

        if ($model->load($data) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success'],
            ]);

            return $this->refresh();
        }

        return $this->render('index', ['model' => $model]);
    }
}