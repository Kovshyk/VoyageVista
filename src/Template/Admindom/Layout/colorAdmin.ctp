<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v1.8/admindom/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Sep 2015 20:33:05 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Color Admin | Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <?= $this->Flash->render() ?>
    <?= $this->fetch('pageCss');?>


    <!-- ================== BEGIN BASE CSS STYLE ================== -->


    <link href="/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/admin/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet"/>

    <link href="/admin/assets/css/animate.min.css" rel="stylesheet" />
    <link href="/admin/assets/css/style.min.css" rel="stylesheet" />
    <link href="/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <link href="/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
    <link href="/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="/admin/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <!--    Bootstrap switch-->
    <link href="/admin/assets/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <link href="/admin/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
    <?= $this->fetch('pageCss'); ?>


<!--    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
<!--    --><?//= $this->PerfectHTML->css('http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'); ?>
<!--    --><?//= $this->PerfectHTML->cssAS('/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.css'); ?>
<!--    --><?//= $this->PerfectHTML->cssAS('/plugins/bootstrap/css/bootstrap.min.css'); ?>
<!--    --><?//= $this->PerfectHTML->cssAS('style.min.css'); ?>
<!--    --><?//= $this->PerfectHTML->cssAS('/plugins/font-awesome/4.7/css/font-awesome.min.css'); ?>
<!--    --><?//= $this->PerfectHTML->cssAS('animate.min.css'); ?>
<!--    --><?//= $this->PerfectHTML->cssAS('style-responsive.min.css'); ?>
<!--    --><?//= $this->PerfectHTML->cssAS('theme/default.css', ['id' => 'theme']); ?>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <!-- ================== END PAGE LEVEL STYLE ================== -->
</head>
<body>

<div id="page-loader" class="fade in"><span class="spinner"></span></div>

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="/admindom" class="navbar-brand"><span class="navbar-logo"></span>
                    Color Admin
                </a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <?//= $this->element('Admin/search'); ?>

                <?//= $this->element('Admin/notifications'); ?>

                <?= $this->element('Admin/profile'); ?>

            </ul>
        </div>
    </div>

    <?= $this->element('Admin/sidebar'); ?>

    <div id="content" class="content">
        <?= $this->fetch('content'); ?>
    </div>

    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
</div>

<!-- ================== BEGIN BASE JS  lvl1 ================== -->
<?= $this->PerfectHTML->scriptAS('/plugins/pace/pace.min.js'); ?>
<?= $this->PerfectHTML->scriptAS('/plugins/jquery/jquery-1.9.1.min.js'); ?>
<?= $this->PerfectHTML->scriptAS('/plugins/jquery/jquery-migrate-1.1.0.min.js'); ?>
<script src="/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<?= $this->PerfectHTML->scriptAS('/plugins/bootstrap/js/bootstrap.min.js'); ?>
<?= $this->PerfectHTML->scriptAS('/plugins/jquery-cookie/jquery.cookie.js'); ?>
<?= $this->PerfectHTML->scriptAS('/plugins/slimscroll/jquery.slimscroll.min.js'); ?>
<?= $this->PerfectHTML->scriptAS('dashboard.min.js'); ?>
<?= $this->PerfectHTML->scriptAS('apps.min.js'); ?>
<?= $this->PerfectHTML->scriptAS('jquery.validate.js'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<?php echo $this->fetch('pageScript');?>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href === url || url.href.indexOf(this.href) === 0;
    }).parent().addClass('active');
    if (element.parent().parent().is('li')) {
        element.parent().parent().addClass('active');
    }
    if (element.parent().parent().parent().parent().is('li')) {
        element.parent().parent().parent().parent().addClass('active');
    }
    if (element.parent().parent().parent().parent().parent().parent().is('li')) {
        element.parent().parent().parent().parent().parent().parent().addClass('active');
    }
</script>
<?//= $this->Flash->render('systemMessage') ?>
</body>
</html>
