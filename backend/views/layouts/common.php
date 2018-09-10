<?php
/**
 * @var $this    yii\web\View
 * @var $content string
 */

use backend\assets\BackendAsset;
use backend\modules\system\models\SystemLog;
use backend\widgets\Menu;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$bundle = BackendAsset::register($this);
?>

<?php $this->beginContent('@backend/views/layouts/base.php'); ?>

<div class="wrapper">
    <!-- header logo: style can be found in header.less -->
    <header class="main-header">
        <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl('/') ?>" class="logo">
            <span class="logo-mini"><b>BKW</b></span>
            <span class="logo-lg"><b><?= Yii::$app->name; ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"><?= Yii::t('backend', 'Toggle navigation') ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li id="timeline-notifications" class="notifications-menu">
                        <a href="<?= Yii::$app->urlManagerFrontend->hostInfo; ?>" target="_blank">
                            <?= Yii::t('backend', 'Go to main sile'); ?>&nbsp;
                            <i class="fa fa-external-link"></i>
                        </a>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <b><?= Yii::$app->user->identity->username; ?></b>&nbsp
                            <span>
                                <span class="glyphicon glyphicon-user"></span>
                                <i class="caret"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <?= Html::a(Yii::t('backend', 'Profile'), [Yii::$app->urlManager->createUrl(['/user/update', 'id' => Yii::$app->user->identity->id])]) ?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('backend', 'Exit'), ['/sign-in/logout'], ['data-method' => 'post']) ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <?= Html::a('<i class="fa fa-cogs"></i>', ['/system/settings']) ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel text-center">
