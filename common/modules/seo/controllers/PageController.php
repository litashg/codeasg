<?php

namespace common\modules\seo\controllers;

use yii\web\Controller;
use labcoding\crud\actions\{UpdateAction, ListAction};
use common\modules\seo\models\Page;
use common\modules\seo\models\search\PageSearch;

/**
 * Page controller for the `seo` module
 */
class PageController extends Controller
{
    public $defaultAction = 'list';

    public function actions()
    {
        return [
            'list' => [
                'class' => ListAction::class,
                'filterModel' => new PageSearch(),
                'view' => '@common/modules/seo/views/page/list',
            ],
            'update' => [
                'class' => UpdateAction::class,
                'model' => new Page(),
                'view' => '@common/modules/seo/views/page/update',
                'redirect' => 'list',
            ],
        ];
    }
}
