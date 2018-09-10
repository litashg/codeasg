<?php

namespace common\modules\seo\models\search;

use labcoding\crud\models\filter\AbstractFilterModel;
use common\modules\seo\models\Page;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * PageSearch represents the model behind the search form about `common\modules\seo\models\Page`.
 */
class PageSearch extends AbstractFilterModel
{

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $title;


    public $pageSize = 20;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'title'], 'string'],
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
        $query = Page::find()
            ->joinWith('currentTranslate', false);

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

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'url', $this->url]);

        return $this->dataProvider;
    }

}
