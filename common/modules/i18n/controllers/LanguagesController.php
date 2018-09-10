<?php

namespace common\modules\i18n\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use labcoding\crud\actions\{CreateAction, DeleteAction, ListAction, UpdateAction};
use common\modules\i18n\models\{Lang, search\LangSearch};

class LanguagesController extends Controller
{
    public $defaultAction = 'list';

    public function actions()
    {
        return [
            'list' => [
                'class' => ListAction::class,
                'filterModel' => new LangSearch(),
                'view' => '@common/modules/i18n/views/languages/list',
            ],
            'create' => [
                'class' => CreateAction::class,
                'model' => new Lang(),
                'view' => '@common/modules/i18n/views/languages/create',
                'redirect' => 'list',
            ],
            'update' => [
                'class' => UpdateAction::class,
                'model' => new Lang(),
                'view' => '@common/modules/i18n/views/languages/update',
                'redirect' => 'list',
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'model' => new Lang(),
                'redirect' => 'list',
            ],
        ];
    }

    public function actionOrder()
    {
        $post = Yii::$app->request->post();
        if (isset($post['key'], $post['pos'])) {
            $this->findModel($post['key'])->order($post['pos']);
        }
    }

    /**
     * @param integer $id
     *
     * @return Lang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }
}
