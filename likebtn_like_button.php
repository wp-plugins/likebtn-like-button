<?php
/*
  Plugin Name: Like Button Voting & Rating
  Plugin URI: http://likebtn.com
  Description: Add a Like Button to posts, pages, comments, WooCommerce and custom post types! Sort content by likes! Get instant voting statistics and insights!
  Version: 2.0
  Author: likebtn
  Author URI: http://likebtn.com
 */

// Current DB version
define('LIKEBTN_DB_VERSION', 4);

// i18n domain
define('LIKEBTN_I18N_DOMAIN', 'likebtn-like-button');

// LikeBtn plans
define('LIKEBTN_PLAN_TRIAL', 9);
define('LIKEBTN_PLAN_FREE', 0);
define('LIKEBTN_PLAN_PLUS', 1);
define('LIKEBTN_PLAN_PRO', 2);
define('LIKEBTN_PLAN_VIP', 3);
define('LIKEBTN_PLAN_ULTRA', 4);

// Flag added to entity excertps
define('LIKEBTN_LIST_FLAG', '_likebtn_list');

// entity names
define('LIKEBTN_ENTITY_POST', 'post');
define('LIKEBTN_ENTITY_POST_LIST', 'post'.LIKEBTN_LIST_FLAG);
define('LIKEBTN_ENTITY_PAGE', 'page');
define('LIKEBTN_ENTITY_COMMENT', 'comment');
define('LIKEBTN_ENTITY_CUSTOM_ITEM', 'custom_item');
define('LIKEBTN_ENTITY_PRODUCT', 'product'); // WooCommerce
define('LIKEBTN_ENTITY_PRODUCT_LIST', 'product'.LIKEBTN_LIST_FLAG); // WooCommerce
define('LIKEBTN_ENTITY_BP_ACTIVITY_POST', 'bp_activity_post');
define('LIKEBTN_ENTITY_BP_ACTIVITY_UPDATE', 'bp_activity_update');
define('LIKEBTN_ENTITY_BP_ACTIVITY_COMMENT', 'bp_activity_comment');
define('LIKEBTN_ENTITY_BP_MEMBER', 'bp_member');
define('LIKEBTN_ENTITY_BP_MEMBER_LIST', 'bp_member'.LIKEBTN_LIST_FLAG);

// position
define('LIKEBTN_POSITION_TOP', 'top');
define('LIKEBTN_POSITION_BOTTOM', 'bottom');
define('LIKEBTN_POSITION_BOTH', 'both');

// alignment
define('LIKEBTN_ALIGNMENT_LEFT', 'left');
define('LIKEBTN_ALIGNMENT_CENTER', 'center');
define('LIKEBTN_ALIGNMENT_RIGHT', 'right');

/*define('LIKEBTN_POST_VIEW_MODE_FULL', 'full');
define('LIKEBTN_POST_VIEW_MODE_EXCERPT', 'excerpt');
define('LIKEBTN_POST_VIEW_MODE_BOTH', 'both');*/

// statistics page size
define('LIKEBTN_STATISTIC_PAGE_SIZE', 50);

// show review link after this period
define('LIKEBTN_REVIEW_LINK_PERIOD', '1 month');

// item table name
define('LIKEBTN_TABLE_ITEM', 'likebtn_item');

// custom fields names
define('LIKEBTN_META_KEY_LIKES', 'Likes');
define('LIKEBTN_META_KEY_DISLIKES', 'Dislikes');
define('LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES', 'Likes minus dislikes');
global $likebtn_custom_fields;
$likebtn_custom_fields = array(
    LIKEBTN_META_KEY_LIKES,
    LIKEBTN_META_KEY_DISLIKES,
    LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES,
);

// entities for which plugin can be enabled
//global $likebtn_entities;
//$likebtn_entities = _likebtn_get_entities($likebtn_entities);

// post format: just to translate
$post_formats = array(
    'standard' => __('Standard'),
    'aside' => __('Aside'),
    'image' => __('Image'),
    'link' => __('Link'),
    'quote' => __('Quote'),
    'status' => __('Status'),
);

// post types without excerpts
global $likebtn_no_excerpts;
$likebtn_no_excerpts = array(
    LIKEBTN_ENTITY_PAGE,
    LIKEBTN_ENTITY_COMMENT
);
// post types titles
global $likebtn_entity_titles;
$likebtn_entity_titles = array(
    LIKEBTN_ENTITY_POST => __('Posts'),
    LIKEBTN_ENTITY_PAGE => __('Pages'),
    LIKEBTN_ENTITY_POST_LIST => __('Post List'),
    LIKEBTN_ENTITY_COMMENT => __('Comments'),
    LIKEBTN_ENTITY_CUSTOM_ITEM => __('Custom Items'),
    LIKEBTN_ENTITY_PRODUCT => __('WooCommerce Products'),
    LIKEBTN_ENTITY_PRODUCT_LIST => __('WooCommerce Product List'),
    LIKEBTN_ENTITY_BP_ACTIVITY_POST => __('BuddyPress Activity Posts'),
    LIKEBTN_ENTITY_BP_ACTIVITY_UPDATE => __('BuddyPress Activity Updates'),
    LIKEBTN_ENTITY_BP_ACTIVITY_COMMENT => __('BuddyPress Activity Comments'),
    LIKEBTN_ENTITY_BP_MEMBER => __('BuddyPress Member Profiles'),
    //LIKEBTN_ENTITY_BP_MEMBER_LIST => __('BuddyPress Member List'),
);

// languages
global $likebtn_page_sizes;
$likebtn_page_sizes = array(
    10,
    20,
    50,
    100,
    500,
    1000,
    5000,
);
global $likebtn_post_statuses;
$likebtn_post_statuses = array_reverse(get_post_statuses());

// likebtn settings
global $likebtn_settings;
$likebtn_settings = array(
    "style" => array("default" => 'white'),
    "lang" => array("default" => "en"),
    "show_like_label" => array("default" => '1'),
    "show_dislike_label" => array("default" => '0'),
    "like_enabled" => array("default" => '1'),
    "lazy_load" => array("default" => '0'),
    "dislike_enabled" => array("default" => '1'),
    "icon_like_show" => array("default" => '1'),
    "icon_dislike_show" => array("default" => '1'),
    "site_id" => array("default" => ""),
    "group_identifier" => array("default" => ""),
    //"local_domain" => array("default" => ''),
    "domain_from_parent" => array("default" => '0'),
    //"subdirectory" => array("default" => ''),
    "item_url" => array("default" => ''),
    "share_enabled" => array("default" => '1'),
    "item_title" => array("default" => ''),
    "item_description" => array("default" => ''),
    "item_image" => array("default" => ''),
    "popup_dislike" => array("default" => '0'),
    "counter_type" => array("default" => "number"),
    "counter_clickable" => array("default" => '0'),
    "counter_show" => array("default" => '1'),
    "counter_padding" => array("default" => ''),
    "counter_zero_show" => array("default" => '0'),
    "voting_enabled" => array("default" => '1'),
    "voting_cancelable" => array("default" => '1'),
    "voting_both" => array("default" => '0'),
    "revote_period" => array("default" => ''),
    "addthis_pubid" => array("default" => ''),
    "addthis_service_codes" => array("default" => ''),
    "loader_image" => array("default" => ''),
    "loader_show" => array("default" => '0'),
    "loader_image" => array("default" => ''),
    "tooltip_enabled" => array("default" => '1'),
    "white_label" => array("default" => '0'),
    "popup_html" => array("default" => ''),
    "popup_donate" => array("default" => ''),
    "popup_content_order" => array("default" => 'popup_share,popup_donate,popup_html'),
    "popup_enabled" => array("default" => '1'),
    "popup_position" => array("default" => 'top'),
    "popup_style" => array("default" => 'light'),
    "popup_hide_on_outside_click" => array("default" => '1'),
    "event_handler" => array("default" => ''),
    "info_message" => array("default" => '1'),
    "i18n_like" => array("default" => ''),
    "i18n_dislike" => array("default" => ''),
    "i18n_after_like" => array("default" => ''),
    "i18n_after_dislike" => array("default" => ''),
    "i18n_like_tooltip" => array("default" => ''),
    "i18n_dislike_tooltip" => array("default" => ''),
    "i18n_unlike_tooltip" => array("default" => ''),
    "i18n_undislike_tooltip" => array("default" => ''),
    "i18n_share_text" => array("default" => ''),
    "i18n_popup_close" => array("default" => ''),
    "i18n_popup_text" => array("default" => ''),
    "i18n_popup_donate" => array("default" => '')
);

// plans
global $likebtn_plans;
$likebtn_plans = array(
    LIKEBTN_PLAN_TRIAL => 'TRIAL',
    LIKEBTN_PLAN_FREE => 'FREE',
    LIKEBTN_PLAN_PLUS => 'PLUS',
    LIKEBTN_PLAN_PRO => 'PRO',
    LIKEBTN_PLAN_VIP => 'VIP',
    LIKEBTN_PLAN_ULTRA => 'ULTRA',
);

// styles
global $likebtn_styles;
$likebtn_styles = array(
    'white',
    'lightgray',
    'gray',
    'black',
    'padded',
    'drop',
    'line',
    'github',
    'transparent',
    'youtube',
    'habr',
    'heartcross',
    'plusminus',
    'google',
    'greenred',
    'large',
    'elegant',
    'disk',
    'squarespace',
    'slideshare',
    'baidu',
    'uwhite',
    'ublack',
    'uorange',
    'ublue',
    'ugreen',
    'direct',
    'homeshop'
);

// languages
global $likebtn_default_locales;
$likebtn_default_locales = array(
    'en' => array('name'    => 'English',
          'en_name' => 'English',
          'iso'     => 'en'
    ),
    'ru' => array('name'    => 'Русский',
          'en_name' => 'Russian',
          'iso'     => 'ru'
    ),
    'de' => array('name'    => 'Deutsch',
          'en_name' => 'German',
          'iso'     => 'de'
    ),
    'ja' => array('name'    => '日本語',
          'en_name' => 'Japanese',
          'iso'     => 'jp'
    ),
    'uk' => array('name'    => 'Українська мова',
          'en_name' => 'Ukrainian',
          'iso'     => 'uk'
    ),
    'kk' => array('name'    => 'Қазақ тілі',
          'en_name' => 'Kazakh',
          'iso'     => 'kk'
    ),
    'nl' => array('name'    => 'Nederlands',
          'en_name' => 'Dutch',
          'iso'     => 'nl'
    ),
    'hu' => array('name'    => 'Magyar',
          'en_name' => 'Hungarian',
          'iso'     => 'hu'
    ),
    'sv' => array('name'    => 'Svenska',
          'en_name' => 'Swedish',
          'iso'     => 'sv'
    ),
    'tr' => array('name'    => 'Türkçe',
          'en_name' => 'Turkish',
          'iso'     => 'tr'
    ),
    'es' => array('name'    => 'Español',
          'en_name' => 'Spanish',
          'iso'     => 'es'
    ),
);

// languages
global $likebtn_sync_intervals;
$likebtn_sync_intervals = array(
    5,
    15,
    30,
    60,
    90,
    120,
);

// LikeBtn website locales available
global $likebtn_website_locales;
$likebtn_website_locales = array(
    'en', 'ru'
);

// Form options
global $likebtn_settings_options;
$likebtn_settings_options = array(
    'likebtn_plan' => LIKEBTN_PLAN_TRIAL,
    'likebtn_account_email' => '',
    'likebtn_account_api_key' => '',
    'likebtn_sync_inerval' => '',
    'likebtn_site_id' => ''
);
// Form entity options
global $likebtn_buttons_options;
$likebtn_buttons_options = array(
    'likebtn_show' => '1',
    'likebtn_use_settings_from' => '',
    'likebtn_post_format' => array('all'),
    'likebtn_exclude_sections' => array(),
    'likebtn_exclude_categories' => array(),
    'likebtn_allow_ids' => '',
    'likebtn_exclude_ids' => '',
    'likebtn_user_logged_in' => '',
    'likebtn_position' => LIKEBTN_POSITION_BOTTOM,
    'likebtn_alignment' => LIKEBTN_ALIGNMENT_LEFT,
    'likebtn_html_before' => '',
    'likebtn_html_after' => ''
);
// Internal settings
global $likebtn_internal_options;
$likebtn_internal_options = array(
    'likebtn_last_sync_time' => 0,
    'likebtn_last_successfull_sync_time' => 0,
    'likebtn_plugin_v' => '',
    'likebtn_installation_timestamp' => '',
//    'likebtn_db_version' => 0,
);

// Internal settings
global $likebtn_entities_config;
$likebtn_entities_config = array(
    'style' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('value'=>'slideshare'),
        LIKEBTN_ENTITY_PRODUCT => array('value'=>'github'),
        LIKEBTN_ENTITY_COMMENT => array('value'=>'transparent'),
    ),
    'popup_position' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('value'=>'bottom'),
    ),
    'likebtn_post_format' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('hide'=>true)
    ),
    'likebtn_exclude_sections' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('hide'=>true)
    ),
    'likebtn_exclude_categories' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('hide'=>true)
    ),
    'likebtn_allow_ids' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('hide'=>true)
    ),
    'likebtn_exclude_ids' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('hide'=>true)
    ),
    'likebtn_position' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('hide'=>true)
    ),
    'likebtn_alignment' => array(
        LIKEBTN_ENTITY_BP_MEMBER => array('hide'=>true)
    ),
);


###############
### Backend ###
###############
// i18n function
/* function likebtn_trans($text, $params = null) {
  if (!is_array($params)) {
  $params = func_get_args();
  $params = array_slice($params, 1);
  }
  return vsprintf(__($text, LIKEBTN_I18N_DOMAIN), $params);
  } */

