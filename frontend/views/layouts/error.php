<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */

\frontend\assets\ErrorAsset::register($this);
?>

<?php $this->beginContent('@frontend/views/layouts/base.php'); ?>
    <?= $content; ?>
<?php $this->endContent(); ?>