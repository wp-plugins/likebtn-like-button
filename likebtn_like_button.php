<?php
/*
  Plugin Name: Like Button Voting & Rating
  Plugin URI: http://likebtn.com
  Description: Add a Like Button to your site! Let your visitors like and dislike posts, pages, comments and custom post types. Sort content by likes. Get instant voting statistics and insights.
  Version: 2.0
  Author: likebtn
  Author URI: http://likebtn.com
 */

// i18n domain
define('LIKEBTN_LIKE_BUTTON_I18N_DOMAIN', 'likebtn-like-button');

// LikeBtn plans
define('LIKEBTN_LIKE_BUTTON_PLAN_TRIAL', 9);
define('LIKEBTN_LIKE_BUTTON_PLAN_FREE', 0);
define('LIKEBTN_LIKE_BUTTON_PLAN_PLUS', 1);
define('LIKEBTN_LIKE_BUTTON_PLAN_PRO', 2);
define('LIKEBTN_LIKE_BUTTON_PLAN_VIP', 3);
define('LIKEBTN_LIKE_BUTTON_PLAN_ULTRA', 4);

define('LIKEBTN_LIKE_BUTTON_ENTITY_POST', 'post');
define('LIKEBTN_LIKE_BUTTON_ENTITY_PAGE', 'page');
define('LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT', 'comment');
define('LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM', 'custom_item');

// position
define('LIKEBTN_LIKE_BUTTON_POSITION_TOP', 'top');
define('LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM', 'bottom');
define('LIKEBTN_LIKE_BUTTON_POSITION_BOTH', 'both');

// alignment
define('LIKEBTN_LIKE_BUTTON_ALIGNMENT_LEFT', 'left');
define('LIKEBTN_LIKE_BUTTON_ALIGNMENT_CENTER', 'center');
define('LIKEBTN_LIKE_BUTTON_ALIGNMENT_RIGHT', 'right');

// user
define('LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_FULL', 'full');
define('LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_EXCERPT', 'excerpt');
define('LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_BOTH', 'both');

// statistics page size
define('LIKEBTN_LIKE_BUTTON_STATISTIC_PAGE_SIZE', 50);

// show review link after this period
define('LIKEBTN_LIKE_BUTTON_REVIEW_LINK_PERIOD', '1 month');

// item table name
define('LIKEBTN_LIKE_BUTTON_TABLE_ITEM', 'likebtn_item');

// custom fields names
define('LIKEBTN_LIKE_BUTTON_META_KEY_LIKES', 'Likes');
define('LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES', 'Dislikes');
define('LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES', 'Likes minus dislikes');
global $likebtn_like_button_custom_fields;
$likebtn_like_button_custom_fields = array(
    LIKEBTN_LIKE_BUTTON_META_KEY_LIKES,
    LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES,
    LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES,
);

// entities for which plugin can be enabled
global $likebtn_like_button_entities;
//$likebtn_like_button_entities = _likebtn_like_button_get_entities($likebtn_like_button_entities);

// post format: just to translate
$post_formats = array(
    'standard' => __('Standard'),
    'aside' => __('Aside'),
    'image' => __('Image'),
    'link' => __('Link'),
    'quote' => __('Quote'),
    'status' => __('Status'),
);

// languages
global $likebtn_like_button_page_sizes;
$likebtn_like_button_page_sizes = array(
    10,
    20,
    50,
    100,
    500,
    1000,
    5000,
);
global $likebtn_like_button_post_statuses;
$likebtn_like_button_post_statuses = array_reverse(get_post_statuses());

