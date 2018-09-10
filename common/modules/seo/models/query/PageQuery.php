<?php

namespace common\modules\seo\models\query;

use yii\db\ActiveQuery;

class PageQuery extends ActiveQuery
{

    /**
     * @param string $url
     * @return $this
     */
    public function url($url)
    {
        $this->andWhere(['url' => $url]);
        return $this;
    }

    /**
     * @param string $route
     * @return $this
     */
    public function route($route)
    {
        $this->andWhere(['route' => $route]);

        return $this;
    }
}
