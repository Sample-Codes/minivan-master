<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Minivan-Facile
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>

<section id="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div id="search-block">
                    <form method="POST" action="" accept-charset="UTF-8" id="bookingBus">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Nombre de km &agrave; parcourir</label>
                                <div class="field-wrap-r">
                                    <span class="ico-r location-ico"></span>
                                    <input id="travel_km" required="" class="form-control" placeholder="Nombre de km &agrave; parcourir" min="1" name="travel_km" type="number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <label>d&eacute;but</label>
                                <div class="field-wrap-l col-l">
                                    <span class="ico-l cal-ico"></span>
                                    <input id="start_date" required="" class="form-control" placeholder="23 mai 2017" name="start_date" type="text">
                                </div>
                                <div class="field-wrap-l col-r">
                                    <span class="ico-l clock-ico"></span>
                                    <input id="start_datetime" required="" class="form-control" placeholder="19h00" name="start_datetime" type="text">
                                    <!-- <input type="text" value="19h00" class="form-control" /> -->
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <label>fin</label>
                                <div class="field-wrap-l col-l">
                                    <span class="ico-l cal-ico"></span>
                                    <input id="end_date" required="" class="form-control" placeholder="23 mai 2017" name="end_date" type="text">
                                </div>
                                <div class="field-wrap-l col-r">
                                    <span class="ico-l clock-ico"></span>
                                    <input id="end_datetime" required="" class="form-control" placeholder="19h00" name="end_datetime" type="text">
                                    <!-- <input type="text" value="19h00" class="form-control" /> -->
                                </div>
                            </div>
                            <div class="col-lg-1 col-xs-12">
                                <button type="submit" class="submit-btn" name="submit"></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (isset($_POST['submit']) && !empty($_POST['travel_km']) && !empty($_POST['start_date']) && !empty($_POST['start_datetime']) && !empty($_POST['end_date']) && !empty($_POST['end_datetime'])) { ?>


<?php } else { ?>

<section id="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Pas de prise de tête, faites-vous livrer votre minibus à domicile</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col">
                            <a href="#">
                                <img src="<?= get_bloginfo("template_url"); ?>/assets/images/time.png" />
                            </a>
                            <h4>Réservation en 5min</h4>
                            <span class="line red"></span>
                            <p class="caption">Recevez un devis en moins de 24h</p>
                        </div>
                        <div class="col">
                            <a href="#">
                                <img src="<?= get_bloginfo("template_url"); ?>/assets/images/money.png" />
                            </a>
                            <h4>Prix imbattables</h4>
                            <span class="line blue"></span>
                            <p class="caption">Recevez un devis en moins de 24h</p>
                        </div>
                        <div class="col">
                            <a href="#">
                                <img src="<?= get_bloginfo("template_url"); ?>/assets/images/package.png" />
                            </a>
                            <h4>Formules sur mesure</h4>
                            <span class="line yellow"></span>
                            <p class="caption">Recevez un devis en moins de 24h</p>
                        </div>
                        <div class="col">
                            <a href="#">
                                <img src="<?= get_bloginfo("template_url"); ?>/assets/images/certificate.png" />
                            </a>
                            <h4>Avis<br /> certifiés</h4>
                            <span class="line green"></span>
                            <p class="caption">Recevez un devis en moins de 24h</p>
                        </div>
                        <div class="col">
                            <a href="#">
                                <img src="<?= get_bloginfo("template_url"); ?>/assets/images/livraison.png" />
                            </a>
                            <h4>Livraison du véhicule</h4>
                            <span class="line orange"></span>
                            <p class="caption">Recevez un devis en moins de 24h</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'offres', 'speciales' ); ?>

<?php } ?>

<?php get_footer(); ?>
