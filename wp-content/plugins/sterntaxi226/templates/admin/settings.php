<?php

Class settings{
	function __construct($widthTable, $widthInput, $showAllOptions){


		$urlImgOk = dirname(dirname(plugins_url("/", __FILE__))).'/img/button_ok.png';
		$urlImgError = dirname(dirname(plugins_url("/", __FILE__))).'/img/b16x16_cancel.png';
		

		//$url = "http://stern-taxi-fare.sternwebagency.com/wp-content/plugins/stern_taxi_fare/readme.txt";
		//$lastVersion = @file_get_contents($url);
		//$lastVersion = substr($lastVersion,65,5);
		$url = "http://stern-taxi-fare.sternwebagency.com/wp-admin/admin-ajax.php?action=version";
		$lastVersion = wp_remote_fopen($url);

		
		?>
		
		<h2><?php _e('SternTaxi Fare Settings', 'stern_taxi_fare'); ?></h2>
		
		<?php if($showAllOptions == true) : ?>
			<?php _e('Use shortcode: ', 'stern_taxi_fare'); ?><strong>[stern-taxi-fare]</strong> <?php _e('in a page or a post, or widget.', 'stern_taxi_fare'); ?>
			<br>
		<?php endif; ?>	
		
		<br>
		<form name="SternSaveSettings" method="post">
			<table name="instfare" width="<?php echo $widthTable; ?>">				

				<tr>
					<td></td>
					<td></td>
				</tr>				
				
	
			

	

				
				
				<tr>
					<td><?php _e('Currency', 'stern_taxi_fare'); ?></td>
					<td><input title="From WooCommerce settings" class='uitip' value="<?php echo get_woocommerce_currency_symbol(); ?>" type="text" readonly name="get_woocommerce_currency_symbol" style="width:<?php echo $widthInput; ?>;" ></td>
				</tr>
		

				<tr>
					<td><?php _e('Currency position', 'stern_taxi_fare'); ?></td>
					<td><input title="From WooCommerce settings" class='uitip' value="<?php echo get_option( 'woocommerce_currency_pos' ); ?>" type="text" readonly name="woocommerce_currency_pos" style="width:<?php echo $widthInput; ?>;" ></td>
				</tr>
						
				
				
				
				<?php if($showAllOptions == true) : ?>
					<tr>
						<td><?php _e('Language', 'stern_taxi_fare'); ?></td>
						<td><input title="From Wordpress settings" class='uitip' value="<?php echo get_locale(); ?>" type="text" readonly name="get_locale" style="width:<?php echo $widthInput; ?>;" ></td>
					</tr>
				<?php endif; ?>	
				
				<tr>
					<td><?php _e('Country to show', 'stern_taxi_fare'); ?></td>
					<td>
						
						<select id="stern_taxi_fare_country" name="stern_taxi_fare_country" style="width:<?php echo $widthInput; ?>;">
							<option <?php echo (get_option('stern_taxi_fare_country') == "" ? 		"selected"	 : 	""	); ?> value=""></option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "af" ? 	"selected"	 : 	""	); ?> value="af">Afghanistan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ax" ? 	"selected"	 : 	""	); ?> value="ax">Åland Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "al" ? 	"selected"	 : 	""	); ?> value="al">Albania</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "dz" ? 	"selected"	 : 	""	); ?> value="dz">Algeria</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "as" ? 	"selected"	 : 	""	); ?> value="as">American Samoa</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ad" ? 	"selected"	 : 	""	); ?> value="ad">Andorra</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ao" ? 	"selected"	 : 	""	); ?> value="ao">Angola</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ai" ? 	"selected"	 : 	""	); ?> value="ai">Anguilla</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "aq" ? 	"selected"	 : 	""	); ?> value="aq">Antarctica</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ag" ? 	"selected"	 : 	""	); ?> value="ag">Antigua and Barbuda</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ar" ? 	"selected"	 : 	""	); ?> value="ar">Argentina</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "am" ? 	"selected"	 : 	""	); ?> value="am">Armenia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "aw" ? 	"selected"	 : 	""	); ?> value="aw">Aruba</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "au" ? 	"selected"	 : 	""	); ?> value="au">Australia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "at" ? 	"selected"	 : 	""	); ?> value="at">Austria</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "az" ? 	"selected"	 : 	""	); ?> value="az">Azerbaijan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bs" ? 	"selected"	 : 	""	); ?> value="bs">Bahamas</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bh" ? 	"selected"	 : 	""	); ?> value="bh">Bahrain</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bd" ? 	"selected"	 : 	""	); ?> value="bd">Bangladesh</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bb" ? 	"selected"	 : 	""	); ?> value="bb">Barbados</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "by" ? 	"selected"	 : 	""	); ?> value="by">Belarus</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "be" ? 	"selected"	 : 	""	); ?> value="be">Belgium</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bz" ? 	"selected"	 : 	""	); ?> value="bz">Belize</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bj" ? 	"selected"	 : 	""	); ?> value="bj">Benin</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bm" ? 	"selected"	 : 	""	); ?> value="bm">Bermuda</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bt" ? 	"selected"	 : 	""	); ?> value="bt">Bhutan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bo" ? 	"selected"	 : 	""	); ?> value="bo">Bolivia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ba" ? 	"selected"	 : 	""	); ?> value="ba">Bosnia and Herzegovina</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bw" ? 	"selected"	 : 	""	); ?> value="bw">Botswana</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bv" ? 	"selected"	 : 	""	); ?> value="bv">Bouvet Island</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "br" ? 	"selected"	 : 	""	); ?> value="br">Brazil</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "io" ? 	"selected"	 : 	""	); ?> value="io">British Indian Ocean Territory</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bn" ? 	"selected"	 : 	""	); ?> value="bn">Brunei Darussalam</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bg" ? 	"selected"	 : 	""	); ?> value="bg">Bulgaria</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bf" ? 	"selected"	 : 	""	); ?> value="bf">Burkina Faso</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "bi" ? 	"selected"	 : 	""	); ?> value="bi">Burundi</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "kh" ? 	"selected"	 : 	""	); ?> value="kh">Cambodia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cm" ? 	"selected"	 : 	""	); ?> value="cm">Cameroon</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ca" ? 	"selected"	 : 	""	); ?> value="ca">Canada</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cv" ? 	"selected"	 : 	""	); ?> value="cv">Cape Verde</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ky" ? 	"selected"	 : 	""	); ?> value="ky">Cayman Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cf" ? 	"selected"	 : 	""	); ?> value="cf">Central African Republic</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "td" ? 	"selected"	 : 	""	); ?> value="td">Chad</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cl" ? 	"selected"	 : 	""	); ?> value="cl">Chile</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cn" ? 	"selected"	 : 	""	); ?> value="cn">China</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cx" ? 	"selected"	 : 	""	); ?> value="cx">Christmas Island</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cc" ? 	"selected"	 : 	""	); ?> value="cc">Cocos (Keeling) Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "co" ? 	"selected"	 : 	""	); ?> value="co">Colombia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "km" ? 	"selected"	 : 	""	); ?> value="km">Comoros</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cg" ? 	"selected"	 : 	""	); ?> value="cg">Congo</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cd" ? 	"selected"	 : 	""	); ?> value="cd">Congo, The Democratic Republic of The</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ck" ? 	"selected"	 : 	""	); ?> value="ck">Cook Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cr" ? 	"selected"	 : 	""	); ?> value="cr">Costa Rica</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ci" ? 	"selected"	 : 	""	); ?> value="ci">Cote D'ivoire</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "hr" ? 	"selected"	 : 	""	); ?> value="hr">Croatia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cu" ? 	"selected"	 : 	""	); ?> value="cu">Cuba</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cy" ? 	"selected"	 : 	""	); ?> value="cy">Cyprus</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "cz" ? 	"selected"	 : 	""	); ?> value="cz">Czech Republic</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "dk" ? 	"selected"	 : 	""	); ?> value="dk">Denmark</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "dj" ? 	"selected"	 : 	""	); ?> value="dj">Djibouti</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "dm" ? 	"selected"	 : 	""	); ?> value="dm">Dominica</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "do" ? 	"selected"	 : 	""	); ?> value="do">Dominican Republic</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ec" ? 	"selected"	 : 	""	); ?> value="ec">Ecuador</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "eg" ? 	"selected"	 : 	""	); ?> value="eg">Egypt</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sv" ? 	"selected"	 : 	""	); ?> value="sv">El Salvador</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gq" ? 	"selected"	 : 	""	); ?> value="gq">Equatorial Guinea</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "er" ? 	"selected"	 : 	""	); ?> value="er">Eritrea</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ee" ? 	"selected"	 : 	""	); ?> value="ee">Estonia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "et" ? 	"selected"	 : 	""	); ?> value="et">Ethiopia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "fk" ? 	"selected"	 : 	""	); ?> value="fk">Falkland Islands (Malvinas)</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "fo" ? 	"selected"	 : 	""	); ?> value="fo">Faroe Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "fj" ? 	"selected"	 : 	""	); ?> value="fj">Fiji</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "fi" ? 	"selected"	 : 	""	); ?> value="fi">Finland</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "fr" ? 	"selected"	 : 	""	); ?> value="fr">France</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gf" ? 	"selected"	 : 	""	); ?> value="gf">French Guiana</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pf" ? 	"selected"	 : 	""	); ?> value="pf">French Polynesia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tf" ? 	"selected"	 : 	""	); ?> value="tf">French Southern Territories</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ga" ? 	"selected"	 : 	""	); ?> value="ga">Gabon</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gm" ? 	"selected"	 : 	""	); ?> value="gm">Gambia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ge" ? 	"selected"	 : 	""	); ?> value="ge">Georgia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "de" ? 	"selected"	 : 	""	); ?> value="de">Germany</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gh" ? 	"selected"	 : 	""	); ?> value="gh">Ghana</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gi" ? 	"selected"	 : 	""	); ?> value="gi">Gibraltar</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gr" ? 	"selected"	 : 	""	); ?> value="gr">Greece</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gl" ? 	"selected"	 : 	""	); ?> value="gl">Greenland</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gd" ? 	"selected"	 : 	""	); ?> value="gd">Grenada</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gp" ? 	"selected"	 : 	""	); ?> value="gp">Guadeloupe</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gu" ? 	"selected"	 : 	""	); ?> value="gu">Guam</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gt" ? 	"selected"	 : 	""	); ?> value="gt">Guatemala</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gg" ? 	"selected"	 : 	""	); ?> value="gg">Guernsey</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gn" ? 	"selected"	 : 	""	); ?> value="gn">Guinea</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gw" ? 	"selected"	 : 	""	); ?> value="gw">Guinea-bissau</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gy" ? 	"selected"	 : 	""	); ?> value="gy">Guyana</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ht" ? 	"selected"	 : 	""	); ?> value="ht">Haiti</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "hm" ? 	"selected"	 : 	""	); ?> value="hm">Heard Island and Mcdonald Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "va" ? 	"selected"	 : 	""	); ?> value="va">Holy See (Vatican City State)</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "hn" ? 	"selected"	 : 	""	); ?> value="hn">Honduras</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "hk" ? 	"selected"	 : 	""	); ?> value="hk">Hong Kong</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "hu" ? 	"selected"	 : 	""	); ?> value="hu">Hungary</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "is" ? 	"selected"	 : 	""	); ?> value="is">Iceland</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "in" ? 	"selected"	 : 	""	); ?> value="in">India</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "id" ? 	"selected"	 : 	""	); ?> value="id">Indonesia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ir" ? 	"selected"	 : 	""	); ?> value="ir">Iran, Islamic Republic of</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "iq" ? 	"selected"	 : 	""	); ?> value="iq">Iraq</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ie" ? 	"selected"	 : 	""	); ?> value="ie">Ireland</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "im" ? 	"selected"	 : 	""	); ?> value="im">Isle of Man</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "il" ? 	"selected"	 : 	""	); ?> value="il">Israel</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "it" ? 	"selected"	 : 	""	); ?> value="it">Italy</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "jm" ? 	"selected"	 : 	""	); ?> value="jm">Jamaica</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "jp" ? 	"selected"	 : 	""	); ?> value="jp">Japan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "je" ? 	"selected"	 : 	""	); ?> value="je">Jersey</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "jo" ? 	"selected"	 : 	""	); ?> value="jo">Jordan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "kz" ? 	"selected"	 : 	""	); ?> value="kz">Kazakhstan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ke" ? 	"selected"	 : 	""	); ?> value="ke">Kenya</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ki" ? 	"selected"	 : 	""	); ?> value="ki">Kiribati</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "kp" ? 	"selected"	 : 	""	); ?> value="kp">Korea, Democratic People's Republic of</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "kr" ? 	"selected"	 : 	""	); ?> value="kr">Korea, Republic of</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "kw" ? 	"selected"	 : 	""	); ?> value="kw">Kuwait</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "kg" ? 	"selected"	 : 	""	); ?> value="kg">Kyrgyzstan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "la" ? 	"selected"	 : 	""	); ?> value="la">Lao People's Democratic Republic</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "lv" ? 	"selected"	 : 	""	); ?> value="lv">Latvia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "lb" ? 	"selected"	 : 	""	); ?> value="lb">Lebanon</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ls" ? 	"selected"	 : 	""	); ?> value="ls">Lesotho</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "lr" ? 	"selected"	 : 	""	); ?> value="lr">Liberia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ly" ? 	"selected"	 : 	""	); ?> value="ly">Libyan Arab Jamahiriya</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "li" ? 	"selected"	 : 	""	); ?> value="li">Liechtenstein</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "lt" ? 	"selected"	 : 	""	); ?> value="lt">Lithuania</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "lu" ? 	"selected"	 : 	""	); ?> value="lu">Luxembourg</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mo" ? 	"selected"	 : 	""	); ?> value="mo">Macao</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mk" ? 	"selected"	 : 	""	); ?> value="mk">Macedonia, The Former Yugoslav Republic of</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mg" ? 	"selected"	 : 	""	); ?> value="mg">Madagascar</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mw" ? 	"selected"	 : 	""	); ?> value="mw">Malawi</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "my" ? 	"selected"	 : 	""	); ?> value="my">Malaysia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mv" ? 	"selected"	 : 	""	); ?> value="mv">Maldives</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ml" ? 	"selected"	 : 	""	); ?> value="ml">Mali</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mt" ? 	"selected"	 : 	""	); ?> value="mt">Malta</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mh" ? 	"selected"	 : 	""	); ?> value="mh">Marshall Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mq" ? 	"selected"	 : 	""	); ?> value="mq">Martinique</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mr" ? 	"selected"	 : 	""	); ?> value="mr">Mauritania</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mu" ? 	"selected"	 : 	""	); ?> value="mu">Mauritius</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "yt" ? 	"selected"	 : 	""	); ?> value="yt">Mayotte</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mx" ? 	"selected"	 : 	""	); ?> value="mx">Mexico</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "fm" ? 	"selected"	 : 	""	); ?> value="fm">Micronesia, Federated States of</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "md" ? 	"selected"	 : 	""	); ?> value="md">Moldova, Republic of</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mc" ? 	"selected"	 : 	""	); ?> value="mc">Monaco</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mn" ? 	"selected"	 : 	""	); ?> value="mn">Mongolia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "me" ? 	"selected"	 : 	""	); ?> value="me">Montenegro</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ms" ? 	"selected"	 : 	""	); ?> value="ms">Montserrat</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ma" ? 	"selected"	 : 	""	); ?> value="ma">Morocco</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mz" ? 	"selected"	 : 	""	); ?> value="mz">Mozambique</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mm" ? 	"selected"	 : 	""	); ?> value="mm">Myanmar</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "na" ? 	"selected"	 : 	""	); ?> value="na">Namibia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "nr" ? 	"selected"	 : 	""	); ?> value="nr">Nauru</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "np" ? 	"selected"	 : 	""	); ?> value="np">Nepal</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "nl" ? 	"selected"	 : 	""	); ?> value="nl">Netherlands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "an" ? 	"selected"	 : 	""	); ?> value="an">Netherlands Antilles</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "nc" ? 	"selected"	 : 	""	); ?> value="nc">New Caledonia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "nz" ? 	"selected"	 : 	""	); ?> value="nz">New Zealand</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ni" ? 	"selected"	 : 	""	); ?> value="ni">Nicaragua</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ne" ? 	"selected"	 : 	""	); ?> value="ne">Niger</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ng" ? 	"selected"	 : 	""	); ?> value="ng">Nigeria</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "nu" ? 	"selected"	 : 	""	); ?> value="nu">Niue</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "nf" ? 	"selected"	 : 	""	); ?> value="nf">Norfolk Island</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "mp" ? 	"selected"	 : 	""	); ?> value="mp">Northern Mariana Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "no" ? 	"selected"	 : 	""	); ?> value="no">Norway</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "om" ? 	"selected"	 : 	""	); ?> value="om">Oman</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pk" ? 	"selected"	 : 	""	); ?> value="pk">Pakistan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pw" ? 	"selected"	 : 	""	); ?> value="pw">Palau</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ps" ? 	"selected"	 : 	""	); ?> value="ps">Palestinian Territory, Occupied</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pa" ? 	"selected"	 : 	""	); ?> value="pa">Panama</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pg" ? 	"selected"	 : 	""	); ?> value="pg">Papua New Guinea</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "py" ? 	"selected"	 : 	""	); ?> value="py">Paraguay</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pe" ? 	"selected"	 : 	""	); ?> value="pe">Peru</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ph" ? 	"selected"	 : 	""	); ?> value="ph">Philippines</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pn" ? 	"selected"	 : 	""	); ?> value="pn">Pitcairn</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pl" ? 	"selected"	 : 	""	); ?> value="pl">Poland</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pt" ? 	"selected"	 : 	""	); ?> value="pt">Portugal</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pr" ? 	"selected"	 : 	""	); ?> value="pr">Puerto Rico</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "qa" ? 	"selected"	 : 	""	); ?> value="qa">Qatar</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "re" ? 	"selected"	 : 	""	); ?> value="re">Reunion</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ro" ? 	"selected"	 : 	""	); ?> value="ro">Romania</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ru" ? 	"selected"	 : 	""	); ?> value="ru">Russian Federation</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "rw" ? 	"selected"	 : 	""	); ?> value="rw">Rwanda</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sh" ? 	"selected"	 : 	""	); ?> value="sh">Saint Helena</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "kn" ? 	"selected"	 : 	""	); ?> value="kn">Saint Kitts and Nevis</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "lc" ? 	"selected"	 : 	""	); ?> value="lc">Saint Lucia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "pm" ? 	"selected"	 : 	""	); ?> value="pm">Saint Pierre and Miquelon</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "vc" ? 	"selected"	 : 	""	); ?> value="vc">Saint Vincent and The Grenadines</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ws" ? 	"selected"	 : 	""	); ?> value="ws">Samoa</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sm" ? 	"selected"	 : 	""	); ?> value="sm">San Marino</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "st" ? 	"selected"	 : 	""	); ?> value="st">Sao Tome and Principe</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sa" ? 	"selected"	 : 	""	); ?> value="sa">Saudi Arabia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sn" ? 	"selected"	 : 	""	); ?> value="sn">Senegal</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "rs" ? 	"selected"	 : 	""	); ?> value="rs">Serbia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sc" ? 	"selected"	 : 	""	); ?> value="sc">Seychelles</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sl" ? 	"selected"	 : 	""	); ?> value="sl">Sierra Leone</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sg" ? 	"selected"	 : 	""	); ?> value="sg">Singapore</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sk" ? 	"selected"	 : 	""	); ?> value="sk">Slovakia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "si" ? 	"selected"	 : 	""	); ?> value="si">Slovenia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sb" ? 	"selected"	 : 	""	); ?> value="sb">Solomon Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "so" ? 	"selected"	 : 	""	); ?> value="so">Somalia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "za" ? 	"selected"	 : 	""	); ?> value="za">South Africa</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gs" ? 	"selected"	 : 	""	); ?> value="gs">South Georgia and The South Sandwich Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "es" ? 	"selected"	 : 	""	); ?> value="es">Spain</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "lk" ? 	"selected"	 : 	""	); ?> value="lk">Sri Lanka</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sd" ? 	"selected"	 : 	""	); ?> value="sd">Sudan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sr" ? 	"selected"	 : 	""	); ?> value="sr">Suriname</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sj" ? 	"selected"	 : 	""	); ?> value="sj">Svalbard and Jan Mayen</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sz" ? 	"selected"	 : 	""	); ?> value="sz">Swaziland</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "se" ? 	"selected"	 : 	""	); ?> value="se">Sweden</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ch" ? 	"selected"	 : 	""	); ?> value="ch">Switzerland</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "sy" ? 	"selected"	 : 	""	); ?> value="sy">Syrian Arab Republic</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tw" ? 	"selected"	 : 	""	); ?> value="tw">Taiwan, Province of China</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tj" ? 	"selected"	 : 	""	); ?> value="tj">Tajikistan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tz" ? 	"selected"	 : 	""	); ?> value="tz">Tanzania, United Republic of</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "th" ? 	"selected"	 : 	""	); ?> value="th">Thailand</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tl" ? 	"selected"	 : 	""	); ?> value="tl">Timor-leste</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tg" ? 	"selected"	 : 	""	); ?> value="tg">Togo</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tk" ? 	"selected"	 : 	""	); ?> value="tk">Tokelau</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "to" ? 	"selected"	 : 	""	); ?> value="to">Tonga</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tt" ? 	"selected"	 : 	""	); ?> value="tt">Trinidad and Tobago</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tn" ? 	"selected"	 : 	""	); ?> value="tn">Tunisia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tr" ? 	"selected"	 : 	""	); ?> value="tr">Turkey</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tm" ? 	"selected"	 : 	""	); ?> value="tm">Turkmenistan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tc" ? 	"selected"	 : 	""	); ?> value="tc">Turks and Caicos Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "tv" ? 	"selected"	 : 	""	); ?> value="tv">Tuvalu</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ug" ? 	"selected"	 : 	""	); ?> value="ug">Uganda</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ua" ? 	"selected"	 : 	""	); ?> value="ua">Ukraine</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ae" ? 	"selected"	 : 	""	); ?> value="ae">United Arab Emirates</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "gb" ? 	"selected"	 : 	""	); ?> value="gb">United Kingdom</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "us" ? 	"selected"	 : 	""	); ?> value="us">United States</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "um" ? 	"selected"	 : 	""	); ?> value="um">United States Minor Outlying Islands</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "uy" ? 	"selected"	 : 	""	); ?> value="uy">Uruguay</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "uz" ? 	"selected"	 : 	""	); ?> value="uz">Uzbekistan</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "vu" ? 	"selected"	 : 	""	); ?> value="vu">Vanuatu</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ve" ? 	"selected"	 : 	""	); ?> value="ve">Venezuela</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "vn" ? 	"selected"	 : 	""	); ?> value="vn">Viet Nam</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "vg" ? 	"selected"	 : 	""	); ?> value="vg">Virgin Islands, British</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "vi" ? 	"selected"	 : 	""	); ?> value="vi">Virgin Islands, U.S.</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "wf" ? 	"selected"	 : 	""	); ?> value="wf">Wallis and Futuna</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "eh" ? 	"selected"	 : 	""	); ?> value="eh">Western Sahara</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "ye" ? 	"selected"	 : 	""	); ?> value="ye">Yemen</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "zm" ? 	"selected"	 : 	""	); ?> value="zm">Zambia</option>
							<option <?php echo (get_option('stern_taxi_fare_country') == "zw" ? 	"selected"	 : 	""	); ?> value="zw">Zimbabwe</option>
						</select>					
						
					</td>
				</tr>				

				<tr>
					<td><?php _e('Unit Systems', 'stern_taxi_fare'); ?></td>					
					<td>
						<select name="stern_taxi_fare_km_mile" style="width:<?php echo $widthInput; ?>;">
						<?php
							if (get_option('stern_taxi_fare_km_mile')=='km') {$selected ="selected";} else {$selected ="";}
							echo "<option  value='km' ".$selected.">km</option>";
							if (get_option('stern_taxi_fare_km_mile')=='miles') {$selected ="selected";} else {$selected ="";}
							echo "<option  value='miles' ".$selected.">miles</option>";
						?>
						</select>
					</td>
				</tr>

				<tr>
					<td>
						<?php echo _e('Format Date', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select id="stern_taxi_fare_formatDate" name="stern_taxi_fare_formatDate" style="width:<?php echo $widthInput; ?>;">
							<option <?php echo (get_option('stern_taxi_fare_formatDate') == "" ? 		"selected"	 : 	""	); ?> value=""></option>
							<option <?php echo (get_option('stern_taxi_fare_formatDate') == "DD/MM/YYYY" ? 	"selected"	 : 	""	); ?> value="DD/MM/YYYY">DD/MM/YYYY</option>
							<option <?php echo (get_option('stern_taxi_fare_formatDate') == "MM/DD/YYYY" ? 	"selected"	 : 	""	); ?> value="MM/DD/YYYY">MM/DD/YYYY</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo _e('Format Time', 'stern_taxi_fare'); ?>
					</td>
					<td>
						<select id="stern_taxi_fare_formatTime" name="stern_taxi_fare_formatTime" style="width:<?php echo $widthInput; ?>;">
							<option <?php echo (get_option('stern_taxi_fare_formatTime') == "" ? 		"selected"	 : 	""	); ?> value=""></option>
							<option <?php echo (get_option('stern_taxi_fare_formatTime') == "12h" ? 	"selected"	 : 	""	); ?> value="12h">12h</option>
							<option <?php echo (get_option('stern_taxi_fare_formatTime') == "24h" ? 	"selected"	 : 	""	); ?> value="24h">24h</option>
						</select>
					</td>
				</tr>
				<?php if($showAllOptions == true) : ?>
					<tr>
						<td><?php _e('First date available', 'stern_taxi_fare'); ?></td>
						<td><input value="<?php echo getFirst_date_available_in_hours(); ?>" type="number" step="0.1" name="First_date_available_in_hours" style="width:<?php echo $widthInput; ?>;" ><?php _e('Hours', 'stern_taxi_fare'); ?></td>
					</tr>					
					
					<tr>
						<td><?php _e('First date available round trip', 'stern_taxi_fare'); ?></td>
						<td><input value="<?php echo getFirst_date_available_roundtrip_in_hours(); ?>" type="number" step="0.1" name="First_date_available_roundtrip_in_hours" style="width:<?php echo $widthInput; ?>;" ><?php _e('Hours', 'stern_taxi_fare'); ?></td>
					</tr>	
				<?php endif; ?>
				


                
				
				<tr>
					<td><?php _e('Round trip', 'stern_taxi_fare'); ?></td>
					<td>					
						<select name="stern_taxi_fare_round_trip" style="width:<?php echo $widthInput; ?>;">
						<?php
							if (get_option('stern_taxi_fare_round_trip')=='') {$selected ="selected";} else {$selected ="";}
							echo "<option  value='' ".$selected."></option>";						
							if (get_option('stern_taxi_fare_round_trip')=='true') {$selected ="selected";} else {$selected ="";}
							echo "<option  value='true' ".$selected.">true</option>";
							if (get_option('stern_taxi_fare_round_trip')=='false') {$selected ="selected";} else {$selected ="";}
							echo "<option  value='false' ".$selected.">false</option>";
						?>
						</select>
					</td>
				</tr>


			
				<tr>
					<td><?php _e('Address of destination button', 'stern_taxi_fare'); ?></td>
					<td>
						<input value="<?php echo get_option('stern_taxi_fare_address_saved_point'); ?>" type="text" id="typeSourceValue" name="stern_taxi_fare_address_saved_point" style="width:<?php echo $widthInput; ?>;" >
					</td>
				</tr>
				<tr>
					<td><?php _e('Address of destination button2', 'stern_taxi_fare'); ?></td>
					<td>
						<input title="Second click" class='uitip' value="<?php echo get_option('stern_taxi_fare_address_saved_point2'); ?>" type="text" id="typeDestinationValue" name="stern_taxi_fare_address_saved_point2" style="width:<?php echo $widthInput; ?>;" >
					</td>
				</tr>				
							
				
				<?php if($showAllOptions == true) : ?>
					<tr>
						<td>ID product</td>
						<td><input value="<?php echo get_option('stern_taxi_fare_product_id_wc'); ?>" type="number"  name="stern_taxi_fare_product_id_wc" style="width:<?php echo $widthInput; ?>;">
						<?php 
						if(isProductCreated()) : ?>
							<img src=<?php echo $urlImgOk; ?>>
						<?php else: ?>
							<img src=<?php echo $urlImgError; ?>> Find ID of product "taxi fare" or <input type="submit" id="createProduct" value="createProduct" class="button-primary" name="createProduct" />
							
						<?php endif; ?>

						<a href="<?php echo esc_url( get_permalink(get_option('stern_taxi_fare_product_id_wc')) ); ?>"><?php echo esc_url( get_permalink(get_option('stern_taxi_fare_product_id_wc')) ); ?></a></td>
					</tr>
				<?php endif; ?>
				
				<tr>
					<td><?php _e('Avoid highways in calculation', 'stern_taxi_fare'); ?></td>
					<td>
						<select name="stern_taxi_fare_avoid_highways_in_calculation" style="width:<?php echo $widthInput; ?>;">
						<?php
							if (get_option('stern_taxi_fare_avoid_highways_in_calculation')=='') {$selected ="selected";} else {$selected ="";}
							echo "<option  value='' ".$selected."></option>";
							if (get_option('stern_taxi_fare_avoid_highways_in_calculation')=='true') {$selected ="selected";} else {$selected ="";}
							echo "<option  value='true' ".$selected.">true</option>";
							if (get_option('stern_taxi_fare_avoid_highways_in_calculation')=='false') {$selected ="selected";} else {$selected ="";}
							echo "<option  value='false' ".$selected.">false</option>";
						?>
						</select>
					</td>
				</tr>

				
			
				<?php if($showAllOptions == true) : ?>		
					<?php $title = __('Use traffic in Calculation', 'stern_taxi_fare'); ?>
					<?php $nameOption = "stern_taxi_fare_use_traffic_in_calculation"; ?>					
					<?php $tooltip = __('Use traffic in Calculation', 'stern_taxi_fare'); ?>				
					<?php $helpURL = ""; ?>
					<?php $helpLabel  = "";	?>	
					<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $helpURL, $helpLabel); ?>															
				<?php endif; ?>
			


				
					
				<?php if($showAllOptions == true) : ?>
				
					<?php new woocommerceStatus; ?>
					<tr>
						<td>Api Google</td>
						<td>
							<h2>Warning!</h2>
							Google map APIs is free, but it is limited. See details here : 
							<a href="https://developers.google.com/maps/documentation/business/faq#usage_limits">Usage limits for the Google Maps API</a> and 
							<a href="https://developers.google.com/maps/documentation/javascript/usage">here</a>. <br>
							Moreover, Google has changed his maps API. You might have the error message: "oops! something went wrong". Your key must be correctly set up. Please follow carefully this <a href="http://www.stern-taxi-fare.sternwebagency.com/docs/google-api/">tutorial</a> to solve this issue. 
							
							
					</tr>
						
		

				
					<?php $nameOption = "stern_taxi_fare_apiGoogleKey"; ?>
					<?php $title = __('Api Google Key. Free ', 'stern_taxi_fare').'<a target="_blank" href="https://developers.google.com/api-client-library/python/auth/api-keys">here</a>'; ?>
					<?php $tooltip = __('Example: AIzaSyD5UzF18OX_hlanu8LK_HIiqPybLHP9Dao', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
					<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>

						
				
			
		
					
				
					<?php if(get_option("stern_taxi_fare_debug") == "true") : ?>
						<tr>
							<td><?php _e('Max queries to API google', 'stern_taxi_fare'); ?></td>
							<td>
								<input value="<?php echo get_option('max_queries_to_API_google'); ?>" type="number" step="1" name="max_queries_to_API_google" style="width:<?php echo $widthInput; ?>;">
							</td>
						</tr>
					<?php endif ?>
					<?php if(get_option("stern_taxi_fare_debug") == "true") : ?>
						<tr>
							<td><?php _e('Time between each API google queries', 'stern_taxi_fare'); ?></td>
							<td>
								<input value="<?php echo get_option('Time_between_each_API_google_queries'); ?>" type="number" step="1" name="Time_between_each_API_google_queries" style="width:<?php echo $widthInput; ?>;">ms</a>
							</td>
						</tr>
					<?php endif ?>
						

					<?php if(get_option("stern_taxi_fare_debug") == "true") : ?>
						<tr>
							<td><?php _e('Output information about allow_url_fopen: ', 'stern_taxi_fare'); ?></td>
							<td>
								<?php if (isFopenOk()) : ?>
									<img src=<?php echo $urlImgOk; ?>> OK! fopen is allowed on this host. 
								<?php else: ?>
									<img src=<?php echo $urlImgError; ?>> W! fopen is not allowed on this host.
									<?php showHelp("http://stern-taxi-fare.sternwebagency.com/docs/troubleshooting/","fopen is not allowed on this host."); ?>
								<?php endif; ?>						
								
							</td>
						</tr>
					<?php endif ?>
					
					
					
					
						<tr>
							<td>API distancematrix</td>
							<td>
								<?php if(isAPIDistancematrixEnable()) : ?>
									<img src=<?php echo $urlImgOk; ?>> OK! 
								<?php else: ?>
									<img src=<?php echo $urlImgError; ?>> Error!
									<?php showHelp("http://stern-taxi-fare.sternwebagency.com/docs/google-api/","Google API error"); ?>				
								<?php endif; ?>						
								
							</td>
						</tr>

						
						
						<tr>
							<td>API geocode</td>
							<td>					
								<?php if(isAPIGeocodeEnable()) : ?>
									<img src=<?php echo $urlImgOk; ?>> OK! 
								<?php else: ?>
									<img src=<?php echo $urlImgError; ?>> Error!
									<?php showHelp("http://stern-taxi-fare.sternwebagency.com/docs/google-api/","Google API error"); ?>
									<?php if(get_option("stern_taxi_fare_debug") == "true") : ?>
										<br>
										-----------------------------DEBUG-----------------------------
										<br>
										<?php var_dump( getDataAPIGeocodeEnable()); ?>
										<br>
										-----------------------------DEBUG-----------------------------										
									<?php endif; ?>									
								<?php endif; ?>						
								
							</td>
						</tr>				

						<tr>
							<td>API directions</td>
							<td>
											
								<?php if(isAPIDirectionsEnable()) : ?>
									<img src=<?php echo $urlImgOk; ?>> OK! 
								<?php else: ?>
									<img src=<?php echo $urlImgError; ?>> Error!
									<?php showHelp("http://stern-taxi-fare.sternwebagency.com/docs/google-api/","Google API error"); ?>
									<?php if(get_option("stern_taxi_fare_debug") == "true") : ?>
										<br>
										-----------------------------DEBUG-----------------------------
										<br>
										<?php var_dump( getDataAPIDirections()); ?>
										<br>
										<a href="<?php echo getDataAPIDirectionsURL(); ?>"><?php echo getDataAPIDirectionsURL(); ?></a>
										<br>										
										-----------------------------DEBUG-----------------------------										
									<?php endif; ?>
								<?php endif; ?>						
								
								
								</pre>
							</td>
						</tr>					

						<tr>
							<td><?php _e('Google Maps Embed API', 'stern_taxi_fare'); ?></td>
							<td>
								<?php 
									$url="";
									$url.="https://www.google.com/maps/embed/v1/directions?";
									$url.="origin=paris";
									$url.="&destination=san+fransisco";
									$url.="&key=".get_option('stern_taxi_fare_apiGoogleKey');
									//$data = file_get_contents($url);
								//	$data = json_decode($data);
								?>
								<iframe  width='<?php echo $widthInput; ?>'   height='150' frameborder='0' style='border:0' allowfullscreen src='<?php echo $url; ?>'> </iframe>
										
								
							</td>
						</tr>
					
					
						
						<?php if(get_option('stern_taxi_fare_show_demo_setting') == "345") : ?>		
							<?php if($showAllOptions == true) : ?>		
								<?php $title = __('Add Address between origin and destination', 'stern_taxi_fare'); ?>
								<?php $nameOption = "stern_taxi_fare_allow_waypoints"; ?>					
								<?php $tooltip = __('Thanks to a drand and drop, customer can addresses between pickup address and destination address', 'stern_taxi_fare'); ?>				
								<?php $helpURL = ""; ?>
								<?php $helpLabel  = "";	?>	
								<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $helpURL, $helpLabel); ?>															
							<?php endif; ?>
						<?php endif; ?>



						<?php if(false) : ?>		
							<?php $title = __('Envato Item Purchase Code', 'stern_taxi_fare'); ?>
							<?php $nameOption = "stern_taxi_fare_envato_purchase_code"; ?>					
							<?php $tooltip = __('Optional', 'stern_taxi_fare'); ?>				
							<?php $helpURL = ""; ?>
							<?php $helpLabel  = "";	?>	
							<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>
						<?php endif; ?>		
						

			
						<?php if(false) : ?>
							<tr>
								<td></td>
								<td>
												
									<?php if( isOk_envato_verify_purchase()) : ?>
										<img src=<?php echo $urlImgOk; ?>> OK! 
										<?php
											$purchase_data = envato_verify_purchase( get_option('stern_taxi_fare_envato_purchase_code') );
											echo '<strong>Valid License Key!</strong><br><ul>';
											echo '<li>Item ID: ' . $purchase_data['verify-purchase']['item_id'] . '</li>';
											echo '<li>Item Name: ' . $purchase_data['verify-purchase']['item_name'] . '</li>';
											echo '<li>Buyer: ' . $purchase_data['verify-purchase']['buyer'] . '</li>';
											update_option('stern_taxi_fare_buyer' , sanitize_text_field($purchase_data['verify-purchase']['buyer']) );
											echo '<li>License: ' . $purchase_data['verify-purchase']['licence'] . '</li>';
											echo '<li>Created At: ' . $purchase_data['verify-purchase']['created_at'] . '</li>';
											echo '<li>Supported Until: ' . $purchase_data['verify-purchase']['supported_until'] . '</li>';
											echo '</ul>';
										?>	
									<?php else: ?>
										<img src=<?php echo $urlImgError; ?>> Error!
										<?php showHelp("http://stern-taxi-fare.sternwebagency.com/docs/f-where-is-my-purchase-code/","Where Is My Purchase Code?"); ?>
										<?php echo 'Invalid license key.'; ?>
								
									<?php endif; ?>						
									<?php if(get_option("stern_taxi_fare_debug") == "true") : ?>
										<br>
										-----------------------------DEBUG-----------------------------
										<br>
										<pre>
										<?php var_dump( envato_verify_purchase( get_option('stern_taxi_fare_envato_purchase_code') )); ?>
										</pre>
										<br>
										-----------------------------DEBUG-----------------------------										
									<?php endif; ?>										
									
									
								</td>
							</tr>									
						<?php endif; ?>	
						
						<?php if(get_option("stern_taxi_fare_debug") == "true") : ?>
							<?php $nameOption = "stern_taxi_fare_show_demo_setting"; ?>
							<?php $title = __('Show demo Setting', 'stern_taxi_fare'); ?>
							<?php $tooltip = __('Show demo', 'stern_taxi_fare', 'stern_taxi_fare'); ?>				
							<?php new showInputOption($nameOption, $title, $tooltip, $widthInput); ?>
						<?php endif; ?>	
																			

										

						
						<?php if($showAllOptions == true) : ?>		
							<?php $title = __('Debug mode', 'stern_taxi_fare'); ?>
							<?php $nameOption = "stern_taxi_fare_debug"; ?>					
							<?php $tooltip = __('Use Only when a debug is necessary', 'stern_taxi_fare'); ?>				
							<?php $helpURL = ""; ?>
							<?php $helpLabel  = "";	?>	
							<?php new showBoolOption($nameOption, $title, $tooltip, $widthInput, $helpURL, $helpLabel); ?>															
						<?php endif; ?>						
						
						
						
					<?php if(false) : ?>	
						<tr>
							<td><?php _e('Actual Version: ', 'stern_taxi_fare'); ?><?php echo getPluginVersion(); ?></td>
							<td>
								<?php if(version_compare(getPluginVersion(),$lastVersion,'>=')) : ?>
									<a href="http://codecanyon.net/item/stern-taxi-fare/13394053"><img src=<?php echo $urlImgOk; ?>></a> OK! 
								<?php else: ?>
									<a href="http://codecanyon.net/item/stern-taxi-fare/13394053"><img src=<?php echo $urlImgError; ?>></a> <?php _e('Latest version: ', 'stern_taxi_fare'); ?> <?php echo 	$lastVersion; ?></td>
								<?php endif; ?>	
								<?php if(get_option("stern_taxi_fare_debug") == "true") : ?>
										<br>
										-----------------------------DEBUG-----------------------------
										<br>
								<?php echo "Last Version: ".$lastVersion; ?> 
										<br>
										-----------------------------DEBUG-----------------------------								
								<?php endif; ?>	
								
							</td>					
						</tr>
					<?php endif; ?>	             
				<?php endif; ?>	

				
				<tr>
					<td></td>
					<td></td>
				</tr>				
				
				
				<tr>
					<td><input type="submit" id="faresubmit" value="<?php _e('Save', 'stern_taxi_fare'); ?>" class="button-primary" name="SternSaveSettings" style="width:150px;"/></td>
					<td>
						<?php if($showAllOptions == true) : ?>
							<input type="submit" id="initVal" value="Reset Options" class="button-primary" name="initVal" />
						<?php endif; ?>	
					</td>
				</tr>
				

		
			</table>
		</form>
		<input type="hidden"  name="countryHidden" id="countryHidden" value="<?php echo get_option('stern_taxi_fare_country'); ?>"/>
		<br>
		<?php
	}
}