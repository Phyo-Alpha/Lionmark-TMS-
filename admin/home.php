<?php

use secure\Secure;

session_start();
require_once '../conf/conf.php';
require_once ADMIN_DIR . 'secure/class/secure/Secure.php';

// lock page
Secure::lock();

// breadcrumb
require_once 'inc/breadcrumb.php';

// sidebar
require_once 'inc/sidebar.php';

require_once ROOT . 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig   = new \Twig\Environment(
    $loader,
    array(
    'debug' => DEBUG,
    )
);
require_once ROOT . 'vendor/twig/twig/src/Extension/CrudTwigExtension.php';
$twig->addExtension(new \Twig\Extension\CrudTwigExtension());
if (ENVIRONMENT == 'development') {
    $twig->addExtension(new \Twig\Extension\DebugExtension());
}
$twig->addGlobal('SERVER', $_SERVER);
$template                 = $twig->load('home.html');
$template_breadcrumb      = $twig->load('breadcrumb.html');
$template_navbar          = $twig->load('navbar.html');
$template_sidebar         = $twig->load('sidebar.html');
if (ENABLE_STYLE_SWITCHING) {
    $template_style_switcher  = $twig->load('style-switcher.html');
}
$template_js              = $twig->load('data-home-js.html');
$subtitle = ADMIN_HOME_PAGE_SUBTITLE;
$desc = ADMIN_HOME_PAGE_DESC;
if (DEMO === true) {
    $subtitle = ADMIN_HOME_PAGE_SUBTITLE_DEMO;
    $desc = ADMIN_HOME_PAGE_DESC_DEMO;
}
$msg = '';
if (isset($_SESSION['msg'])) {
    // catch registered message & reset.
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<!DOCTYPE html>
<html lang="<?php echo LANG; ?>">

<head>
    <title><?php echo SITENAME . ' - ' . $subtitle; ?></title>
    <link rel="alternate" hreflang="cs" href="https://www.phpcrudgenerator.com/admin/home?lang=cs">
    <link rel="alternate" hreflang="de" href="https://www.phpcrudgenerator.com/admin/home?lang=de">
    <link rel="alternate" hreflang="en" href="https://www.phpcrudgenerator.com/admin/home?lang=en">
    <link rel="alternate" hreflang="es" href="https://www.phpcrudgenerator.com/admin/home?lang=es">
    <link rel="alternate" hreflang="fr" href="https://www.phpcrudgenerator.com/admin/home?lang=fr">
    <link rel="alternate" hreflang="it" href="https://www.phpcrudgenerator.com/admin/home?lang=it">
    <link rel="alternate" hreflang="pt-br" href="https://www.phpcrudgenerator.com/admin/home?lang=pt-br">
    <meta name="description" content="<?php echo SITENAME . ' - ' . $desc; ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/admin/home?lang=<?php echo LANG; ?>" rel="canonical">
    <meta name="theme-color" content="#ffffff">
    <?php require_once 'inc/css-includes.php'; ?>
</head>

<body>
    <?php
    if (DEMO) {
        include_once '../inc/navbar-main.php';
    }
    ?>
    <div class="d-flex flex-nowrap">
        <?php echo $template_sidebar->render(array('sidebar' => $sidebar)); ?>
        <div id="content-wrapper">
            <?php
            echo $template_navbar->render(array('session' => $_SESSION));
            echo $template_breadcrumb->render(array('breadcrumb' => $breadcrumb));
            ?>
            <!-- shows all the user messages -->
            <div id="msg" class="mx-4"><?php echo $msg; ?></div>
            <?php
            echo $template->render(array());
            ?>
        </div> <!-- end content-wrapper -->
    </div> <!-- end container -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    <?php
    if (ENABLE_STYLE_SWITCHING) {
        echo $template_style_switcher->render();
    }
    require_once 'inc/js-includes.php';

    // Home page Javascripts
    echo $template_js->render(array('object' => ''));
    ?>
</body>

</html>
