<?php

use yii\db\Migration;

/**
 * Class m180725_062438_add_seo_page
 */
class m180816_123238_add_seo_page extends Migration
{

    public $pages = [
        [
            'route' => 'site/index',
            'url' => '/',
        ]
    ];
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach($this->pages as $page) {
            $page = new \common\modules\seo\models\Page([
                'url' => $page['url'],
                'route' => $page['route'],
            ]);
            $page->save(false);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach($this->pages as $page) {
            $this->delete(\common\modules\seo\models\Page::tableName(), [
                'url' => $page['url'],
                'route' => $page['route']
            ]);
        }
    }
}
