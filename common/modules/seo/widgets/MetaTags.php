<?php

namespace common\modules\seo\widgets;

use yii\base\Widget;
use common\modules\seo\models\SeoTrait;

class MetaTags extends Widget
{
    /**
     * @var SeoTrait
     */
    public $model;

    /**
     * @return string|void
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        $this->getView()->title = $this->model->getMetaTitle();

        if ($this->model->getMetaDescription() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'description',
                'content' => $this->model->getMetaDescription(),
            ]);
        }

        if ($this->model->getMetaRobots() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'robots',
                'content' => $this->model->getMetaRobots()
            ]);
        }

        if ($this->model->getVerificationTags() != null) {
            foreach ($this->model->getVerificationTags() as $metaVerificationTag) {
                $this->getView()->registerMetaTag([
                    'name' => $metaVerificationTag['name'],
                    'content' => $metaVerificationTag['content']
                ]);
            }
        }

        if ($this->model->getMetaKeywords() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'keywords',
                'content' => $this->model->getMetaKeywords(),
            ]);
        }

        // fb
        if ($this->model->getMetaTitle() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'og:title',
                'content' => $this->model->getMetaTitle(),
            ]);
        }
        if ($this->model->getMetaDescription() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'og:description',
                'content' => $this->model->getMetaDescription(),
            ]);
        }
        $this->getView()->registerMetaTag([
            'name' => 'og:url',
            'content' => \Yii::$app->urlManagerFrontend->getHostInfo(),
        ]);
        $this->getView()->registerMetaTag([
            'name' => 'og:site_name',
            'content' => \Yii::$app->name,
        ]);

        if ($this->model->getMetaOgImage() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'og:image',
                'content' => $this->model->getMetaOgImage(),
            ]);
            if ($this->model->getMetaTitle() != null) {
                $this->getView()->registerMetaTag([
                    'name' => 'og:image:alt',
                    'content' => $this->model->getMetaTitle(),
                ]);
            }
        }

        // twitter
        $this->getView()->registerMetaTag([
            'name' => 'twitter:card',
            'content' => 'summary_large_image',
        ]);
        if ($this->model->getMetaTitle() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'twitter:title',
                'content' => $this->model->getMetaTitle(),
            ]);
        }
        if ($this->model->getMetaDescription() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'twitter:description',
                'content' => $this->model->getMetaDescription(),
            ]);
        }
        if ($this->model->getMetaTwitterImage() != null) {
            $this->getView()->registerMetaTag([
                'name' => 'twitter:image',
                'content' => $this->model->getMetaTwitterImage(),
            ]);
            if ($this->model->getMetaTitle() != null) {
                $this->getView()->registerMetaTag([
                    'name' => 'twitter:image:alt',
                    'content' => $this->model->getMetaTitle(),
                ]);
            }
        }
    }
}
