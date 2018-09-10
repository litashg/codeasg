<?php

namespace labcoding\crud\models\filter;

use yii\base\Model;
use yii\data\DataProviderInterface;

abstract class AbstractFilterModel extends Model implements FilterModelInterface
{
    /**
     * @var DataProviderInterface
     */
    protected $dataProvider;

    /**
     * @param array $params
     * @return DataProviderInterface
     */
    abstract public function search($params = []);

    /**
     * @return array
     */
    public function buildModels()
    {
        return $this->dataProvider->getModels();
    }

    /**
     * @return DataProviderInterface
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }
}