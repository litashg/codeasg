<?php

namespace common\modules\i18n\models\query;

use yii\db\ActiveQuery;
use common\modules\i18n\models\Lang;

/**
 * This is the ActiveQuery class for [[Lang]].
 *
 * @see Lang
 */
class LangQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => Lang::STATUS_ACTIVE]);
    }
}