// likebtn settings
global $likebtn_like_button_settings;
$likebtn_like_button_settings = array(
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
global $likebtn_like_button_plans;
$likebtn_like_button_plans = array(
    LIKEBTN_LIKE_BUTTON_PLAN_TRIAL => 'TRIAL',
    LIKEBTN_LIKE_BUTTON_PLAN_FREE => 'FREE',
    LIKEBTN_LIKE_BUTTON_PLAN_PLUS => 'PLUS',
    LIKEBTN_LIKE_BUTTON_PLAN_PRO => 'PRO',
    LIKEBTN_LIKE_BUTTON_PLAN_VIP => 'VIP',
    LIKEBTN_LIKE_BUTTON_PLAN_ULTRA => 'ULTRA',
);

// styles
global $likebtn_like_button_styles;
$likebtn_like_button_styles = array(
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
global $likebtn_like_button_default_languages;
$likebtn_like_button_default_languages = array(
    'en' => 'en - English',
    'ru' => 'ru - Русский (Russian)',
    'de' => 'de - Deutsch (German)',
    'ja' => 'ja - 日本語 (Japanese)',
    'uk' => 'uk - Українська мова (Ukrainian)',
    'kk' => 'kk - Қазақ тілі (Kazakh)',
    'nl' => 'nl - Nederlands (Dutch)',
    'hu' => 'hu - Magyar (Hungarian)',
    'sv' => 'sv - Svenska (Swedish)',
    'tr' => 'tr - Türkçe (Turkish)',
    'es' => 'es - Español (Spanish)'
);

// languages
global $likebtn_like_button_sync_intervals;
$likebtn_like_button_sync_intervals = array(
    5,
    15,
    30,
    60,
    90,
    120,
);

// LikeBtn website locales available
global $likebtn_like_button_website_locales;
$likebtn_like_button_website_locales = array(
    'en', 'ru'
);

###############
### Backend ###
###############
// i18n function
/* function likebtn_like_button_trans($text, $params = null) {
  if (!is_array($params)) {
  $params = func_get_args();
  $params = array_slice($params, 1);
  }
  return vsprintf(__($text, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), $params);
  } */

// initicalization
function likebtn_like_button_init() {
    load_plugin_textdomain(LIKEBTN_LIKE_BUTTON_I18N_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
    wp_enqueue_script('jquery');
}

add_action('init', 'likebtn_like_button_init');

// add Settings link to the plugin list page
function likebtn_like_button_links($links, $file) {
    $plugin_file = basename(__FILE__);
    if (basename($file) == $plugin_file) {
        $settings_link = '<a href="admin.php?page=likebtn_like_button_settings">' . __('Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . '</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}

add_filter('plugin_action_links', 'likebtn_like_button_links', 10, 2);

// admin options
function likebtn_like_button_admin_menu() {
    $logo_url = _likebtn_like_button_get_public_url() . 'img/menu_icon.png';

    add_menu_page(__('Like Buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), __('Like Buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), 'manage_options', 'likebtn_like_button_buttons', '', $logo_url);
    add_submenu_page(
            'likebtn_like_button_buttons', __('Buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . ' ‹ ' . __('LikeBtn Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), __('Buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), 'manage_options', 'likebtn_like_button_buttons', 'likebtn_like_button_admin_buttons'
    );
    //add_options_page('LikeBtn Like Button', __('LikeBtn Like Button', 'likebtn_like_button'), 'activate_plugins', 'likebtn_like_button', 'likebtn_like_button_admin_content');
    add_submenu_page(
            'likebtn_like_button_buttons', __('Synchronization', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . ' ‹ ' . __('LikeBtn Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), __('Synchronization', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), 'manage_options', 'likebtn_like_button_settings', 'likebtn_like_button_admin_settings'
    );
    add_submenu_page(
            'likebtn_like_button_buttons', __('Statistics', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . ' ‹ LikeBtn Like Button', __('Statistics', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), 'manage_options', 'likebtn_like_button_statistics', 'likebtn_like_button_admin_statistics'
    );
    add_submenu_page(
            'likebtn_like_button_buttons', __('Help') . ' ‹ LikeBtn Like Button', __('Help'), 'manage_options', 'likebtn_like_button_help', 'likebtn_like_button_admin_help'
    );
}

add_action('admin_menu', 'likebtn_like_button_admin_menu');

// plugin header
function likebtn_like_button_admin_head() {
    $url_css = _likebtn_like_button_get_public_url() . 'css/admin.css?v=' . _likebtn_like_button_get_plugin_version();
    $url_js = _likebtn_like_button_get_public_url() . 'js/admin.js?v=' . _likebtn_like_button_get_plugin_version();

    echo '<link rel="stylesheet" type="text/css" href="' . $url_css . '" />';
    echo '<link rel="stylesheet" type="text/css" href="' . _likebtn_like_button_get_public_url() . 'css/jquery/tipsy.css' . '" />';
    echo '<script src="' . $url_js . '" type="text/javascript"></script>';
    echo '<script src="' . _likebtn_like_button_get_public_url() . 'js/jquery/jquery.tipsy.js" type="text/javascript"></script>';
}

add_action('admin_head', 'likebtn_like_button_admin_head');

// admin header
function likebtn_like_button_admin_header() {
    $logo_url = _likebtn_like_button_get_public_url() . 'img/logotype.png';
    $header = <<<HEADER
    <div class="wrap" id="likebtn_like_button">
        <h2 class="likebtn_logo">
            <a href="http://likebtn.com" target="_blank" title="LikeBtn Like Button">
                <img alt="" src="{$logo_url}">LikeBtn
            </a>
        </h2>
HEADER;
//<div id="plan_upgrade">
//                Plan:
//        </div>

    /*$installation_timestamp = get_option('likebtn_like_button_installation_timestamp');

    if ( (($installation_timestamp && strtotime(date('Y-m-d H:i:s', $installation_timestamp) . ' +' . LIKEBTN_LIKE_BUTTON_REVIEW_LINK_PERIOD) < time())
           || !$installation_timestamp)
         && (get_option('likebtn_like_button_plan') != LIKEBTN_LIKE_BUTTON_PLAN_FREE && get_option('likebtn_like_button_plan') != LIKEBTN_LIKE_BUTTON_PLAN_TRIAL)
    ) {*/

    //}

    $header .= '
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_like_button_buttons' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_like_button_buttons">' . __('Buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . '</a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_like_button_settings' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_like_button_settings">' . __('Synchronization', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . '</a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_like_button_statistics' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_like_button_statistics">' . __('Statistics', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . ' <i class="premium_feature" title="PRO / VIP / ULTRA"></i></a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_like_button_help' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_like_button_help">' . __('Help') . '</a>';

    $header .= '
        <div id="premium_features_hint">
            <i class="premium_feature"></i>' . __('Premium / Trial features', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) .
        '</div>
    ';

    $header .= '</h2>';


    echo $header;
}

// uninstall hook
function likebtn_like_button_unistall() {
    global $likebtn_like_button_settings;

    $likebtn_like_button_entities = _likebtn_like_button_get_entities();

    // set default values for options
    delete_option('likebtn_like_button_plan');
    delete_option('likebtn_like_button_account_email');
    delete_option('likebtn_like_button_account_api_key');
    delete_option('likebtn_like_button_sync_inerval');
    delete_option('likebtn_like_button_site_id');
    //delete_option('likebtn_like_button_local_domain');
    //delete_option('likebtn_like_button_subdirectory');
    foreach ($likebtn_like_button_entities as $entity_name => $entity_title) {
        delete_option('likebtn_like_button_show_' . $entity_name);
        delete_option('likebtn_like_button_use_settings_from_' . $entity_name);
        delete_option('likebtn_like_button_post_view_mode_' . $entity_name);
        delete_option('likebtn_like_button_post_format_' . $entity_name);
        delete_option('likebtn_like_button_exclude_sections_' . $entity_name);
        delete_option('likebtn_like_button_exclude_categories_' . $entity_name);
        delete_option('likebtn_like_button_allow_ids_' . $entity_name);
        delete_option('likebtn_like_button_exclude_ids_' . $entity_name);
        delete_option('likebtn_like_button_user_logged_in_' . $entity_name);
        delete_option('likebtn_like_button_position_' . $entity_name);
        delete_option('likebtn_like_button_alignment_' . $entity_name);
        delete_option('likebtn_like_button_html_before_' . $entity_name);
        delete_option('likebtn_like_button_html_after_' . $entity_name);
        // settings
        foreach ($likebtn_like_button_settings as $option => $option_info) {
            delete_option('likebtn_like_button_settings_' . $option . '_' . $entity_name);
        }
    }
    delete_option('likebtn_like_button_last_sync_time');
    delete_option('likebtn_like_button_last_successfull_sync_time');
    delete_option('likebtn_like_button_last_locale_sync_time');
    delete_option('likebtn_like_button_plugin_v');
}

register_uninstall_hook(__FILE__, 'likebtn_like_button_unistall');

// activation hook
function likebtn_like_button_activation_hook() {

    $likebtn_like_button_entities = _likebtn_like_button_get_entities();

    // set default values for options
    add_option('likebtn_like_button_plan', LIKEBTN_LIKE_BUTTON_PLAN_TRIAL);
    add_option('likebtn_like_button_account_email', '');
    add_option('likebtn_like_button_account_api_key', '');
    add_option('likebtn_like_button_sync_inerval', '');
    add_option('likebtn_like_button_site_id', '');
    //add_option('likebtn_like_button_local_domain', '');
    //add_option('likebtn_like_button_subdirectory', '');

    // set default options for post types
    foreach ($likebtn_like_button_entities as $entity_name => $entity_title) {
        _likebtn_like_button_set_default_options($entity_name);
    }

    add_option('likebtn_like_button_last_sync_time', 0);
    add_option('likebtn_like_button_last_successfull_sync_time', 0);
    add_option('likebtn_like_button_plugin_v', '');

    // For showing review link
    if (!get_option('likebtn_like_button_installation_timestamp')) {
        add_option('likebtn_like_button_installation_timestamp', time());
    }

    // Remember plugin version
    if (function_exists('get_plugin_data')) {
        $plugin_data = get_plugin_data(__FILE__);
        if ($plugin_data && $plugin_data['Version']) {
            update_option("likebtn_like_button_plugin_v", $plugin_data['Version']);
        }
    }
}

// database update function
function likebtn_like_button_db_update_1() {
    global $wpdb;

    $table_name = $wpdb->prefix . LIKEBTN_LIKE_BUTTON_TABLE_ITEM;

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

    update_option("likebtn_like_button_db_version", 1);
}

// database update function
function likebtn_like_button_db_update_2() {
    global $wpdb;

    $table_name = $wpdb->prefix . LIKEBTN_LIKE_BUTTON_TABLE_ITEM;

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

    update_option("likebtn_like_button_db_version", 2);
}

// database update function
function likebtn_like_button_db_update_3() {
    global $wpdb;

    $table_name = $wpdb->prefix . LIKEBTN_LIKE_BUTTON_TABLE_ITEM;

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

    update_option("likebtn_like_button_db_version", 3);
}

// set default options for post type
function _likebtn_like_button_set_default_options($entity_name) {
    global $likebtn_like_button_settings;

    add_option('likebtn_like_button_show_' . $entity_name, '0');
    add_option('likebtn_like_button_use_settings_from_' . $entity_name, '');
    add_option('likebtn_like_button_post_view_mode_' . $entity_name, LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_BOTH);
    add_option('likebtn_like_button_post_format_' . $entity_name, array('all'));
    add_option('likebtn_like_button_exclude_sections_' . $entity_name, array());
    add_option('likebtn_like_button_exclude_categories_' . $entity_name, array());
    add_option('likebtn_like_button_allow_ids_' . $entity_name, '');
    add_option('likebtn_like_button_exclude_ids_' . $entity_name, '');
    add_option('likebtn_like_button_user_logged_in_' . $entity_name, '');
    add_option('likebtn_like_button_position_' . $entity_name, LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM);
    add_option('likebtn_like_button_alignment_' . $entity_name, LIKEBTN_LIKE_BUTTON_ALIGNMENT_LEFT);
    add_option('likebtn_like_button_html_before_' . $entity_name, '');
    add_option('likebtn_like_button_html_after_' . $entity_name, '');

    // settings
    foreach ($likebtn_like_button_settings as $option => $option_info) {
        add_option('likebtn_like_button_settings_' . $option . '_' . $entity_name, $option_info['default']);
    }
}

register_activation_hook(__FILE__, 'likebtn_like_button_activation_hook');

// registering settings
function likebtn_like_button_admin_init() {

    // Update DB
    $db_version = (int)get_option('likebtn_like_button_db_version');
    if (!$db_version) {
        add_option('likebtn_like_button_db_version', 0);
    }

    $db_version++;
    while (function_exists('likebtn_like_button_db_update_'.$db_version)) {
        call_user_func('likebtn_like_button_db_update_'.$db_version);
        $db_version++;
    }

    // Sync
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_plan');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_account_email');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_account_api_key');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_sync_inerval');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_site_id');
    //register_setting('likebtn_like_button_settings', 'likebtn_like_button_local_domain');
    //register_setting('likebtn_like_button_settings', 'likebtn_like_button_subdirectory');

    // Buttons
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_subpage');
    // Register settings
    $likebtn_like_button_entities = _likebtn_like_button_get_entities();
    foreach ($likebtn_like_button_entities as $entity_name => $entity_title) {
        _likebtn_like_button_register_entity_settings($entity_name);
    }
}

// register entity settings
function _likebtn_like_button_register_entity_settings($entity_name)
{
    global $likebtn_like_button_settings;

    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_show_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_use_settings_from_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_post_view_mode_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_post_format_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_exclude_sections_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_exclude_categories_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_allow_ids_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_exclude_ids_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_user_logged_in_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_position_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_alignment_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_html_before_' . $entity_name);
    register_setting('likebtn_like_button_buttons', 'likebtn_like_button_html_after_' . $entity_name);

    // settings
    foreach ($likebtn_like_button_settings as $option => $option_info) {
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_settings_' . $option . '_' . $entity_name);
    }
}

add_action('admin_init', 'likebtn_like_button_admin_init');

// admin content
function likebtn_like_button_admin_settings() {

    global $likebtn_like_button_plans;
    global $likebtn_like_button_sync_intervals;

    // reset sync interval
    if (!get_option('likebtn_like_button_account_email') || !get_option('likebtn_like_button_account_api_key')) {
        update_option('likebtn_like_button_sync_inerval', '');
    }

    likebtn_like_button_admin_header();
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            planChange(jQuery(":input[name='likebtn_like_button_plan']").val());
        });
    </script>
    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <form method="post" action="options.php">
            <?php settings_fields('likebtn_like_button_settings'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label><?php _e('Current plan', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                    <td>
                        <select name="likebtn_like_button_plan" onChange="planChange(this.value)">
                            <?php foreach ($likebtn_like_button_plans as $plan_id => $plan_name): ?>
                                <option value="<?php echo $plan_id; ?>" <?php if (get_option('likebtn_like_button_plan') == $plan_id): ?>selected="selected"<?php endif ?> ><?php echo $plan_name; ?></option>
                            <?php endforeach ?>
                        </select>
                        <p class="description">
                            <?php _e('Premium features are available only if your website is upgraded to the corresponding tariff plan (PLUS, PRO, VIP, ULTRA). Keep in mind that only websites upgraded to <a href="http://likebtn.com/en/#plans_pricing" target="_blank">PLUS</a> plan or higher are allowed to display more than 1 Like Button per page.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?><br/>
                            <a href="javascript:toggleToUpgrade();void(0);"><?php _e('To upgrade your website...', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></a>
                            <ol id="likebtn_like_button_to_upgrade" class="hidden">
                                <li><?php _e('Register on <a href="http://likebtn.com/en/customer.php/register/" target="_blank">LikeBtn.com</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></li>
                                <li><?php _e('Add your website to your account and activate it on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites page</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></li>
                                <li><?php _e('Upgrade your website to the desired plan.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></li>
                            </ol>
                        </p>
                    </td>
                </tr>
            </table>

            <p class="description">
                <?php _e('Enter this information in order to enable synchronization of likes from LikeBtn.com system into your database and get the opportunity to use the following features:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                ● <?php _e('View statistics on Statistics tab.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                ● <?php _e('Sort posts and comments by votes.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                ● <?php _e('Use Most Liked Content widget.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
            </p>
            <br/>

            <div class="postbox ">
                <h3><?php _e('LikeBtn.com Account', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <p>
                        <?php _e('To get your account data:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                        <ol>
                            <li><?php _e('Register on <a href="http://likebtn.com/en/customer.php/register/" target="_blank">LikeBtn.com</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></li>
                            <li><?php _e('Add your website to your account on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></li>
                        </ol>
                    </p>
                    <input class="likebtn_button_account" type="button" value="<?php _e('Get Account Data', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" onclick="likebtnPopup('<?php _e('http://likebtn.com/en/customer.php/register/', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>?likebtn_short_version=1')" />
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><label><?php _e('E-mail', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                            <td>
                                <input type="text" name="likebtn_like_button_account_email" value="<?php echo get_option('likebtn_like_button_account_email') ?>" size="60" onkeyup="accountChange(this)" class="likebtn_like_button_account"/><br/>
                                <p class="description"><?php _e('Your LikeBtn.com account email. Can be found on <a href="http://likebtn.com/en/customer.php/profile/edit" target="_blank">Profile</a> page', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('API key', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                            <td>
                                <input type="text" name="likebtn_like_button_account_api_key" value="<?php echo get_option('likebtn_like_button_account_api_key') ?>" size="60" onkeyup="accountChange(this)" class="likebtn_like_button_account"/><br/>
                                <p class="description"><?php _e('Your website API key on LikeBtn.com. Can be obtained on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Site ID', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                            <td>
                                <input type="text" name="likebtn_like_button_site_id" value="<?php echo get_option('likebtn_like_button_site_id') ?>" size="60" /><br/>
                                <?php /*<span class="description"><?php _e('Enter Site ID in following cases:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?><br/>
                                ● <?php _e('Your site is local – located on a local server and is available from your local network only and NOT available from the Internet.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?><br/>
                                ● <?php _e('Your site is path-based – one of sites located in different subdirectories of one domain and you want to have statistics separate from other sites.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?><br/><br/>*/ ?>
                                <p class="description">
                                    <?php _e('Your Site ID on LikeBtn.com. Can be obtained on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
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
                            <th scope="row"><label><?php _e('Synchronization Interval', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                            <td>
                                <select name="likebtn_like_button_sync_inerval" <?php disabled((!get_option('likebtn_like_button_account_email') || !get_option('likebtn_like_button_account_api_key'))); ?> >
                                    <option value="" <?php selected('', get_option('likebtn_like_button_sync_inerval')); ?> ><?php _e('Do not fetch votes from LikeBtn.com into my database', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></option>
                                    <?php foreach ($likebtn_like_button_sync_intervals as $sync_interval): ?>
                                        <option value="<?php echo $sync_interval; ?>" <?php selected($sync_interval, get_option('likebtn_like_button_sync_inerval')); ?> ><?php echo $sync_interval; ?> <?php _e('min', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                    <?php endforeach ?>
                                </select>
                                <i class="likebtn_help" title="<?php _e('Time interval in minutes in which fetching of vote results from LikeBtn.com into your database is being launched. When synchronization is enabled you can view Statistics, number of likes and dislikes for each post as Custom Field, sort posts by vote results, use Like Button widgets. The less the interval the heavier your database load.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                <br/><br/>
                                <input class="button-primary" type="button" value="<?php _e('Test sync', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" onclick="testSync('<?php echo _likebtn_like_button_get_public_url() ?>img/ajax_loader.gif')" /> &nbsp;<strong class="likebtn_like_button_test_sync_container"><img src="<?php echo _likebtn_like_button_get_public_url() ?>img/ajax_loader.gif" class="hidden"/></strong>
                                <br/><br/>
                                <input class="button-secondary likebtn_ttip" type="button" value="<?php _e('Run full sync manually', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" onclick="manualSync('<?php echo _likebtn_like_button_get_public_url() ?>img/ajax_loader.gif')" title="<?php _e("ATTENTION: Use this feature carefully since full synchronization may affect your website performance. If you don't experience any problems with likes synchronization better to avoid using this feature.", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>" /> &nbsp;<strong class="likebtn_like_button_manual_sync_container"><img src="<?php echo _likebtn_like_button_get_public_url() ?>img/ajax_loader.gif" class="hidden"/></strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php /*<div class="postbox likebtn_like_button_account">
                <h3><?php _e('Local domain', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">&nbsp;</th>
                            <td> ?>
                                <input type="hidden" name="likebtn_like_button_local_domain" value="<?php echo get_option('likebtn_like_button_local_domain') ?>" size="60" />
                                <?php
                                <br/>
                                <strong class="description"><?php _e('Example:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?> localdomain!50f358d30acf358d30ac000001</strong>
                                <br/><br/>
                                <span class="description"><?php _e('Specify it if your website is located on a local server and is available from your local network only and NOT available from the Internet. You can find the domain on your <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page after adding your local website to the panel. See <a href="http://likebtn.com/en/faq#local_domain" target="_blank">FAQ</a> for more details.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>*/ ?>
            <?php /*<div class="postbox likebtn_like_button_account">
                <h3><?php _e('Website subdirectory', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">&nbsp;</th>
                            <td> ?>
                                <input type="hidden" name="likebtn_like_button_subdirectory" value="<?php echo get_option('likebtn_like_button_subdirectory') ?>" size="60" />
                                <?php
                                <br/>
                                <strong class="description"><?php _e('Example:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?> /subdirectory/</strong>
                                <br/><br/>
                                <span class="description"><?php _e('If your website is one of websites located in different subdirectories of one domain and you want to have a separate from other websites on this domain statistics, enter subdirectory (for example /subdirectory/). Required for path-based <a href="http://codex.wordpress.org/Create_A_Network" target="_blank">multisite networks</a> in which on-demand sites use paths.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>*/ ?>

            <input class="button-primary" type="submit" name="Save" value="<?php _e('Save Changes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" />
        </form>

    </div>
    </div>
    <?php
}

// admin buttons
function likebtn_like_button_admin_buttons() {

    global $likebtn_like_button_styles;
    global $likebtn_like_button_default_languages;
    global $likebtn_like_button_settings;

    $likebtn_like_button_entities = _likebtn_like_button_get_entities();

    // retrieve post formats
    $post_formats = _likebtn_like_button_get_post_formats();

    // run sunchronization
    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncLocales();
    $likebtn->runSyncStyles();

    $locales = get_option('likebtn_like_button_locales');

    $languages = array();
    $languages['auto'] = __("Browser language", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    if ($locales) {
        // Locales have been loaded using API.
        foreach ($locales as $locale_code => $locale_info) {
            $lang_option = $locale_info['name'];
            /*if ($locale_code != 'en') {
                $lang_option .= ' (' . $locale_info['en_name'] . ')';
            }*/
            $languages[$locale_code] = $lang_option;
        }
    } else {
        // Locales have not been loaded using API yet, load default languages.
        foreach ($likebtn_like_button_default_languages as $lang_code => $lang_title) {
            $languages[$lang_code] = $lang_title;
        }
    }

    // Get styles
    $styles = get_option('likebtn_like_button_styles');

    $style_options = array();
    if (!$styles) {
      // Styles have not been loaded using API yet, load default languages
      $styles = $likebtn_like_button_styles;
    }
    foreach ($styles as $style) {
      $style_options[] = $style;
    }

    // Select tab
    $subpage = LIKEBTN_LIKE_BUTTON_ENTITY_POST;

    $post_subpage = get_option('likebtn_like_button_subpage');
    if (!empty($_GET['settings-updated']) && $post_subpage && array_key_exists($post_subpage, $likebtn_like_button_entities)) {
        $subpage = $post_subpage;
    } elseif (!empty($_GET['likebtn_like_button_subpage']) && array_key_exists($_GET['likebtn_like_button_subpage'], $likebtn_like_button_entities) ) {
        $subpage = $_GET['likebtn_like_button_subpage'];
    }
    //$entity_title = $likebtn_like_button_entities[$entity_name];

    // JS and Styles
    global $likebtn_like_button_website_locales;
    $likebtn_website_locale = substr(get_bloginfo('language'), 0, 2);
    if (!in_array($likebtn_website_locale, $likebtn_like_button_website_locales)) {
        $likebtn_website_locale = 'en';
    }

    likebtn_like_button_admin_header();
    ?>
    <script src="//likebtn.com/<?php echo $likebtn_website_locale ?>/js/donate_generator.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo _likebtn_like_button_get_public_url() ?>js/jquery/select2/select2.js?v=<?php echo _likebtn_like_button_get_plugin_version() ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo _likebtn_like_button_get_public_url() ?>js/jquery/jquery-ui/jquery-ui.js?v=<?php echo _likebtn_like_button_get_plugin_version() ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo _likebtn_like_button_get_public_url() ?>css/jquery/select2/select2.css?v=<?php echo _likebtn_like_button_get_plugin_version() ?>" />

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
    <?php foreach ($likebtn_like_button_settings as $option_name => $option_info): ?>
            reset_settings['settings_<?php echo $option_name ?>'] = '<?php echo $option_info['default'] ?>';
    <?php endforeach ?>

    <?php /*
        var likebtn_entities = [
    <?php $entity_index = 0; ?>
    <?php foreach ($likebtn_like_button_entities as $entity_name => $entity_title): ?>
            <?php $entity_index++; ?>
            '<?php echo $entity_name; ?>'<?php if ($entity_index != count($likebtn_like_button_entities)-1): ?>,<?php endif ?>
    <?php endforeach ?>
        ];
     */ ?>

        var likebtn_msg_reset = '<?php _e('Are you sure you want to reset settings for this entity?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>';

        jQuery(document).ready(function() {
            planChange('<?php echo get_option('likebtn_like_button_plan'); ?>');
            <?php if (!empty($subpage)): ?>
                likebtnGotoSubpage('<?php echo $subpage; ?>');
            <?php endif ?>
            likebtnDetectSubpage();
        });
    </script>

    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <form method="post" action="options.php">
            <?php settings_fields('likebtn_like_button_buttons'); ?>
            <input type="hidden" value="" name="likebtn_like_button_subpage" id="likebtn_like_button_subpage"/>

            <h3 class="nav-tab-wrapper" style="padding: 0" id="likebtn_subpage_tab_wrapper">
                <?php foreach ($likebtn_like_button_entities as $tab_entity_name => $tab_entity_title): ?>
                    <a class="nav-tab likebtn_like_button_tab_<?php echo $tab_entity_name; ?> <?php echo ($subpage == $tab_entity_name ? 'nav-tab-active' : '') ?>" href="#likebtn_like_button_subpage_<?php echo $tab_entity_name; ?>" onclick="javascript:likebtnGotoSubpage('<?php echo $tab_entity_name; ?>');void(0);"><img src="<?php echo _likebtn_like_button_get_public_url() ?>img/yes.png" class="likebtn_ttip likebtn_show_marker <?php if (get_option('likebtn_like_button_show_' . $tab_entity_name) != '1'): ?>hidden<?php endif ?>" title="<?php _e('Like Button enabled', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"><?php _e($tab_entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a>
                <?php endforeach ?>
            </h3>
            <?php
            foreach ($likebtn_like_button_entities as $entity_name => $entity_title):

                $excluded_sections = get_option('likebtn_like_button_exclude_sections_' . $entity_name);
                if (!is_array($excluded_sections)) {
                    $excluded_sections = array();
                }

                $excluded_categories = get_option('likebtn_like_button_exclude_categories_' . $entity_name);
                if (!is_array($excluded_categories)) {
                    $excluded_categories = array();
                }

                // just in case
                if (!is_array(get_option('likebtn_like_button_post_format_' . $entity_name))) {
                    update_option('likebtn_like_button_post_format_' . $entity_name, array('all'));
                }

                // Backward compatibility
                if (get_option('likebtn_like_button_settings_display_only_' . $entity_name)) {
                    if (get_option('likebtn_like_button_settings_display_only_' . $entity_name) == '1') {
                        update_option('likebtn_like_button_settings_voting_enabled_' . $entity_name, '0');
                    }
                    delete_option('likebtn_like_button_settings_display_only_' . $entity_name);
                }
                if (get_option('likebtn_like_button_settings_unlike_allowed_' . $entity_name)) {
                    if (get_option('likebtn_like_button_settings_unlike_allowed_' . $entity_name) == '1') {
                        update_option('likebtn_like_button_settings_voting_cancelable_' . $entity_name, '1');
                    }
                    delete_option('likebtn_like_button_settings_unlike_allowed_' . $entity_name);
                }
                if (get_option('likebtn_like_button_settings_like_dislike_at_the_same_time_' . $entity_name)) {
                    if (get_option('likebtn_like_button_settings_like_dislike_at_the_same_time_' . $entity_name) == '1') {
                        update_option('likebtn_like_button_settings_voting_both_' . $entity_name, '1');
                    }
                    delete_option('likebtn_like_button_settings_like_dislike_at_the_same_time_' . $entity_name);
                }
                if (get_option('likebtn_like_button_settings_show_copyright_' . $entity_name) === '0') {
                    update_option('likebtn_like_button_settings_white_label_' . $entity_name, '1');
                    delete_option('likebtn_like_button_settings_show_copyright_' . $entity_name);
                }

                ?>

                <div id="likebtn_like_button_subpage_wrapper_<?php echo $entity_name; ?>" class="likebtn_like_button_subpage <?php if ($subpage !== $entity_name): ?>hidden<?php endif ?>" >
                    <?php /*<h3><?php _e($entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>*/ ?>
                    <div class="inside">

                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row"><label><?php _e('Enable Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                <td>
                                    <input type="checkbox" name="likebtn_like_button_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_show_' . $entity_name)); ?> onClick="entityShowChange(this, '<?php echo $entity_name; ?>')" />
                                </td>
                            </tr>
                        </table>

                        <div id="entity_container_<?php echo $entity_name; ?>" <?php if (!get_option('likebtn_like_button_show_' . $entity_name)): ?>style="display:none"<?php endif ?>>
                            <table class="form-table" >
                                <tr valign="top">
                                    <th scope="row"><label><?php _e('Copy Settings From', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                    <td>
                                        <select name="likebtn_like_button_use_settings_from_<?php echo $entity_name; ?>" onChange="userSettingsFromChange(this, '<?php echo $entity_name; ?>')">
                                            <option value="" <?php selected('', get_option('likebtn_like_button_use_settings_from_' . $entity_name)); ?> >&nbsp;</option>
                                            <?php foreach ($likebtn_like_button_entities as $use_entity_name => $use_entity_title): ?>
                                                <?php
                                                if ($use_entity_name == $entity_name) {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo $use_entity_name; ?>" <?php selected($use_entity_name, get_option('likebtn_like_button_use_settings_from_' . $entity_name)); ?> ><?php _e($use_entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <i class="likebtn_help" title="<?php _e('Choose the entity from which you want to copy settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                    </td>
                                </tr>
                                <?php if (get_option('likebtn_like_button_show_' . $entity_name) == '1'): ?>
                                    <tr valign="top">
                                        <th scope="row" colspan="2">
                                            <label><?php _e('Preview', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
                                            <div class="preview_container">
                                                <?php echo _likebtn_like_button_get_markup($entity_name, 'demo', array(), get_option('likebtn_like_button_use_settings_from_' . $entity_name)) ?>
                                            </div>
                                            <p class="description support_link">
                                                ♥ <?php _e('Like it?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                                                <a href="http://wordpress.org/support/view/plugin-reviews/likebtn-like-button?rate=5#postform" target="_blank">
                                                    <?php _e('Support the plugin with 5 Stars', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                                                </a>
                                            </p>
                                        </th>
                                    </tr>
                                <?php endif ?>
                            </table>
                            <div id="use_settings_from_container_<?php echo $entity_name; ?>" <?php if (get_option('likebtn_like_button_use_settings_from_' . $entity_name)): ?>style="display:none"<?php endif ?>>
                                <div class="postbox">
                                    <h3><?php _e('Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                    <div class="inside">

                                        <table class="form-table">
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Theme', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <select name="likebtn_like_button_settings_style_<?php echo $entity_name; ?>">
                                                        <?php foreach ($style_options as $style): ?>
                                                            <option value="<?php echo $style; ?>" <?php selected($style, get_option('likebtn_like_button_settings_style_' . $entity_name)); ?> ><?php echo $style; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Language', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <select name="likebtn_like_button_settings_lang_<?php echo $entity_name; ?>">
                                                        <?php foreach ($languages as $lang_code => $lang_title): ?>
                                                            <option value="<?php echo $lang_code; ?>" <?php selected($lang_code, get_option('likebtn_like_button_settings_lang_' . $entity_name)); ?> ><?php echo $lang_title; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Show buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="checkbox" name="likebtn_like_button_settings_like_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_like_enabled_' . $entity_name)); ?> />
                                                    <i><?php _e('Like', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></i>
                                                    &nbsp;&nbsp;
                                                    <input type="checkbox" name="likebtn_like_button_settings_dislike_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_dislike_enabled_' . $entity_name)); ?> />
                                                    <i><?php _e('Dislike', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></i>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Show labels', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="checkbox" name="likebtn_like_button_settings_show_like_label_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_show_like_label_' . $entity_name)); ?> />
                                                    <i><?php _e('Like', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></i>
                                                    &nbsp;&nbsp;
                                                    <input type="checkbox" name="likebtn_like_button_settings_show_dislike_label_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_show_dislike_label_' . $entity_name)); ?> />
                                                    <i><?php _e('Dislike', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></i>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                 <th scope="row"><label><?php _e('Show icons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                 <td>
                                                     <input type="checkbox" name="likebtn_like_button_settings_icon_like_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_icon_like_show_' . $entity_name)); ?> />
                                                     <i><?php _e('Like', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></i>
                                                     &nbsp;&nbsp;
                                                     <input type="checkbox" name="likebtn_like_button_settings_icon_dislike_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_icon_dislike_show_' . $entity_name)); ?> />
                                                     <i><?php _e('Dislike', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></i>
                                                 </td>
                                             </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Counter type', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <select name="likebtn_like_button_settings_counter_type_<?php echo $entity_name; ?>">
                                                        <option value="number" <?php selected('number', get_option('likebtn_like_button_settings_counter_type_' . $entity_name)); ?> ><?php _e('Number', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                        <option value="percent" <?php selected('percent', get_option('likebtn_like_button_settings_counter_type_' . $entity_name)); ?> ><?php _e('Percent', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                        <option value="subtract_dislikes" <?php selected('subtract_dislikes', get_option('likebtn_like_button_settings_counter_type_' . $entity_name)); ?> ><?php _e('Subtract dislikes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                        <option value="single_number" <?php selected('single_number', get_option('likebtn_like_button_settings_counter_type_' . $entity_name)); ?> ><?php _e('Next to Dislike button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Show tooltips', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="checkbox" name="likebtn_like_button_settings_tooltip_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_tooltip_enabled_' . $entity_name)); ?> />
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Like button text', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="text" name="likebtn_like_button_settings_i18n_like_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_like_' . $entity_name); ?>" size="60"/>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('Dislike button text', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                <td>
                                                    <input type="text" name="likebtn_like_button_settings_i18n_dislike_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_dislike_' . $entity_name); ?>" size="60"/>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row"><label><?php _e('White-label', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> <i class="premium_feature" title="VIP / ULTRA"></i></label></th>
                                                <td>
                                                    <input type="checkbox" name="likebtn_like_button_settings_white_label_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_white_label_' . $entity_name)); ?> class="plan_dependent plan_vip" />
                                                    <i class="likebtn_help" title="<?php _e('No LikeBtn branding link', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="postbox">

                                            <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Extended Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                            <div class="inside hidden">
                                                <br/>

                                                <?php /*<p class="description">&nbsp;&nbsp;<?php _e('You can find detailed settings description on <a href="http://likebtn.com/en/#settings" target="_blank">LikeBtn.com</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></p><br/>*/ ?>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('General', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table" >

                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Post view mode', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="radio" name="likebtn_like_button_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_FULL; ?>" <?php checked(LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_FULL, get_option('likebtn_like_button_post_view_mode_' . $entity_name)) ?> /> <?php _e('Full', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_like_button_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_EXCERPT; ?>" <?php checked(LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_EXCERPT, get_option('likebtn_like_button_post_view_mode_' . $entity_name)) ?> /> <?php _e('Excerpt', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_like_button_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_BOTH; ?>" <?php checked(LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_BOTH, get_option('likebtn_like_button_post_view_mode_' . $entity_name)) ?> /> <?php _e('Both', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>

                                                                    <i class="likebtn_help likebtn_help_space" title="<?php _e('Choose post display modes for which you want to show the Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>

                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Post format', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_post_format_<?php echo $entity_name; ?>[]" value="all" <?php if (in_array('all', get_option('likebtn_like_button_post_format_' . $entity_name))): ?>checked="checked"<?php endif ?> onClick="postFormatAllChange(this, '<?php echo $entity_name; ?>')" /> <?php _e('All', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <span id="post_format_container_<?php echo $entity_name; ?>" <?php if (in_array('all', get_option('likebtn_like_button_post_format_' . $entity_name))): ?>style="display:none"<?php endif ?>>
                                                                        <?php foreach ($post_formats as $post_format): ?>
                                                                            <input type="checkbox" name="likebtn_like_button_post_format_<?php echo $entity_name; ?>[]" value="<?php echo $post_format; ?>" <?php if (in_array($post_format, get_option('likebtn_like_button_post_format_' . $entity_name))): ?>checked="checked"<?php endif ?> /> <?php _e(__(ucfirst($post_format), LIKEBTN_LIKE_BUTTON_I18N_DOMAIN)); ?>&nbsp;&nbsp;&nbsp;
                                                                        <?php endforeach ?>
                                                                    </span>
                                                                    <i class="likebtn_help likebtn_help_space" title="<?php _e('Select post formats for which you want to show the Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>

                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Exclude on selected sections', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_exclude_sections_<?php echo $entity_name; ?>[]" value="home" <?php if (in_array('home', $excluded_sections)): ?>checked="checked"<?php endif ?> /> <?php _e('Home'); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="checkbox" name="likebtn_like_button_exclude_sections_<?php echo $entity_name; ?>[]" value="archive" <?php if (in_array('archive', $excluded_sections)): ?>checked="checked"<?php endif ?> /> <?php _e('Archive', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                                                                    <i class="likebtn_help likebtn_help_space" title="<?php _e('Choose sections where you DO NOT want to show the Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Exclude in selected categories', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <select name='likebtn_like_button_exclude_categories_<?php echo $entity_name; ?>[]' multiple="multiple" size="4" style="height:auto !important;">
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
                                                                    <i class="likebtn_help" title="<?php _e('Select categories where you DO NOT want to show the Like Button (use CTRL key to pick categories)', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Allow post/page IDs', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" size="40" name="likebtn_like_button_allow_ids_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_like_button_allow_ids_' . $entity_name)); ?>" />
                                                                    <i class="likebtn_help" title="<?php _e('Suppose you have a post which belongs to more than one category and you have excluded one of those categories. So the Like Button will not be available for that post. Enter comma separated post ids where you want to show the Like Button irrespective of that post category being excluded.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Exclude post/page IDs', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" size="40" name="likebtn_like_button_exclude_ids_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_like_button_exclude_ids_' . $entity_name)); ?>" />
                                                                    <i class="likebtn_help" title="<?php _e('Comma separated post/page IDs where you DO NOT want to show the Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('User authorization', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="radio" name="likebtn_like_button_user_logged_in_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_user_logged_in_' . $entity_name)) ?> /> <?php _e('Logged in', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_like_button_user_logged_in_<?php echo $entity_name; ?>" value="0" <?php checked('0', get_option('likebtn_like_button_user_logged_in_' . $entity_name)) ?> /> <?php _e('Not logged in', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_like_button_user_logged_in_<?php echo $entity_name; ?>" value="" <?php checked('', get_option('likebtn_like_button_user_logged_in_' . $entity_name)) ?> /> <?php _e('For all', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                                                                    <i class="likebtn_help likebtn_help_space" title="<?php _e('Show the Like Button when user is logged in, not logged in or show always', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>

                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Position', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="radio" name="likebtn_like_button_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POSITION_TOP ?>" <?php if (LIKEBTN_LIKE_BUTTON_POSITION_TOP == get_option('likebtn_like_button_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Top of Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_like_button_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM ?>" <?php if (LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM == get_option('likebtn_like_button_position_' . $entity_name) || !get_option('likebtn_like_button_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Bottom of Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_like_button_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POSITION_BOTH ?>" <?php if (LIKEBTN_LIKE_BUTTON_POSITION_BOTH == get_option('likebtn_like_button_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Top and Bottom', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>

                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Alignment', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="radio" name="likebtn_like_button_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_ALIGNMENT_LEFT; ?>" <?php if (LIKEBTN_LIKE_BUTTON_ALIGNMENT_LEFT == get_option('likebtn_like_button_alignment_' . $entity_name) || !get_option('likebtn_like_button_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Left'); ?>
                                                                    &nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_like_button_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_ALIGNMENT_CENTER; ?>" <?php if (LIKEBTN_LIKE_BUTTON_ALIGNMENT_CENTER == get_option('likebtn_like_button_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Center'); ?>
                                                                    &nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="likebtn_like_button_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_ALIGNMENT_RIGHT; ?>" <?php if (LIKEBTN_LIKE_BUTTON_ALIGNMENT_RIGHT == get_option('likebtn_like_button_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Right'); ?>

                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Insert HTML before', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <textarea name="likebtn_like_button_html_before_<?php echo $entity_name; ?>" cols="40" rows="2"><?php echo get_option('likebtn_like_button_html_before_' . $entity_name); ?></textarea>
                                                                    <i class="likebtn_help" title="<?php _e('HTML code to insert before the Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Insert HTML after', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <textarea name="likebtn_like_button_html_after_<?php echo $entity_name; ?>" cols="40" rows="2"><?php echo get_option('likebtn_like_button_html_after_' . $entity_name); ?></textarea>
                                                                    <i class="likebtn_help" title="<?php _e('HTML code to insert after the Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Voting', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Allow voting', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_voting_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_voting_enabled_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Allow to cancel a vote', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_voting_cancelable_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_voting_cancelable_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Allow to like and dislike at the same time', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_voting_both_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_voting_both_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Voting frequency', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <select name="likebtn_like_button_settings_revote_period_<?php echo $entity_name; ?>">
                                                                        <option value=""><?php _e('Once', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="60" <?php selected('1', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('Every second', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> *</option>
                                                                        <option value="60" <?php selected('60', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('Every minute', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> *</option>
                                                                        <option value="3600" <?php selected('3600', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('Hourly', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="86400" <?php selected('86400', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('Daily', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="604800" <?php selected('604800', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('Weekly', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="2592000" <?php selected('2592000', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('Monthly', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="31536000" <?php selected('31536000', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('Annually', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                    </select>
                                                                    <i class="likebtn_help" title="<?php _e("If voting frequency set to every second/minute make sure that 'IP address vote interval' of your website is set to 1 and 60 seconds correspondingly on Websites page of LikeBtn.com", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Counter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                         <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show votes counter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_counter_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_counter_show_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Votes counter is clickable', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_counter_clickable_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_counter_clickable_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Counter padding', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_counter_padding_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_counter_padding_' . $entity_name); ?>" size="60" />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show zero value in counter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_counter_zero_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_counter_zero_show_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Popup', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show popup on voting', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> <i class="premium_feature" title="VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_popup_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_popup_enabled_' . $entity_name)); ?> class="plan_dependent plan_vip" />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show popup on disliking', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_popup_dislike_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_popup_dislike_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup position', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <select name="likebtn_like_button_settings_popup_position_<?php echo $entity_name; ?>">
                                                                        <option value="top" <?php selected('top', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('top', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="right" <?php selected('right', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('right', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="bottom" <?php selected('bottom', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('bottom', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="left" <?php selected('left', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('left', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup style', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <select name="likebtn_like_button_settings_popup_style_<?php echo $entity_name; ?>">
                                                                        <option value="light" <?php selected('light', get_option('likebtn_like_button_settings_popup_style_' . $entity_name)); ?> ><?php _e('light', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                        <option value="dark" <?php selected('dark', get_option('likebtn_like_button_settings_popup_style_' . $entity_name)); ?> ><?php _e('dark', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Hide popup when clicking outside', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_popup_hide_on_outside_click_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_popup_hide_on_outside_click_' . $entity_name)); ?> />
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show share buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> <i class="premium_feature" title="PLUS / PRO / VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_share_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_share_enabled_' . $entity_name)); ?> class="plan_dependent plan_plus" />
                                                                    <?php /*<span class="description"><?php _e('Use popup_enabled option to enable/disable popup.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>*/ ?>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('AddThis <a href="https://www.addthis.com/settings/publisher" target="_blank">Profile ID</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> <i class="premium_feature" title="PLUS / PRO / VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_addthis_pubid_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_addthis_pubid_' . $entity_name); ?>" size="60" class="plan_dependent plan_pro"/>
                                                                    <i class="likebtn_help" title="<?php _e("Enter your AddThis Profile ID to collect sharing statistics and view it on AddThis analytics page", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('AddThis share buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> <i class="premium_feature" title="PLUS / PRO / VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_addthis_service_codes_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_addthis_service_codes_' . $entity_name); ?>" size="60" class="plan_dependent plan_pro"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Custom HTML', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> <i class="premium_feature" title="PRO / VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_popup_html_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_popup_html_' . $entity_name); ?>" size="60" class="plan_dependent plan_pro"/>
                                                                    <i class="likebtn_help" title="<?php _e("Custom HTML to insert into the popup", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Donate buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> <i class="premium_feature" title="VIP / ULTRA"></i></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_popup_donate_<?php echo $entity_name; ?>" value="<?php echo htmlspecialchars(get_option('likebtn_like_button_settings_popup_donate_' . $entity_name)); ?>" size="60" id="popup_donate_input" class="plan_dependent plan_vip"/> <a href="javascript:likebtnDG('popup_donate_input', false, {width: '80%'});void(0);"><img class="popup_donate_trigger" src="<?php echo _likebtn_like_button_get_public_url() ?>img/popup_donate.png" alt="<?php _e('Configure donate buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></a>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup content order', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_popup_content_order_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_popup_content_order_' . $entity_name); ?>" size="60" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <?php /*<div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Sharing', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">

                                                        </table>
                                                    </div>
                                                </div>*/ ?>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Loading', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Lazy load', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_lazy_load_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_lazy_load_' . $entity_name)); ?> />
                                                                    <i class="likebtn_help" title="<?php _e("If button is outside a viewport it is loaded when user scrolls to it", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show loader', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_loader_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_loader_show_' . $entity_name)); ?> />
                                                                    <i class="likebtn_help" title="<?php _e("Show loader while loading a button", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Loader image', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_loader_image_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_loader_image_' . $entity_name); ?>" size="60" />
                                                                    <i class="likebtn_help" title="<?php _e("URL of the image to use as loader image (leave empty to display default image)", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></i>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <?php /*<div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Domains', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Use domain of the parent window', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_domain_from_parent_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_domain_from_parent_' . $entity_name)); ?> />
                                                                    <span class="description">domain_from_parent</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>*/ ?>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Events & messages', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row">
                                                                    <label>
                                                                        <?php _e('JavaScript callback function', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
                                                                </th>
                                                                <td class="description">
                                                                    <input type="text" size="40" name="likebtn_like_button_settings_event_handler_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_like_button_settings_event_handler_' . $entity_name)); ?>" />
                                                                    <p class="description">
                                                                        <?php _e('The provided function receives the event object as its single argument. The event object has the following properties:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                                                                        <code>type</code> – <?php _e('indicates which event was dispatched:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                                                                        ● "likebtn.loaded"<br/>
                                                                        ● "likebtn.like"<br/>
                                                                        ● "likebtn.unlike"<br/>
                                                                        ● "likebtn.dislike"<br/>
                                                                        ● "likebtn.undislike"<br/>
                                                                        <code>settings</code> – <?php _e('button settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                                                                        <code>wrapper</code> – <?php _e('button DOM-element', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Show info messages', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="checkbox" name="likebtn_like_button_settings_info_message_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_info_message_' . $entity_name)); ?> />
                                                                    <i class="likebtn_help" title="<?php _e("Show information message instead of the button when it is restricted by tariff plan", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="postbox">
                                                    <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Texts', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                                    <div class="inside hidden">
                                                        <table class="form-table">
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Like button text after liking', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_after_like_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_after_like_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Dislike button text after disliking', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_after_dislike_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_after_dislike_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Like button tooltip', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_like_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_like_tooltip_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Dislike button tooltip', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_dislike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_dislike_tooltip_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Like button tooltip after liking', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_unlike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_unlike_tooltip_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Dislike button tooltip after disliking', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_undislike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_undislike_tooltip_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Text before share buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_share_text_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_share_text_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup close button text', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_popup_close_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_popup_close_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Popup text when sharing disabled', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_popup_text_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_popup_text_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label><?php _e('Text before donate buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                                <td>
                                                                    <input type="text" name="likebtn_like_button_settings_i18n_popup_donate_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_popup_donate_' . $entity_name); ?>" size="60"/>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="likebtn_reset_wrapper">
                                            <input class="button-secondary" type="button" name="Reset" value="<?php _e('Reset', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" onclick="return resetSettings('<?php echo $entity_name; ?>', reset_settings)" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <input class="button-primary" type="submit" name="Save" value="<?php _e('Save Changes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" /><br/><br/>
        </form>

    </div>
    </div>
    <?php
}

// admin vote statistics
function likebtn_like_button_admin_statistics() {

    global $likebtn_like_button_page_sizes;
    global $likebtn_like_button_post_statuses;
    global $wpdb;

    $likebtn_like_button_entities = _likebtn_like_button_get_entities();

    // Custom item
    $likebtn_like_button_entities[LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM] = __('Custom item');

    // get parameters
    // For translation
    __('Comment');
    $entity_name = $_GET['likebtn_like_button_entity_name'];
    if (!array_key_exists($entity_name, $likebtn_like_button_entities)) {
        $entity_name = LIKEBTN_LIKE_BUTTON_ENTITY_POST;
    }

    // Resettings
    $reseted = '';
    if (!empty($_POST['item'])) {
        $reseted = likebtn_like_button_reset($entity_name, $_POST['item']);
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
        if (isset($_GET['likebtn_like_button_blog_id'])) {
            if ($_GET['likebtn_like_button_blog_id'] == 'all') {
                $statistics_blog_id = $_GET['likebtn_like_button_blog_id'];
            } else {
                // Check if blog with ID exists
                foreach ($blog_list as $blog) {
                    if ($blog->blog_id == (int)$_GET['likebtn_like_button_blog_id']) {
                        $statistics_blog_id = (int)$_GET['likebtn_like_button_blog_id'];
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
    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncVotes();

    // add comment statuses
    $likebtn_like_button_post_statuses['0'] = __('Comment not approved', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    $likebtn_like_button_post_statuses['1'] = __('Comment approved', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);

    $sort_by = $_GET['likebtn_like_button_sort_by'];
    if (!$sort_by) {
        $sort_by = 'likes';
    }

    $page_size = $_GET['likebtn_like_button_page_size'];
    if (!$page_size) {
        $page_size = LIKEBTN_LIKE_BUTTON_STATISTIC_PAGE_SIZE;
    }

    $post_id = '';
    if (isset($_GET['likebtn_like_button_post_id'])) {
        $post_id = trim(stripcslashes($_GET['likebtn_like_button_post_id']));
    }

    $post_title = '';
    if (isset($_GET['likebtn_like_button_post_title'])) {
        $post_title = trim(stripcslashes($_GET['likebtn_like_button_post_title']));
    }
    $post_status = '';
    if (isset($_GET['likebtn_like_button_post_status'])) {
        $post_status = trim($_GET['likebtn_like_button_post_status']);
    }

    // pagination
    require_once(dirname(__FILE__) . '/likebtn_like_button_pagination.class.php');

    $pagination_target = "admin.php?page=likebtn_like_button_statistics";
    foreach ($_GET as $get_parameter => $get_value) {
        $pagination_target .= '&' . $get_parameter . '=' . stripcslashes($get_value);
    }

    $p = new LikeBtnLikeButtonPagination();
    $p->limit($page_size); // Limit entries per page
    $p->target($pagination_target);
    $p->currentPage($_GET[$p->paging]); // Gets and validates the current page
    $p->prevLabel(__('Previous', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN));
    $p->nextLabel(__('Next', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN));

    if (!isset($_GET['paging'])) {
        $p->page = 1;
    } else {
        $p->page = $_GET['paging'];
    }

    // query for limit paging
    $query_limit = "LIMIT " . ($p->page - 1) * $p->limit . ", " . $p->limit;

    // query parameters
    $query_where = '';

    if (!in_array($entity_name, array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM))) {
        $query_where .= ' AND p.post_type = %s ';
        $query_parameters[] = $entity_name;
    }

    if ($post_id) {
        $query_where .= ' AND p.ID = %d ';
        $query_parameters[] = $post_id;
    }
    if ($post_title) {
        if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
            $query_where .= ' AND LOWER(p.comment_content) LIKE "%%%s%%" ';
        } elseif ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM) {
            $query_where .= ' AND LOWER(p.identifier) LIKE "%%%s%%" ';
        } else {
            $query_where .= ' AND LOWER(p.post_title) LIKE "%%%s%%" ';
        }
        $query_parameters[] = strtolower($post_title);
    }
    if ($post_status !== '') {
        if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
            $query_where .= ' AND p.comment_approved = %s ';
        } elseif ($entity_name != LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM) {
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
        $query = _likebtn_like_button_get_statistics_sql($entity_name, $prefix, $query_where, $query_orderby, $query_limit);
        $query_prepared = $wpdb->prepare($query, $query_parameters);
    } else if ($statistics_blog_id == 'all') {
        foreach ($blog_list as $blog) {
            if ($blog->blog_id == 1) {
                $prefix = $prefix_prepared;
            } else {
                $prefix = "{$prefix_prepared}{$blog->blog_id}_";
            }
            $query_list[] = $wpdb->prepare(_likebtn_like_button_get_statistics_sql($entity_name, $prefix, $query_where, '', '', $blog->blog_id . ' as blog_id, '), $query_parameters);
        }
        $query_prepared = ' SELECT SQL_CALC_FOUND_ROWS * from (' . implode(' UNION ', $query_list) . ") query {$query_orderby} {$query_limit} ";
    } else {
        $query = _likebtn_like_button_get_statistics_sql($entity_name, $prefix_prepared, $query_where, $query_orderby, $query_limit);
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

    likebtn_like_button_admin_header();
    ?>
    <div id="poststuff" class="metabox-holder has-right-sidebar">

        <a href="javascript:toggleToUpgrade();void(0);"><?php _e('To enable statistics...', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></a>
        <ol id="likebtn_like_button_to_upgrade" class="hidden">
            <li><?php _e('Enable synchronization on Synchronization tab.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <li><?php _e('Upgrade your website to PRO or higher plan on <a href="http://likebtn.com/en/#plans_pricing" target="_blank" title="Like Button Plans">LikeBtn.com</a>.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <?php /*<li><?php _e('Set your website tariff plan in Settings.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <li><?php _e('Enter E-mail and API key in Settings.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <li><?php _e('Set Synchronization interval in Settings.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>*/ ?>
            <?php /* <li><?php _e('Run Synchronization test in Settings.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li> */ ?>
        </ol>
        <br/><br/>
        <form action="" method="get" id="statistics_form">
            <input type="hidden" name="page" value="likebtn_like_button_statistics" />

            <?php if ($blogs): ?>
                <label><?php _e('Site', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
                <select name="likebtn_like_button_blog_id" >
                    <?php foreach ($blogs as $blog_id_value => $blog_title): ?>
                        <option value="<?php echo $blog_id_value; ?>" <?php selected($statistics_blog_id, $blog_id_value); ?> ><?php echo $blog_title; ?></option>
                    <?php endforeach ?>
                </select>
                &nbsp;&nbsp;
            <?php endif ?>

            <label><?php _e('Type'); ?>:</label>
            <select name="likebtn_like_button_entity_name" >
                <?php foreach ($likebtn_like_button_entities as $entity_name_value => $entity_title): ?>
                    <option value="<?php echo $entity_name_value; ?>" <?php selected($entity_name, $entity_name_value); ?> ><?php _e($entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <?php endforeach ?>
            </select>
            &nbsp;&nbsp;
            <label><?php _e('Show first', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
            <select name="likebtn_like_button_sort_by" >
                <option value="likes" <?php selected('likes', $sort_by); ?> ><?php _e('Most liked', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <option value="dislikes" <?php selected('dislikes', $sort_by); ?> ><?php _e('Most disliked', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <?php /* <option value="last_updated" <?php selected('last_updated', $sort_by); ?> ><?php _e('Last updated', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option> */ ?>
            </select>

            &nbsp;&nbsp;
            <label><?php _e('Page size', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
            <select name="likebtn_like_button_page_size" >
                <?php foreach ($likebtn_like_button_page_sizes as $page_size_value): ?>
                    <option value="<?php echo $page_size_value; ?>" <?php selected($page_size, $page_size_value); ?> ><?php echo $page_size_value ?></option>
                <?php endforeach ?>

            </select>
            <br/><br/>
            <div class="postbox statistics_filter_container">
                <h3><?php _e('Filter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <label><?php _e('ID', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
                    <input type="text" name="likebtn_like_button_post_id" value="<?php echo htmlspecialchars($post_id) ?>" size="8" />
                    &nbsp;&nbsp;
                    <label><?php _e('Title'); ?>:</label>
                    <input type="text" name="likebtn_like_button_post_title" value="<?php echo htmlspecialchars($post_title) ?>" size="60"/>
                    &nbsp;&nbsp;
                    <label><?php _e('Status', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
                    <select name="likebtn_like_button_post_status" >
                        <option value=""></option>
                        <?php foreach ($likebtn_like_button_post_statuses as $post_status_value => $post_status_title): ?>
                            <option value="<?php echo $post_status_value; ?>" <?php selected($post_status, $post_status_value); ?> ><?php echo _e($post_status_title) ?></option>
                        <?php endforeach ?>
                    </select>

                    &nbsp;&nbsp;
                    <input class="button-secondary" type="button" name="reset" value="<?php _e('Reset filter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" onClick="jQuery('.statistics_filter_container :input[type!=button]').val('');
                jQuery('#statistics_form').submit();"/>
                </div>
            </div>

            <input class="button-primary" type="submit" name="show" value="<?php _e('Show', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" />
        </form>
        <br/>
        <?php _e('Total found', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>: <strong><?php echo $total_found ?></strong>
        <br/>
        <?php if ($reseted !== ''): ?>
            <br/><span style="color: green"><?php _e('Likes and dislikes for the following number of items have been successfully reseted:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span> <strong style="color: green"><?php echo $reseted ?></strong><br/>
        <?php endif ?>
        <form onsubmit="return statisticsSubmit('<?php echo get_option('likebtn_like_button_plan'); ?>', {
              confirm: '<?php _e("The votes count can not be recovered after resetting. Are you sure you want to reset likes and dislikes for the selected item(s)?", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>',
              items: '<?php _e("Select item(s) you want to reset", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>',
              upgrade: '<?php _e("Upgrade your website to VIP to be able to use the feature", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>'
        })" method="post" action="">
        <?php if (count($statistics) && $p->total_pages > 0): ?>
            <div class="tablenav">
                <input type="submit" class="button-secondary" onclick="" name="reset_selected" value="<?php _e('Reset selected', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" title="<?php _e('Set to zero number of likes and dislikes for selected items', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>">
                <div class="tablenav-pages">
                    <?php echo $p->show(); ?>
                </div>
            </div>
        <?php endif ?>
        <table class="widefat" id="statistics_container">
            <thead>
                <tr>
                    <th><input type="checkbox" onclick="statisticsItemsCheckbox(this)" value="all" style="margin:0"></th>
                    <?php if ($entity_name != LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM): ?>
                        <th>ID</th>
                    <?php endif ?>
                    <?php if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_POST): ?>
                        <th><?php _e('Thumbnail') ?></th>
                    <?php endif ?>
                    <th width="100%"><?php _e('Title') ?></th>
                    <?php if ($blogs && $statistics_blog_id == 'all'): ?>
                        <th><?php _e('Site') ?></th>
                    <?php endif ?>
                    <th><?php _e('Likes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></th>
                    <th><?php _e('Dislikes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></th>
                    <th><?php _e('Likes minus dislikes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statistics as $statistics_item): ?>

                    <?php if (!$blogs): ?>
                        <?php if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT): ?>
                            <?php $post_url = get_comment_link($statistics_item->post_id); ?>
                        <?php elseif ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM): ?>
                            <?php $post_url = $statistics_item->url; ?>
                        <?php else: ?>
                            <?php $post_url = get_permalink($statistics_item->post_id); ?>
                        <?php endif ?>
                    <?php else: ?>
                        <?php if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT): ?>
                            <?php $post_url = _likebtn_like_button_get_blog_comment_link($statistics_item->blog_id, $statistics_item->post_id); ?>
                        <?php elseif ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM): ?>
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
                        <?php if ($entity_name != LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM): ?>
                            <td><?php echo $statistics_item->post_id; ?></td>
                        <?php endif ?>
                        <?php if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_POST): ?>
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
                                <a href="javascript:statisticsEdit('<?php echo $entity_name ?>', '<?php echo $statistics_item->post_id; ?>', 'like', '<?php echo get_option('likebtn_like_button_plan'); ?>', '<?php _e('Enter new value:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>', '<?php _e('Upgrade your website plan to the ULTRA plan to use the feature', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>', '<?php _e('Error occured. Please, try again later.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>');void(0);" title="<?php _e('Click to change', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>" class="item_like"><?php echo $statistics_item->likes; ?></a>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if ($blogs && $statistics_item->blog_id != $blog_id): ?>
                                <?php echo $statistics_item->dislikes; ?>
                            <?php else: ?>
                                <a href="javascript:statisticsEdit('<?php echo $entity_name ?>', '<?php echo $statistics_item->post_id; ?>', 'dislike', '<?php echo get_option('likebtn_like_button_plan'); ?>', '<?php _e('Enter new value:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>', '<?php _e('Upgrade your website plan to the ULTRA plan to use the feature', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>', '<?php _e('Error occured. Please, try again later.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>');void(0);" title="<?php _e('Click to change', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>" class="item_dislike"><?php echo $statistics_item->dislikes; ?></a>
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
function _likebtn_like_button_get_statistics_sql($entity_name, $prefix, $query_where, $query_orderby, $query_limit, $query_select = 'SQL_CALC_FOUND_ROWS')
{
    if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
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
                 ON (pm_dislikes.comment_id = pm_likes.comment_id AND pm_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES . "')
             LEFT JOIN {$prefix}commentmeta pm_likes_minus_dislikes
                 ON (pm_likes_minus_dislikes.comment_id = pm_likes.comment_id AND pm_likes_minus_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES . "')
             WHERE
                pm_likes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES . "'
                {$query_where}
             {$query_orderby}
             {$query_limit}";
    } elseif ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_CUSTOM_ITEM) {
        // custom item
        $query = "
             SELECT {$query_select}
                p.ID as 'post_id',
                p.identifier as 'post_title',
                p.likes,
                p.dislikes,
                p.likes_minus_dislikes,
                p.url
             FROM {$prefix}" . LIKEBTN_LIKE_BUTTON_TABLE_ITEM . " p
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
                 ON (pm_dislikes.post_id = pm_likes.post_id AND pm_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES . "')
             LEFT JOIN {$prefix}postmeta pm_likes_minus_dislikes
                 ON (pm_likes_minus_dislikes.post_id = pm_likes.post_id AND pm_likes_minus_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES . "')
             WHERE
                pm_likes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES . "'
                {$query_where}
             {$query_orderby}
             {$query_limit}";
    }

    return $query;
}

// admin help
function likebtn_like_button_admin_help() {
    likebtn_like_button_admin_header();
    ?>
    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <ul>
            <li><?php echo __('<a href="http://likebtn.com/en/wordpress-like-button-plugin" target="_blank">WordPress LikeBtn Plugin FAQ</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <li><?php echo __('<a href="http://likebtn.com/en/faq" target="_blank">LikeBtn FAQ</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <li><?php echo __('<a href="http://forum.likebtn.com/forums/34-WordPress" target="_blank">Forum</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
        </ul>
    </div>
    <?php
}

// get URL of the public folder
function _likebtn_like_button_get_public_url() {
    $siteurl = get_option('siteurl');
    return $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/public/';
}

// get plugin version
function _likebtn_like_button_get_plugin_version() {
    return get_option('likebtn_like_button_plugin_v');
}

// Get supported by current theme Post Formats
function _likebtn_like_button_get_post_formats() {
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
function _likebtn_like_button_get_entities() {
    global $likebtn_like_button_entities;

    if (count($likebtn_like_button_entities)) {
        return $likebtn_like_button_entities;
    }
    /*$likebtn_like_button_entities = array(
        'post' => __('Post'),
        'page' => __('Page'),
        'attachment' => __('Attachment'),
        'revision' => __('Revision'),
        'nav_menu_item' => __('Nav menu item'),
        //'comment' => __('Comment'),
    );*/
    $post_types = get_post_types(array('public'=>true));

    if (!empty($post_types)) {
        foreach ($post_types as $post_type) {
            $likebtn_like_button_entities[$post_type] = __(str_replace('_', ' ', ucfirst($post_type)));
        }
    }

    // append Comments
    $likebtn_like_button_entities[LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT] = ucfirst(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT);

    // translate entity names
    // does not work here
    /* load_plugin_textdomain(LIKEBTN_LIKE_BUTTON_I18N_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');

      foreach ($entities as $entity_name => $entity_title) {
      $entities[$entity_name] = __($entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
      } */

    return $likebtn_like_button_entities;
}

// short code
function likebtn_like_button_shortcode($args) {
    $entity_name = get_post_type();
    $entity_id = get_the_ID();

    return _likebtn_like_button_get_markup($entity_name, $entity_id, $args, '', false, false);
}

add_shortcode('likebtn', 'likebtn_like_button_shortcode');

################
###  Widget  ###
################
require_once(dirname(__FILE__) . '/likebtn_like_button_most_liked_widget.class.php');

// most liked short code
function likebtn_like_button_most_liked_widget_shortcode($args) {
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

add_shortcode('likebtn_most_liked', 'likebtn_like_button_most_liked_widget_shortcode');


################
### Frontend ###
################

function _likebtn_like_button_get_markup($entity_name, $entity_id, $values = null, $use_entity_name = '', $use_entity_settings = true, $wrap = true) {

    global $likebtn_like_button_settings;
    global $wp_version;

    $prepared_settings = array();

    // Run sunchronization
    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncVotes();

    if ($values && $values['identifier']) {
        $data = ' data-identifier="' . $values['identifier'] . '" ';
    } else {
        $data = ' data-identifier="' . $entity_name . '_' . $entity_id . '" ';
    }

    if (!$use_entity_name) {
        $use_entity_name = $entity_name;
    }

    // Site ID
    if (get_option('likebtn_like_button_site_id')) {
        $data .= ' data-site_id="' . get_option('likebtn_like_button_site_id') . '" ';
    }

    // Local domain
    /*if (get_option('likebtn_like_button_local_domain')) {
        $data .= ' data-local_domain="' . get_option('likebtn_like_button_local_domain') . '" ';
    }

    // Website subdirectory
    if (get_option('likebtn_like_button_subdirectory')) {
        $data .= ' data-subdirectory="' . get_option('likebtn_like_button_subdirectory') . '" ';
    }*/

    foreach ($likebtn_like_button_settings as $option_name => $option_info) {

        if ($values && isset($values[$option_name])) {
            // if values passed
            $option_value = $values[$option_name];
        } elseif (!$use_entity_settings) {
            // Do not user entity value - use default. Usually in shortcodes.
            $option_value = $option_info['default'];
        } else {
            $option_value = get_option('likebtn_like_button_settings_' . $option_name . '_' . $use_entity_name);
        }

        $option_value_prepared = _likebtn_prepare_option($option_name, $option_value);
        $prepared_settings[$option_name] = $option_value_prepared;

        // do not add option if it has default value
        if ($option_value == $likebtn_like_button_settings[$option_name]['default'] ||
                ($option_value === '' && $likebtn_like_button_settings[$option_name]['default'] == '0')
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

    if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
        $entity = get_comment($entity_id);
        if ($entity) {
            $entity_url = get_comment_link($entity->comment_ID);
            $entity_title = $entity->comment_content;
        }
    } elseif ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_POST) {
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
    $plugin_v = _likebtn_like_button_get_plugin_version();
    if ($plugin_v) {
        $data .= ' data-plugin_v="' . $plugin_v . '" ';
    }

    $public_url = _likebtn_like_button_get_public_url();

    $markup = <<<MARKUP
<!-- LikeBtn.com BEGIN --><span class="likebtn-wrapper" {$data}></span><script type="text/javascript" src="//w.likebtn.com/js/w/widget.js" async="async"></script><script type="text/javascript">if (typeof(LikeBtn) != "undefined") { LikeBtn.init(); }</script><!-- LikeBtn.com END -->
MARKUP;

    // HTML before
    $html_before = '';
    if (isset($values['html_before'])) {
        $html_before = $values['html_before'];
    } elseif (get_option('likebtn_like_button_html_before_' . $use_entity_name)) {
        $html_before = get_option('likebtn_like_button_html_before_' . $use_entity_name);
    }
    if (trim($html_before)) {
        $markup = $html_before . $markup;
    }

    // HTML after
    $html_after = '';
    if (isset($values['html_after'])) {
        $html_after = $values['html_after'];
    } elseif (get_option('likebtn_like_button_html_after_' . $use_entity_name)) {
        $html_after = get_option('likebtn_like_button_html_after_' . $use_entity_name);
    }
    if (trim($html_after)) {
        $markup = $markup . $html_after;
    }

    // alignment
    if ($wrap) {
        $alignment = get_option('likebtn_like_button_alignment_' . $use_entity_name);
        if ($alignment == LIKEBTN_LIKE_BUTTON_ALIGNMENT_RIGHT) {
            $markup = '<div style="text-align:right" class="likebtn_container">' . $markup . '</div>';
        } elseif ($alignment == LIKEBTN_LIKE_BUTTON_ALIGNMENT_CENTER) {
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
    global $likebtn_like_button_settings;

    $option_value_prepared = $option_value;

    // do not format i18n options
    if (!strstr($option_name, 'i18n') &&
       (!isset($likebtn_like_button_settings[$option_name]) || $likebtn_like_button_settings[$option_name]['default'] !== ''))
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

    global $likebtn_like_button_settings;
    $settings = array();

    foreach ($likebtn_like_button_settings as $option_name => $option_info) {
        $settings[$option_name] = get_option('likebtn_like_button_settings_' . $option_name . '_' . $entity_name);
    }
    return $settings;
}

// add Like Button to the entity (except Comment)
function likebtn_like_button_the_content($content) {

    if (is_feed()) {
        return $content;
    }

    // detemine entity type
    $real_entity_name = get_post_type();

    // get entity name whose settings should be copied
    $use_entity_name = get_option('likebtn_like_button_use_settings_from_' . $real_entity_name);
    if ($use_entity_name) {
        $entity_name = $use_entity_name;
    } else {
        $entity_name = $real_entity_name;
    }

    if (get_option('likebtn_like_button_show_' . $real_entity_name) != '1'
        || get_option('likebtn_like_button_show_' . $entity_name) != '1')
    {
        return $content;
    }

    $entity_id = get_the_ID();

    // get the Posts/Pages IDs where we do not need to show like functionality
    $allow_ids = explode(",", get_option('likebtn_like_button_allow_ids_' . $entity_name));
    $exclude_ids = explode(",", get_option('likebtn_like_button_exclude_ids_' . $entity_name));
    $exclude_categories = get_option('likebtn_like_button_exclude_categories_' . $entity_name);
    $exclude_sections = get_option('likebtn_like_button_exclude_sections_' . $entity_name);

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
    switch (get_option('likebtn_like_button_post_view_mode_' . $entity_name)) {
        case LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_FULL:
            if (!is_single()) {
                return $content;
            }
            break;
        case LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_EXCERPT:
            if (is_single()) {
                return $content;
            }
            break;
    }

    // check Post format
    $post_format = get_post_format($entity_id);
    if (!$post_format) {
        $post_format = 'standard';
    }

    if (!in_array('all', get_option('likebtn_like_button_post_format_' . $entity_name)) &&
            !in_array($post_format, get_option('likebtn_like_button_post_format_' . $entity_name))
    ) {
        return $content;
    }

    // check user authorization
    $user_logged_in = get_option('likebtn_like_button_user_logged_in_' . $entity_name);

    if ($user_logged_in === '1' || $user_logged_in === '0') {
        if ($user_logged_in == '1' && !is_user_logged_in()) {
            return $content;
        }
        if ($user_logged_in == '0' && is_user_logged_in()) {
            return $content;
        }
    }

    $html = _likebtn_like_button_get_markup($real_entity_name, $entity_id, array(), $entity_name);

    $position = get_option('likebtn_like_button_position_' . $entity_name);

    if ($position == LIKEBTN_LIKE_BUTTON_POSITION_TOP) {
        $content = $html . $content;
    } elseif ($position == LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM) {
        $content = $content . $html;
    } else {
        $content = $html . $content . $html;
    }

    return $content;
}

add_filter('the_content', 'likebtn_like_button_the_content');
add_filter('the_excerpt', 'likebtn_like_button_the_content');

// add Like Button to the Comment
function likebtn_like_button_comment_text($content) {

    global $comment;

    if (is_feed()) {
        return $content;
    }

    // detemine entity type
    $real_entity_name = LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT;

    // get entity name whose settings should be copied
    $use_entity_name = get_option('likebtn_like_button_use_settings_from_' . $real_entity_name);
    if ($use_entity_name) {
        $entity_name = $use_entity_name;
    } else {
        $entity_name = $real_entity_name;
    }

    if (get_option('likebtn_like_button_show_' . $real_entity_name) != '1'
        || get_option('likebtn_like_button_show_' . $entity_name) != '1')
    {
        return $content;
    }

    $comment_id = $comment->comment_ID;
    //$comment = get_comment($comment_id, ARRAY_A);
    $post_id = $comment->comment_post_ID;

    // get the Posts/Pages IDs where we do not need to show like functionality
    $allow_ids = explode(",", get_option('likebtn_like_button_allow_ids_' . $entity_name));
    $exclude_ids = explode(",", get_option('likebtn_like_button_exclude_ids_' . $entity_name));
    $exclude_categories = get_option('likebtn_like_button_exclude_categories_' . $entity_name);
    $exclude_sections = get_option('likebtn_like_button_exclude_sections_' . $entity_name);

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

    if (!in_array('all', get_option('likebtn_like_button_post_format_' . $entity_name)) &&
            !in_array($post_format, get_option('likebtn_like_button_post_format_' . $entity_name))
    ) {
        return $content;
    }

    $html = _likebtn_like_button_get_markup($real_entity_name, $comment_id, array(), $entity_name);

    $position = get_option('likebtn_like_button_position_' . $entity_name);

    if ($position == LIKEBTN_LIKE_BUTTON_POSITION_TOP) {
        $content = $html . $content;
    } elseif ($position == LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM) {
        $content = $content . $html;
    } else {
        $content = $html . $content . $html;
    }

    return $content;
}

add_filter('comment_text', 'likebtn_like_button_comment_text');

// show the Like Button in Post/Page
// if Like Button is enabled in admin for Post/Page do not show button twice
function likebtn_post($post_id = NULL) {
    global $post;
    if (empty($post_id)) {
        $post_id = $post->ID;
    }

    // detemine entity type
    if (is_page()) {
        $entity_name = LIKEBTN_LIKE_BUTTON_ENTITY_PAGE;
    } else {
        $entity_name = LIKEBTN_LIKE_BUTTON_ENTITY_POST;
    }

    // check if the Like Button should be displayed
    // if Like Button enabled for Post or Page in Admin do not show Like Button twice
    if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_POST && get_option('likebtn_like_button_show_' . LIKEBTN_LIKE_BUTTON_ENTITY_POST) == '1') {
        return;
    }
    if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_PAGE && get_option('likebtn_like_button_show_' . LIKEBTN_LIKE_BUTTON_ENTITY_PAGE) == '1') {
        return;
    }

    // 'post' here is for the sake of backward compatibility
    $html = _likebtn_like_button_get_markup('post', $post_id);

    echo $html;
}

// get or echo the Like Button in comment
function likebtn_comment($comment_id = NULL) {
    //global $comment;
    if (empty($comment_id)) {
        $comment_id = get_comment_ID();
    }

    // if Like Button enabled for Comment in Admin do not show Like Button twice
    if (get_option('likebtn_like_button_show_' . LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) == '1') {
        return;
    }

    $html = _likebtn_like_button_get_markup(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $comment_id);

    echo $html;
}

// test synchronization callback
function likebtn_like_button_manual_sync_callback() {

    $likebtn_like_button_account_email = '';
    if (isset($_POST['likebtn_like_button_account_email'])) {
        $likebtn_like_button_account_email = $_POST['likebtn_like_button_account_email'];
    }

    $likebtn_like_button_account_api_key = '';
    if (isset($_POST['likebtn_like_button_account_api_key'])) {
        $likebtn_like_button_account_api_key = $_POST['likebtn_like_button_account_api_key'];
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $sync_response = $likebtn->syncVotes($likebtn_like_button_account_email, $likebtn_like_button_account_api_key, true);

    if ($sync_response['result'] == 'success') {
        $result_text = __('OK', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    } else {
        $result_text = __('Error', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
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

add_action('wp_ajax_likebtn_like_button_manual_sync', 'likebtn_like_button_manual_sync_callback');

// test synchronization callback
function likebtn_like_button_test_sync_callback() {

    $likebtn_like_button_account_email = '';

    if (isset($_POST['likebtn_like_button_account_email'])) {
        $likebtn_like_button_account_email = $_POST['likebtn_like_button_account_email'];
    }
    $likebtn_like_button_account_api_key = '';
    if (isset($_POST['likebtn_like_button_account_api_key'])) {
        $likebtn_like_button_account_api_key = $_POST['likebtn_like_button_account_api_key'];
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $test_response = $likebtn->testSync($likebtn_like_button_account_email, $likebtn_like_button_account_api_key);

    if ($test_response['result'] == 'success') {
        $result_text = __('OK', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    } else {
        $result_text = __('Error', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
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

add_action('wp_ajax_likebtn_like_button_test_sync', 'likebtn_like_button_test_sync_callback');

// edit item callback
function likebtn_like_button_edit_item_callback() {

    $entity_name = '';
    if (isset($_POST['entity_name'])) {
        $entity_name = $_POST['entity_name'];
    }

    $entity_id = '';
    if (isset($_POST['entity_id'])) {
        $entity_id = $_POST['entity_id'];
    }

    $identifier = likebtn_like_button_get_identifier($entity_name, $entity_id);

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
        $result_text = __('OK', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);

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
        $result_text = __('Error', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
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

add_action('wp_ajax_likebtn_like_button_edit_item', 'likebtn_like_button_edit_item_callback');

// reset items likes/dislikes
function likebtn_like_button_reset($entity_name, $items)
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
function likebtn_like_button_get_identifier($entity_name, $entity_id)
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
        $comment_a_meta = get_comment_meta($comment_a->comment_ID, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES);
        $comment_b_meta = get_comment_meta($comment_b->comment_ID, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES);

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
        $comment_a_meta = get_comment_meta($comment_a->comment_ID, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES);
        $comment_b_meta = get_comment_meta($comment_b->comment_ID, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES);

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

/**
 * Get the permalink for a comment on another blog.
 *
 */
function _likebtn_like_button_get_blog_comment_link( $blog_id, $comment_id ) {
	switch_to_blog( $blog_id );
	$link = get_comment_link( $comment_id );
	restore_current_blog();

	return $link;
}