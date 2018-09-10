<?php

namespace common\modules\redirect\controllers;

use yii\web\Controller;
use common\modules\redirect\models\{Redirect, search\RedirectSearch};
use labcoding\crud\actions\{UpdateAction, CreateAction, ListAction, DeleteAction};

/**
 * Page controller for the `redirect` module
 */
class RedirectController extends Controller
{
    public $defaultAction = 'list';

    public function actions()
    {
        return [
            'list' => [
                'class' => ListAction::class,
                'filterModel' => new RedirectSearch(),
                'view' => '@common/modules/redirect/views/redirect/list',
            ],
            'create' => [
                'class' => CreateAction::class,
                'model' => new Redirect(),
                'view' => '@common/modules/redirect/views/redirect/create',
                'redirect' => 'list',
            ],
            'update' => [
                'class' => UpdateAction::class,
                'model' => new Redirect(),
                'view' => '@common/modules/redirect/views/redirect/update',
                'redirect' => 'list',
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'model' => new Redirect(),
                'redirect' => 'list',
            ],
        ];
    }
}
