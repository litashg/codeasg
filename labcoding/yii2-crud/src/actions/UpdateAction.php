<?php

namespace labcoding\crud\actions;

use Yii;
use yii\base\Action;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class UpdateAction extends Action
{

    /**
     * @var Model
     */
    public $model;

    /**
     * @var array
     */
    public $redirect;

    /**
     * @var array
     */
    public $params = [];

    /**
     * @var string
     */
    public $view = '@app/modules/crud/views/update';

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function run($id)
    {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('alert', [
                'body' => \Yii::t('backend', 'Data successfully saved'),
                'options' => ['class' => 'alert-success'],
            ]);

            if(\Yii::$app->request->post('save_and_stay') !== null) {
                return $this->controller->redirect(Url::current());
            }

            if(is_callable($this->redirect)) {
                $this->redirect = call_user_func($this->redirect, $model);
            }

            return $this->controller->redirect($this->redirect);
        } else {

            if(is_callable($this->params)) {
                $this->params = call_user_func($this->params, $model);
            }

            $params = ArrayHelper::merge([
                'model' => $model,
            ], $this->params);

            if (Yii::$app->request->isAjax) {
                return $this->controller->renderAjax($this->view, $params);
            }
            return $this->controller->render($this->view, $params);
        }
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param $id
     * @return Model
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = $this->model->findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
