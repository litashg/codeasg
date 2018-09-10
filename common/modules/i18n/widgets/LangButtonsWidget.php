<?php

namespace common\modules\i18n\widgets;

use yii\base\{Widget, Model};

class LangButtonsWidget extends Widget
{
    /**
     * @var Model
     */
    public $model;

    /**
     * @var bool
     */
    public $showDeleteButton = false;

    /**
     * @var string
     */
    public $view = '@common/modules/i18n/views/widgets/lang-buttons';

    /**
     * @return string
     */
    public function run()
    {
        $langList = \Yii::$app->getModule('i18n')->getLangList();

        return $this->render($this->view, [
            'showDeleteButton' => $this->showDeleteButton,
            'model' => $this->model,
            'langList' => $langList,
        ]);
    }
}
