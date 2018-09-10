<?php

namespace api\modules\v1\resources\maps\filter;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use api\modules\v1\resources\maps\Country;

class CountriesFilter extends Model
{

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
            ['status', 'in', 'range' => array_values(Country::getEnumStatuses()), 'allowArray' => true],
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
        $query = Country::find();
        $this->load($params, '');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        if (false === $this->validate()) {
            return $dataProvider;
        }

        $statuses = array_flip(Country::getEnumStatuses());

        $statuses = array_map(function($value) use ($statuses) {
            return $statuses[$value];
        }, (array)$this->status);

        $query->andFilterWhere(['in', 'status', $statuses]);

        return $dataProvider;
    }
}
