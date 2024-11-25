<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="" />
    <meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
    <meta name="author" content="Kashif Shaikh" />

    <!-- Page Title -->
    <title><?=isset($website_obj['WEBSITE_NAME'])?$website_obj['WEBSITE_NAME']:WEBSITE_NAME?></title>

    <!-- Favicon and Touch Icons -->
    <link href="<?=base_url()?>images/usindh/logo.png" rel="shortcut icon" type="image/png">
    <link href="<?=base_url()?>images/usindh/logo.png" rel="apple-touch-icon">
    <link href="<?=base_url()?>images/usindh/logo.png" rel="apple-touch-icon" sizes="72x72">
    <link href="<?=base_url()?>images/usindh/logo.png" rel="apple-touch-icon" sizes="114x114">
    <link href="<?=base_url()?>images/usindh/logo.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Stylesheet -->
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/animate.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>css/css-plugin-collections.css" rel="stylesheet"/>
    <!-- CSS | menuzord megamenu skins -->
    <link id="menuzord-menu-skins" href="<?=base_url()?>css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
    <!-- CSS | Main style file -->
    <link href="<?=base_url()?>css/style-main.css" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <link href="<?=base_url()?>css/preloader.css" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="<?=base_url()?>css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="<?=base_url()?>css/responsive.css" rel="stylesheet" type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="<?=base_url()?>css/style.css" rel="stylesheet" type="text/css"> -->

    <!-- Revolution Slider 5.x CSS settings -->
    <link  href="<?=base_url()?>js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
    <link  href="<?=base_url()?>js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
    <link  href="<?=base_url()?>js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

    <!-- CSS | Theme Color -->
    <link href="<?=base_url()?>css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">

    <!-- external javascripts -->
    <script src="<?=base_url()?>js/jquery-2.2.4.min.js"></script>
    <script src="<?=base_url()?>js/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="<?=base_url()?>js/jquery-plugin-collection.js"></script>

    <!-- Revolution Slider 5.x SCRIPTS -->
    <script src="<?=base_url()?>js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?=base_url()?>js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?=base_url()?>js/html5shiv.min.js"></script>
    <script src="<?=base_url()?>js/respond.min.js"></script>

    <![endif]-->
    <style>
        .marquee {
            width: 100%;
            line-height: 40px;

            color: red;
            white-space: nowrap;
            overflow: hidden;
            box-sizing: border-box;
        }
        .marquee p {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 20s linear infinite;
        }
        @keyframes marquee {
            0%   { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }
    </style>
</head>