// initicalization
function likebtn_init() {
    _likebtn_plugin_on_load();

    load_plugin_textdomain(LIKEBTN_I18N_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
    wp_enqueue_script('jquery');
}

add_action('init', 'likebtn_init');

// add Settings link to the plugin list page
function likebtn_links($links, $file) {
    $plugin_file = basename(__FILE__);
    if (basename($file) == $plugin_file) {
        $settings_link = '<a href="admin.php?page=likebtn_settings">' . __('Settings', LIKEBTN_I18N_DOMAIN) . '</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}

add_filter('plugin_action_links', 'likebtn_links', 10, 2);

// admin options
function likebtn_admin_menu() {
    $logo_url = _likebtn_get_public_url() . 'img/menu_icon.png';

    add_menu_page(__('Like Buttons', LIKEBTN_I18N_DOMAIN), __('Like Buttons', LIKEBTN_I18N_DOMAIN), 'manage_options', 'likebtn_buttons', '', $logo_url);
    add_submenu_page(
            'likebtn_buttons', __('Buttons', LIKEBTN_I18N_DOMAIN) . ' ‹ ' . __('LikeBtn Like Button', LIKEBTN_I18N_DOMAIN), __('Buttons', LIKEBTN_I18N_DOMAIN), 'manage_options', 'likebtn_buttons', 'likebtn_admin_buttons'
    );
    //add_options_page('LikeBtn Like Button', __('LikeBtn Like Button', 'likebtn'), 'activate_plugins', 'likebtn', 'likebtn_admin_content');
    add_submenu_page(
            'likebtn_buttons', __('Synchronization', LIKEBTN_I18N_DOMAIN) . ' ‹ ' . __('LikeBtn Like Button', LIKEBTN_I18N_DOMAIN), __('Synchronization', LIKEBTN_I18N_DOMAIN), 'manage_options', 'likebtn_settings', 'likebtn_admin_settings'
    );
    add_submenu_page(
            'likebtn_buttons', __('Statistics', LIKEBTN_I18N_DOMAIN) . ' ‹ LikeBtn Like Button', __('Statistics', LIKEBTN_I18N_DOMAIN), 'manage_options', 'likebtn_statistics', 'likebtn_admin_statistics'
    );
    add_submenu_page(
            'likebtn_buttons', __('Help') . ' ‹ LikeBtn Like Button', __('Help'), 'manage_options', 'likebtn_help', 'likebtn_admin_help'
    );
}

add_action('admin_menu', 'likebtn_admin_menu');

// plugin header
function likebtn_admin_head() {
    $url_css = _likebtn_get_public_url() . 'css/admin.css?v=' . _likebtn_get_plugin_version();
    $url_js = _likebtn_get_public_url() . 'js/admin.js?v=' . _likebtn_get_plugin_version();

    echo '<link rel="stylesheet" type="text/css" href="' . $url_css . '" />';
    echo '<link rel="stylesheet" type="text/css" href="' . _likebtn_get_public_url() . 'css/jquery/tipsy.css' . '" />';
    echo '<script src="' . $url_js . '" type="text/javascript"></script>';
    echo '<script src="' . _likebtn_get_public_url() . 'js/jquery/jquery.tipsy.js" type="text/javascript"></script>';
}

add_action('admin_head', 'likebtn_admin_head');

// admin header
function likebtn_admin_header() {
    $logo_url = _likebtn_get_public_url() . 'img/logotype.png';
    $header = <<<HEADER
    <div class="wrap" id="likebtn">
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-37384414-15', 'auto');
          ga('send', 'pageview');

        </script>
        <h2 class="likebtn_logo">
            <a href="http://likebtn.com" target="_blank" title="LikeBtn Like Button"><img alt="" src="{$logo_url}">LikeBtn</a>
        </h2>
HEADER;
//<div id="plan_upgrade">
//                Plan:
//        </div>

    /*$installation_timestamp = get_option('likebtn_installation_timestamp');

    if ( (($installation_timestamp && strtotime(date('Y-m-d H:i:s', $installation_timestamp) . ' +' . LIKEBTN_REVIEW_LINK_PERIOD) < time())
           || !$installation_timestamp)
         && (get_option('likebtn_plan') != LIKEBTN_PLAN_FREE && get_option('likebtn_plan') != LIKEBTN_PLAN_TRIAL)
    ) {*/

    //}

    $header .= '
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_buttons' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_buttons">' . __('Buttons', LIKEBTN_I18N_DOMAIN) . '</a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_settings' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_settings">' . __('Synchronization', LIKEBTN_I18N_DOMAIN) . '</a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_statistics' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_statistics">' . __('Statistics', LIKEBTN_I18N_DOMAIN) . ' <i class="premium_feature" title="PRO / VIP / ULTRA">&nbsp;</i></a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_help' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_help">' . __('Help') . '</a>';

    $header .= '
        <div id="premium_features_hint">
            <i class="premium_feature"></i>' . __('Premium / Trial features', LIKEBTN_I18N_DOMAIN) .
        '</div>
    ';

    $header .= '</h2>';


    echo $header;
}

// uninstall hook
function likebtn_unistall() {
    global $likebtn_settings;
    global $likebtn_settings_options;
    global $likebtn_buttons_options;
    global $likebtn_internal_options;

    $likebtn_entities = _likebtn_get_entities();

    foreach ($likebtn_settings_options as $option_name=>$option_value) {
        delete_option($option_name);
    }

    foreach ($likebtn_entities as $entity_name => $entity_title) {
        foreach ($likebtn_buttons_options as $option_name=>$option_value) {
            delete_option($option_name.'_'.$entity_name);
        }
        // settings
        foreach ($likebtn_settings as $option_name => $option_info) {
            delete_option('likebtn_settings_' . $option_name . '_' . $entity_name);
        }
    }

    foreach ($likebtn_internal_options as $option_name=>$option_value) {
        delete_option($option_name);
    }
}

register_uninstall_hook(__FILE__, 'likebtn_unistall');

// activation hook
function likebtn_activation_hook()
{
    // Install DB
    _likebtn_db_install();

    // Add options
    _likebtn_add_options();
}

// Add options
function _likebtn_add_options()
{
    global $likebtn_settings_options;
    global $likebtn_internal_options;

    $likebtn_entities = _likebtn_get_entities();

    // set default values for options
    foreach ($likebtn_settings_options as $option_name=>$option_value) {
        add_option($option_name, $option_value);
    }

    // set default options for entities
    foreach ($likebtn_entities as $entity_name => $entity_title) {
        _likebtn_set_default_options($entity_name);
    }

    // set default values for options
    foreach ($likebtn_internal_options as $option_name=>$option_value) {
        add_option($option_name, $option_value);
    }

    // For showing review link
    if (!get_option('likebtn_installation_timestamp')) {
        add_option('likebtn_installation_timestamp', time());
    }

    // Remember plugin version
    if (function_exists('get_plugin_data')) {
        $plugin_data = get_plugin_data(__FILE__);
        if ($plugin_data && $plugin_data['Version']) {
            update_option("likebtn_plugin_v", $plugin_data['Version']);
        }
    }

    add_option('likebtn_db_version', LIKEBTN_DB_VERSION);
}

// The latest version of DB
function _likebtn_db_install() {
    global $wpdb;

    $table_name = $wpdb->prefix . LIKEBTN_TABLE_ITEM;

    $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
        `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `identifier` text NOT NULL,
        `identifier_hash` varchar(32) NOT NULL,
        `url` text,
        `title` text,
        `description` text,
        `image` text,
        `likes` int(11) NOT NULL DEFAULT '0',
        `dislikes` int(11) NOT NULL DEFAULT '0',
        `likes_minus_dislikes` int(11) NOT NULL DEFAULT '0',
        PRIMARY KEY (`ID`),
        UNIQUE KEY `identifier_hash` (`identifier_hash`),
        KEY `title` (`title`(1)),
        KEY `likes` (`likes`),
        KEY `dislikes` (`dislikes`),
        KEY `likes_minus_dislikes` (`likes_minus_dislikes`),
        KEY `identifier` (`identifier`(1))
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Plugin loaded
function _likebtn_plugin_on_load()
{
    //likebtn_unistall();
    //_likebtn_add_options();

    _likebtn_db_update();
    _likebtn_update_options();

    // Run sunchronization
    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncVotes();
}

// Update DB
function _likebtn_db_update() {

    $db_version = (int)get_option('likebtn_db_version');

    if (!$db_version) {
        // Backward compatibility
        $db_version = (int)get_option('likebtn_like_button_db_version');
    }

    $db_version++;
    while (function_exists('likebtn_db_update_'.$db_version)) {
        call_user_func('likebtn_db_update_'.$db_version);
        update_option("likebtn_db_version", $db_version);
        $db_version++;
    }
}

// database update function
function likebtn_db_update_1() {
    global $wpdb;

    $table_name = $wpdb->prefix . LIKEBTN_TABLE_ITEM;

    $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
        `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `identifier` text NOT NULL,
        `url` text,
        `title` text,
        `description` text,
        `image` text,
        `likes` int(11) NOT NULL DEFAULT '0',
        `dislikes` int(11) NOT NULL DEFAULT '0',
        `likes_minus_dislikes` int(11) NOT NULL DEFAULT '0',
        PRIMARY KEY (`ID`),
        UNIQUE KEY `identifier` (`identifier`(1)),
        KEY `title` (`title`(1)),
        KEY `likes` (`likes`),
        KEY `dislikes` (`dislikes`),
        KEY `likes_minus_dislikes` (`likes_minus_dislikes`)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// database update function
function likebtn_db_update_2() {
    global $wpdb;

    $table_name = $wpdb->prefix . LIKEBTN_TABLE_ITEM;

    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") == $table_name) {

        // Remove UNIQUE from identifier
        $sql = "DROP INDEX identifier ON {$table_name};";
        $wpdb->query($sql);

        $sql = "CREATE INDEX identifier ON {$table_name} (identifier(1));";
        $wpdb->query($sql);

        $sql = "ALTER TABLE {$table_name} ADD identifier_hash varchar(32) DEFAULT NULL, ADD UNIQUE (identifier_hash);";
        $wpdb->query($sql);

        $sql = "UPDATE {$table_name} SET identifier_hash = md5(identifier);";
        $wpdb->query($sql);
    }
}

// database update function
function likebtn_db_update_3() {
    global $wpdb;

    $table_name = $wpdb->prefix . LIKEBTN_TABLE_ITEM;

    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") == $table_name) {

        // Check if there duplicates
        $duplicates_count = $wpdb->get_results("SELECT count(*) FROM {$table_name} GROUP BY identifier HAVING count(*) > 1");

        if (count($duplicates_count) > 0) {
            // Remove duplicates by creating a proxy table
            $sql = "CREATE TABLE {$table_name}_tmp AS SELECT * FROM {$table_name};";
            $wpdb->query($sql);
            $sql = "DROP INDEX identifier_hash ON {$table_name}_tmp;";
            $wpdb->query($sql);
            $sql = "UPDATE {$table_name}_tmp SET identifier_hash = md5(identifier);";
            $wpdb->query($sql);
            $sql = "DELETE FROM {$table_name};";
            $wpdb->query($sql);
            $sql = "CREATE UNIQUE INDEX identifier_hash ON {$table_name} (identifier_hash);";
            $wpdb->query($sql);
            $sql = "INSERT IGNORE INTO {$table_name} SELECT * FROM {$table_name}_tmp;";
            $wpdb->query($sql);
            $sql = "DROP TABLE {$table_name}_tmp;";
            $wpdb->query($sql);
            // Set identifier_hash once more
            $sql = "UPDATE {$table_name} SET identifier_hash = md5(identifier);";
            $wpdb->query($sql);
            $sql = "ALTER TABLE {$table_name} MODIFY identifier_hash varchar(32) NOT NULL;";
            $wpdb->query($sql);
        } else {
            // Add index once more
            $sql = "CREATE UNIQUE INDEX identifier_hash ON {$table_name} (identifier_hash);";
            $wpdb->query($sql);
            $sql = "UPDATE {$table_name} SET identifier_hash = md5(identifier);";
            $wpdb->query($sql);
            $sql = "ALTER TABLE {$table_name} MODIFY identifier_hash varchar(32) NOT NULL;";
            $wpdb->query($sql);
        }
    }
}

// database update function
function likebtn_db_update_4() {
    // rename options
    global $likebtn_settings;
    global $likebtn_settings_options;
    global $likebtn_buttons_options;
    global $likebtn_internal_options;

    // On actiovation at this point options are not added yet
    _likebtn_add_options();

    // no need to rename options
    if (!get_option('likebtn_like_button_plan')) {
        return true;
    }

    foreach ($likebtn_settings_options as $option_name=>$option_value) {
        $old_option_name = str_replace('likebtn_', 'likebtn_like_button_', $option_name);
        update_option($option_name, get_option($old_option_name));
        delete_option($old_option_name);
    }

    $likebtn_entities = _likebtn_get_entities();
    foreach ($likebtn_entities as $entity_name => $entity_title) {
        foreach ($likebtn_buttons_options as $option_name=>$option_value) {
            $option_name = $option_name.'_'.$entity_name;
            $old_option_name = str_replace('likebtn_', 'likebtn_like_button_', $option_name);
            update_option($option_name, get_option($old_option_name));
            delete_option($old_option_name);
        }
        // settings
        foreach ($likebtn_settings as $option_name => $option_info) {
            $option_name = 'likebtn_settings_'.$option_name.'_'.$entity_name;
            $old_option_name = str_replace('likebtn_', 'likebtn_like_button_', $option_name);
            update_option($option_name, get_option($old_option_name));
            delete_option($old_option_name);
        }
    }

    foreach ($likebtn_internal_options as $option_name=>$option_value) {
        $old_option_name = str_replace('likebtn_', 'likebtn_like_button_', $option_name);
        update_option($option_name, get_option($old_option_name));
        delete_option($old_option_name);
    }
}

// update options
function _likebtn_update_options() {
    $likebtn_entities = _likebtn_get_entities();

    foreach ($likebtn_entities as $entity_name => $entity_title) {

        // Set default settings for new entity
        // User lang parameter to check if option exists
        if (!get_option('likebtn_settings_lang_' . $entity_name)) {
            _likebtn_set_default_options($entity_name);
        }

        // Backward compatibility
        if (get_option('likebtn_settings_display_only_' . $entity_name)) {
            if (get_option('likebtn_settings_display_only_' . $entity_name) == '1') {
                update_option('likebtn_settings_voting_enabled_' . $entity_name, '0');
            }
            delete_option('likebtn_settings_display_only_' . $entity_name);
        }
        if (get_option('likebtn_settings_unlike_allowed_' . $entity_name)) {
            if (get_option('likebtn_settings_unlike_allowed_' . $entity_name) == '1') {
                update_option('likebtn_settings_voting_cancelable_' . $entity_name, '1');
            }
            delete_option('likebtn_settings_unlike_allowed_' . $entity_name);
        }
        if (get_option('likebtn_settings_like_dislike_at_the_same_time_' . $entity_name)) {
            if (get_option('likebtn_settings_like_dislike_at_the_same_time_' . $entity_name) == '1') {
                update_option('likebtn_settings_voting_both_' . $entity_name, '1');
            }
            delete_option('likebtn_settings_like_dislike_at_the_same_time_' . $entity_name);
        }
        if (get_option('likebtn_settings_show_copyright_' . $entity_name) === '0') {
            update_option('likebtn_settings_white_label_' . $entity_name, '1');
            delete_option('likebtn_settings_show_copyright_' . $entity_name);
        }
        // Process likebtn_post_view_mode_ for Excerpt entities
        if (_likebtn_has_list_flag($entity_name)) {
            $original_name = _likebtn_cut_list_flag($entity_name);

            if (get_option('likebtn_post_view_mode_' . $entity_name) && get_option('likebtn_show_' . $original_name) == '1') {
                if (in_array(get_option('likebtn_post_view_mode_' . $entity_name), array('excerpt', 'both')) &&
                    get_option('likebtn_show_' . $entity_name) != '1')
                {
                    update_option('likebtn_show_' . $entity_name, '1');
                    update_option('likebtn_use_settings_from_' . $entity_name, $original_name);
                }
                delete_option('likebtn_post_view_mode_' . $entity_name);
            }
        }
    }
}

// set default options for post type
function _likebtn_set_default_options($entity_name) {
    global $likebtn_settings;
    global $likebtn_buttons_options;
    global $likebtn_entities_config;

    foreach ($likebtn_buttons_options as $option_name=>$option_value) {

        switch ($option_name) {
            case 'likebtn_show':
                if ($entity_name == LIKEBTN_ENTITY_COMMENT) {
                    $option_value = '0';
                }
                break;
            case 'likebtn_use_settings_from':
                // Set copy settings for list entities
                if (_likebtn_has_list_flag($entity_name)) {
                    $option_value = _likebtn_cut_list_flag($entity_name);
                }
                break;
            case 'likebtn_position':
                if ($entity_name == LIKEBTN_ENTITY_PRODUCT || $entity_name == LIKEBTN_ENTITY_PRODUCT_LIST) {
                    $option_value = LIKEBTN_POSITION_TOP;
                }
                break;
        }

        add_option($option_name.'_'.$entity_name, $option_value);
    }

    // settings
    foreach ($likebtn_settings as $option_name => $option_info) {
        $value = $option_info['default'];
        if (!empty($likebtn_entities_config[$option_name][$entity_name]['value'])) {
            $value = $likebtn_entities_config[$option_name][$entity_name]['value'];
        }
        add_option('likebtn_settings_' . $option_name . '_' . $entity_name, $value);
    }
}

register_activation_hook(__FILE__, 'likebtn_activation_hook');

// registering settings
function likebtn_admin_init()
{
    global $likebtn_settings_options;

    foreach ($likebtn_settings_options as $option_name=>$option_value) {
        register_setting('likebtn_settings', $option_name);
    }

    // Buttons
    register_setting('likebtn_buttons', 'likebtn_subpage');
    // Register settings
    $likebtn_entities = _likebtn_get_entities();
    foreach ($likebtn_entities as $entity_name => $entity_title) {
        _likebtn_register_entity_settings($entity_name);
    }
}

// register entity settings
function _likebtn_register_entity_settings($entity_name)
{
    global $likebtn_settings;
    global $likebtn_buttons_options;

    foreach ($likebtn_buttons_options as $option_name=>$option_value) {
        register_setting('likebtn_buttons', $option_name.'_'.$entity_name);
    }

    // settings
    foreach ($likebtn_settings as $option_name => $option_info) {
        register_setting('likebtn_buttons', 'likebtn_settings_' . $option_name . '_' . $entity_name);
    }
}

add_action('admin_init', 'likebtn_admin_init');

// admin content
function likebtn_admin_settings() {

    global $likebtn_plans;
    global $likebtn_sync_intervals;

    // reset sync interval
    if (!get_option('likebtn_account_email') || !get_option('likebtn_account_api_key')) {
        update_option('likebtn_sync_inerval', '');
    }

    likebtn_admin_header();
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            planChange(jQuery(":input[name='likebtn_plan']").val());
        });
    </script>
    <div id="poststuff" class="metabox-holder has-right-sidebar likebtn_subpage">
        <form method="post" action="options.php">
            <?php settings_fields('likebtn_settings'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label><?php _e('Current plan', LIKEBTN_I18N_DOMAIN); ?></label></th>
                    <td>
                        <select name="likebtn_plan" onChange="planChange(this.value)">
                            <?php foreach ($likebtn_plans as $plan_id => $plan_name): ?>
                                <option value="<?php echo $plan_id; ?>" <?php if (get_option('likebtn_plan') == $plan_id): ?>selected="selected"<?php endif ?> ><?php echo $plan_name; ?></option>
                            <?php endforeach ?>
                        </select>
                        <p class="description">
                            <?php _e('Premium features are available only if your website is upgraded to the corresponding tariff plan (PLUS, PRO, VIP, ULTRA). Keep in mind that only websites upgraded to <a href="http://likebtn.com/en/#plans_pricing" target="_blank">PLUS</a> plan or higher are allowed to display more than 1 Like Button per page.', LIKEBTN_I18N_DOMAIN) ?><br/>
                            <a href="javascript:toggleToUpgrade();void(0);"><?php _e('To upgrade your website...', LIKEBTN_I18N_DOMAIN) ?></a>
                            <ol id="likebtn_to_upgrade" class="hidden">
                                <li><?php _e('Register on <a href="http://likebtn.com/en/customer.php/register/" target="_blank">LikeBtn.com</a>', LIKEBTN_I18N_DOMAIN) ?></li>
                                <li><?php _e('Add your website to your account and activate it on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites page</a>', LIKEBTN_I18N_DOMAIN) ?></li>
                                <li><?php _e('Upgrade your website to the desired plan.', LIKEBTN_I18N_DOMAIN) ?></li>
                            </ol>
                        </p>
                    </td>
                </tr>
            </table>

            <p class="description">
                <?php _e('Enable synchronization of likes from LikeBtn.com system into your database to get the opportunity to use the following features:', LIKEBTN_I18N_DOMAIN); ?><br/>
                ● <?php _e('View statistics on Statistics tab.', LIKEBTN_I18N_DOMAIN); ?><br/>
                ● <?php _e('Sort content by votes.', LIKEBTN_I18N_DOMAIN); ?><br/>
                ● <?php _e('Use Most Liked Content widget and shortcode.', LIKEBTN_I18N_DOMAIN); ?><br/>
            </p>
            <br/>

            <div class="postbox ">
                <h3><?php _e('LikeBtn.com Account', LIKEBTN_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <p>
                        <?php _e('To get your account data:', LIKEBTN_I18N_DOMAIN); ?>
                        <ol>
                            <li><?php _e('Register on <a href="http://likebtn.com/en/customer.php/register/" target="_blank">LikeBtn.com</a>', LIKEBTN_I18N_DOMAIN) ?></li>
                            <li><?php _e('Add your website to your account on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page.', LIKEBTN_I18N_DOMAIN) ?></li>
                        </ol>
                    </p>
                    <input class="likebtn_button_account" type="button" value="<?php _e('Get Account Data', LIKEBTN_I18N_DOMAIN); ?>" onclick="likebtnPopup('<?php _e('http://likebtn.com/en/customer.php/register/', LIKEBTN_I18N_DOMAIN) ?>?likebtn_short_version=1')" />
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><label><?php _e('E-mail', LIKEBTN_I18N_DOMAIN); ?></label></th>
                            <td>
                                <input type="text" name="likebtn_account_email" value="<?php echo get_option('likebtn_account_email') ?>" size="60" onkeyup="accountChange(this)" class="likebtn_account"/><br/>
                                <p class="description"><?php _e('Your LikeBtn.com account email. Can be found on <a href="http://likebtn.com/en/customer.php/profile/edit" target="_blank">Profile</a> page', LIKEBTN_I18N_DOMAIN) ?></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('API key', LIKEBTN_I18N_DOMAIN); ?></label></th>
                            <td>
                                <input type="text" name="likebtn_account_api_key" value="<?php echo get_option('likebtn_account_api_key') ?>" size="60" onkeyup="accountChange(this)" class="likebtn_account"/><br/>
                                <p class="description"><?php _e('Your website API key on LikeBtn.com. Can be obtained on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page', LIKEBTN_I18N_DOMAIN) ?></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Site ID', LIKEBTN_I18N_DOMAIN); ?></label></th>
                            <td>
                                <input type="text" name="likebtn_site_id" value="<?php echo get_option('likebtn_site_id') ?>" size="60" /><br/>
                                <?php /*<span class="description"><?php _e('Enter Site ID in following cases:', LIKEBTN_I18N_DOMAIN) ?><br/>
                                ● <?php _e('Your site is local – located on a local server and is available from your local network only and NOT available from the Internet.', LIKEBTN_I18N_DOMAIN) ?><br/>
                                ● <?php _e('Your site is path-based – one of sites located in different subdirectories of one domain and you want to have statistics separate from other sites.', LIKEBTN_I18N_DOMAIN) ?><br/><br/>*/ ?>
                                <p class="description">
                                    <?php _e('Your Site ID on LikeBtn.com. Can be obtained on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page.', LIKEBTN_I18N_DOMAIN) ?></span>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="postbox ">
                <div class="inside">
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Synchronization Interval', LIKEBTN_I18N_DOMAIN); ?></label>
                                <i class="likebtn_help" title="<?php _e('Time interval in minutes in which fetching of vote results from LikeBtn.com into your database is being launched. When synchronization is enabled you can view Statistics, number of likes and dislikes for each post as Custom Field, sort posts by vote results, use Like Button widgets. The less the interval the heavier your database load.', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                            </th>
                            <td>
                                <select name="likebtn_sync_inerval" <?php disabled((!get_option('likebtn_account_email') || !get_option('likebtn_account_api_key'))); ?> >
                                    <option value="" <?php selected('', get_option('likebtn_sync_inerval')); ?> ><?php _e('Do not fetch votes from LikeBtn.com into my database', LIKEBTN_I18N_DOMAIN) ?></option>
                                    <?php foreach ($likebtn_sync_intervals as $sync_interval): ?>
                                        <option value="<?php echo $sync_interval; ?>" <?php selected($sync_interval, get_option('likebtn_sync_inerval')); ?> ><?php echo $sync_interval; ?> <?php _e('min', LIKEBTN_I18N_DOMAIN); ?></option>
                                    <?php endforeach ?>
                                </select>
                                <br/><br/>
                                <input class="button-primary" type="button" value="<?php _e('Test sync', LIKEBTN_I18N_DOMAIN); ?>" onclick="testSync('<?php echo _likebtn_get_public_url() ?>img/ajax_loader.gif')" /> &nbsp;<strong class="likebtn_test_sync_container"><img src="<?php echo _likebtn_get_public_url() ?>img/ajax_loader.gif" class="hidden"/></strong>
                                <br/><br/>
                                <input class="button-secondary likebtn_ttip" type="button" value="<?php _e('Run full sync manually', LIKEBTN_I18N_DOMAIN); ?>" onclick="manualSync('<?php echo _likebtn_get_public_url() ?>img/ajax_loader.gif')" title="<?php _e("ATTENTION: Use this feature carefully since full synchronization may affect your website performance. If you don't experience any problems with likes synchronization better to avoid using this feature.", LIKEBTN_I18N_DOMAIN) ?>" /> &nbsp;<strong class="likebtn_manual_sync_container"><img src="<?php echo _likebtn_get_public_url() ?>img/ajax_loader.gif" class="hidden"/></strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php /*<div class="postbox likebtn_account">
                <h3><?php _e('Local domain', LIKEBTN_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">&nbsp;</th>
                            <td> ?>
                                <input type="hidden" name="likebtn_local_domain" value="<?php echo get_option('likebtn_local_domain') ?>" size="60" />
                                <?php
                                <br/>
                                <strong class="description"><?php _e('Example:', LIKEBTN_I18N_DOMAIN) ?> localdomain!50f358d30acf358d30ac000001</strong>
                                <br/><br/>
                                <span class="description"><?php _e('Specify it if your website is located on a local server and is available from your local network only and NOT available from the Internet. You can find the domain on your <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page after adding your local website to the panel. See <a href="http://likebtn.com/en/faq#local_domain" target="_blank">FAQ</a> for more details.', LIKEBTN_I18N_DOMAIN) ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>*/ ?>
            <?php /*<div class="postbox likebtn_account">
                <h3><?php _e('Website subdirectory', LIKEBTN_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">&nbsp;</th>
                            <td> ?>
                                <input type="hidden" name="likebtn_subdirectory" value="<?php echo get_option('likebtn_subdirectory') ?>" size="60" />
                                <?php
                                <br/>
                                <strong class="description"><?php _e('Example:', LIKEBTN_I18N_DOMAIN) ?> /subdirectory/</strong>
                                <br/><br/>
                                <span class="description"><?php _e('If your website is one of websites located in different subdirectories of one domain and you want to have a separate from other websites on this domain statistics, enter subdirectory (for example /subdirectory/). Required for path-based <a href="http://codex.wordpress.org/Create_A_Network" target="_blank">multisite networks</a> in which on-demand sites use paths.', LIKEBTN_I18N_DOMAIN) ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>*/ ?>

            <input class="button-primary" type="submit" name="Save" value="<?php _e('Save Changes', LIKEBTN_I18N_DOMAIN); ?>" />
        </form>

    </div>
    </div>
    <?php
}

// admin buttons
function likebtn_admin_buttons() {

    global $likebtn_styles;
    global $likebtn_default_locales;
    global $likebtn_settings;

    $likebtn_entities = _likebtn_get_entities();

    // retrieve post formats
    $post_formats = _likebtn_get_post_formats();

    // run sunchronization
    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncLocales();
    $likebtn->runSyncStyles();

    // Languages
    $locales = get_option('likebtn_locales');
    $languages = array();
    $languages['auto'] = __("Automatic", LIKEBTN_I18N_DOMAIN);
    if (!$locales) {
        $locales = $likebtn_default_locales;
    }
    foreach ($locales as $locale_code => $locale_info) {
        $lang_option = $locale_info['en_name'];
        if ($locale_code != 'en') {
            $lang_option .= ' - ' . $locale_info['name'];
        }
        $languages[$locale_code] = $lang_option;
    }

    // Get styles
    $styles = get_option('likebtn_styles');

    $style_options = array();
    if (!$styles) {
      // Styles have not been loaded using API yet, load default languages
      $styles = $likebtn_styles;
    }
    foreach ($styles as $style) {
      $style_options[] = $style;
    }

    // Select tab
    $subpage = LIKEBTN_ENTITY_POST;

    $post_subpage = get_option('likebtn_subpage');
    if (!empty($_GET['settings-updated']) && $post_subpage && array_key_exists($post_subpage, $likebtn_entities)) {
        $subpage = $post_subpage;
    } elseif (!empty($_GET['likebtn_subpage']) && array_key_exists($_GET['likebtn_subpage'], $likebtn_entities) ) {
        $subpage = $_GET['likebtn_subpage'];
    }
    //$entity_title = $likebtn_entities[$entity_name];

    // JS and Styles
    global $likebtn_website_locales;
    $likebtn_website_locale = substr(get_bloginfo('language'), 0, 2);
    if (!in_array($likebtn_website_locale, $likebtn_website_locales)) {
        $likebtn_website_locale = 'en';
    }

    likebtn_admin_header();
    ?>
    <script src="//likebtn.com/<?php echo $likebtn_website_locale ?>/js/donate_generator.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo _likebtn_get_public_url() ?>js/jquery/select2/select2.js?v=<?php echo _likebtn_get_plugin_version() ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo _likebtn_get_public_url() ?>js/jquery/jquery-ui/jquery-ui.js?v=<?php echo _likebtn_get_plugin_version() ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo _likebtn_get_public_url() ?>css/jquery/select2/select2.css?v=<?php echo _likebtn_get_plugin_version() ?>" />

    <script type="text/javascript">
        var reset_settings = [];
        reset_settings['post_view_mode'] = 'both';
        reset_settings['post_format'] = 'all';
        reset_settings['exclude_sections'] = '';
        reset_settings['exclude_categories'] = '';
        reset_settings['allow_ids'] = '';
        reset_settings['exclude_ids'] = '';
        reset_settings['position'] = 'bottom';
        reset_settings['alignment'] = 'left';
        reset_settings['user_logged_in'] = '';
    <?php foreach ($likebtn_settings as $option_name => $option_info): ?>
            reset_settings['settings_<?php echo $option_name ?>'] = '<?php echo $option_info['default'] ?>';
    <?php endforeach ?>

    <?php /*
        var likebtn_entities = [
    <?php $entity_index = 0; ?>
    <?php foreach ($likebtn_entities as $entity_name => $entity_title): ?>
            <?php $entity_index++; ?>
            '<?php echo $entity_name; ?>'<?php if ($entity_index != count($likebtn_entities)-1): ?>,<?php endif ?>
    <?php endforeach ?>
        ];
     */ ?>

        var likebtn_msg_reset = '<?php _e('Are you sure you want to reset settings for this entity?', LIKEBTN_I18N_DOMAIN); ?>';

        jQuery(document).ready(function() {
            planChange('<?php echo get_option('likebtn_plan'); ?>');
            <?php if (!empty($subpage)): ?>
                likebtnGotoSubpage('<?php echo $subpage; ?>');
            <?php endif ?>
            likebtnDetectSubpage();
        });
    </script>

    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <form method="post" action="options.php">
            <?php settings_fields('likebtn_buttons'); ?>
            <input type="hidden" value="" name="likebtn_subpage" id="likebtn_subpage"/>

            <h3 class="nav-tab-wrapper" style="padding: 0" id="likebtn_subpage_tab_wrapper">
                <?php foreach ($likebtn_entities as $tab_entity_name => $tab_entity_title): ?>
                    <a class="nav-tab likebtn_tab_<?php echo $tab_entity_name; ?> <?php echo ($subpage == $tab_entity_name ? 'nav-tab-active' : '') ?>" href="#likebtn_subpage_<?php echo $tab_entity_name; ?>" onclick="javascript:likebtnGotoSubpage('<?php echo $tab_entity_name; ?>');void(0);"><img src="<?php echo _likebtn_get_public_url() ?>img/yes.png" class="likebtn_ttip likebtn_show_marker <?php if (get_option('likebtn_show_' . $tab_entity_name) != '1'): ?>hidden<?php endif ?>" title="<?php _e('Like Button enabled', LIKEBTN_I18N_DOMAIN); ?>"><?php _e($tab_entity_title, LIKEBTN_I18N_DOMAIN); ?></a>
                <?php endforeach ?>
            </h3>
            <?php
            foreach ($likebtn_entities as $entity_name => $entity_title):

                $excluded_sections = get_option('likebtn_exclude_sections_' . $entity_name);
                if (!is_array($excluded_sections)) {
                    $excluded_sections = array();
                }

                $excluded_categories = get_option('likebtn_exclude_categories_' . $entity_name);
                if (!is_array($excluded_categories)) {
                    $excluded_categories = array();
                }

                // just in case
                if (!is_array(get_option('likebtn_post_format_' . $entity_name))) {
                    update_option('likebtn_post_format_' . $entity_name, array('all'));
                }

                ?>

                <div id="likebtn_subpage_wrapper_<?php echo $entity_name; ?>" class="likebtn_subpage <?php if ($subpage !== $entity_name): ?>hidden<?php endif ?>" >
                    <?php /*<h3><?php _e($entity_title, LIKEBTN_I18N_DOMAIN); ?></h3>*/ ?>
                    <div class="inside">

                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row"><label><?php _e('Enable Like Button', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                <td>
                                    <input type="checkbox" name="likebtn_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_show_' . $entity_name)); ?> onClick="entityShowChange(this, '<?php echo $entity_name; ?>')" />
                                </td>
                            </tr>
                        </table>

                        <div id="entity_container_<?php echo $entity_name; ?>" <?php if (!get_option('likebtn_show_' . $entity_name)): ?>style="display:none"<?php endif ?>>
                            <table class="form-table" >
                                <tr valign="top">
                                    <th scope="row"><label><?php _e('Copy Settings From', LIKEBTN_I18N_DOMAIN); ?></label>
                                        <i class="likebtn_help" title="<?php _e('Choose the entity from which you want to copy settings', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                    </th>
                                    <td>
                                        <select name="likebtn_use_settings_from_<?php echo $entity_name; ?>" onChange="userSettingsFromChange(this, '<?php echo $entity_name; ?>')">
                                            <option value="" <?php selected('', get_option('likebtn_use_settings_from_' . $entity_name)); ?> >&nbsp;</option>
                                            <?php foreach ($likebtn_entities as $use_entity_name => $use_entity_title): ?>
                                                <?php
                                                if ($use_entity_name == $entity_name) {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo $use_entity_name; ?>" <?php selected($use_entity_name, get_option('likebtn_use_settings_from_' . $entity_name)); ?> ><?php _e($use_entity_title, LIKEBTN_I18N_DOMAIN); ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                </tr>

                                <?php if (get_option('likebtn_show_' . $entity_name) == '1'): ?>
                                    <tr valign="top">
                                        <th scope="row" colspan="2" style="padding-right: 0;">
                                            <label><?php _e('Preview', LIKEBTN_I18N_DOMAIN); ?></label>
                                            <div class="preview_container">
                                                <?php echo _likebtn_get_markup($entity_name, 'demo', array(), get_option('likebtn_use_settings_from_' . $entity_name)) ?>
                                            </div>
                                            <div class="support_link">
                                                ♥ <?php _e('Like it?', LIKEBTN_I18N_DOMAIN); ?>
                                                <a href="http://wordpress.org/support/view/plugin-reviews/likebtn-like-button?rate=5#postform" target="_blank">
                                                    <?php _e('Support the plugin with 5 Stars', LIKEBTN_I18N_DOMAIN); ?>
                                                </a>
                                                <?php if ($subpage == $entity_name): ?>
                                                    <table class="likebtn_social"><tr>
                                                        <td>
                                                            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FLikeBtn.LikeButton&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=192115980991078" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; width:110px;" allowTransparency="true"></iframe>
                                                        </td>
                                                        <td>
                                                            <a href="https://twitter.com/likebtn" class="twitter-follow-button" data-show-count="true" data-show-screen-name="false" data-width="144px"></a>
                                                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                                        </td>
                                                        <td style="max-width: 125px">
                                                            <script src="https://apis.google.com/js/platform.js" async defer></script>
                                                            <div class="g-follow" data-href="https://plus.google.com/+Likebtn" data-rel="publisher"></div>
                                                        </td>
                                                    </tr></table>
                                                <?php endif ?>
                                            </div>
                                        </th>
                                    </tr>
                                <?php endif ?>
                            </table>
                            <div id="use_settings_from_container_<?php echo $entity_name; ?>" <?php if (get_option('likebtn_use_settings_from_' . $entity_name)): ?>style="display:none"<?php endif ?>>
                                <div class="postbox">
                                    <h3><?php _e('Settings', LIKEBTN_I18N_DOMAIN); ?></h3>
                                    <div class="inside">

                                        <table class="form-table">
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Theme', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <select name="likebtn_settings_style_<?php echo $entity_name; ?>">
                                                        <?php foreach ($style_options as $style): ?>
                                                            <option value="<?php echo $style; ?>" <?php selected($style, get_option('likebtn_settings_style_' . $entity_name)); ?> ><?php echo $style; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Language', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <select name="likebtn_settings_lang_<?php echo $entity_name; ?>">
                                                        <?php foreach ($languages as $lang_code => $lang_title): ?>
                                                            <option value="<?php echo $lang_code; ?>" <?php selected($lang_code, get_option('likebtn_settings_lang_' . $entity_name)); ?> ><?php echo $lang_title; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Show buttons', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="checkbox" name="likebtn_settings_like_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_like_enabled_' . $entity_name)); ?> />
                                                    <i><?php _e('Like', LIKEBTN_I18N_DOMAIN); ?></i>
                                                    &nbsp;&nbsp;
                                                    <input type="checkbox" name="likebtn_settings_dislike_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_dislike_enabled_' . $entity_name)); ?> />
                                                    <i><?php _e('Dislike', LIKEBTN_I18N_DOMAIN); ?></i>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Show labels', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="checkbox" name="likebtn_settings_show_like_label_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_show_like_label_' . $entity_name)); ?> />
                                                    <i><?php _e('Like', LIKEBTN_I18N_DOMAIN); ?></i>
                                                    &nbsp;&nbsp;
                                                    <input type="checkbox" name="likebtn_settings_show_dislike_label_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_show_dislike_label_' . $entity_name)); ?> />
                                                    <i><?php _e('Dislike', LIKEBTN_I18N_DOMAIN); ?></i>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                 <th scope="row"><label><?php _e('Show icons', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                 <td>
                                                     <input type="checkbox" name="likebtn_settings_icon_like_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_icon_like_show_' . $entity_name)); ?> />
                                                     <i><?php _e('Like', LIKEBTN_I18N_DOMAIN); ?></i>
                                                     &nbsp;&nbsp;
                                                     <input type="checkbox" name="likebtn_settings_icon_dislike_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_icon_dislike_show_' . $entity_name)); ?> />
                                                     <i><?php _e('Dislike', LIKEBTN_I18N_DOMAIN); ?></i>
                                                 </td>
                                             </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Counter type', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <select name="likebtn_settings_counter_type_<?php echo $entity_name; ?>">
                                                        <option value="number" <?php selected('number', get_option('likebtn_settings_counter_type_' . $entity_name)); ?> ><?php _e('Number', LIKEBTN_I18N_DOMAIN); ?></option>
                                                        <option value="percent" <?php selected('percent', get_option('likebtn_settings_counter_type_' . $entity_name)); ?> ><?php _e('Percent', LIKEBTN_I18N_DOMAIN); ?></option>
                                                        <option value="subtract_dislikes" <?php selected('subtract_dislikes', get_option('likebtn_settings_counter_type_' . $entity_name)); ?> ><?php _e('Subtract dislikes', LIKEBTN_I18N_DOMAIN); ?></option>
                                                        <option value="single_number" <?php selected('single_number', get_option('likebtn_settings_counter_type_' . $entity_name)); ?> ><?php _e('Next to Dislike button', LIKEBTN_I18N_DOMAIN); ?></option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Show tooltips', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="checkbox" name="likebtn_settings_tooltip_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_tooltip_enabled_' . $entity_name)); ?> />
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Like button text', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="text" name="likebtn_settings_i18n_like_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_like_' . $entity_name); ?>" size="60"/>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Dislike button text', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="text" name="likebtn_settings_i18n_dislike_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_dislike_' . $entity_name); ?>" size="60"/>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('White-label', LIKEBTN_I18N_DOMAIN); ?> <i class="premium_feature" title="VIP / ULTRA"></i></label>
                                                    <i class="likebtn_help" title="<?php _e('No LikeBtn branding link', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                </th>
                                                <td>
                                                    <input type="checkbox" name="likebtn_settings_white_label_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_white_label_' . $entity_name)); ?> class="plan_dependent plan_vip" />
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Position', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="radio" name="likebtn_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_POSITION_TOP ?>" <?php if (LIKEBTN_POSITION_TOP == get_option('likebtn_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Top of Content', LIKEBTN_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="likebtn_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_POSITION_BOTTOM ?>" <?php if (LIKEBTN_POSITION_BOTTOM == get_option('likebtn_position_' . $entity_name) || !get_option('likebtn_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Bottom of Content', LIKEBTN_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="likebtn_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_POSITION_BOTH ?>" <?php if (LIKEBTN_POSITION_BOTH == get_option('likebtn_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Top and Bottom', LIKEBTN_I18N_DOMAIN); ?>

                                                </td>
                                            </tr>
                                            <?php if (!in_array($entity_name, array(LIKEBTN_ENTITY_PRODUCT))): ?>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Alignment', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="radio" name="likebtn_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_ALIGNMENT_LEFT; ?>" <?php if (LIKEBTN_ALIGNMENT_LEFT == get_option('likebtn_alignment_' . $entity_name) || !get_option('likebtn_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Left'); ?>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="likebtn_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_ALIGNMENT_CENTER; ?>" <?php if (LIKEBTN_ALIGNMENT_CENTER == get_option('likebtn_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Center'); ?>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="likebtn_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_ALIGNMENT_RIGHT; ?>" <?php if (LIKEBTN_ALIGNMENT_RIGHT == get_option('likebtn_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Right'); ?>

                                                    </td>
                                                </tr>
                                            <?php endif ?>
                                        </table>

                                        <div class="postbox">

                                            <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Extended Settings', LIKEBTN_I18N_DOMAIN); ?></h3>
                                            <div class="inside hidden">
                                                <br/>

                                                <?php /*<p class="description">&nbsp;&nbsp;<?php _e('You can find detailed settings description on <a href="http://likebtn.com/en/#settings" target="_blank">LikeBtn.com</a>', LIKEBTN_I18N_DOMAIN); ?></p><br/>*/ ?>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('General', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table" >
                                                            <?php /*if (!in_array($entity_name, $likebtn_no_excerpts)): ?>
                                                                <tr valign="top">
                                                                    <th scope="row"><label><?php _e('View mode', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                    <td>
                                                                        <input type="radio" name="likebtn_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_POST_VIEW_MODE_FULL; ?>" <?php checked(LIKEBTN_POST_VIEW_MODE_FULL, get_option('likebtn_post_view_mode_' . $entity_name)) ?> /> <?php _e('Full', LIKEBTN_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="likebtn_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_POST_VIEW_MODE_EXCERPT; ?>" <?php checked(LIKEBTN_POST_VIEW_MODE_EXCERPT, get_option('likebtn_post_view_mode_' . $entity_name)) ?> /> <?php _e('Excerpt', LIKEBTN_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="likebtn_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_POST_VIEW_MODE_BOTH; ?>" <?php checked(LIKEBTN_POST_VIEW_MODE_BOTH, get_option('likebtn_post_view_mode_' . $entity_name)) ?> /> <?php _e('Both', LIKEBTN_I18N_DOMAIN); ?>

                                                                        <i class="likebtn_help" title="<?php _e('Choose post display modes for which you want to show the Like Button', LIKEBTN_I18N_DOMAIN); ?>"></i>
                                                                    </td>
                                                                </tr>
                                                            <?php endif*/ ?>

                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Format', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e('Select post formats for which you want to show the Like Button', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_post_format_<?php echo $entity_name; ?>[]" value="all" <?php if (in_array('all', get_option('likebtn_post_format_' . $entity_name))): ?>checked="checked"<?php endif ?> onClick="postFormatAllChange(this, '<?php echo $entity_name; ?>')" /> <?php _e('All', LIKEBTN_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <span id="post_format_container_<?php echo $entity_name; ?>" <?php if (in_array('all', get_option('likebtn_post_format_' . $entity_name))): ?>style="display:none"<?php endif ?>>
                                                                        <?php foreach ($post_formats as $post_format): ?>
                                                                            <input type="checkbox" name="likebtn_post_format_<?php echo $entity_name; ?>[]" value="<?php echo $post_format; ?>" <?php if (in_array($post_format, get_option('likebtn_post_format_' . $entity_name))): ?>checked="checked"<?php endif ?> /> <?php _e(__(ucfirst($post_format), LIKEBTN_I18N_DOMAIN)); ?>&nbsp;&nbsp;&nbsp;
                                                                        <?php endforeach ?>
                                                                    </span>
                                                                </td>
                                                            </tr>

                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Exclude on selected sections', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e('Choose sections where you DO NOT want to show the Like Button', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_exclude_sections_<?php echo $entity_name; ?>[]" value="home" <?php if (in_array('home', $excluded_sections)): ?>checked="checked"<?php endif ?> /> <?php _e('Home'); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="checkbox" name="likebtn_exclude_sections_<?php echo $entity_name; ?>[]" value="archive" <?php if (in_array('archive', $excluded_sections)): ?>checked="checked"<?php endif ?> /> <?php _e('Archive', LIKEBTN_I18N_DOMAIN); ?>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Exclude in selected categories', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e('Select categories where you DO NOT want to show the Like Button (use CTRL key to pick categories)', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <select name='likebtn_exclude_categories_<?php echo $entity_name; ?>[]' multiple="multiple" size="4" style="height:auto !important;">
                                                                        <?php
                                                                        $categories = get_categories();

                                                                        foreach ($categories as $category) {
                                                                            $selected = (in_array($category->cat_ID, $excluded_categories)) ? 'selected="selected"' : '';
                                                                            $option = '<option value="' . $category->cat_ID . '" ' . $selected . '>';
                                                                            $option .= $category->cat_name;
                                                                            $option .= ' (' . $category->category_count . ')';
                                                                            $option .= '</option>';
                                                                            echo $option;
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Allow post/page IDs', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e('Suppose you have a post which belongs to more than one category and you have excluded one of those categories. So the Like Button will not be available for that post. Enter comma separated post ids where you want to show the Like Button irrespective of that post category being excluded.', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="text" size="40" name="likebtn_allow_ids_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_allow_ids_' . $entity_name)); ?>" />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Exclude post/page IDs', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e('Comma separated post/page IDs where you DO NOT want to show the Like Button', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="text" size="40" name="likebtn_exclude_ids_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_exclude_ids_' . $entity_name)); ?>" />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('User authorization', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e('Show the Like Button when user is logged in, not logged in or show always', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="radio" name="likebtn_user_logged_in_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_user_logged_in_' . $entity_name)) ?> /> <?php _e('Logged in', LIKEBTN_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_user_logged_in_<?php echo $entity_name; ?>" value="0" <?php checked('0', get_option('likebtn_user_logged_in_' . $entity_name)) ?> /> <?php _e('Not logged in', LIKEBTN_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_user_logged_in_<?php echo $entity_name; ?>" value="" <?php checked('', get_option('likebtn_user_logged_in_' . $entity_name)) ?> /> <?php _e('For all', LIKEBTN_I18N_DOMAIN); ?>

                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Insert HTML before', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e('HTML code to insert before the Like Button', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <textarea name="likebtn_html_before_<?php echo $entity_name; ?>" cols="40" rows="2"><?php echo get_option('likebtn_html_before_' . $entity_name); ?></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Insert HTML after', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e('HTML code to insert after the Like Button', LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <textarea name="likebtn_html_after_<?php echo $entity_name; ?>" cols="40" rows="2"><?php echo get_option('likebtn_html_after_' . $entity_name); ?></textarea>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Voting', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Allow voting', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_voting_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_voting_enabled_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Allow to cancel a vote', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_voting_cancelable_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_voting_cancelable_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Allow to like and dislike at the same time', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_voting_both_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_voting_both_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Voting frequency', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e("If voting frequency set to every second/minute make sure that 'IP address vote interval' of your website is set to 1 and 60 seconds correspondingly on Websites page of LikeBtn.com", LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <select name="likebtn_settings_revote_period_<?php echo $entity_name; ?>">
                                                                        <option value=""><?php _e('Once', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="60" <?php selected('1', get_option('likebtn_settings_revote_period_' . $entity_name)); ?> ><?php _e('Every second', LIKEBTN_I18N_DOMAIN); ?> *</option>
                                                                        <option value="60" <?php selected('60', get_option('likebtn_settings_revote_period_' . $entity_name)); ?> ><?php _e('Every minute', LIKEBTN_I18N_DOMAIN); ?> *</option>
                                                                        <option value="3600" <?php selected('3600', get_option('likebtn_settings_revote_period_' . $entity_name)); ?> ><?php _e('Hourly', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="86400" <?php selected('86400', get_option('likebtn_settings_revote_period_' . $entity_name)); ?> ><?php _e('Daily', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="604800" <?php selected('604800', get_option('likebtn_settings_revote_period_' . $entity_name)); ?> ><?php _e('Weekly', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="2592000" <?php selected('2592000', get_option('likebtn_settings_revote_period_' . $entity_name)); ?> ><?php _e('Monthly', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="31536000" <?php selected('31536000', get_option('likebtn_settings_revote_period_' . $entity_name)); ?> ><?php _e('Annually', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Counter', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                         <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show votes counter', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_counter_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_counter_show_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Votes counter is clickable', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_counter_clickable_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_counter_clickable_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Counter padding', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_counter_padding_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_counter_padding_' . $entity_name); ?>" size="60" />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show zero value in counter', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_counter_zero_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_counter_zero_show_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Popup', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show popup on voting', LIKEBTN_I18N_DOMAIN); ?> <i class="premium_feature" title="VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_popup_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_popup_enabled_' . $entity_name)); ?> class="plan_dependent plan_vip" />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show popup on disliking', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_popup_dislike_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_popup_dislike_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup position', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <select name="likebtn_settings_popup_position_<?php echo $entity_name; ?>">
                                                                        <option value="top" <?php selected('top', get_option('likebtn_settings_popup_position_' . $entity_name)); ?> ><?php _e('top', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="right" <?php selected('right', get_option('likebtn_settings_popup_position_' . $entity_name)); ?> ><?php _e('right', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="bottom" <?php selected('bottom', get_option('likebtn_settings_popup_position_' . $entity_name)); ?> ><?php _e('bottom', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="left" <?php selected('left', get_option('likebtn_settings_popup_position_' . $entity_name)); ?> ><?php _e('left', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup style', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <select name="likebtn_settings_popup_style_<?php echo $entity_name; ?>">
                                                                        <option value="light" <?php selected('light', get_option('likebtn_settings_popup_style_' . $entity_name)); ?> ><?php _e('light', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                        <option value="dark" <?php selected('dark', get_option('likebtn_settings_popup_style_' . $entity_name)); ?> ><?php _e('dark', LIKEBTN_I18N_DOMAIN); ?></option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Hide popup when clicking outside', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_popup_hide_on_outside_click_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_popup_hide_on_outside_click_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show share buttons', LIKEBTN_I18N_DOMAIN); ?> <i class="premium_feature" title="PLUS / PRO / VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_share_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_share_enabled_' . $entity_name)); ?> class="plan_dependent plan_plus" />
                                                                    <?php /*<span class="description"><?php _e('Use popup_enabled option to enable/disable popup.', LIKEBTN_I18N_DOMAIN); ?></span>*/ ?>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('AddThis <a href="https://www.addthis.com/settings/publisher" target="_blank">Profile ID</a>', LIKEBTN_I18N_DOMAIN); ?> <i class="premium_feature" title="PLUS / PRO / VIP / ULTRA"></i></label>
                                                                    <i class="likebtn_help" title="<?php _e("Enter your AddThis Profile ID to collect sharing statistics and view it on AddThis analytics page", LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_addthis_pubid_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_addthis_pubid_' . $entity_name); ?>" size="60" class="plan_dependent plan_pro"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('AddThis share buttons', LIKEBTN_I18N_DOMAIN); ?> <i class="premium_feature" title="PLUS / PRO / VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_addthis_service_codes_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_addthis_service_codes_' . $entity_name); ?>" size="60" class="plan_dependent plan_pro"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Custom HTML', LIKEBTN_I18N_DOMAIN); ?> <i class="premium_feature" title="PRO / VIP / ULTRA"></i></label>
                                                                    <i class="likebtn_help" title="<?php _e("Custom HTML to insert into the popup", LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <textarea name="likebtn_settings_popup_html_<?php echo $entity_name; ?>" cols="58" rows="2"><?php echo get_option('likebtn_settings_popup_html_' . $entity_name); ?></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Donate buttons', LIKEBTN_I18N_DOMAIN); ?> <i class="premium_feature" title="VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_popup_donate_<?php echo $entity_name; ?>" value="<?php echo htmlspecialchars(get_option('likebtn_settings_popup_donate_' . $entity_name)); ?>" size="60" id="popup_donate_input" class="plan_dependent plan_vip"/> <a href="javascript:likebtnDG('popup_donate_input', false, {width: '80%'});void(0);"><img class="popup_donate_trigger" src="<?php echo _likebtn_get_public_url() ?>img/popup_donate.png" alt="<?php _e('Configure donate buttons', LIKEBTN_I18N_DOMAIN); ?>"></a>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup content order', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_popup_content_order_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_popup_content_order_' . $entity_name); ?>" size="60" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <?php /*<div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Sharing', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">

                                                        </table>
                                                    </div>
                                                </div>*/ ?>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Loading', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Lazy load', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e("If button is outside a viewport it is loaded when user scrolls to it", LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_lazy_load_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_lazy_load_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show loader', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e("Show loader while loading a button", LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_loader_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_loader_show_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Loader image', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e("URL of the image to use as loader image (leave empty to display default image)", LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_loader_image_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_loader_image_' . $entity_name); ?>" size="60" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <?php /*<div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Domains', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Use domain of the parent window', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_domain_from_parent_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_domain_from_parent_' . $entity_name)); ?> />
                                                                    <span class="description">domain_from_parent</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>*/ ?>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Events & messages', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row">
                                                                    <label>
                                                                        <?php _e('JavaScript callback function', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                </th>
                                                                <td class="description">
                                                                    <input type="text" size="40" name="likebtn_settings_event_handler_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_settings_event_handler_' . $entity_name)); ?>" />
                                                                    <p class="description">
                                                                        <?php _e('The provided function receives the event object as its single argument. The event object has the following properties:', LIKEBTN_I18N_DOMAIN); ?><br/>
                                                                        <code>type</code> – <?php _e('indicates which event was dispatched:', LIKEBTN_I18N_DOMAIN); ?><br/>
                                                                        ● "likebtn.loaded"<br/>
                                                                        ● "likebtn.like"<br/>
                                                                        ● "likebtn.unlike"<br/>
                                                                        ● "likebtn.dislike"<br/>
                                                                        ● "likebtn.undislike"<br/>
                                                                        <code>settings</code> – <?php _e('button settings', LIKEBTN_I18N_DOMAIN); ?><br/>
                                                                        <code>wrapper</code> – <?php _e('button DOM-element', LIKEBTN_I18N_DOMAIN); ?>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show info messages', LIKEBTN_I18N_DOMAIN); ?></label>
                                                                    <i class="likebtn_help" title="<?php _e("Show information message instead of the button when it is restricted by tariff plan", LIKEBTN_I18N_DOMAIN); ?>">&nbsp;</i>
                                                                </th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_settings_info_message_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_settings_info_message_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_collapse_trigger"><small>►</small> <?php _e('Texts', LIKEBTN_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Like button text after liking', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_after_like_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_after_like_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Dislike button text after disliking', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_after_dislike_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_after_dislike_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Like button tooltip', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_like_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_like_tooltip_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Dislike button tooltip', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_dislike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_dislike_tooltip_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Like button tooltip after liking', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_unlike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_unlike_tooltip_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Dislike button tooltip after disliking', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_undislike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_undislike_tooltip_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Text before share buttons', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_share_text_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_share_text_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup close button text', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_popup_close_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_popup_close_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup text when sharing disabled', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_popup_text_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_popup_text_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Text before donate buttons', LIKEBTN_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_settings_i18n_popup_donate_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_settings_i18n_popup_donate_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row" colspan="2">
                                                                    <a href="javascript:likebtnPopup('<?php _e('http://likebtn.com/en/translate-like-button-widget', LIKEBTN_I18N_DOMAIN); ?>?likebtn_short_version=1');void(0);"><?php _e('Send us Translation', LIKEBTN_I18N_DOMAIN); ?></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="likebtn_reset_wrapper">
                                            <input class="button-secondary" type="button" name="Reset" value="<?php _e('Reset', LIKEBTN_I18N_DOMAIN); ?>" onclick="return resetSettings('<?php echo $entity_name; ?>', reset_settings)" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <input class="button-primary" type="submit" name="Save" value="<?php _e('Save Changes', LIKEBTN_I18N_DOMAIN); ?>" /><br/><br/>
        </form>

    </div>
    </div>
    <?php
}

// admin vote statistics
function likebtn_admin_statistics() {

    global $likebtn_page_sizes;
    global $likebtn_post_statuses;
    global $wpdb;

    $likebtn_entities = _likebtn_get_entities(true);

    // Custom item
    $likebtn_entities[LIKEBTN_ENTITY_CUSTOM_ITEM] = __('Custom item');

    // get parameters
    // For translation
    __('Comment');
    $entity_name = $_GET['likebtn_entity_name'];
    if (!array_key_exists($entity_name, $likebtn_entities)) {
        $entity_name = LIKEBTN_ENTITY_POST;
    }

    // Resettings
    $reseted = '';
    if (!empty($_POST['item'])) {
        $reseted = likebtn_reset($entity_name, $_POST['item']);
    }

    // Multisite - available for super admin only
    $blogs = array();
    $blog_list = array();
    $statistics_blog_id = '';
    $prefix_prepared = $wpdb->prefix;
    if (is_multisite() && is_super_admin()) {

        global $blog_id;

        $blog_list = $wpdb->get_results("
            SELECT blog_id, domain
            FROM {$wpdb->blogs}
            WHERE site_id = '{$wpdb->siteid}'
            AND spam = '0'
            AND deleted = '0'
            AND archived = '0'
            ORDER BY blog_id
        ");

        // Place current blog on the first place
        foreach ($blog_list as $blog) {
            if ($blog->blog_id == $blog_id) {
                $blogs["{$blog->blog_id}"] = get_blog_option($blog->blog_id, 'blogname') . ' - ' . $blog->domain;
                break;
            }
        }

        foreach ($blog_list as $blog) {
            if ($blog->blog_id != $blog_id) {
                $blogs["{$blog->blog_id}"] = get_blog_option($blog->blog_id, 'blogname') . ' - ' . $blog->domain;
            }
        }

        // Add all
        $blogs['all'] = __('All Sites');

        // Determine selected blog id
        if (isset($_GET['likebtn_blog_id'])) {
            if ($_GET['likebtn_blog_id'] == 'all') {
                $statistics_blog_id = $_GET['likebtn_blog_id'];
            } else {
                // Check if blog with ID exists
                foreach ($blog_list as $blog) {
                    if ($blog->blog_id == (int)$_GET['likebtn_blog_id']) {
                        $statistics_blog_id = (int)$_GET['likebtn_blog_id'];
                        break;
                    }
                }
            }
        }

        // Prepare prefix if this is not main blog
        if ($blog_id != 1) {
            $prefix_prepared = substr($wpdb->prefix, 0, strlen($wpdb->prefix)-strlen($blog_id)-1);
        }
    }

    // Run sunchronization
    /**require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncVotes();*/

    // add comment statuses
    $likebtn_post_statuses['0'] = __('Comment not approved', LIKEBTN_I18N_DOMAIN);
    $likebtn_post_statuses['1'] = __('Comment approved', LIKEBTN_I18N_DOMAIN);

    $sort_by = $_GET['likebtn_sort_by'];
    if (!$sort_by) {
        $sort_by = 'likes';
    }

    $page_size = $_GET['likebtn_page_size'];
    if (!$page_size) {
        $page_size = LIKEBTN_STATISTIC_PAGE_SIZE;
    }

    $post_id = '';
    if (isset($_GET['likebtn_post_id'])) {
        $post_id = trim(stripcslashes($_GET['likebtn_post_id']));
    }

    $post_title = '';
    if (isset($_GET['likebtn_post_title'])) {
        $post_title = trim(stripcslashes($_GET['likebtn_post_title']));
    }
    $post_status = '';
    if (isset($_GET['likebtn_post_status'])) {
        $post_status = trim($_GET['likebtn_post_status']);
    }

    // pagination
    require_once(dirname(__FILE__) . '/likebtn_like_button_pagination.class.php');

    $pagination_target = "admin.php?page=likebtn_statistics";
    foreach ($_GET as $get_parameter => $get_value) {
        $pagination_target .= '&' . $get_parameter . '=' . stripcslashes($get_value);
    }

    $p = new LikeBtnLikeButtonPagination();
    $p->limit($page_size); // Limit entries per page
    $p->target($pagination_target);
    $p->currentPage($_GET[$p->paging]); // Gets and validates the current page
    $p->prevLabel(__('Previous', LIKEBTN_I18N_DOMAIN));
    $p->nextLabel(__('Next', LIKEBTN_I18N_DOMAIN));

    if (!isset($_GET['paging'])) {
        $p->page = 1;
    } else {
        $p->page = $_GET['paging'];
    }

    // query for limit paging
    $query_limit = "LIMIT " . ($p->page - 1) * $p->limit . ", " . $p->limit;

    // query parameters
    $query_where = '';

    if (!in_array($entity_name, array(LIKEBTN_ENTITY_COMMENT, LIKEBTN_ENTITY_CUSTOM_ITEM))) {
        $query_where .= ' AND p.post_type = %s ';
        $query_parameters[] = $entity_name;
    }

    if ($post_id) {
        $query_where .= ' AND p.ID = %d ';
        $query_parameters[] = $post_id;
    }
    if ($post_title) {
        if ($entity_name == LIKEBTN_ENTITY_COMMENT) {
            $query_where .= ' AND LOWER(p.comment_content) LIKE "%%%s%%" ';
        } elseif ($entity_name == LIKEBTN_ENTITY_CUSTOM_ITEM) {
            $query_where .= ' AND LOWER(p.identifier) LIKE "%%%s%%" ';
        } else {
            $query_where .= ' AND LOWER(p.post_title) LIKE "%%%s%%" ';
        }
        $query_parameters[] = strtolower($post_title);
    }
    if ($post_status !== '') {
        if ($entity_name == LIKEBTN_ENTITY_COMMENT) {
            $query_where .= ' AND p.comment_approved = %s ';
        } elseif ($entity_name != LIKEBTN_ENTITY_CUSTOM_ITEM) {
            $query_where .= ' AND p.post_status = %s ';
        }
        $query_parameters[] = $post_status;
    }

    // order by
    switch ($sort_by) {
        case 'likes':
            $query_orderby = 'ORDER BY likes DESC';
            break;
        case 'dislikes':
            $query_orderby = 'ORDER BY dislikes DESC';
            break;
        /*case 'last_updated':
            $query_orderby = 'ORDER BY pm_likes.meta_id DESC';
            break;*/
    }

    // For Multisite
    $query = '';
    if ($statistics_blog_id && $statistics_blog_id != 1 && $statistics_blog_id != 'all') {
        $prefix = "{$prefix_prepared}{$statistics_blog_id}_";
        $query = _likebtn_get_statistics_sql($entity_name, $prefix, $query_where, $query_orderby, $query_limit);
        $query_prepared = $wpdb->prepare($query, $query_parameters);
    } else if ($statistics_blog_id == 'all') {
        foreach ($blog_list as $blog) {
            if ($blog->blog_id == 1) {
                $prefix = $prefix_prepared;
            } else {
                $prefix = "{$prefix_prepared}{$blog->blog_id}_";
            }
            $query_list[] = $wpdb->prepare(_likebtn_get_statistics_sql($entity_name, $prefix, $query_where, '', '', $blog->blog_id . ' as blog_id, '), $query_parameters);
        }
        $query_prepared = ' SELECT SQL_CALC_FOUND_ROWS * from (' . implode(' UNION ', $query_list) . ") query {$query_orderby} {$query_limit} ";
    } else {
        $query = _likebtn_get_statistics_sql($entity_name, $prefix_prepared, $query_where, $query_orderby, $query_limit);
        $query_prepared = $wpdb->prepare($query, $query_parameters);
    }

//    echo "<pre>";
//    echo $wpdb->prepare($query, $query_parameters);
//    $wpdb->show_errors();
    $statistics = $wpdb->get_results($query_prepared);

    $total_found = 0;
    if (isset($statistics[0])) {
        $query_found_rows = "SELECT FOUND_ROWS() as found_rows";
        $found_rows = $wpdb->get_results($query_found_rows);

        $total_found = (int) $found_rows[0]->found_rows;

        $p->items($total_found);
        $p->calculate(); // Calculates what to show
        $p->parameterName('paging');
        $p->adjacents(1); // No. of page away from the current page
    }

    likebtn_admin_header();
    ?>
    <div id="poststuff" class="metabox-holder has-right-sidebar">

        <a href="javascript:toggleToUpgrade();void(0);"><?php _e('To enable statistics...', LIKEBTN_I18N_DOMAIN) ?></a>
        <ol id="likebtn_to_upgrade" class="hidden">
            <li><?php _e('Enable synchronization on Synchronization tab.', LIKEBTN_I18N_DOMAIN); ?></li>
            <li><?php _e('Upgrade your website to PRO or higher plan on <a href="http://likebtn.com/en/#plans_pricing" target="_blank" title="Like Button Plans">LikeBtn.com</a>.', LIKEBTN_I18N_DOMAIN); ?></li>
            <?php /*<li><?php _e('Set your website tariff plan in Settings.', LIKEBTN_I18N_DOMAIN); ?></li>
            <li><?php _e('Enter E-mail and API key in Settings.', LIKEBTN_I18N_DOMAIN); ?></li>
            <li><?php _e('Set Synchronization interval in Settings.', LIKEBTN_I18N_DOMAIN); ?></li>*/ ?>
            <?php /* <li><?php _e('Run Synchronization test in Settings.', LIKEBTN_I18N_DOMAIN); ?></li> */ ?>
        </ol>
        <br/><br/>
        <form action="" method="get" id="statistics_form">
            <input type="hidden" name="page" value="likebtn_statistics" />

            <?php if ($blogs): ?>
                <label><?php _e('Site', LIKEBTN_I18N_DOMAIN); ?>:</label>
                <select name="likebtn_blog_id" >
                    <?php foreach ($blogs as $blog_id_value => $blog_title): ?>
                        <option value="<?php echo $blog_id_value; ?>" <?php selected($statistics_blog_id, $blog_id_value); ?> ><?php echo $blog_title; ?></option>
                    <?php endforeach ?>
                </select>
                &nbsp;&nbsp;
            <?php endif ?>

            <label><?php _e('Type'); ?>:</label>
            <select name="likebtn_entity_name" >
                <?php foreach ($likebtn_entities as $entity_name_value => $entity_title): ?>
                    <option value="<?php echo $entity_name_value; ?>" <?php selected($entity_name, $entity_name_value); ?> ><?php _e($entity_title, LIKEBTN_I18N_DOMAIN); ?></option>
                <?php endforeach ?>
            </select>
            &nbsp;&nbsp;
            <label><?php _e('Show first', LIKEBTN_I18N_DOMAIN); ?>:</label>
            <select name="likebtn_sort_by" >
                <option value="likes" <?php selected('likes', $sort_by); ?> ><?php _e('Most liked', LIKEBTN_I18N_DOMAIN); ?></option>
                <option value="dislikes" <?php selected('dislikes', $sort_by); ?> ><?php _e('Most disliked', LIKEBTN_I18N_DOMAIN); ?></option>
                <?php /* <option value="last_updated" <?php selected('last_updated', $sort_by); ?> ><?php _e('Last updated', LIKEBTN_I18N_DOMAIN); ?></option> */ ?>
            </select>

            &nbsp;&nbsp;
            <label><?php _e('Page size', LIKEBTN_I18N_DOMAIN); ?>:</label>
            <select name="likebtn_page_size" >
                <?php foreach ($likebtn_page_sizes as $page_size_value): ?>
                    <option value="<?php echo $page_size_value; ?>" <?php selected($page_size, $page_size_value); ?> ><?php echo $page_size_value ?></option>
                <?php endforeach ?>

            </select>
            <br/><br/>
            <div class="postbox statistics_filter_container">
                <h3><?php _e('Filter', LIKEBTN_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <label><?php _e('ID', LIKEBTN_I18N_DOMAIN); ?>:</label>
                    <input type="text" name="likebtn_post_id" value="<?php echo htmlspecialchars($post_id) ?>" size="8" />
                    &nbsp;&nbsp;
                    <label><?php _e('Title'); ?>:</label>
                    <input type="text" name="likebtn_post_title" value="<?php echo htmlspecialchars($post_title) ?>" size="60"/>
                    &nbsp;&nbsp;
                    <label><?php _e('Status', LIKEBTN_I18N_DOMAIN); ?>:</label>
                    <select name="likebtn_post_status" >
                        <option value=""></option>
                        <?php foreach ($likebtn_post_statuses as $post_status_value => $post_status_title): ?>
                            <option value="<?php echo $post_status_value; ?>" <?php selected($post_status, $post_status_value); ?> ><?php echo _e($post_status_title) ?></option>
                        <?php endforeach ?>
                    </select>

                    &nbsp;&nbsp;
                    <input class="button-secondary" type="button" name="reset" value="<?php _e('Reset filter', LIKEBTN_I18N_DOMAIN); ?>" onClick="jQuery('.statistics_filter_container :input[type!=button]').val('');
                jQuery('#statistics_form').submit();"/>
                </div>
            </div>

            <input class="button-primary" type="submit" name="show" value="<?php _e('Show', LIKEBTN_I18N_DOMAIN); ?>" />
        </form>
        <br/>
        <?php _e('Total found', LIKEBTN_I18N_DOMAIN); ?>: <strong><?php echo $total_found ?></strong>
        <br/>
        <?php if ($reseted !== ''): ?>
            <br/><span style="color: green"><?php _e('Likes and dislikes for the following number of items have been successfully reseted:', LIKEBTN_I18N_DOMAIN); ?></span> <strong style="color: green"><?php echo $reseted ?></strong><br/>
        <?php endif ?>
        <form onsubmit="return statisticsSubmit('<?php echo get_option('likebtn_plan'); ?>', {
              confirm: '<?php _e("The votes count can not be recovered after resetting. Are you sure you want to reset likes and dislikes for the selected item(s)?", LIKEBTN_I18N_DOMAIN); ?>',
              items: '<?php _e("Select item(s) you want to reset", LIKEBTN_I18N_DOMAIN); ?>',
              upgrade: '<?php _e("Upgrade your website to VIP to be able to use the feature", LIKEBTN_I18N_DOMAIN); ?>'
        })" method="post" action="">
        <?php if (count($statistics) && $p->total_pages > 0): ?>
            <div class="tablenav">
                <input type="submit" class="button-secondary" onclick="" name="reset_selected" value="<?php _e('Reset selected', LIKEBTN_I18N_DOMAIN); ?>" title="<?php _e('Set to zero number of likes and dislikes for selected items', LIKEBTN_I18N_DOMAIN); ?>">
                <div class="tablenav-pages">
                    <?php echo $p->show(); ?>
                </div>
            </div>
        <?php endif ?>
        <table class="widefat" id="statistics_container">
            <thead>
                <tr>
                    <th><input type="checkbox" onclick="statisticsItemsCheckbox(this)" value="all" style="margin:0"></th>
                    <?php if ($entity_name != LIKEBTN_ENTITY_CUSTOM_ITEM): ?>
                        <th>ID</th>
                    <?php endif ?>
                    <?php if ($entity_name == LIKEBTN_ENTITY_POST): ?>
                        <th><?php _e('Thumbnail') ?></th>
                    <?php endif ?>
                    <th width="100%"><?php _e('Title') ?></th>
                    <?php if ($blogs && $statistics_blog_id == 'all'): ?>
                        <th><?php _e('Site') ?></th>
                    <?php endif ?>
                    <th><?php _e('Likes', LIKEBTN_I18N_DOMAIN) ?></th>
                    <th><?php _e('Dislikes', LIKEBTN_I18N_DOMAIN) ?></th>
                    <th><?php _e('Likes minus dislikes', LIKEBTN_I18N_DOMAIN) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statistics as $statistics_item): ?>

                    <?php if (!$blogs): ?>
                        <?php if ($entity_name == LIKEBTN_ENTITY_COMMENT): ?>
                            <?php $post_url = get_comment_link($statistics_item->post_id); ?>
                        <?php elseif ($entity_name == LIKEBTN_ENTITY_CUSTOM_ITEM): ?>
                            <?php $post_url = $statistics_item->url; ?>
                        <?php else: ?>
                            <?php $post_url = get_permalink($statistics_item->post_id); ?>
                        <?php endif ?>
                    <?php else: ?>
                        <?php if ($entity_name == LIKEBTN_ENTITY_COMMENT): ?>
                            <?php $post_url = _likebtn_get_blog_comment_link($statistics_item->blog_id, $statistics_item->post_id); ?>
                        <?php elseif ($entity_name == LIKEBTN_ENTITY_CUSTOM_ITEM): ?>
                            <?php $post_url = $statistics_item->url; ?>
                        <?php else: ?>
                            <?php $post_url = get_blog_permalink($statistics_item->blog_id, $statistics_item->post_id); ?>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if (mb_strlen($statistics_item->post_title) > 100): ?>
                        <?php $statistics_item->post_title = mb_substr($statistics_item->post_title, 0, 100) . '...'; ?>
                    <?php endif ?>
                    <?php if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')): ?>
                        <?php $statistics_item->post_title = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($statistics_item->post_title); ?>
                    <?php endif ?>
                    <tr id="item_<?php echo $statistics_item->post_id; ?>">
                        <td><input type="checkbox" class="item_checkbox" value="<?php echo $statistics_item->post_id; ?>" name="item[]" <?php if ($blogs && $statistics_item->blog_id != $blog_id): ?>disabled="disabled"<?php endif ?>></td>
                        <?php if ($entity_name != LIKEBTN_ENTITY_CUSTOM_ITEM): ?>
                            <td><?php echo $statistics_item->post_id; ?></td>
                        <?php endif ?>
                        <?php if ($entity_name == LIKEBTN_ENTITY_POST): ?>
                            <td><?php echo get_the_post_thumbnail($statistics_item->post_id, array(32,32)); ?>&nbsp;</td>
                        <?php endif ?>
                        <td><a href="<?php echo $post_url ?>" target="_blank"><?php echo htmlspecialchars($statistics_item->post_title); ?></a></td>
                        <?php if ($blogs && $statistics_blog_id == 'all'): ?>
                            <td><?php echo get_blog_option($statistics_item->blog_id, 'blogname') ?></td>
                        <?php endif ?>
                        <td>
                            <?php if ($blogs && $statistics_item->blog_id != $blog_id): ?>
                                <?php echo $statistics_item->likes; ?>
                            <?php else: ?>
                                <a href="javascript:statisticsEdit('<?php echo $entity_name ?>', '<?php echo $statistics_item->post_id; ?>', 'like', '<?php echo get_option('likebtn_plan'); ?>', '<?php _e('Enter new value:', LIKEBTN_I18N_DOMAIN) ?>', '<?php _e('Upgrade your website plan to the ULTRA plan to use the feature', LIKEBTN_I18N_DOMAIN) ?>', '<?php _e('Error occured. Please, try again later.', LIKEBTN_I18N_DOMAIN) ?>');void(0);" title="<?php _e('Click to change', LIKEBTN_I18N_DOMAIN) ?>" class="item_like"><?php echo $statistics_item->likes; ?></a>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if ($blogs && $statistics_item->blog_id != $blog_id): ?>
                                <?php echo $statistics_item->dislikes; ?>
                            <?php else: ?>
                                <a href="javascript:statisticsEdit('<?php echo $entity_name ?>', '<?php echo $statistics_item->post_id; ?>', 'dislike', '<?php echo get_option('likebtn_plan'); ?>', '<?php _e('Enter new value:', LIKEBTN_I18N_DOMAIN) ?>', '<?php _e('Upgrade your website plan to the ULTRA plan to use the feature', LIKEBTN_I18N_DOMAIN) ?>', '<?php _e('Error occured. Please, try again later.', LIKEBTN_I18N_DOMAIN) ?>');void(0);" title="<?php _e('Click to change', LIKEBTN_I18N_DOMAIN) ?>" class="item_dislike"><?php echo $statistics_item->dislikes; ?></a>
                            <?php endif ?>
                        </td>
                        <td><?php echo $statistics_item->likes_minus_dislikes; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </form>
        <?php if (count($statistics) && $p->total_pages > 0): ?>
            <div class="tablenav">
                <div class="tablenav-pages">
                    <?php echo $p->show(); ?>
                </div>
            </div>
        <?php endif ?>

    </div>

    </div>
    <?php
}

// get SQL query for retrieving statistics
function _likebtn_get_statistics_sql($entity_name, $prefix, $query_where, $query_orderby, $query_limit, $query_select = 'SQL_CALC_FOUND_ROWS')
{
    if ($entity_name == LIKEBTN_ENTITY_COMMENT) {
        // comment
        $query = "
             SELECT {$query_select}
                p.comment_ID as 'post_id',
                p.comment_content as post_title,
                pm_likes.meta_value as 'likes',
                pm_dislikes.meta_value as 'dislikes',
                pm_likes_minus_dislikes.meta_value as 'likes_minus_dislikes'
             FROM {$prefix}commentmeta pm_likes
             LEFT JOIN {$prefix}comments p
                 ON (p.comment_ID = pm_likes.comment_id)
             LEFT JOIN {$prefix}commentmeta pm_dislikes
                 ON (pm_dislikes.comment_id = pm_likes.comment_id AND pm_dislikes.meta_key = '" . LIKEBTN_META_KEY_DISLIKES . "')
             LEFT JOIN {$prefix}commentmeta pm_likes_minus_dislikes
                 ON (pm_likes_minus_dislikes.comment_id = pm_likes.comment_id AND pm_likes_minus_dislikes.meta_key = '" . LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES . "')
             WHERE
                pm_likes.meta_key = '" . LIKEBTN_META_KEY_LIKES . "'
                {$query_where}
             {$query_orderby}
             {$query_limit}";
    } elseif ($entity_name == LIKEBTN_ENTITY_CUSTOM_ITEM) {
        // custom item
        $query = "
             SELECT {$query_select}
                p.ID as 'post_id',
                p.identifier as 'post_title',
                p.likes,
                p.dislikes,
                p.likes_minus_dislikes,
                p.url
             FROM {$prefix}" . LIKEBTN_TABLE_ITEM . " p
             WHERE
                1 = 1
                {$query_where}
             {$query_orderby}
             {$query_limit}";
    } else {
        // post
        $query = "
             SELECT {$query_select}
                p.ID as 'post_id',
                p.post_title,
                pm_likes.meta_value as 'likes',
                pm_dislikes.meta_value as 'dislikes',
                pm_likes_minus_dislikes.meta_value as 'likes_minus_dislikes'
             FROM {$prefix}postmeta pm_likes
             LEFT JOIN {$prefix}posts p
                 ON (p.ID = pm_likes.post_id)
             LEFT JOIN {$prefix}postmeta pm_dislikes
                 ON (pm_dislikes.post_id = pm_likes.post_id AND pm_dislikes.meta_key = '" . LIKEBTN_META_KEY_DISLIKES . "')
             LEFT JOIN {$prefix}postmeta pm_likes_minus_dislikes
                 ON (pm_likes_minus_dislikes.post_id = pm_likes.post_id AND pm_likes_minus_dislikes.meta_key = '" . LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES . "')
             WHERE
                pm_likes.meta_key = '" . LIKEBTN_META_KEY_LIKES . "'
                {$query_where}
             {$query_orderby}
             {$query_limit}";
    }

    return $query;
}

// admin help
function likebtn_admin_help() {
    likebtn_admin_header();
    ?>
    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <ul>
            <li><?php echo __('<a href="http://likebtn.com/en/wordpress-like-button-plugin" target="_blank">WordPress LikeBtn Plugin FAQ</a>', LIKEBTN_I18N_DOMAIN); ?></li>
            <li><?php echo __('<a href="http://likebtn.com/en/faq" target="_blank">LikeBtn FAQ</a>', LIKEBTN_I18N_DOMAIN); ?></li>
            <li><?php echo __('<a href="http://forum.likebtn.com/forums/34-WordPress" target="_blank">Forum</a>', LIKEBTN_I18N_DOMAIN); ?></li>
        </ul>
    </div>
    <?php
}

// get URL of the public folder
function _likebtn_get_public_url() {
    $siteurl = get_option('siteurl');
    return $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/public/';
}

// get plugin version
function _likebtn_get_plugin_version() {
    return get_option('likebtn_plugin_v');
}

// Get supported by current theme Post Formats
function _likebtn_get_post_formats() {
    $post_formats = get_theme_support('post-formats');
    if (is_array($post_formats[0])) {
        $post_formats = $post_formats[0];
    } else {
        $post_formats = array();
    }

    if (!is_array($post_formats)) {
        $post_formats = array();
    }

    // append Standard format
    array_unshift($post_formats, 'standard');

    return $post_formats;
}

// Get entity types
function _likebtn_get_entities($no_list = false) {
    /*global $likebtn_entities;

    if (count($likebtn_entities)) {
        return $likebtn_entities;
    }*/
    $likebtn_entities = array(
        LIKEBTN_ENTITY_POST => _likebtn_get_entity_title(LIKEBTN_ENTITY_POST),
        LIKEBTN_ENTITY_POST_LIST => _likebtn_get_entity_title(LIKEBTN_ENTITY_POST_LIST),
        LIKEBTN_ENTITY_PAGE => _likebtn_get_entity_title(LIKEBTN_ENTITY_PAGE),
    );
    $post_types = get_post_types(array('public'=>true, '_builtin' => false));

    if (!empty($post_types)) {
        foreach ($post_types as $post_type) {
            $likebtn_entities[$post_type] = _likebtn_get_entity_title($post_type);
            $likebtn_entities[$post_type.LIKEBTN_LIST_FLAG] = _likebtn_get_entity_title($post_type.LIKEBTN_LIST_FLAG);
        }
    }

    // Append BuddyPress
    /*if (_likebtn_is_bp_active()) {
        $likebtn_entities[LIKEBTN_ENTITY_BP_ACTIVITY_POST] = _likebtn_get_entity_title(LIKEBTN_ENTITY_BP_ACTIVITY_POST);
        $likebtn_entities[LIKEBTN_ENTITY_BP_ACTIVITY_UPDATE] = _likebtn_get_entity_title(LIKEBTN_ENTITY_BP_ACTIVITY_UPDATE);
        $likebtn_entities[LIKEBTN_ENTITY_BP_ACTIVITY_COMMENT] = _likebtn_get_entity_title(LIKEBTN_ENTITY_BP_ACTIVITY_COMMENT);
        $likebtn_entities[LIKEBTN_ENTITY_BP_MEMBER] = _likebtn_get_entity_title(LIKEBTN_ENTITY_BP_MEMBER);
        //$likebtn_entities[LIKEBTN_ENTITY_BP_MEMBER_LIST] = _likebtn_get_entity_title(LIKEBTN_ENTITY_BP_MEMBER_LIST);
    }*/

    // append Comments
    $likebtn_entities[LIKEBTN_ENTITY_COMMENT] = _likebtn_get_entity_title(LIKEBTN_ENTITY_COMMENT);

    // translate entity names
    // does not work here
    /* load_plugin_textdomain(LIKEBTN_I18N_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');

      foreach ($entities as $entity_name => $entity_title) {
      $entities[$entity_name] = __($entity_title, LIKEBTN_I18N_DOMAIN);
      } */

    // Remove excerpt entities
    if ($no_list) {
        foreach ($likebtn_entities as $entity_name=>$entity_title) {
            if (_likebtn_has_list_flag($entity_name)) {
                unset($likebtn_entities[$entity_name]);
            }
        }
    }

    return $likebtn_entities;
}

// short code
function likebtn_shortcode($args) {
    $entity_name = get_post_type();
    $entity_id = get_the_ID();

    return _likebtn_get_markup($entity_name, $entity_id, $args, '', false, false);
}

add_shortcode('likebtn', 'likebtn_shortcode');

################
###  Widget  ###
################
require_once(dirname(__FILE__) . '/likebtn_like_button_most_liked_widget.class.php');

// most liked short code
function likebtn_most_liked_widget_shortcode($args) {
    global $LikeBtnLikeButtonMostLiked;
    $options = $args;

    if (isset($options['number'])) {
        $options['number'] = (int) $options['number'];
    }
    $options['entity_name'] = array();
    if (isset($options['content_types'])) {
        $options['entity_name'] = explode(',', $options['content_types']);
    }
    return $LikeBtnLikeButtonMostLiked->widget(null, $options);
}

add_shortcode('likebtn_most_liked', 'likebtn_most_liked_widget_shortcode');


################
### Frontend ###
################

function _likebtn_get_markup($entity_name, $entity_id, $values = null, $use_entity_name = '', $use_entity_settings = true, $wrap = true) {

    global $likebtn_settings;
    global $wp_version;

    $prepared_settings = array();

    if (!$use_entity_name) {
        $use_entity_name = $entity_name;
    }

    // Cut excerpt flag from entity_name
    if ($entity_id !== 'demo') {
        $entity_name = _likebtn_cut_list_flag($entity_name);
    }

    if ($values && $values['identifier']) {
        $data = ' data-identifier="' . $values['identifier'] . '" ';
    } else {
        $data = ' data-identifier="' . $entity_name . '_' . $entity_id . '" ';
    }

    // Site ID
    if (get_option('likebtn_site_id')) {
        $data .= ' data-site_id="' . get_option('likebtn_site_id') . '" ';
    }

    foreach ($likebtn_settings as $option_name => $option_info) {

        if ($values && isset($values[$option_name])) {
            // if values passed
            $option_value = $values[$option_name];
        } elseif (!$use_entity_settings) {
            // Do not use entity value - use default. Usually in shortcodes.
            $option_value = $option_info['default'];
        } else {
            $option_value = get_option('likebtn_settings_' . $option_name . '_' . $use_entity_name);
        }

        $option_value_prepared = _likebtn_prepare_option($option_name, $option_value);
        $prepared_settings[$option_name] = $option_value_prepared;

        // do not add option if it has default value
        if ($option_value == $likebtn_settings[$option_name]['default'] ||
            $option_value === '' || is_bool($option_value)
        ) {
            // option has default value
        } else {
            $data .= ' data-' . $option_name . '="' . $option_value_prepared . '" ';
        }
    }

    // Add item options
    $entity = null;
    $entity_url = '';
    $entity_title = '';
    $entity_image = '';

    if ($entity_name == LIKEBTN_ENTITY_COMMENT) {
        $entity = get_comment($entity_id);
        if ($entity) {
            $entity_url = get_comment_link($entity->comment_ID);
            $entity_title = $entity->comment_content;
        }
    } else {
        $entity = get_post($entity_id);
        if ($entity) {
            $entity_url = get_permalink($entity->ID);
            $entity_title = $entity->post_title;
            $entity_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($entity->ID), 'large');
            if (!empty($entity_image_url[0])) {
                $entity_image = $entity_image_url[0];
            }
        }
    }

    if ($entity_url && !$prepared_settings['item_url']) {
        $data .= ' data-item_url="' . $entity_url . '" ';
    }
    if ($entity_title && !$prepared_settings['item_title']) {
        $entity_title = preg_replace('/\s+/', ' ', $entity_title);
        $entity_title = htmlspecialchars($entity_title);
        $data .= ' data-item_title="' . $entity_title . '" ';
    }
    if ($entity_image && !$prepared_settings['item_image']) {
        $data .= ' data-item_image="' . $entity_image . '" ';
    }

    // Set engine and plugin info
    $data .= ' data-engine="WordPress" ';
    $data .= ' data-engine_v="' . $wp_version . '" ';
    $plugin_v = _likebtn_get_plugin_version();
    if ($plugin_v) {
        $data .= ' data-plugin_v="' . $plugin_v . '" ';
    }

    $public_url = _likebtn_get_public_url();

    $markup = <<<MARKUP
<!-- LikeBtn.com BEGIN --><span class="likebtn-wrapper" {$data}></span><script type="text/javascript" src="//w.likebtn.com/js/w/widget.js" async="async"></script><script type="text/javascript">if (typeof(LikeBtn) != "undefined") { LikeBtn.init(); }</script><!-- LikeBtn.com END -->
MARKUP;

    // HTML before
    $html_before = '';
    if (isset($values['html_before'])) {
        $html_before = $values['html_before'];
    } elseif (get_option('likebtn_html_before_' . $use_entity_name)) {
        $html_before = get_option('likebtn_html_before_' . $use_entity_name);
    }
    if (trim($html_before)) {
        $markup = $html_before . $markup;
    }

    // HTML after
    $html_after = '';
    if (isset($values['html_after'])) {
        $html_after = $values['html_after'];
    } elseif (get_option('likebtn_html_after_' . $use_entity_name)) {
        $html_after = get_option('likebtn_html_after_' . $use_entity_name);
    }
    if (trim($html_after)) {
        $markup = $markup . $html_after;
    }

    // alignment
    if ($wrap) {
        $alignment = get_option('likebtn_alignment_' . $use_entity_name);
        if ($alignment == LIKEBTN_ALIGNMENT_RIGHT) {
            $markup = '<div style="text-align:right" class="likebtn_container">' . $markup . '</div>';
        } elseif ($alignment == LIKEBTN_ALIGNMENT_CENTER) {
            $markup = '<div style="text-align:center" class="likebtn_container">' . $markup . '</div>';
        } else {
            $markup = '<div class="likebtn_container">' . $markup . '</div>';
        }
    }

    return $markup;
}

// prepare option value
function _likebtn_prepare_option($option_name, $option_value)
{
    global $likebtn_settings;

    $option_value_prepared = $option_value;

    // do not format i18n options
    if (!strstr($option_name, 'i18n') &&
       (!isset($likebtn_settings[$option_name]) || $likebtn_settings[$option_name]['default'] !== ''))
    {
        if (is_int($option_value)) {
            if ($option_value) {
                $option_value_prepared = 'true';
            } else {
                $option_value_prepared = 'false';
            }
        }
        if ($option_value === '1') {
            $option_value_prepared = 'true';
        }
        if ($option_value === '0' || $option_value === '') {
            $option_value_prepared = 'false';
        }
    }
    // Replace quotes with &quot; to avoid XSS.
    //$option_value_prepared = str_replace('"', '&quot;', $option_value_prepared);
    $option_value_prepared = htmlspecialchars($option_value_prepared);

    return $option_value_prepared;
}

// get Entity settings
function _likebtn_get_entity_settings($entity_name) {

    global $likebtn_settings;
    $settings = array();

    foreach ($likebtn_settings as $option_name => $option_info) {
        $settings[$option_name] = get_option('likebtn_settings_' . $option_name . '_' . $entity_name);
    }
    return $settings;
}

// add Like Button to content
function likebtn_get_content($content, $callback_content_position = '') {

    global $likebtn_no_excerpts;

    if (is_feed()) {
        return $content;
    }

    // detemine entity type
    $real_entity_name = get_post_type();

    // Excerpt mode
    if (!is_single()) {
        if (!in_array($real_entity_name, $likebtn_no_excerpts)) {
            $real_entity_name = $real_entity_name . LIKEBTN_LIST_FLAG;
        }
    }

    // get entity name whose settings should be copied
    $use_entity_name = get_option('likebtn_use_settings_from_' . $real_entity_name);
    if ($use_entity_name) {
        $entity_name = $use_entity_name;
    } else {
        $entity_name = $real_entity_name;
    }

    if (get_option('likebtn_show_' . $real_entity_name) != '1'
        || get_option('likebtn_show_' . $entity_name) != '1')
    {
        return $content;
    }

    $entity_id = get_the_ID();

    // get the Posts/Pages IDs where we do not need to show like functionality
    $allow_ids = explode(",", get_option('likebtn_allow_ids_' . $entity_name));
    $exclude_ids = explode(",", get_option('likebtn_exclude_ids_' . $entity_name));
    $exclude_categories = get_option('likebtn_exclude_categories_' . $entity_name);
    $exclude_sections = get_option('likebtn_exclude_sections_' . $entity_name);

    if (empty($exclude_categories)) {
        $exclude_categories = array();
    }

    if (empty($exclude_sections)) {
        $exclude_sections = array();
    }

    // checking if section is excluded
    if ((in_array('home', $exclude_sections) && is_home()) || (in_array('archive', $exclude_sections) && is_archive())) {
        return $content;
    }

    // checking if category is excluded
    $categories = get_the_category();
    foreach ($categories as $category) {
        if (in_array($category->cat_ID, $exclude_categories) && !in_array($entity_id, $allow_ids)) {
            return $content;
        }
    }

    // check if post is excluded
    if (in_array($entity_id, $exclude_ids)) {
        return $content;
    }

    // check Post view mode
    /*switch (get_option('likebtn_post_view_mode_' . $entity_name)) {
        case LIKEBTN_POST_VIEW_MODE_FULL:
            if (!is_single()) {
                return $content;
            }
            break;
        case LIKEBTN_POST_VIEW_MODE_EXCERPT:
            if (is_single()) {
                return $content;
            }
            break;
    }*/

    // check Post format
    $post_format = get_post_format($entity_id);
    if (!$post_format) {
        $post_format = 'standard';
    }

    if (!in_array('all', get_option('likebtn_post_format_' . $entity_name)) &&
            !in_array($post_format, get_option('likebtn_post_format_' . $entity_name))
    ) {
        return $content;
    }

    // check user authorization
    $user_logged_in = get_option('likebtn_user_logged_in_' . $entity_name);

    if ($user_logged_in === '1' || $user_logged_in === '0') {
        if ($user_logged_in == '1' && !is_user_logged_in()) {
            return $content;
        }
        if ($user_logged_in == '0' && is_user_logged_in()) {
            return $content;
        }
    }

    $html = _likebtn_get_markup($real_entity_name, $entity_id, array(), $entity_name);

    $position = get_option('likebtn_position_' . $entity_name);

    if ($callback_content_position && function_exists($callback_content_position)) {
        $content = call_user_func($callback_content_position, $content, $html, $position);
    } else {
        if ($position == LIKEBTN_POSITION_TOP) {
            $content = $html . $content;
        } elseif ($position == LIKEBTN_POSITION_BOTTOM) {
            $content = $content . $html;
        } else {
            $content = $html . $content . $html;
        }
    }

    return $content;
}

// add Like Button to the entity (except Comment)
function likebtn_the_content($content) {
    if (get_post_type() == LIKEBTN_ENTITY_PRODUCT) {
        return $content;
    }

    $content = likebtn_get_content($content);
    return $content;
}
add_filter('the_content', 'likebtn_the_content');
add_filter('the_excerpt', 'likebtn_the_content');

// WooCommerce - top and button
function likebtn_woocommerce_product($content) {
    $content = likebtn_get_content($content);
    echo $content;
}
// WooCommerce - top
function likebtn_woocommerce_product_top($content) {
    $content = likebtn_get_content($content, '_likebtn_woocommerce_content_top');
    echo $content;
}
function _likebtn_woocommerce_content_top($content, $html, $position) {
    // WooCommerce
    if ($position == LIKEBTN_POSITION_BOTTOM) {
        return $content;
    } else {
        return $html . $content;
    }
}
// WooCommerce - bottom
function likebtn_woocommerce_after_main_content($content) {
    if (!is_single()) {
        return false;
    }
    $content = likebtn_get_content($content, '_likebtn_woocommerce_content_bottom');
    echo $content;
}
function likebtn_woocommerce_product_bottom($content) {
    $content = likebtn_get_content($content, '_likebtn_woocommerce_content_bottom');
    echo $content;
}
function _likebtn_woocommerce_content_bottom($content, $html, $position) {
    // WooCommerce
    if ($position == LIKEBTN_POSITION_TOP) {
        return $content;
    } else {
        return $html . $content;
    }
}

add_action('woocommerce_single_product_summary', 'likebtn_woocommerce_product_top', 7);
add_action('woocommerce_after_main_content', 'likebtn_woocommerce_after_main_content', 7);
add_action('woocommerce_after_shop_loop_item_title', 'likebtn_woocommerce_product_top', 7);
add_action('woocommerce_after_shop_loop_item_title', 'likebtn_woocommerce_product_bottom', 12);

// add Like Button to the Comment
function likebtn_comment_text($content) {

    global $comment;

    if (is_feed()) {
        return $content;
    }

    // detemine entity type
    $real_entity_name = LIKEBTN_ENTITY_COMMENT;

    // get entity name whose settings should be copied
    $use_entity_name = get_option('likebtn_use_settings_from_' . $real_entity_name);
    if ($use_entity_name) {
        $entity_name = $use_entity_name;
    } else {
        $entity_name = $real_entity_name;
    }

    if (get_option('likebtn_show_' . $real_entity_name) != '1'
        || get_option('likebtn_show_' . $entity_name) != '1')
    {
        return $content;
    }

    $comment_id = $comment->comment_ID;
    //$comment = get_comment($comment_id, ARRAY_A);
    $post_id = $comment->comment_post_ID;

    // get the Posts/Pages IDs where we do not need to show like functionality
    $allow_ids = explode(",", get_option('likebtn_allow_ids_' . $entity_name));
    $exclude_ids = explode(",", get_option('likebtn_exclude_ids_' . $entity_name));
    $exclude_categories = get_option('likebtn_exclude_categories_' . $entity_name);
    $exclude_sections = get_option('likebtn_exclude_sections_' . $entity_name);

    if (empty($exclude_categories)) {
        $exclude_categories = array();
    }

    if (empty($exclude_sections)) {
        $exclude_sections = array();
    }

    // checking if section is excluded
    if ((in_array('home', $exclude_sections) && is_home()) || (in_array('archive', $exclude_sections) && is_archive())) {
        return $content;
    }

    // checking if category is excluded
    $categories = get_the_category();
    foreach ($categories as $category) {
        if (in_array($category->cat_ID, $exclude_categories) && !in_array($post_id, $allow_ids)) {
            return $content;
        }
    }

    // check if post is excluded
    if (in_array($post_id, $exclude_ids)) {
        return $content;
    }

    // check Post view mode - no need
    // check Post format
    $post_format = get_post_format($post_id);
    if (!$post_format) {
        $post_format = 'standard';
    }

    if (!in_array('all', get_option('likebtn_post_format_' . $entity_name)) &&
            !in_array($post_format, get_option('likebtn_post_format_' . $entity_name))
    ) {
        return $content;
    }

    $html = _likebtn_get_markup($real_entity_name, $comment_id, array(), $entity_name);

    $position = get_option('likebtn_position_' . $entity_name);

    if ($position == LIKEBTN_POSITION_TOP) {
        $content = $html . $content;
    } elseif ($position == LIKEBTN_POSITION_BOTTOM) {
        $content = $content . $html;
    } else {
        $content = $html . $content . $html;
    }

    return $content;
}

add_filter('comment_text', 'likebtn_comment_text');

// show the Like Button in Post/Page
// if Like Button is enabled in admin for Post/Page do not show button twice
function likebtn_post($post_id = NULL) {
    global $post;
    if (empty($post_id)) {
        $post_id = $post->ID;
    }

    // detemine entity type
    if (is_page()) {
        $entity_name = LIKEBTN_ENTITY_PAGE;
    } else {
        $entity_name = LIKEBTN_ENTITY_POST;
    }

    // check if the Like Button should be displayed
    // if Like Button enabled for Post or Page in Admin do not show Like Button twice
    if ($entity_name == LIKEBTN_ENTITY_POST && get_option('likebtn_show_' . LIKEBTN_ENTITY_POST) == '1') {
        return;
    }
    if ($entity_name == LIKEBTN_ENTITY_PAGE && get_option('likebtn_show_' . LIKEBTN_ENTITY_PAGE) == '1') {
        return;
    }

    // 'post' here is for the sake of backward compatibility
    $html = _likebtn_get_markup('post', $post_id);

    echo $html;
}

// get or echo the Like Button in comment
function likebtn_comment($comment_id = NULL) {
    //global $comment;
    if (empty($comment_id)) {
        $comment_id = get_comment_ID();
    }

    // if Like Button enabled for Comment in Admin do not show Like Button twice
    if (get_option('likebtn_show_' . LIKEBTN_ENTITY_COMMENT) == '1') {
        return;
    }

    $html = _likebtn_get_markup(LIKEBTN_ENTITY_COMMENT, $comment_id);

    echo $html;
}

// test synchronization callback
function likebtn_manual_sync_callback() {

    $likebtn_account_email = '';
    if (isset($_POST['likebtn_account_email'])) {
        $likebtn_account_email = $_POST['likebtn_account_email'];
    }

    $likebtn_account_api_key = '';
    if (isset($_POST['likebtn_account_api_key'])) {
        $likebtn_account_api_key = $_POST['likebtn_account_api_key'];
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $sync_response = $likebtn->syncVotes($likebtn_account_email, $likebtn_account_api_key, true);

    if ($sync_response['result'] == 'success') {
        $result_text = __('OK', LIKEBTN_I18N_DOMAIN);
    } else {
        $result_text = __('Error', LIKEBTN_I18N_DOMAIN);
    }

    $response = array(
        'result' => $sync_response['result'],
        'result_text' => $result_text,
        'message' => $sync_response['message'],
    );

    define( 'DOING_AJAX', true );
    ob_clean();
    wp_send_json($response);
}

add_action('wp_ajax_likebtn_manual_sync', 'likebtn_manual_sync_callback');

// test synchronization callback
function likebtn_test_sync_callback() {

    $likebtn_account_email = '';

    if (isset($_POST['likebtn_account_email'])) {
        $likebtn_account_email = $_POST['likebtn_account_email'];
    }
    $likebtn_account_api_key = '';
    if (isset($_POST['likebtn_account_api_key'])) {
        $likebtn_account_api_key = $_POST['likebtn_account_api_key'];
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $test_response = $likebtn->testSync($likebtn_account_email, $likebtn_account_api_key);

    if ($test_response['result'] == 'success') {
        $result_text = __('OK', LIKEBTN_I18N_DOMAIN);
    } else {
        $result_text = __('Error', LIKEBTN_I18N_DOMAIN);
    }

    $response = array(
        'result' => $test_response['result'],
        'result_text' => $result_text,
        'message' => $test_response['message'],
    );

    define( 'DOING_AJAX', true );
    ob_clean();
    wp_send_json($response);
}

add_action('wp_ajax_likebtn_test_sync', 'likebtn_test_sync_callback');

// edit item callback
function likebtn_edit_item_callback() {

    $entity_name = '';
    if (isset($_POST['entity_name'])) {
        $entity_name = $_POST['entity_name'];
    }

    $entity_id = '';
    if (isset($_POST['entity_id'])) {
        $entity_id = $_POST['entity_id'];
    }

    $identifier = likebtn_get_identifier($entity_name, $entity_id);

    $type = '';
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }

    $value = '';
    if (isset($_POST['value'])) {
        $value = $_POST['value'];
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $edit_response = $likebtn->edit($identifier, $type, $value);

    if ($edit_response['result'] == 'success') {
        $result_text = __('OK', LIKEBTN_I18N_DOMAIN);

        // Update custom fields
        if ($type == '1') {
            $likes = $value;
            $dislikes = null;
        } else {
            $dislikes = $value;
            $likes = null;
        }
        $likebtn->updateCustomFields($identifier, $likes, $dislikes);
    } else {
        $result_text = __('Error', LIKEBTN_I18N_DOMAIN);
    }

    $response = array(
        'result' => $edit_response['result'],
        'result_text' => $result_text,
        'message' => $edit_response['message'],
        'value' => $value
    );

    define( 'DOING_AJAX', true );
    ob_clean();
    wp_send_json($response);
}

add_action('wp_ajax_likebtn_edit_item', 'likebtn_edit_item_callback');

// reset items likes/dislikes
function likebtn_reset($entity_name, $items)
{
    $counter = 0;

    if (empty($entity_name) || empty($items)) {
        return false;
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();

    // prepare an array for resettings in the CMS
    $reset_list = array();
    $reset_list['response'] = array('items'=>array());

    foreach ($items as $item_identifier) {
        $identifier = $entity_name . '_' . $item_identifier;
        // reset votes in LikeBtn
        $likebtn_result = $likebtn->reset($identifier);
        $reset_list['response']['items'][] = array(
            'identifier' => $identifier,
            'likes'      => 0,
            'dislikes'   => 0
        );
        if ($likebtn_result) {
            $counter++;
        }
    }

    if ($reset_list) {
        $likebtn->updateVotes($reset_list);
    }
    return $counter;
}

// get entity identifier
function likebtn_get_identifier($entity_name, $entity_id)
{
    $identifier = $entity_name . '_' . $entity_id;
    return $identifier;
}

// get comments sorted by likes
function likebtn_comments_sorted_by_likes()
{
    // function for sorting comments by Likes
    function sort_comments_by_likes($comment_a, $comment_b)
    {
        $comment_a_meta = get_comment_meta($comment_a->comment_ID, LIKEBTN_META_KEY_LIKES);
        $comment_b_meta = get_comment_meta($comment_b->comment_ID, LIKEBTN_META_KEY_LIKES);

        $comment_a_likes = (int)$comment_a_meta[0];
        $comment_b_likes = (int)$comment_b_meta[0];

        if ($comment_a_likes > $comment_b_likes) {
            return -1;
        } elseif ($comment_a_likes < $comment_b_likes) {
            return 1;
        }
        return 0;
    }

    global $wp_query;
    $comments = $wp_query->comments;
    usort($comments, 'sort_comments_by_likes');

    return $comments;
}

// get comments sorted by dislikes
function likebtn_comments_sorted_by_dislikes()
{
    // function for sorting comments by Likes
    function sort_comments_by_dislikes($comment_a, $comment_b)
    {
        $comment_a_meta = get_comment_meta($comment_a->comment_ID, LIKEBTN_META_KEY_DISLIKES);
        $comment_b_meta = get_comment_meta($comment_b->comment_ID, LIKEBTN_META_KEY_DISLIKES);

        $comment_a_dislikes = (int)$comment_a_meta[0];
        $comment_b_dislikes = (int)$comment_b_meta[0];

        if ($comment_a_dislikes > $comment_b_dislikes) {
            return -1;
        } elseif ($comment_a_dislikes < $comment_b_dislikes) {
            return 1;
        }
        return 0;
    }

    global $wp_query;
    $comments = $wp_query->comments;
    usort($comments, 'sort_comments_by_dislikes');

    return $comments;
}

// Get the permalink for a comment on another blog.
function _likebtn_get_blog_comment_link( $blog_id, $comment_id ) {
	switch_to_blog( $blog_id );
	$link = get_comment_link( $comment_id );
	restore_current_blog();

	return $link;
}

// Converts entity name to title
function _likebtn_get_entity_title($entity_name)
{
    global $likebtn_entity_titles;

    $title = '';
    $is_excerpt = false;
    if (_likebtn_has_list_flag($entity_name)) {
        $is_excerpt = true;
    }

    if (!array_key_exists($entity_name, $likebtn_entity_titles)) {

        $entity_name = _likebtn_cut_list_flag($entity_name);

        $title = __(str_replace('_', ' ', ucfirst($entity_name)));
        if ($is_excerpt) {
            $title .= ' ' . __('List');
        }
    } else {
        $title = __($likebtn_entity_titles[$entity_name]);
    }

    return $title;
}

// Check if entity has a list flag
function _likebtn_has_list_flag($entity_name)
{
    if (strstr($entity_name, LIKEBTN_LIST_FLAG)) {
        return true;
    } else {
        return false;
    }
}

// Cut list flag from entity name
function _likebtn_cut_list_flag($entity_name)
{
    return str_replace(LIKEBTN_LIST_FLAG, '', $entity_name);
}

// Check if BuddyPress is installed and active
function _likebtn_is_bp_active()
{
    if (function_exists('bp_is_active') && bp_is_active()) {
        return true;
    } else {
        return false;
    }
}

// add Like Button to content
function _likebtn_get_bp_content($entity_id)
{
    // detemine entity type
    $real_entity_name = LIKEBTN_ENTITY_BP_MEMBER;

    // Excerpt mode
    /*if (!is_single()) {
        if (!in_array($real_entity_name, $likebtn_no_excerpts)) {
            $real_entity_name = $real_entity_name . LIKEBTN_LIST_FLAG;
        }
    }*/

    // get entity name whose settings should be copied
    $use_entity_name = get_option('likebtn_use_settings_from_' . $real_entity_name);
    if ($use_entity_name) {
        $entity_name = $use_entity_name;
    } else {
        $entity_name = $real_entity_name;
    }

    if (get_option('likebtn_show_' . $real_entity_name) != '1'
        || get_option('likebtn_show_' . $entity_name) != '1')
    {
        return '';
    }

    // check user authorization
    $user_logged_in = get_option('likebtn_user_logged_in_' . $entity_name);

    if ($user_logged_in === '1' || $user_logged_in === '0') {
        if ($user_logged_in == '1' && !is_user_logged_in()) {
            return '';
        }
        if ($user_logged_in == '0' && is_user_logged_in()) {
            return '';
        }
    }

    $html = _likebtn_get_markup($real_entity_name, $entity_id, array(), $entity_name);

    return $html;
}

// BuddyPress member profile
function likebtn_bp_member()
{
    $content = _likebtn_get_bp_content(buddypress()->displayed_user->id);
    echo $content;
}
// User profile page.
add_action('bp_before_member_header_meta', 'likebtn_bp_member');