<?php

namespace common\modules\seo\models;

use yii\helpers\HtmlPurifier;

/**
 * Trait SeoTrait
 *
 * @package common\modules\seo\models
 *
 * @property string $metaOgImagePath
 * @property string $metaTwitterImagePath
 *
 * @property string $metaTitle
 * @property string $metaKeywords
 * @property string $metaDescription
 */
trait SeoTrait
{
    /**
     * @var string
     */
    public $meta_og_image;

    /**
     * @var string
     */
    public $meta_twitter_image;

    /**
     * @return string
     */
    public function getMetaTitle(): string
    {
        return HtmlPurifier::process(!empty($this->translation->meta_title) ? $this->translation->meta_title : strip_tags($this->translation->title));
    }

    /**
     * @return string
     */
    public function getMetaKeywords(): string
    {
        return (string)$this->translation->meta_keywords;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return (string)$this->translation->meta_description;
    }

    /**
     * @return string
     */
    public function getMetaOgImage(): string
    {
        if(!empty($this->meta_og_image_path)) {
            return \Yii::$app->fileStorage->baseUrl . '/' . $this->meta_og_image_path;
        }

        return '';
    }

    /**
     * @return string
     */
    public function getMetaTwitterImage(): string
    {
        if(!empty($this->meta_twitter_image_path)) {
            return \Yii::$app->fileStorage->baseUrl . '/' . $this->meta_twitter_image_path;
        }

        return '';
    }
}