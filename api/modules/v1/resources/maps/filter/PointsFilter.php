<?php

namespace api\modules\v1\resources\maps\filter;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use api\modules\v1\resources\maps\Point;

class PointsFilter extends Model
{

    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $status = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            ['type', 'in', 'range' => array_values(Point::getEnumTypes())],
            ['status', 'in', 'range' => array_values(Point::getEnumStatuses()), 'allowArray' => true],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params = [])
    {
        $query = Point::find();
        $this->load($params, '');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        if (false === $this->validate()) {
            return $dataProvider;
        }

        $types = array_flip(Point::getEnumTypes());

        $query->andFilterWhere([
            'type' => $types[$this->type] ?? null,
        ]);

        $statuses = array_flip(Point::getEnumStatuses());

        $statuses = array_map(function($value) use ($statuses) {
            return $statuses[$value];
        }, (array)$this->status);

        $query->andFilterWhere(['in', 'status', $statuses]);

        return $dataProvider;
    }
}
