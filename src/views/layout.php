<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <title><?php echo PROJECT_NAME; ?></title>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta name=description content="test project">
    <meta name=author content="Harish Anchu">

    <link rel=author href=<?php echo SITE_URL; ?>/humans.txt />
    <link href=<?php echo SITE_URL ?>/assets/css/style.css rel=stylesheet>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?php echo SITE_URL ?>/assets/js/html5shiv.js"></script>
    <![endif]-->

    <script>
        window.SITE_URL = '<?php echo SITE_URL; ?>';
        window.App = {};
    </script>
</head>
<body>

<div id="ajax-loader">
    <i class='icon-spinner icon-spin icon-large'></i>
    <img src="<?php echo SITE_URL; ?>/assets/img/loading.gif">
</div>

    <div id="notifications">
    </div>

    <div class=container-fluid id=container>
        <?= $_html ?>
        <!-- Modal -->
        <div id=app-modal class="modal hide fade">
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo SITE_URL; ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo SITE_URL; ?>/assets/node_modules/noty/packaged/jquery.noty.packaged.js"></script>
    <script src="<?php echo SITE_URL; ?>/assets/node_modules/underscore/underscore-min.js"></script>
    <script src="<?php echo SITE_URL; ?>/assets/template/app.js"></script>
    <script src="<?php echo SITE_URL; ?>/assets/js/app.js"></script>
    <?php
    foreach($scripts as $script)
    {
        ?>
    <script src="<?php echo SITE_URL; ?>/assets/js/<?php echo $script; ?>.js"></script>
        <?php

    }
    ?>
</body>
</html>