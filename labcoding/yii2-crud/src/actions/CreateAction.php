<?php

namespace labcoding\crud\actions;

use Yii;
use yii\base\Action;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class CreateAction extends Action
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
    public $redirectCurrent;

    /**
     * @var array
     */
    public $params = [];

    /**
     * @var string
     */
    public $view = '@app/modules/crud/views/create';

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
//die(var_dump(Yii::$app->request->post()));
        if ($this->model->load(Yii::$app->request->post()) && $this->model->save()) {

            Yii::$app->session->setFlash('alert', [
                'body' => \Yii::t('backend', 'Data successfully saved'),
                'options' => ['class' => 'alert-success'],
            ]);

            if(\Yii::$app->request->post('save_and_stay') !== null) {
                if(is_callable($this->redirectCurrent)) {
                    $this->redirectCurrent = call_user_func($this->redirectCurrent, $this->model);
                }
                if(empty($this->redirectCurrent)) {
                    $this->redirectCurrent = Url::toRoute(['update', 'id' => $this->model->id]);
                }

                return $this->controller->redirect($this->redirectCurrent);
            }

            if(is_callable($this->redirect)) {
                $this->redirect = call_user_func($this->redirect, $this->model);
            }

            return $this->controller->redirect($this->redirect);
        } else {

            if(is_callable($this->params)) {
                $this->params = call_user_func($this->params, $this->model);
            }

            $params = ArrayHelper::merge([
                'model' => $this->model,
            ], $this->params);

            return $this->controller->render($this->view, $params);
        }
    }

}
