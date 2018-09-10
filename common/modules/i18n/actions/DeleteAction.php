<?php

namespace common\modules\i18n\actions;

use yii\base\Action;
use yii\base\Model;
use yii\base\ErrorException;
use yii\web\BadRequestHttpException;
use common\modules\i18n\Module;
use yii\helpers\Url;

class DeleteAction extends Action
{
    /**
     * @var Model
     */
    public $modelClass;

    /**
     * @var string
     */
    public $redirectRoute = 'update';

    /**
     * @var string
     */
    public $attributeId = 'model_id';

    /**
     * @param $id
     * @param $lang_id
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     * @throws ErrorException
     */
    public function run($id, $lang_id)
    {
        if (!$this->modelClass) {
            throw new ErrorException('Params $modelClass not defined');
        }

        if($lang_id == Module::getDefaultLanguage()) {
            throw new BadRequestHttpException('You can\'t delete default translate');
        }

        $this->modelClass::deleteAll([
            $this->attributeId => $id,
            'lang_id' => $lang_id,
        ]);

        return $this->controller->redirect(Url::toRoute([$this->redirectRoute, 'id' => $id]));
    }
}
