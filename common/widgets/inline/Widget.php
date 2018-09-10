<?php

namespace common\widgets\inline;

use common\widgets\inline\assets\TinyMceAsset;
use yii\helpers\Html;
use yii\web\AssetBundle;

class Widget extends \yii\base\Widget
{
    /**
     * @var array the options for the Imperavi Redactor.
     * Please refer to the corresponding [Imperavi Web page](http://imperavi.com/redactor/docs/)  for possible options.
     */
    public $options = [];

    /**
     * @var array the html options.
     */
    public $htmlOptions = [];

    /**
     * @var array plugins that you want to use
     */
    public $plugins = [];

    /*
     * @var object model for active text area
     */
    public $model = null;

    /*
     * @var string selector for init js scripts
     */
    protected $selector = null;

    /*
     * @var string name of textarea tag or name of attribute
     */
    public $attribute = null;

    /*
     * @var string value for text area (without model)
     */
    public $value = '';

    /**
     * @var \yii\web\AssetBundle|null Imperavi Redactor Asset bundle
     */
    protected $_assetBundle = null;

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->htmlOptions['id'])) {
            $this->htmlOptions['id'] = $this->getId();
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->selector = '.' . $this->getInputSelectorName();

        $model = $this->model;
        $options = $this->htmlOptions;
        $attribute = $this->attribute;

        $name = isset($options['name']) ? $options['name'] : Html::getInputName($model, $attribute);
        if (isset($options['value'])) {
            $value = $options['value'];
            unset($options['value']);
        } else {
            $value = Html::getAttributeValue($model, $attribute);
        }
//        if (!array_key_exists('id', $options)) {
//            $options['id'] = Html::getInputId($model, $attribute);
//        }
        $options['id'] = $name;
        $options['class'] = $this->getInputSelectorName() . ' form-control';

        echo Html::tag('div', $value, $options);

        $this->registerRedactorAsset();
        $this->registerClientScript();
    }

    /**
     * @return string
     */
    public function getInputSelectorName()
    {
        return sprintf('_tinymce_inline_%s', $this->id);
    }

    /**
     * Registers Imperavi Redactor asset bundle
     */
    protected function registerRedactorAsset()
    {
        $this->_assetBundle = TinyMceAsset::register($this->getView());
    }

    /**
     * Returns current asset bundle
     * @return \yii\web\AssetBundle current asset bundle for Redactor
     */
    protected function getAssetBundle()
    {
        if (!($this->_assetBundle instanceof AssetBundle)) {
            $this->registerRedactorAsset();
        }

        return $this->_assetBundle;
    }

    /**
     * Registers Imperavi Redactor JS
     */
    protected function registerClientScript()
    {
        $view = $this->getView();

//        $options = empty($this->options) ? '' : Json::encode($this->options);
        $view->registerJs("
            jQuery(function() {
                if (typeof tinymce != 'undefined' && tinymce != null) {
                    tinymce.remove('div{$this->selector}');
                }
                
                tinymce.init({
                    selector: 'div{$this->selector}',
                    inline: true,
                    toolbar: 'bold italic superscript',
                    menubar: false,
                    plugins : 'paste',
                    forced_root_block: '',
                    force_br_newlines: true,
                    force_p_newlines: false,
                    paste_auto_cleanup_on_paste : true,
                    paste_remove_styles: true,
                    paste_remove_styles_if_webkit: true,
                    paste_strip_class_attributes: true,
                    paste_preprocess: function(pl, o) {
                        //example: keep bold,italic,underline and paragraphs
                        //o.content = strip_tags( o.content,'<b><u><i><p>' );
            
                        // remove all tags => plain text
                        o.content = strip_tags( o.content,'' );
                    }
                });
            
                function strip_tags(str, allowed_tags) {
            
                    var key = '', allowed = false;
                    var matches = [];
                    var allowed_array = [];
                    var allowed_tag = '';
                    var i = 0;
                    var k = '';
                    var html = '';
                    var replacer = function (search, replace, str) {
                        return str.split(search).join(replace);
                    };
                    // Build allowes tags associative array
                    if (allowed_tags) {
                        allowed_array = allowed_tags.match(/([a-zA-Z0-9]+)/gi);
                    }
                    str += '';
            
                    // Match tags
                    matches = str.match(/(<\/?[\S][^>]*>)/gi);
                    // Go through all HTML tags
                    for (key in matches) {
                        if (isNaN(key)) {
                            // IE7 Hack
                            continue;
                        }
            
                        // Save HTML tag
                        html = matches[key].toString();
                        // Is tag not in allowed list? Remove from str!
                        allowed = false;
            
                        // Go through all allowed tags
                        for (k in allowed_array) {            // Init
                            allowed_tag = allowed_array[k];
                            i = -1;
            
                            if (i != 0) {
                                i = html.toLowerCase().indexOf('<' + allowed_tag + '>');
                            }
                            if (i != 0) {
                                i = html.toLowerCase().indexOf('<' + allowed_tag + ' ');
                            }
                            if (i != 0) {
                                i = html.toLowerCase().indexOf('</' + allowed_tag);
                            }
            
                            // Determine
                            if (i == 0) {
                                allowed = true;
                                break;
                            }
                        }
                        if (!allowed) {
                            str = replacer(html, \"\", str); // Custom replace. No regexing
                        }
                    }
                    return str;
                }
            });
        ");
    }
}

