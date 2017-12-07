<?php

namespace Reactive\App;

class Re_Frontend_Scripts{
  protected $reactive_settings;

  public function __construct(){
    add_action('wp_head', array($this , 're_add_reactivetempltes'),1);
    add_action('wp_enqueue_scripts', array( $this , 're_load_scripts' ), 20 );
    $this->reactive_settings = get_option('reactive_settings', true);
  }

  public function re_load_scripts() {

    global $post;
    $reactive_settings = $this->reactive_settings;
    $reactive_libraries = array(
        'jquery_ui_css' => array(
          'type' => 'css',
          'cdn'   => '//cdn.jsdelivr.net/jquery.ui/1.11.4/jquery-ui.min.css',
          'local' => RE_VEN.'jquery-ui.min.css',
          'load_settings'  =>  'jqueryui_load_scripts',
          'enable_settings'  => 'reactive_jquery_ui_css_switch',
        ),
        'bootstrap_css' => array(
          'type' => 'css',
          'local' => RE_VEN.'bootstrap/css/bootstrap.min.css',
          'cdn' =>  '//cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css',
          'load_settings' =>  'bootstrap_load_scripts',
          'enable_settings' => 'reactive_bootstrap_switch',
        ),  
        'bootstrap_js' => array(
          'type' => 'js',
          'local' => RE_VEN.'bootstrap/js/bootstrap.min.js',
          'cdn' =>  '//cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.min.js',
          'load_settings' => 'bootstrap_load_scripts',
          'enable_settings' => 'reactive_bootstrap_switch',
        ),
        'fontawesome' => array(
          'type' => 'css',
          'local' =>  RE_VEN.'font-awesome.css',
          'cdn'   => '//cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css',
          'load_settings' => 'fontawesome_load_scripts',
          'enable_settings' => 'reactive_fontawesome_switch',
        ),
        'isotope_js' => array(
          'type' => 'js',
          'local' =>  RE_VEN.'isotope.pkgd.min.js',
          'cdn' => '//cdn.jsdelivr.net/isotope/3.0.1/isotope.pkgd.min.js',
          'load_settings' =>  'isotope_load_scripts',
          'enable_settings' => 'reactive_isotope_switch',
        ),
        'ion_range_css' => array(
          'type' => 'css',
          'local' =>  RE_VEN.'ion.rangeSlider.css',
          'cdn' => '//cdn.jsdelivr.net/ion.rangeslider/2.0.6/css/ion.rangeSlider.css',
          'load_settings' =>  'ionrange_load_scripts',
          'enable_settings' => 'reactive_ion_range_slider_switch',
        ),
        'ion_range_skin_css' => array(
          'type' => 'css',
          'local' =>  RE_VEN.'ion.rangeSlider.skinFlat.css',
          'cdn' => '//cdn.jsdelivr.net/ion.rangeslider/2.0.6/css/ion.rangeSlider.skinFlat.css',
          'load_settings' =>  'ionrange_load_scripts',
          'enable_settings' => 'reactive_ion_range_slider_switch',
        ),
        'ion_range_js' => array(
          'type' => 'js',
          'local' =>  RE_VEN.'ion.rangeSlider.js',
          'cdn' => '//cdn.jsdelivr.net/ion.rangeslider/2.0.6/js/ion.rangeSlider.min.js',
          'load_settings' =>  'ionrange_load_scripts',
          'enable_settings' => 'reactive_ion_range_slider_switch',
        ),
        'magnefic_popup_css' => array(
          'type' => 'css',
          'local' =>  RE_VEN.'magnific-popup.css',
          'cdn' => '//cdn.jsdelivr.net/jquery.magnific-popup/1.0.0/magnific-popup.css',
          'load_settings' => 'magnefic_popup_load_scripts',
          'enable_settings' => 'reactive_magnefic_popup_switch',
        ),
        'magnefic_popup_js' => array(
          'type' => 'js',
          'local' =>  RE_VEN.'jquery.magnific-popup.min.js',
          'cdn' => '//cdn.jsdelivr.net/jquery.magnific-popup/1.0.0/jquery.magnific-popup.min.js',
          'load_settings' => 'magnefic_popup_load_scripts',
          'enable_settings' => 'reactive_magnefic_popup_switch',
        ),     
    );

    if( is_page() && strpos($post->post_content, '[reactive key=') !== false) :
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'underscore' );
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-sortable' );

