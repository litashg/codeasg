<?php

namespace common\modules\redirect\models\search;

use yii\data\{ActiveDataProvider, Pagination};
use common\modules\redirect\models\Redirect;
use labcoding\crud\models\filter\AbstractFilterModel;

/**
 * RedirectSearch represents the model behind the search form about `common\modules\redirect\models\Redirect`.
 */
class RedirectSearch extends AbstractFilterModel
{

    public $from_url;
    public $to_url;
    public $code;
    public $pageSize = 20;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_url', 'to_url', 'code'], 'string']
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
        $query = Redirect::find();

        $this->dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => new Pagination([
                'pageSize' => $this->pageSize
            ]),
            'sort'=> [
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ],
        ]);

        if ($this->validate() === false) {
            return $this->dataProvider;
        }

        $query->andFilterWhere(['like', 'from_url', $this->from_url]);
        $query->andFilterWhere(['like', 'to_url', $this->to_url]);
        $query->andFilterWhere(['like', 'code', $this->code]);

        return $this->dataProvider;
    }
}