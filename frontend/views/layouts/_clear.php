<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">

    <title><?= Html::encode($this->title); ?></title>

    <!-- Favicons Package and advanced options -->
    <link rel="apple-touch-icon" sizes="180x180" href="/media/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/media/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/media/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/media/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700" rel="stylesheet">
    <!-- ./Favicons Package and advanced options -->
    <?php $this->head() ?>

    <?= Html::csrfMetaTags() ?>

    <?= Yii::$app->keyStorage->get('frontend.scripts.head'); ?>
</head>
<body>
<?= Yii::$app->keyStorage->get('frontend.scripts.body'); ?>

<?php $this->beginBody(); ?>
    <?= $content; ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBmsxjUyTTqnuUFGrSkO6KHKa3I1_zkyA"></script>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
