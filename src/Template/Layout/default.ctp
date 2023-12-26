<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta name="author" content="thecoderdev.com">

    <?= $this->printNiceSeo(); ?>

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/frontend/img/fav/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/frontend/img/fav/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/frontend/img/fav/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/frontend/img/fav/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/frontend/img/fav/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/frontend/img/fav/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/frontend/img/fav/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/frontend/img/fav/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="/frontend/img/fav/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="/frontend/img/fav/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="/frontend/img/fav/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/frontend/img/fav/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="/frontend/img/fav/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

<!--    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="/css/foundation.css">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">-->
<!--    <link rel="stylesheet" href="/css/checkbox.css">-->
<!--    <link rel="stylesheet" href="/css/index.css">-->
<!--    <link rel="stylesheet" href="/css/ilightbox.css">-->
<!--    <link rel="stylesheet" href="/libs/flickity/dist/flickity.css" media="screen">-->
<!--    <link rel="stylesheet" href="/app/css/main.css?--><?//= time() ?><!--">-->


    <link rel="stylesheet" href="/frontend/css/build.css?<?= 'v=3.1' ?>">
<!--    <script src="/frontend/js/libs/jquery.min.js"></script>-->
<!---->
<!--    <script>-->
<!--        setTimeout(function () {-->
<!--            $(".loader__gif").animate({-->
<!--                "left": '80px'-->
<!--            }, 800);-->
<!--        }, 800);-->
<!--        setTimeout(function () {-->
<!--            $(".loader__text").fadeIn(1200);-->
<!--        }, 1000);-->
<!--        setTimeout(function () {-->
<!--            $(".loader").fadeOut('slow');-->
<!--        }, 2000);-->
<!--    </script>-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-69376120-14', 'auto');
        ga('send', 'pageview');
        function sendGoogleTel() {
            console.log(3);
            ga('send', 'event', 'telcall', 'click');
        }
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '780485055853358');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=780485055853358&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- FingerPrint.site No Click fraud -->
<!--    <script>var u = new URL(window.location.href);var i = Math.random().toString();i = i.substring(2, i.length);if (!localStorage.getItem('i')) localStorage.setItem('i', i);fetch('https://visits.fingerprint.site/visits', {method: "POST",body: JSON.stringify({i: localStorage.getItem('i'),l: window.location.href,d: 'wonder-wood.com.ua',g: u.searchParams.get("gclid"),c: u.searchParams.get("ca"),}),headers: {Accept: 'application/json','Content-Type': 'application/json',},});</script><noscript><img src="https://visits.fingerprint.site/nojs/wonder-wood.com.ua"alt="clickfraudprotection"/></noscript>-->
    <!-- FingerPrint.site No Click fraud -->
    <style>
        .category__link:hover:before {
            top: 12px!important;
        }
    </style>
</head>

<body id="top-page">

<?= $this->fetch('content'); ?>

<?= (isset($errorPage) && $errorPage) ? '' : $this->element('footer'); ?>


<div
    data-title="<?= $layout_page->getContentField(['feedbackLayout', 'title']) ?>"
    data-description="<?= $layout_page->getContentField(['feedbackLayout', 'description']) ?>"
    data-button_name="<?= $layout_page->getContentField(['feedbackLayout', 'button']) ?>"
    data-type="formPhone"
    class="phone-wrapper popup-link">
    <div class="phone-icon"></div>
</div>

<?= $this->element('Modals/popup') ?>
<?= $this->element('Modals/popup_answer') ?>

<script src="/frontend/js/libs/jquery.min.js"></script>

<?= $this->fetch('pageScript1'); ?>

<!-- libs -->
<script src="/frontend/js/libs/jquery.validate.js"></script>
<?php if($lang !== 'en') { ?>
    <script src="/frontend/js/libs/messages_<?= $lang ?>.js"></script>
<?php } ?>
<script src="/frontend/js/libs/additional-methods.min.js"></script>
<script src="/frontend/js/libs/jquery.mask.min.js"></script>
<script src="/frontend/js/libs/smoothscroll.js"></script>
<script>
    jQuery.validator.addMethod("fullEmail", function(value, element) {
        return this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
    }, $.validator.messages.email);
</script>

<!-- frontend -->
<script src="/frontend/js/frontend.js?<?= 'v=2.0' ?>"></script>
<script src="/frontend/js/validation.js?<?= 'v=2.0' ?>"></script>

<?= $this->fetch('pageScript'); ?>

</body>
</html>