<!--                <img src="/img/logo.svg" width="200" alt="">-->
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?= Menu::widget([
                'options' => ['class' => 'sidebar-menu'],
                'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                'activateParents' => true,
                'items' => [

                    [
                        'label' => Yii::t('backend', 'Seo'),
                        'url' => '#',
                        'icon' => '<i class="fa fa-globe"></i>',
                        'options' => ['class' => 'treeview'],
                        'active' => (in_array(Yii::$app->controller->module->id, ['seo', 'redirect'])) || (Yii::$app->controller->id == 'manager'),
                        'items' => [
                            [
                                'label' => Yii::t('backend', 'Seo Page'),
                                'url' => ['/seo/page/list'],
                                'icon' => '<i class="fa fa-globe"></i>',
                                'active' => (Yii::$app->controller->module->id == 'seo' && Yii::$app->controller->id == 'page'),
                                'visible' => Yii::$app->user->can('administrator'),
                            ],
                            [
                                'label' => Yii::t('backend', 'Redirect'),
                                'url' => ['/redirect/redirect/list'],
                                'icon' => '<i class="fa fa-external-link"></i>',
                                'active' => (Yii::$app->controller->module->id == 'redirect'),
                                'visible' => Yii::$app->user->can('administrator'),
                            ],
                            [
                                'label' => Yii::t('backend', 'Manager'),
                                'url' => ['/file/manager/index'],
                                'icon' => '<i class="fa fa-television"></i>',
                                'active' => (Yii::$app->controller->id == 'manager'),
                                'visible' => Yii::$app->user->can('administrator'),
                            ],
                        ],
                    ],
                    [
                        'label' => Yii::t('backend', 'Users'),
                        'icon' => '<i class="fa fa-users"></i>',
                        'url' => ['/user/index'],
                        'active' => (Yii::$app->controller->id == 'user'),
                        'visible' => Yii::$app->user->can('administrator'),
                    ],
                    [
                        'label' => Yii::t('backend', 'API Documentation'),
                        'icon' => '<i class="fa fa-exchange"></i>',
                        'url' => ['/api/docs'],
                        'active' => (Yii::$app->controller->id == 'api'),
                        'visible' => Yii::$app->user->can('administrator'),
                    ],
                    [
                        'label' => Yii::t('backend', 'System'),
                        'options' => ['class' => 'header'],
                    ],
                    [
                        'label' => Yii::t('backend', 'Languages'),
                        'url' => ['/i18n/languages/list'],
                        'icon' => '<i class="fa fa-language"></i>',
                        'active' => (Yii::$app->controller->id == 'languages'),
                    ],
                    [
                        'label' => Yii::t('backend', 'Settings'),
                        'url' => ['/system/settings'],
                        'icon' => '<i class="fa fa-cogs"></i>',
                        'active' => (Yii::$app->controller->id == 'settings'),
                    ],
                    [
                        'label' => Yii::t('backend', 'Translations'),
                        'url' => ['/translation/default/index'],
                        'icon' => '<i class="fa fa-language"></i>',
                        'active' => (Yii::$app->controller->module->id == 'translation'),
                    ],
                    [
                        'label' => Yii::t('backend', 'Files'),
                        'url' => '#',
                        'icon' => '<i class="fa fa-th-large"></i>',
                        'options' => ['class' => 'treeview'],
                        'active' => (Yii::$app->controller->module->id == 'file'),
                        'items' => [
                            [
                                'label' => Yii::t('backend', 'Storage'),
                                'url' => ['/file/storage/index'],
                                'icon' => '<i class="fa fa-database"></i>',
                                'active' => (Yii::$app->controller->id == 'storage'),
                                'visible' => Yii::$app->user->can('root'),
                            ],
                        ],
                    ],
                    [
                        'label' => Yii::t('backend', 'Key-Value Storage'),
                        'url' => ['/system/key-storage/index'],
                        'icon' => '<i class="fa fa-arrows-h"></i>',
                        'active' => (Yii::$app->controller->id == 'key-storage'),
                        'visible' => Yii::$app->user->can('root'),
                    ],
                    [
                        'label' => Yii::t('backend', 'Logs'),
                        'url' => ['/system/log/index'],
                        'icon' => '<i class="fa fa-warning"></i>',
                        'badge' => SystemLog::find()->count(),
                        'badgeBgClass' => 'label-danger',
                        'visible' => Yii::$app->user->can('root'),
                    ],
                    [
                        'label' => Yii::t('backend', 'RBAC Rules'),
                        'url' => '#',
                        'icon' => '<i class="fa fa-flag"></i>',
                        'options' => ['class' => 'treeview'],
                        'active' => in_array(Yii::$app->controller->id, ['rbac-auth-assignment', 'rbac-auth-item', 'rbac-auth-item-child', 'rbac-auth-rule']),
                        'visible' => Yii::$app->user->can('root'),
                        'items' => [
                            [
                                'label' => Yii::t('backend', 'Auth Assignment'),
                                'url' => ['/rbac/rbac-auth-assignment/index'],
                                'icon' => '<i class="fa fa-angle-double-right"></i>',
                            ],
                            [
                                'label' => Yii::t('backend', 'Auth Items'),
                                'url' => ['/rbac/rbac-auth-item/index'],
                                'icon' => '<i class="fa fa-angle-double-right"></i>',
                            ],
                            [
                                'label' => Yii::t('backend', 'Auth Item Child'),
                                'url' => ['/rbac/rbac-auth-item-child/index'],
                                'icon' => '<i class="fa fa-angle-double-right"></i>',
                            ],
                            [
                                'label' => Yii::t('backend', 'Auth Rules'),
                                'url' => ['/rbac/rbac-auth-rule/index'],
                                'icon' => '<i class="fa fa-angle-double-right"></i>',
                            ],
                        ],
                    ],
                    [
                        'label' => Yii::t('backend', 'System Information'),
                        'url' => ['/system/information/index'],
                        'icon' => '<i class="fa fa-dashboard"></i>',
                        'visible' => Yii::$app->user->can('root'),
                    ],
                ],
            ]) ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header clearfix">
            <h1 class="col-lg-8 col-md-6 col-sm-12">
                <?= $this->title; ?>
                <?php if (isset($this->params['subtitle'])): ?>
                    <small><?= $this->params['subtitle']; ?></small>
                <?php endif; ?>
            </h1>

            <?= Breadcrumbs::widget([
                'tag' => 'ol',
                'options' => [
                    'class' => 'breadcrumb col-lg-4 col-md-6 col-sm-12'
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]); ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php if (Yii::$app->session->hasFlash('alert')): ?>
                <?= Alert::widget([
                    'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                ]) ?>
            <?php endif; ?>
            <?= $content ?>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php $this->endContent(); ?>
