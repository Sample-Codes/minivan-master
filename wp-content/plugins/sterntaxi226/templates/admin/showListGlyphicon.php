<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


Class showListGlyphicon{
	function __construct($widthInput,$sourceOrDestination){
		if($sourceOrDestination=="source") {
			?>
				<?php $nameOption = "stern_taxi_fare_Source_Button_glyph"; ?>
				<?php $title = __('Source button', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Source Button', 'stern_taxi_fare', 'stern_taxi_fare'); ?>
			<?php				
		} else {
			?>
				<?php $nameOption = "stern_taxi_fare_Destination_Button_glyph"; ?>
				<?php $title = __('Destination button', 'stern_taxi_fare'); ?>
				<?php $tooltip = __('Destination Button', 'stern_taxi_fare', 'stern_taxi_fare'); ?>	
			<?php	
		}
	?>
		 
	<tr>
		<td>
			<?php echo $title; ?> <a href="http://getbootstrap.com/components/" target="_blank">Icon</a>
		</td>
		<td>
			<select id="<?php echo $nameOption; ?>" name="<?php echo $nameOption; ?>" style="width:<?php echo $widthInput; ?>;">
				<option <?php echo (get_option( $nameOption ) == "" ? "selected" : ""); ?> value=""></option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-adjust" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-adjust">glyphicon-adjust</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-alert" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-alert">glyphicon-alert</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-align-center" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-align-center">glyphicon-align-center</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-align-justify" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-align-justify">glyphicon-align-justify</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-align-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-align-left">glyphicon-align-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-align-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-align-right">glyphicon-align-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-apple" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-apple">glyphicon-apple</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-arrow-down" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-arrow-down">glyphicon-arrow-down</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-arrow-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-arrow-left">glyphicon-arrow-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-arrow-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-arrow-right">glyphicon-arrow-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-arrow-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-arrow-up">glyphicon-arrow-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-asterisk" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-asterisk">glyphicon-asterisk</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-baby-formula" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-baby-formula">glyphicon-baby-formula</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-backward" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-backward">glyphicon-backward</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-ban-circle" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-ban-circle">glyphicon-ban-circle</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-barcode" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-barcode">glyphicon-barcode</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-bed" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-bed">glyphicon-bed</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-bell" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-bell">glyphicon-bell</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-bishop" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-bishop">glyphicon-bishop</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-bitcoin" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-bitcoin">glyphicon-bitcoin</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-blackboard" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-blackboard">glyphicon-blackboard</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-bold" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-bold">glyphicon-bold</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-book" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-book">glyphicon-book</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-bookmark" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-bookmark">glyphicon-bookmark</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-briefcase" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-briefcase">glyphicon-briefcase</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-bullhorn" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-bullhorn">glyphicon-bullhorn</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-calendar" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-calendar">glyphicon-calendar</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-camera" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-camera">glyphicon-camera</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-cd" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-cd">glyphicon-cd</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-certificate" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-certificate">glyphicon-certificate</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-check" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-check">glyphicon-check</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-chevron-down" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-chevron-down">glyphicon-chevron-down</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-chevron-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-chevron-left">glyphicon-chevron-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-chevron-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-chevron-right">glyphicon-chevron-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-chevron-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-chevron-up">glyphicon-chevron-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-circle-arrow-down" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-circle-arrow-down">glyphicon-circle-arrow-down</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-circle-arrow-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-circle-arrow-left">glyphicon-circle-arrow-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-circle-arrow-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-circle-arrow-right">glyphicon-circle-arrow-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-circle-arrow-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-circle-arrow-up">glyphicon-circle-arrow-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-cloud" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-cloud">glyphicon-cloud</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-cloud-download" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-cloud-download">glyphicon-cloud-download</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-cloud-upload" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-cloud-upload">glyphicon-cloud-upload</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-cog" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-cog">glyphicon-cog</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-collapse-down" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-collapse-down">glyphicon-collapse-down</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-collapse-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-collapse-up">glyphicon-collapse-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-comment" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-comment">glyphicon-comment</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-compressed" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-compressed">glyphicon-compressed</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-copy" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-copy">glyphicon-copy</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-copyright-mark" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-copyright-mark">glyphicon-copyright-mark</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-credit-card" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-credit-card">glyphicon-credit-card</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-cutlery" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-cutlery">glyphicon-cutlery</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-dashboard" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-dashboard">glyphicon-dashboard</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-download" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-download">glyphicon-download</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-download-alt" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-download-alt">glyphicon-download-alt</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-duplicate" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-duplicate">glyphicon-duplicate</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-earphone" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-earphone">glyphicon-earphone</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-edit" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-edit">glyphicon-edit</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-education" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-education">glyphicon-education</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-eject" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-eject">glyphicon-eject</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-envelope" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-envelope">glyphicon-envelope</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-equalizer" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-equalizer">glyphicon-equalizer</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-erase" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-erase">glyphicon-erase</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-euro" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-euro">glyphicon-euro</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-exclamation-sign" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-exclamation-sign">glyphicon-exclamation-sign</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-expand" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-expand">glyphicon-expand</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-export" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-export">glyphicon-export</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-eye-close" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-eye-close">glyphicon-eye-close</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-eye-open" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-eye-open">glyphicon-eye-open</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-facetime-video" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-facetime-video">glyphicon-facetime-video</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-fast-backward" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-fast-backward">glyphicon-fast-backward</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-fast-forward" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-fast-forward">glyphicon-fast-forward</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-file" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-file">glyphicon-file</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-film" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-film">glyphicon-film</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-filter" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-filter">glyphicon-filter</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-fire" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-fire">glyphicon-fire</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-flag" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-flag">glyphicon-flag</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-flash" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-flash">glyphicon-flash</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-floppy-disk" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-floppy-disk">glyphicon-floppy-disk</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-floppy-open" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-floppy-open">glyphicon-floppy-open</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-floppy-remove" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-floppy-remove">glyphicon-floppy-remove</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-floppy-save" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-floppy-save">glyphicon-floppy-save</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-floppy-saved" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-floppy-saved">glyphicon-floppy-saved</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-folder-close" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-folder-close">glyphicon-folder-close</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-folder-open" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-folder-open">glyphicon-folder-open</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-font" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-font">glyphicon-font</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-forward" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-forward">glyphicon-forward</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-fullscreen" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-fullscreen">glyphicon-fullscreen</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-gbp" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-gbp">glyphicon-gbp</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-gift" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-gift">glyphicon-gift</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-glass" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-glass">glyphicon-glass</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-globe" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-globe">glyphicon-globe</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-grain" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-grain">glyphicon-grain</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-hand-down" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-hand-down">glyphicon-hand-down</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-hand-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-hand-left">glyphicon-hand-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-hand-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-hand-right">glyphicon-hand-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-hand-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-hand-up">glyphicon-hand-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-hdd" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-hdd">glyphicon-hdd</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-hd-video" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-hd-video">glyphicon-hd-video</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-header" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-header">glyphicon-header</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-headphones" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-headphones">glyphicon-headphones</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-heart" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-heart">glyphicon-heart</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-heart-empty" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-heart-empty">glyphicon-heart-empty</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-home" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-home">glyphicon-home</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-hourglass" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-hourglass">glyphicon-hourglass</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-ice-lolly" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-ice-lolly">glyphicon-ice-lolly</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-ice-lolly-tasted" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-ice-lolly-tasted">glyphicon-ice-lolly-tasted</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-import" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-import">glyphicon-import</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-inbox" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-inbox">glyphicon-inbox</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-indent-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-indent-left">glyphicon-indent-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-indent-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-indent-right">glyphicon-indent-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-info-sign" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-info-sign">glyphicon-info-sign</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-italic" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-italic">glyphicon-italic</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-king" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-king">glyphicon-king</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-knight" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-knight">glyphicon-knight</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-lamp" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-lamp">glyphicon-lamp</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-leaf" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-leaf">glyphicon-leaf</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-level-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-level-up">glyphicon-level-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-link" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-link">glyphicon-link</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-list" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-list">glyphicon-list</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-list-alt" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-list-alt">glyphicon-list-alt</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-lock" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-lock">glyphicon-lock</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-log-in" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-log-in">glyphicon-log-in</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-log-out" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-log-out">glyphicon-log-out</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-magnet" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-magnet">glyphicon-magnet</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-map-marker" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-map-marker">glyphicon-map-marker</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-menu-down" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-menu-down">glyphicon-menu-down</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-menu-hamburger" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-menu-hamburger">glyphicon-menu-hamburger</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-menu-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-menu-left">glyphicon-menu-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-menu-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-menu-right">glyphicon-menu-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-menu-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-menu-up">glyphicon-menu-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-minus" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-minus">glyphicon-minus</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-minus-sign" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-minus-sign">glyphicon-minus-sign</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-modal-window" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-modal-window">glyphicon-modal-window</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-move" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-move">glyphicon-move</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-music" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-music">glyphicon-music</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-new-window" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-new-window">glyphicon-new-window</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-object-align-bottom" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-object-align-bottom">glyphicon-object-align-bottom</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-object-align-horizontal" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-object-align-horizontal">glyphicon-object-align-horizontal</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-object-align-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-object-align-left">glyphicon-object-align-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-object-align-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-object-align-right">glyphicon-object-align-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-object-align-top" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-object-align-top">glyphicon-object-align-top</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-object-align-vertical" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-object-align-vertical">glyphicon-object-align-vertical</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-off" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-off">glyphicon-off</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-oil" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-oil">glyphicon-oil</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-ok" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-ok">glyphicon-ok</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-ok-circle" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-ok-circle">glyphicon-ok-circle</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-ok-sign" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-ok-sign">glyphicon-ok-sign</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-open" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-open">glyphicon-open</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-open-file" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-open-file">glyphicon-open-file</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-option-horizontal" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-option-horizontal">glyphicon-option-horizontal</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-option-vertical" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-option-vertical">glyphicon-option-vertical</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-paperclip" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-paperclip">glyphicon-paperclip</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-paste" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-paste">glyphicon-paste</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-pause" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-pause">glyphicon-pause</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-pawn" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-pawn">glyphicon-pawn</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-pencil" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-pencil">glyphicon-pencil</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-phone" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-phone">glyphicon-phone</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-phone-alt" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-phone-alt">glyphicon-phone-alt</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-picture" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-picture">glyphicon-picture</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-piggy-bank" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-piggy-bank">glyphicon-piggy-bank</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-plane" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-plane">glyphicon-plane</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-play" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-play">glyphicon-play</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-play-circle" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-play-circle">glyphicon-play-circle</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-plus" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-plus">glyphicon-plus</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-plus-sign" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-plus-sign">glyphicon-plus-sign</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-print" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-print">glyphicon-print</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-pushpin" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-pushpin">glyphicon-pushpin</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-qrcode" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-qrcode">glyphicon-qrcode</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-queen" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-queen">glyphicon-queen</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-question-sign" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-question-sign">glyphicon-question-sign</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-random" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-random">glyphicon-random</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-record" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-record">glyphicon-record</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-refresh" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-refresh">glyphicon-refresh</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-registration-mark" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-registration-mark">glyphicon-registration-mark</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-remove" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-remove">glyphicon-remove</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-remove-circle" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-remove-circle">glyphicon-remove-circle</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-remove-sign" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-remove-sign">glyphicon-remove-sign</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-repeat" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-repeat">glyphicon-repeat</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-resize-full" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-resize-full">glyphicon-resize-full</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-resize-horizontal" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-resize-horizontal">glyphicon-resize-horizontal</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-resize-small" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-resize-small">glyphicon-resize-small</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-resize-vertical" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-resize-vertical">glyphicon-resize-vertical</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-retweet" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-retweet">glyphicon-retweet</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-road" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-road">glyphicon-road</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-ruble" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-ruble">glyphicon-ruble</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-save" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-save">glyphicon-save</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-saved" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-saved">glyphicon-saved</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-save-file" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-save-file">glyphicon-save-file</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-scale" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-scale">glyphicon-scale</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-scissors" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-scissors">glyphicon-scissors</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-screenshot" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-screenshot">glyphicon-screenshot</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sd-video" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sd-video">glyphicon-sd-video</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-search" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-search">glyphicon-search</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-send" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-send">glyphicon-send</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-share" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-share">glyphicon-share</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-share-alt" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-share-alt">glyphicon-share-alt</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-shopping-cart" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-shopping-cart">glyphicon-shopping-cart</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-signal" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-signal">glyphicon-signal</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sort" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sort">glyphicon-sort</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sort-by-alphabet" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sort-by-alphabet">glyphicon-sort-by-alphabet</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sort-by-alphabet-alt" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sort-by-alphabet-alt">glyphicon-sort-by-alphabet-alt</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sort-by-attributes" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sort-by-attributes">glyphicon-sort-by-attributes</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sort-by-attributes-alt" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sort-by-attributes-alt">glyphicon-sort-by-attributes-alt</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sort-by-order" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sort-by-order">glyphicon-sort-by-order</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sort-by-order-alt" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sort-by-order-alt">glyphicon-sort-by-order-alt</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sound-5-1" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sound-5-1">glyphicon-sound-5-1</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sound-6-1" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sound-6-1">glyphicon-sound-6-1</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sound-7-1" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sound-7-1">glyphicon-sound-7-1</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sound-dolby" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sound-dolby">glyphicon-sound-dolby</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sound-stereo" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sound-stereo">glyphicon-sound-stereo</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-star" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-star">glyphicon-star</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-star-empty" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-star-empty">glyphicon-star-empty</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-stats" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-stats">glyphicon-stats</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-step-backward" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-step-backward">glyphicon-step-backward</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-step-forward" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-step-forward">glyphicon-step-forward</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-stop" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-stop">glyphicon-stop</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-subscript" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-subscript">glyphicon-subscript</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-subtitles" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-subtitles">glyphicon-subtitles</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-sunglasses" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-sunglasses">glyphicon-sunglasses</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-superscript" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-superscript">glyphicon-superscript</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-tag" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-tag">glyphicon-tag</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-tags" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-tags">glyphicon-tags</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-tasks" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-tasks">glyphicon-tasks</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-tent" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-tent">glyphicon-tent</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-text-background" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-text-background">glyphicon-text-background</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-text-color" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-text-color">glyphicon-text-color</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-text-height" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-text-height">glyphicon-text-height</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-text-size" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-text-size">glyphicon-text-size</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-text-width" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-text-width">glyphicon-text-width</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-th" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-th">glyphicon-th</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-th-large" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-th-large">glyphicon-th-large</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-th-list" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-th-list">glyphicon-th-list</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-thumbs-down" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-thumbs-down">glyphicon-thumbs-down</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-thumbs-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-thumbs-up">glyphicon-thumbs-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-time" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-time">glyphicon-time</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-tint" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-tint">glyphicon-tint</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-tower" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-tower">glyphicon-tower</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-transfer" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-transfer">glyphicon-transfer</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-trash" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-trash">glyphicon-trash</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-tree-conifer" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-tree-conifer">glyphicon-tree-conifer</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-tree-deciduous" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-tree-deciduous">glyphicon-tree-deciduous</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-triangle-bottom" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-triangle-bottom">glyphicon-triangle-bottom</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-triangle-left" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-triangle-left">glyphicon-triangle-left</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-triangle-right" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-triangle-right">glyphicon-triangle-right</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-triangle-top" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-triangle-top">glyphicon-triangle-top</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-unchecked" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-unchecked">glyphicon-unchecked</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-upload" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-upload">glyphicon-upload</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-usd" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-usd">glyphicon-usd</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-user" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-user">glyphicon-user</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-volume-down" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-volume-down">glyphicon-volume-down</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-volume-off" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-volume-off">glyphicon-volume-off</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-volume-up" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-volume-up">glyphicon-volume-up</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-warning-sign" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-warning-sign">glyphicon-warning-sign</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-wrench" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-wrench">glyphicon-wrench</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-yen" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-yen">glyphicon-yen</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-zoom-in" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-zoom-in">glyphicon-zoom-in</option>
				<option <?php echo (get_option( $nameOption ) == "glyphicon glyphicon-zoom-out" ?   "selected"  :  "" ); ?> value="glyphicon glyphicon-zoom-out">glyphicon-zoom-out</option>
			
			</select>
		</td>
	</tr>			

	<?php
			
	}
}