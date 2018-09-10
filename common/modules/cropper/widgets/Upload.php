<?php

namespace common\modules\cropper\widgets;

use Yii;
use yii\helpers\Json;
use yii\jui\JuiAsset;
use yii\bootstrap\Modal;
use common\modules\cropper\assets\{UploadAsset, CropperAsset};

/**
 * Class Upload
 * @package backend\components\widget
 */
class Upload extends \trntv\filekit\widget\Upload
{
    /**
     * @var string
     */
    public $messagesCategory = 'widget';

    protected function registerMessages(){
        if (array_key_exists($this->messagesCategory, Yii::$app->i18n->translations)) {
            Yii::$app->i18n->translations[$this->messagesCategory] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => __DIR__ . '/messages',
                'fileMap' => [
                    $this->messagesCategory => 'filekit/widget.php'
                ],
            ];
        }
    }

    public function run()
    {
        Modal::begin([
            'header'=>'<h4 class="modal-title">' . \Yii::t('backend', 'Crop') . '</h4>',
            'id'=>'crop-modal',
            'size'=>'large',
            'footer'=>'<button type="button" class="btn btn-default" data-dismiss="modal">' .
                     \Yii::t('backend', 'Закрыть') . '
                </button>
                <button type="button" class="btn btn-primary" id="save">' .
                    \Yii::t('backend', 'Обрезать') . '
                </button>',
        ]);

        echo '<div class="row">
                <div class="col-lg-8 col-xs-6">
                    <div class="img-container" style="">
                        <img src="" id="crop-cover-photo" alt=""/>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div id="preview-pane" >
                        <div class="preview-container preview"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 has-error">
                    <p class="help-block"></p>
                </div>
            </div>';
        Modal::end();

        return parent::run();
    }

    /**
     * Registers required script for the plugin to work as jQuery File Uploader
     */
    public function registerClientScript()
    {
        UploadAsset::register($this->getView());
        if(isset($this->clientOptions['crop']) && $this->clientOptions['crop'] == true) {
            CropperAsset::register($this->getView());
        }

        $options = Json::encode($this->clientOptions);
        if ($this->sortable) {
            JuiAsset::register($this->getView());
        }
        $this->getView()->registerJs("jQuery('#{$this->getId()}').yiiUploadKit({$options});");
    }
}
