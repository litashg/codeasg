<?php

namespace api\modules\v1\resources\pages\filter;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PagesFilter extends Model
{

    /**
     * @var int
     */
    public $limit = 6;

    /**
     * @var int
     */
    public $offset = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['limit', 'offset'], 'integer'],
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
        $query = \api\modules\v1\resources\pages\Page::find()
            ->active();
        $this->load($params, '');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $query->offset($this->offset);
        $query->limit($this->limit);

        if (false === $this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
