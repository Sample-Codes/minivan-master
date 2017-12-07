<?php
function showDemoSettings($backgroundColor) {

?>	



	<?php if(get_option('stern_taxi_fare_show_demo_setting') =="345") : ?>
		
		<div id="settingDemo" style="<?php echo $backgroundColor; ?>;">
		<a class='closeBoxSettingDemo' id='closeBoxSettingDemo' onclick='closeBoxSettingDemo();'></a>
			<?php 
				if (
					($_SERVER['REQUEST_METHOD'] == 'POST') && (
						isset($_POST['SternSaveSettings']) or 
						isset($_POST['SternSaveSettingsCalendarTableSubmit']) or 
						isset($_POST['SettingsTemplateListAddressSubmit']))
					)
				{		
					updateOptionsSternTaxiFare();
				}

				
							
				new settings("350px","60px",false);
				new design("350px","60px",false);				
				new templateListAddress("350px","60px",false);	
				new templateCalendar("350px","60px",false);	
				
			?>
						
		</div>
	<?php endif;?>
		
<?php	
}										