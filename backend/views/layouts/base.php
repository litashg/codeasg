<?php

use backend\assets\BackendAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

BackendAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::t('backend', 'Admin'); ?> - <?= Html::encode(strip_tags($this->title)); ?></title>
    <?php $this->head(); ?>

</head>
<?= Html::beginTag('body', ['class' => 'hold-transition skin-blue sidebar-mini']); ?>
    <?php $this->beginBody(); ?>
        <?= $content; ?>
    <?php $this->endBody(); ?>
<?= Html::endTag('body'); ?>
</html>
<?php $this->endPage(); ?>