    foreach ($reactive_libraries as $library_name => $library_props) {
      if($this->re_check_library_settings($reactive_libraries[$library_name]['enable_settings'])) {
       $load_from = $this->re_check_library_load_settings($reactive_libraries[$library_name]['load_settings']);
        $this->re_enqueue_cdn_script($library_name, $reactive_libraries[$library_name][$load_from], $reactive_libraries[$library_name]['type']);
      }
    }

    if( !isset($reactive_settings['google_map_switch']) ) {
      if( isset( $reactive_settings['gmap_api_key'] ) && !empty( $reactive_settings['gmap_api_key'] ) ) {
        if($reactive_settings['reactive_map_country_switch'] == 'china') {
          wp_enqueue_script('google-maps-js', '//maps.google.cn/maps/api/js?key='.$reactive_settings["gmap_api_key"].'&libraries=places,geometry&language=en-US' , true , false ); 
        }
        else {
        wp_enqueue_script('google-maps-js', '//maps.googleapis.com/maps/api/js?key='.$reactive_settings["gmap_api_key"].'&libraries=places,geometry&language=en-US' , true , false );
        }
      } else {
        wp_enqueue_script('google-maps-js', '//maps.googleapis.com/maps/api/js?libraries=places,geometry&language=en-US' , true , false );
      }
    }

    wp_register_style('restyle', RE_CSS.'style.css', array(), $ver = false, $media = 'all');
    wp_enqueue_style('restyle');

    wp_register_script( 're-markercluster',RE_VEN.'markerclusterer.js', array('google-maps-js'), $ver = true, true);
    wp_enqueue_script( 're-markercluster' );

    wp_localize_script( 're-markercluster', 'MARKER', array(
      'IMG' => RE_IMG,
    ));

    wp_register_script( 're-richmarker',RE_VEN.'richmarker.js', array('google-maps-js'), $ver = true, true);
    wp_enqueue_script( 're-richmarker' );

    wp_register_script( 're-frontend',RE_JS.'frontend.js', array('jquery','underscore'), $ver = true, true);
    wp_enqueue_script( 're-frontend' );

    wp_localize_script( 're-frontend', 'API', array(
      'builder_nonce' => wp_create_nonce( 'builder_nonce' ),
      'post_id' => $post->ID,
      'ajaxurl' => admin_url('admin-ajax.php'),
      'isEditable' => is_super_admin( get_current_user_id() ),
      'isActiveUserplace' => $this->plugin_active(),
      // 'builder_data' => $this->get_builder_data($post->ID),
      'isMobile'  => wp_is_mobile(),
      'helper' => array(
        'all_post_types' => $this->re_get_all_post_types()
      ),
      'googlemap_key' => isset($reactive_settings["gmap_api_key"]) && !empty( $reactive_settings['gmap_api_key'] ) ? $reactive_settings["gmap_api_key"] : null,
      'sidebar' => $this->re_get_all_sidebar(),
      'IMG' => RE_IMG,
      'LANG' => $this->re_get_all_lang(),
      'mapbox_token' => isset($reactive_settings["mapbox_token"]) && !empty( $reactive_settings['mapbox_token'] ) ? $reactive_settings["mapbox_token"] : null,
    ));

