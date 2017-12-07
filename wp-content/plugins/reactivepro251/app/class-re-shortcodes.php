<?php

namespace Reactive\App;

/**
* Class Re_Shortcodes
*/
class Re_Shortcodes extends Re_Template
{

	public function __construct()
	{
    $shortcodes = array(
       'reactive' => 'load_reactive',
    );

    foreach ( $shortcodes as $shortcode => $function ) {
        add_shortcode( $shortcode , array( $this , $function ) );
    }

	}

	public function load_reactive( $atts )
	{
    extract( shortcode_atts(
      array(
        'key' => '',
      ), $atts )
    );
    ob_start();

    //$template = $this->locate_template('shortcodes/builder.php');
    $template = RE_DIR.'/reactive-templates/shortcodes/builder.php';
    include_once($template);
    return ob_get_clean();
	}

}
