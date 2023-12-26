<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v1.8/admindom/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Sep 2015 20:37:21 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Color Admin | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/admin/assets/css/animate.min.css" rel="stylesheet" />
    <link href="/admin/assets/css/style.min.css" rel="stylesheet" />
    <link href="/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/admin/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
<?= $this->Flash->render('systemMessage') ?>
<?php echo $this->fetch('pageCss'); ?>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login bg-black animated fadeInDown">
        <!-- begin brand -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> Color Admin
                <small>responsive bootstrap 3 admin template</small>
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
            </div>
        </div>
        <!-- end brand -->
        <div class="login-content">
            <?=$this->Flash->render('auth') ?>
            <form action="/admindom/login" method="POST" class="margin-bottom-0">
                <div class="form-group m-b-20">
                    <input type="text" name="login" class="form-control input-lg" placeholder="Login" />
                </div>
                <div class="form-group m-b-20">
                    <input type="password" name="pass" class="form-control input-lg" placeholder="Password" />
                </div>
                <div class="checkbox m-b-20">
                    <label>
                        <input type="checkbox" value="on" name="rememberMe" /> Remember Me
                    </label>
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                </div>
            </form>
        </div>
    </div>
    <!-- end login -->

</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="/admin/assets/crossbrowserjs/html5shiv.js"></script>
<script src="/admin/assets/crossbrowserjs/respond.min.js"></script>
<script src="/admin/assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/admin/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<?php echo $this->fetch('pageScript');?>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.8/admindom/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Sep 2015 20:37:21 GMT -->
</html>