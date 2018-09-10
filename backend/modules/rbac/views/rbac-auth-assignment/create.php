<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthAssignment */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Rbac Auth Assignment',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Rbac Auth Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-assignment-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
