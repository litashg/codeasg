<?php

namespace labcoding\crud\actions;

use yii\base\Action;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class DeleteAction extends Action
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
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function run($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        if(is_callable($this->redirect)) {
            $this->redirect = call_user_func($this->redirect, $model);
        }

        return $this->controller->redirect($this->redirect);
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
