<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Minivan-Facile
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Festimove</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="<?= get_bloginfo("template_url"); ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= get_stylesheet_uri(); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= get_bloginfo("template_url"); ?>/assets/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?= get_bloginfo("template_url"); ?>/assets/datetimepicker/jquery.datetimepicker.css" />
    <style type="text/css">
        .error {
            color: red !important;
            text-transform: lowercase !important;
            font-size: 14px !important;
        }

        .flash-margin {
            margin-top: 10px;
        }
    </style>
    
<?php wp_head(); ?>

</head>


<body>
    <nav class="navbar navbar-orange">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= get_bloginfo("template_url"); ?>/home"><img src="<?= get_bloginfo("template_url"); ?>/assets/images/logo.png" /></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown open">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">MENU <span class="sandwitch"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= get_bloginfo("template_url"); ?>/home">Accueil</a></li>
                            <li><a href="<?= get_bloginfo("template_url"); ?>/rent">LOUER UN MINIBUS</a></li>
                            <li><a href="<?= get_bloginfo("template_url"); ?>/fleets">NOS V&Eacute;HICULES</a></li>
                            <li><a href="<?= get_bloginfo("template_url"); ?>/faq">FAQ</a></li>
                            <li><a href="<?= get_bloginfo("template_url"); ?>/qui-sommes-nous">QUI SOMMES NOUS</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav separator navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nous contacter</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">+33602838291</a></li>
                            <li><a href="<?= get_bloginfo("template_url"); ?>/contact">Nous contacter par mail</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= get_bloginfo("template_url"); ?>/login">Se connecter</a></li>
                </ul>

            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
	
	
	<?php
        
    ?>


    <style type="text/css">
        input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance:textfield;
        }
    </style>