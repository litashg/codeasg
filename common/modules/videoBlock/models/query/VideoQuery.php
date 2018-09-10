<?php

namespace common\modules\videoBlock\models\query;

use yii\db\ActiveQuery;
use common\modules\videoBlock\models\Video;

class VideoQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(["status" => Video::STATUS_ACTIVE]);

        return $this;
    }
}