    wp_localize_script( 're-frontend', 'REBUILDER', array());
    endif;
  }

  public function re_get_all_lang()
  {
    $lang = array(
      'SAVE' => esc_html__('Save', 'reactive'),
      'ADD' => esc_html__('Add', 'reactive'),
      'OPTION' => esc_html__('Options', 'reactive'),
      'GRID' => esc_html__('Grid', 'reactive'),
      'SIDEBAR' => esc_html__('Widgets', 'reactive'),
      'CHOOSE_GRID_LAYOUT' => esc_html__('Choose Grid Layout', 'reactive'),
      'SELECT_TYPE' => esc_html__('Select Type', 'reactive'),
      'SEARCH' => esc_html__('Search', 'reactive'),
      'MAP' => esc_html__('Map', 'reactive'),
      'USER' => esc_html__('Users', 'reactive'),
      'CHANGE_MAP_LAYOUT' => esc_html__('Change Map Layout:', 'reactive'),
      'CHANGE_HEIGHT' => esc_html__('Change Height:', 'reactive'),
      'SETTINGS' => esc_html__('Settings', 'reactive'),
      'LAYOUT' => esc_html__('Layout', 'reactive'),
      'COLUMN' => esc_html__('Column', 'reactive'),
      'GRID_DESKTOP_HD' => esc_html__('Desktop HD Size', 'reactive'),
      'GRID_DESKTOP' => esc_html__('Desktop Size', 'reactive'),
      'GRID_TABLET' => esc_html__('Tablet Size', 'reactive'),
      'GRID_MOBILE' => esc_html__('Mobile size', 'reactive'),
      'LIST_DESKTOP_HD' => esc_html__('Desktop HD Size', 'reactive'),
      'LIST_DESKTOP' => esc_html__('Desktop Size', 'reactive'),
      'LIST_TABLET' => esc_html__('Tablet Size', 'reactive'),
      'LIST_MOBILE' => esc_html__('Mobile size', 'reactive'),
      'SORTING' => esc_html__('Sorting', 'reactive'),
      'TOP_BAR' => esc_html__('Top bar', 'reactive'),
      'VIEW_CHANGE' => esc_html__('View Changer', 'reactive'),
      'BOTTOM_BAR' => esc_html__('Bottom bar', 'reactive'),
      'BAR_APPS' => esc_html__('Bar appearance', 'reactive'),
      'NUMBER_OF_POST' => esc_html__('Number Of Post:', 'reactive'),
      'CHANGE_GRID_LAYOUT' => esc_html__('Change Grid Layout:', 'reactive'),
      'POST_TYPE' => esc_html__('Post type:', 'reactive'),
      'PLEASE_SELECT_SORTING_ATTRIBUTES' => esc_html__('Please select sorting attributes', 'reactive'),
      'SHOW_OR_HIDE_THE_TOPBAR' => esc_html__('Show or Hide the Topbar', 'reactive'),
      'SHOW_OR_HIDE_THE_TOPBAR_PAGINATION' => esc_html__('Show or Hide the Topbar Pagination', 'reactive'),
      'SHOW_OR_HIDE_THE_SEARCH_FILTER_ATTRIBUTES' => esc_html__('Show or Hide the Search Filter Attributes', 'reactive'),
      'SHOW_OR_HIDE_THE_SORTING_OPTION' => esc_html__('Show or Hide the Sorting Option', 'reactive'),
      'SHOW_OR_HIDE_THE_VIEW_CHANGER' => esc_html__('Show or Hide the View Changer', 'reactive'),
      'SHOW_OR_HIDE_THE_BOTTOMBAR' => esc_html__('Show or Hide the Bottombar', 'reactive'),
      'SHOW_OR_HIDE_THE_BOTTOMBAR_PAGINATION' => esc_html__('Show or Hide the Bottombar Pagination', 'reactive'),
      'SHOW_OR_HIDE_THE_BOTTOMBAR_LOADMORE' => esc_html__('Show or Hide the Bottombar Loadmore', 'reactive'),
      'IMAGE_SELECT' => esc_html__('Image Select', 'reactive'),
      'RADIO' => esc_html__('Radio', 'reactive'),
      'SELECT' => esc_html__('Select', 'reactive'),
      'CHECK_BOX' => esc_html__('Check Box', 'reactive'),
      'SIZE_BOX' => esc_html__('Size Box', 'reactive'),
      'MAP_SEARCH' => esc_html__('Map Seach', 'reactive'),
      'COLOR_BOX' => esc_html__('Color Box', 'reactive'),
      'SCROLL_BOX' => esc_html__('Scroll Box', 'reactive'),
      'TEXT' => esc_html__('Text', 'reactive'),
      'COMBO_BOX' => esc_html__('Combo Box', 'reactive'),
      'TAGS' => esc_html__('Tags', 'reactive'),
      'RANGE_INPUT' => esc_html__('Range Input', 'reactive'),
      'RESET' => esc_html__('Reset', 'reactive'),
      'DATA' => esc_html__('Data', 'reactive'),
      'CALENDAR' => esc_html__('Calendar', 'reactive'),
      'ZOOM' => esc_html__('Zoom', 'reactive'),
      'APPEARANCE' => esc_html__('Appearance', 'reactive'),
      'PLEASE_ENTER_THE_TITLE' => esc_html__('Please Enter the Title', 'reactive'),
      'PLEASE_ENTER_THE_DATE_FORMAT' => esc_html__('Please Enter the Date Format', 'reactive'),
      'PLEASE_ENTER_THE_SUBTITLE' => esc_html__('Please Enter the SubTitle', 'reactive'),
      'PLEASE_ENTER_A_DATA_TYPE' => esc_html__('Please select a data type', 'reactive'),
      'PLEASE_CHOOSE_A_SELECT_TYPE' => esc_html__('Please choose a select type', 'reactive'),
      'PLEASE_ENTER_THE_CUSTOM_CSS_CLASSNAME' => esc_html__('Please Enter the Custom CSS Class', 'reactive'),
      'CHANGE_CATEGOREY_LAYOUT' => esc_html__('Change Categorey Layout:', 'reactive'),
      'NUMBER_OF_CATEGOREY' => esc_html__('Number Of Categorey:', 'reactive'),
      'LOAD_MORE_OPTION' => esc_html__('Loadmore Button Link:', 'reactive'),
      'LOAD_MORE_BUTTON' => esc_html__('Load More', 'reactive'),
      'LOAD_MORE_TOGGLE' => esc_html__('Show LoadMore Button:', 'reactive'),
      'CATEGOREY_DESKTOP_HD' => esc_html__('Desktop HD Size', 'reactive'),
      'CATEGOREY_DESKTOP' => esc_html__('Desktop Size', 'reactive'),
      'CATEGOREY_TABLET' => esc_html__('Tablet Size', 'reactive'),
      'CATEGOREY_MOBILE' => esc_html__('Mobile size', 'reactive'),
      'MARKER_TEMPLATE' => esc_html__('Select Marker Template','reactive'),
      'ICON_TEMPLATE' => esc_html__('Select Icon Template','reactive'),
      'Grid_View' => esc_html__('Grid','reactive'),
      'List_View' => esc_html__('List','reactive'),
      'View_Type' => esc_html__('Choose Default View Type', 'reactive'),
      'SHOW_HISTOGRAM_TOGGLE' => esc_html__('Show Histogram:', 'reactive'),
      'SHOW_NUMBER_OF_ITEMS' => esc_html__('Show Number Of Items:', 'reactive'),
      'SET_COLUMN' => esc_html__('Set Column:', 'reactive'),
      'TOGGLE_OPTION' => esc_html__('Show Toggle Option:', 'reactive'),
      'UNIT_OPTION' => esc_html__('Show Unit(Prefix/Postfix)', 'reactive'),
      'RANGE_TYPE' => esc_html__('Range Type(Double/Single)', 'reactive'),
      'CATEGORY' => esc_html__('Category','reactive'),
      'ADVANCE_SETTINGS' => esc_html__('Block Orientation','reactive'),
      'VERTICAL' => esc_html__('Vertical', 'reactive'),
      'HORIZONTAL' => esc_html__('Horizontal', 'reactive'),
      'DEFAULT' => esc_html__('Default', 'reactive'),
      'DROPDOWN' => esc_html__('Dropdown', 'reactive'),
      'CUSTOM_CLASS' => esc_html__('Custom Class', 'reactive'),
      'TEMPLATE_SETTINGS' => esc_html__('Template Setting', 'reactive'),
      'SELECT_POST_TYPE' => esc_html__('Please select a post type', 'reactive'),
      'SHOW_WITH_AJAX' => esc_html__('Do you want to show the result with Ajax', 'reactive'),
      'SELECT_THEME' => esc_html__('Select a theme', 'reactive'),
      'SELECT_CATEGORY_TEMPLATE' => esc_html__('Select Categorey Template', 'reactive'),
      'LIST' => esc_html__('List', 'reactive'),
      'SELECT_POST_TYPE_FIRST' => esc_html__('Please select a post type first from appearance settings', 'reactive'),
      'WELCOME' => esc_html__('Welcome to Reactive', 'reactive'),
      'ON_BOARD' => esc_html__('We are so excited to have you on board. Here are a few steps to maximize your experience.', 'reactive'),
      'STEP_1' => esc_html__('First step', 'reactive'),
      'CREATE_SEARCH' => esc_html__('Now you can create your SearchPage', 'reactive'),
      'STEP_2' => esc_html__('Second step', 'reactive'),
      'WISH_LETTER' => esc_html__('Add as your wish, build your page with style', 'reactive'),
      'STEP_3' => esc_html__('Third step', 'reactive'),
      'BEAST_RELEASE' => esc_html__('Add search component and release the beast', 'reactive'),
      'STEP_4' => esc_html__('Forth step', 'reactive'),
      'DATA_CONTROL' => esc_html__('You will have total control over your data, add unlimited Taxonomy / Metadata as search attribute', 'reactive'),
      'READY' => esc_html__('Ready to go', 'reactive'),
      'FOLLOW' => esc_html__('Please follow the ', 'reactive'),
      'REACTIVE_DOC_LINK' => esc_html__('link', 'reactive'),
      'FURTHER_QUERIES' => esc_html__(' for further queries , If you need any ', 'reactive'),
      'REDQ_EMAIL' => esc_html__('help', 'reactive'),
      'LET_US_KNOW' => esc_html__(' let us know. thanks', 'reactive'),
      'SKIP' => esc_html__('Skip', 'reactive'),
      'NEXT' => esc_html__('Next', 'reactive'),
      'FINISH' => esc_html__('Finish', 'reactive'),
      'PREVIOUS' => esc_html__('Previous', 'reactive'),
      'MORE' => esc_html__('More', 'reactive'),
      'PAGINATION_HERE' => esc_html__('Pagination Here', 'reactive'),
      'FOF' => esc_html__('Oops, No Post Found', 'reactive'),
      'MAP_YOUR_LOC' => esc_html__('Get your Location', 'reactive'),
      'NO_ATTR_FOUND' => esc_html__('No attributes found', 'reactive'),
      'PLACE_SEARCH' => esc_html__('Search...', 'reactive'),
      'PLACE_TOOGLE' => esc_html__('Please select Toogle Button On/Off', 'reactive'),
      'PLACE_MONTH_VIEW' => esc_html__('Please Select Number of Display Month(Double/single)', 'reactive'),
      'PLACE_CAL_VIEW' => esc_html__('Please Select view(Range/SingleDate)', 'reactive'),

      'PLACE_CAL_RL_V' => esc_html__('Please select Calender View Type right/left', 'reactive'),
      'PLACE_MAX_VAL' => esc_html__('Please Enter the MaxValue', 'reactive'),
      'PLACE_MIN_VAL' => esc_html__('Please Enter the MinValue', 'reactive'),
      'PLACE_BUTTON_TEXT' => esc_html__('Please Enter the Button Text', 'reactive'),
      'PLACE_BUTTON_STYLE' => esc_html__('Please Enter the Button Style e.g. btn btn-primary', 'reactive'),
      'PLACE_CUSTOM_CSS' => esc_html__('Please Enter the Custom CSS ClassName', 'reactive'),
      'PLACE_SELECT_VIEW' => esc_html__('Please select a view type', 'reactive'),
      'PLACE_ENTER_ANY_CLASS_NAME' => esc_html__('Enter any custom class Name', 'reactive'),
      'PLACE_CLASS_NAME_4_FILTER_COUNT' => esc_html__('Class name for filter count', 'reactive'),
      'PLACE_CLASS_NAME_4_SORT' => esc_html__('Class name for sorting option', 'reactive'),
      'PLACE_CLASS_NAME_4_VIEW' => esc_html__('Class name for view changer', 'reactive'),
      'PLACE_CLASS_NAME_4_TOP_PAGINATION' => esc_html__('Class name for topbar pagination', 'reactive'),
      'PLACE_CLASS_NAME_4_BOTTOM_PAGINATION' => esc_html__('Class name for bottombar pagination', 'reactive'),
      'PLACE_CLASS_NAME_4_BOTTOM_LOAD_MORE' => esc_html__('Class name for bottombar loadmore', 'reactive'),
      'PLACE_TITLE' => esc_html__('title', 'reactive'),
      'SHOW_ITEM_COLOR_NAME' => esc_html__('Show Item Color Name', 'reactive'),
      'TOOL_TIP_ADD_BLOCK' => esc_html__('Add Block', 'reactive'),
      'TOOL_TIP_SETTINGS' => esc_html__('Settings', 'reactive'),
      'TOOL_TIP_TOGGLE' => esc_html__('Toogle', 'reactive'),
      'TOOL_TIP_SEARCH_SETTINGS' => esc_html__('Settings', 'reactive'),
      'TOOL_TIP_SEARCH_DELETE' => esc_html__('Delete', 'reactive'),
      'TOOL_TIP_SEARCH_ADD' => esc_html__('Add', 'reactive'),
      'TOOL_TIP_BLOCK_PANEL' => esc_html__('Panel', 'reactive'),
      'REACTIVE_HELP_BUTTON' => esc_html__('Help', 'reactive'),
      'REACTIVE_PREVIEW_BUTTON' => esc_html__('Preview','reactive'),
      'LOADMORE_LESS' => esc_html__('Toogle Show More', 'reactive'),
      'ENTER_UNIT' => esc_html__('Please enter range unit', 'reactive'),
      'LOADMORELESS_DEFAULT_ITEM_NO' => esc_html__('Select Number of options in load More Mode'),
      'WRAPPER_CLASS_GRID' => esc_html__('Enter Any Custom Grid Wrapper Class Name'),
      'WRAPPER_CLASS_LIST' => esc_html__('Enter Any Custom List Wrapper Class Name'),
      'WRAPPER_CLASS_CATEGORY' => esc_html__('Custom Class Name for Categorey'),
      'WRAPPER_CLASS_MAP' => esc_html__('Custom Class Name for MAP'),
      'OPTIONS' => esc_html__('Options'),
      'MAPRADIUS' => esc_html__('Map Radius'),
      'BAR' => esc_html__('Bar'),
      'ISOTOPE_COLUMN' => esc_html__('Isotope Grid Column', 'reactive'),
      'SELECT_ISOTOPE_TEMPLATE' => esc_html__('Select Isotope Template', 'reactive'),
      'LINEARCHECKBOX' => esc_html__('Linear Checkbox', 'reactive'),
      'DATEPICKER' => esc_html__('Date Picker', 'reactive'),
      'RNBDATEPICKER' => esc_html__('Rnb Date Picker','reactive'),
      'WRAPPER_CLASS_ISOTOPE_GRID' => esc_html__('Enter Any Custom Isotope Grid Wrapper Class Name'),
      'WRAPPER_CLASS_ISOTOPE_BAR' => esc_html__('Enter Any Custom Isotope Bar Wrapper Class Name'),
      'GRID_ISOTOPE' => esc_html__('Isotope Grid', 'reactive'),
      'MAP_RADIOUS' => esc_html__('Enter Radious(In Km)', 'reactive'),
      'PREQUERY' => esc_html__('Pre Query', 'reactive'),
      'PREQUERY_AJAX_WARNING' => esc_html__('It will work only with `non-ajax` call for now, you can change the settings from `Reactive Builder`', 'reactive'),
      'RESULTS' => esc_html__('results', 'reactive'),
      'RESULT' => esc_html__('result', 'reactive'),
      'FOUND' => esc_html__('found', 'reactive'),
    );
    return $lang;
  }

  public function plugin_active()
  {
      if ( in_array( 'userplace/userplace.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
        return "true";
      }
    return "false";
  }

  // public function get_builder_data($post_id)
  // {
  //   return $post_id;
  // }


  public function re_get_all_sidebar(){
    global $wp_registered_sidebars;

    $all_sidebar = array();
    foreach ($wp_registered_sidebars as $sidebar) {
      $all_sidebar[] = array(
          'id' => $sidebar['id'],
          'name' => $sidebar['name'],
        );
    }
    return $all_sidebar;
  }

  public function re_get_all_post_types(){
    $post_types = get_post_types( array('public'=> true ) , 'names', 'and' );

    $all_types = array();
    foreach ($post_types as $type) {
      $all_types[] = $type;
    }

    return $all_types;
  }

  public function re_check_library_settings($library_settings){
    if(!empty($this->reactive_settings[$library_settings])) {
      if( isset( $this->reactive_settings[$library_settings] ) && ( $this->reactive_settings[$library_settings] == 'true' ) ) {
        return true;
      }
    }
    else {
      return true;
    }
  }

  public function re_check_library_load_settings($library_settings){
    if(!empty($this->reactive_settings[$library_settings])) {
      if( isset( $this->reactive_settings[$library_settings] ) && ( $this->reactive_settings[$library_settings] == 'true' ) ) {
        return 'local';
      }
    }
    else {
      return 'cdn';
    }
  }

  public function re_enqueue_cdn_script($script_name, $load_from, $type) {
    if($type == 'css') {
      wp_register_style($script_name,$load_from, array(), $ver = false, $media = 'all');
      wp_enqueue_style($script_name);
    }
    else {
      wp_register_script($script_name, $load_from, array('jquery'), $ver = true, true);
      wp_enqueue_script($script_name);
    }
  }

  public function re_add_reactivetempltes() {
    echo '<script type="text/javascript">
    /* <![CDATA[ */
    window.ReactiveTemplates = {};
    window.ReactiveTemplateCategories = {};
    window.ReactiveLayouts = [];
    window.ReactiveCategories = [];
    window.ReactiveSearchTemplate = {};
    window.ReactiveMarkerTemplate = {};
    window.ReactiveMarkerIcon = {};
    window.ReactiveTheme = {};
    window.ReactiveCategoryTemplate = {};
    window.IsotopeGrid = " ";
    window.searchArray = [];
    window.ReactiveFanoutData = {};
    ReactiveMap = {};
    /* ]]> */
    </script>';
  }

}
