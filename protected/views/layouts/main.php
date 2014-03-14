<!DOCTYPE >
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/buttons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/icons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/tables.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/mbmenu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/mbmenu_iestyles.css" />


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">
            <div id="topnav">
                <div class="topnav_text">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                    ));
                    ?>
                </div>
                <!--                <div class="topnav_text"><a href='#'>Home</a> | <a href='#'>My Account</a> | <a href='#'>Settings</a> | <a href='#'>Logout</a> </div>-->
            </div>
            <div id="header">
<!--                <div id="logo"><img src="<?php echo Yii::app()->baseUrl; ?>/images/logo.png"></img><?php //echo CHtml::encode(Yii::app()->name);   ?></div>-->
            </div><!-- header -->
            <div id="mainmenu">

                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => Menu::getMenu($this),
                    'encodeLabel' => false,
                    'itemCssClass' => 'sub-menu',
                    'activeCssClass' => 'active',
                    'htmlOptions' => array('class' => 'sidebar-menu'),
                    'submenuHtmlOptions' => array('class' => 'sub')
                ));
                ?>
            </div> <!--mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

<?php echo $content; ?>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by webapplicationthemes.com<br/>
                All Rights Reserved.<br/>
<?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->
<?php echo Yii::app()->user->ui->displayErrorConsole() ?>
    </body>
</html>