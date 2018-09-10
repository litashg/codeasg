<?php

namespace common\modules\file\controllers;

use alexantr\elfinder\ConnectorAction;
use Yii;
use yii\web\Controller;

class ManagerController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'connector' => [
                'class' => ConnectorAction::class,
                'options' => [
                    'disabledCommands' => ['netmount'],
                    'connectOptions' => [
                        'filter'
                    ],
                    'roots' => [
                        [
                            'driver' => 'LocalFileSystem',
                            'path' => Yii::getAlias('@frontend/web'),
                            'URL' => Yii::getAlias('@frontendUrl'),
                            'attributes' => array(
                               [
                                    'pattern' => '/[.]/',
                                    'read' => true,
                                    'write' => true,
                                    'hidden' => false,
                                ],
                                [
                                    'pattern' => '/[a-zA-Z_][0-9a-zA-Z_]*/',
                                    'read' => false,
                                    'write' => false,
                                    'hidden' => true,
                                ],
                            ),
                            'uploadAllow' => ["text/plain"],
                            'uploadDeny' => [
                                "all"
                            ],
                        ],
                    ],
                ],
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}