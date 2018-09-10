<?php

namespace common\grid;

use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;

/**
 * Class EnumColumn
 * [
 *      'class' => 'common\grid\EnumColumn',
 *      'attribute' => 'role',
 *      'enum' => User::getRoles()
 * ]
 * @package common\components\grid
 */
class EnumColumn extends DataColumn
{
    /**
     * @var array List of value => name pairs
     */
    public $enum = [];

    public $format = 'raw';

    /**
     * @var array List of value => name pairs
     */
    public $labels = [];

    /**
     * @var bool
     */
    public $loadFilterDefaultValues = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->loadFilterDefaultValues && $this->filter === null) {
            $this->filter = $this->enum;
        }
    }

    /**
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return mixed
     */
    public function getDataCellValue($model, $key, $index)
    {
        $value = parent::getDataCellValue($model, $key, $index);

        $color = ArrayHelper::getValue($this->labels, $value);

        if(empty($color)) {
            $color = 'default';
        }
        return '<span class="label label-'.$color.'">'.ArrayHelper::getValue($this->enum, $value, $value).'</span>';
    }
}
