<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Minivan-Facile
 * @since 1.0
 * @version 1.0
 */

?>

<?php wp_footer(); ?>

  <!-- FOOTER -->
<footer id="footer">
    <div class="container">
        <ul class="nav">
            <li><a href="<?= get_bloginfo("template_url"); ?>/garanties">Garanties</a></li>
            <li><a href="<?= get_bloginfo("template_url"); ?>/modes-de-paiement">Modes de Paiement</a></li>
            <li><a href="<?= get_bloginfo("template_url"); ?>/reglementation-et-legislation">R&eacute;glementation et l&eacute;gislation</a></li>
            <li><a href="<?= get_bloginfo("template_url"); ?>/conditions-generales-de-vente">Conditions G&eacute;n&eacute;rales de Vente</a></li>
            <li><a href="<?= get_bloginfo("template_url"); ?>/mentions-legales">Mentions l&eacute;gales</a></li>
            <li><a href="<?= get_bloginfo("template_url"); ?>/contact">Contactez-nous</a></li>
        </ul>
        <p>Droits d&#039;auteur &copy; 2017 Festimove</p>
    </div>
</footer>

<!-- JavaScripts -->
<script src="<?= get_bloginfo("template_url"); ?>/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?= get_bloginfo("template_url"); ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= get_bloginfo("template_url"); ?>/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?= get_bloginfo("template_url"); ?>/assets/plugins/jquery-validation/localization/messages_fr.min.js"></script>
<script src="<?= get_bloginfo("template_url"); ?>/assets/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<!-- AutoComplete -->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRK7d8CJsX1fmYBnig13azyA9AZ03h5EM&amp;v=3.exp&amp;&amp;libraries=places&amp;language=FR&amp;region=fr"></script>-->
<script type="text/javascript">
        $.datetimepicker.setLocale('fr');
        $('#start_date').datetimepicker({
            timepicker:false,
            format:'d/m/Y',
            formatDate:'d/m/Y',
            onShow:function( ct ){
             this.setOptions({
                minDate: 0,
                maxDate:$('#end_date').val()?$('#end_date').val():false,
              })
            },
        });
        $('#end_date').datetimepicker({
            timepicker:false,
            format:'d/m/Y',
            formatDate:'d/m/Y',
            onShow:function( ct ){
             this.setOptions({
                minDate:$('#start_date').val()?$('#start_date').val():false,
                maxDate: false,
              })
            },
        });
        $('#start_datetime').datetimepicker({
            timepicker:true,
            datepicker:false,
            format:'H:i',
        });
        $('#end_datetime').datetimepicker({
            timepicker:true,
            datepicker:false,
            format:'H:i',
        });
        $(document).ready(function() {
            $("#bookingBus").validate({
                lang: 'fr',
                rules: {
                    end_date: { greaterThan: "#start_date" }
                }
            });
            $.validator.addMethod("greaterThan", function(value, element, params) {
                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date($(params).val());
                }
                return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
            },'doit être supérieur à la date de début.');
        });
        /*-- AutoComplete code--*/
//        function initialize() {
//            var input = document.getElementById('address');
//            var autocomplete = new google.maps.places.Autocomplete(input);
//        }
//        google.maps.event.addDomListener(window, 'load', initialize);
</script>