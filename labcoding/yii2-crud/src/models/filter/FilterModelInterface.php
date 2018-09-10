<?php

namespace labcoding\crud\models\filter;

use yii\data\DataProviderInterface;

interface FilterModelInterface
{
    /**
     * @param array $params
     * @return DataProviderInterface
     */
    public function search($params = []);

    /**
     * @return array
     */
    public function buildModels();

    /**
     * @return DataProviderInterface
     */
    public function getDataProvider();
}