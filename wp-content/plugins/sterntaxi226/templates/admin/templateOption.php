<?php

if ( ! defined( 'ABSPATH' ) )
	exit;


Class showInputNumberOption{
	function __construct($nameOption, $title, $tooltip, $width, $step="1", $helpURL=null, $helpLabel=null ){
		
	
		?>
			<tr>
				<td>
					<?php echo $title; ?>
				</td>
				
				<td>
					<input value="<?php echo get_option($nameOption); ?>" type="number" step="<?php echo $step; ?>" id="<?php echo $nameOption; ?>" name="<?php echo $nameOption; ?>" title='<?php echo $tooltip; ?>' class='uitip' style="width:<?php echo $width; ?>;">
				</td>
				<td>
					<?php 
						if($helpURL!=null) {
							showHelp($helpURL, $helpLabel); 
						}
					?>
				</td>			
			</tr>
	
		<?php
			
	}
}

Class showInputOption{
	function __construct($nameOption, $title, $tooltip, $width, $helpURL=null, $helpLabel=null) {
		
	
	?>			
		<tr>
			<td><?php echo $title; ?></td>
			<td>
				<input value="<?php echo get_option($nameOption); ?>" type="text" name="<?php echo $nameOption; ?>" title='<?php echo $tooltip; ?>' class='uitip' style="width:<?php echo $width; ?>;"> 
			</td>
			<td>
				<?php 
					if($helpURL!=null) {
						showHelp($helpURL, $helpLabel); 
					}
				?>
			</td>			
		</tr>
	<?php
	}
}




Class showBoolOption{
	function __construct($nameOption, $title, $tooltip, $width, $helpURL=null, $helpLabel=null) {

		?>
			<tr>
				<td>
					<?php echo $title; ?>
				</td>
				<td>
					<select id="<?php echo $nameOption; ?>" name="<?php echo $nameOption; ?>" title='<?php echo $tooltip; ?>' class='uitip' style="width:<?php echo $width; ?>;">
						<option <?php echo (get_option($nameOption) == "" ? 		"selected"	 : 	""	); ?> value=""></option>
						<option <?php echo (get_option($nameOption) == "true" ? 	"selected"	 : 	""	); ?> value="true">true</option>
						<option <?php echo (get_option($nameOption) == "false" ? 	"selected"	 : 	""	); ?> value="false">false</option>
					</select>				
				</td>				
				<td>
					<?php 
						if($helpURL!=null) {
							showHelp($helpURL, $helpLabel); 
						}
					?>
				</td>
			</tr>
		<?php
	}	
}