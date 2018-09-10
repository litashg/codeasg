<?php

namespace common\modules\i18n\models\search;

use common\modules\i18n\models\Lang;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * LangSearch represents the model behind the search form about `common\modules\i18n\models\Lang`.
 */
class LangSearch extends \labcoding\crud\models\filter\AbstractFilterModel
{

    public $id;
    public $code;
    public $name;
    public $locale;
    public $status;

    public $pageSize = 20;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'locale', 'status'], 'string'],
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
        $query = Lang::find();

        $this->dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => new Pagination([
                'pageSize' => $this->pageSize
            ]),
            'sort'=> [
                'defaultOrder' => [
                    'order' => SORT_ASC
                ]
            ],
        ]);

        if ($this->validate() === false) {
            return $this->dataProvider;
        }

        $query->andFilterWhere(['like', 'code', $this->code]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'locale', $this->locale]);
        $query->andFilterWhere(['like', 'status', $this->status]);

        return $this->dataProvider;
    }
}
