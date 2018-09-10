<?php
\backend\assets\BackendAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= Yii::$app->name; ?> API documentstion</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <?php $this->head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Roboto:300,400,700" rel="stylesheet">

    <style>
        body {
            padding-top: 50px;
        }

        .main-header>.navbar {
            margin-left: 0;
        }
        .main-header .navbar-brand {
            color: #777;
        }
        .redoc-wrap .menu-content {
            top: 50px!important;
        }
    </style>
</head>

<body>

<header class="main-header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Yii::$app->urlManagerBackend->createUrl(['/']); ?>">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>

            <div class="navbar-text">
                <h4 style="margin: 0;">
                    <i class="fa fa-file-text"></i>
                    API. Documentation
                </h4>
            </div>
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?= Yii::$app->urlManagerFrontend->hostInfo; ?>">
                            Go to site
                            <i class="fa fa-external-link"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<?php $this->beginBody(); ?>

<redoc spec-url="<?= \yii\helpers\Url::toRoute(['api/json-schema']); ?>"></redoc>
<script src="https://cdn.jsdelivr.net/npm/redoc@next/bundles/redoc.standalone.js"> </script>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
