<?php

define('LIKEBTN_LAST_SUCCESSFULL_SYNC_TIME_OFFSET', 57600);
define('LIKEBTN_API_URL', 'http://api.likebtn.com/api/');
define('LIKEBTN_LOCALES_SYNC_INTERVAL', 86400);
define('LIKEBTN_STYLES_SYNC_INTERVAL', 86400);
define('LIKEBTN_PLAN_SYNC_INTERVAL', 43200);

class LikeBtnLikeButton {

    protected static $synchronized = false;
    // Cached API request URL.
    //protected static $apiurl = '';

    /**
     * Constructor.
     */
    public function __construct() {
        // Do nothing.
    }

    /**
     * Running votes synchronization.
     */
    public function runSyncVotes() {
        if (!self::$synchronized && get_option('likebtn_account_email') && get_option('likebtn_account_api_key') && get_option('likebtn_sync_inerval') && $this->timeToSyncVotes(get_option('likebtn_sync_inerval') * 60)) {
            $this->syncVotes();
        }
    }

    /**
     * Check if it is time to sync votes.
     */
    public function timeToSyncVotes($sync_period) {

        $last_sync_time = get_option('likebtn_last_sync_time');

        //$now = time();
        //update_option('likebtn_last_sync_time', $now);
        //return true;

        $now = time();
        if (!$last_sync_time) {
            update_option('likebtn_last_sync_time', $now);
            self::$synchronized = true;
            return true;
        } else {

            if ($last_sync_time + $sync_period > $now) {
                return false;
            } else {
                update_option('likebtn_last_sync_time', $now);
                self::$synchronized = true;
                return true;
            }
        }
    }

    /**
     * Retrieve data.
     */
    public function curl($url) {

        global $wp_version;

        $cms_version = $wp_version;

        $likebtn_version = LIKEBTN_VERSION;
        $php_version = phpversion();
        $useragent = "WordPress $wp_version; likebtn plugin $likebtn_version; PHP $php_version";

        try {
            $http = new WP_Http();
            $response = $http->request($url, array('headers' => array("User-Agent" => $useragent)));
        } catch (Exception $e) {
            return array(
                'result' => 'error',
                'message' => $e->getMesssage()
            );
        }

        // Error occured
        if (is_wp_error($response)) {
            return array(
                'result' => 'error',
                'message' => $response->get_error_message()
            );
        }

        if (is_array($response) && !empty($response['body'])) {
            return $response['body'];
        } else {
            return '';
        }
    }

    /**
     * Sync votes from LikeBtn.com to local DB.
     */
    public function syncVotes($email = '', $api_key = '', $site_id = '', $full = false) {
        $sync_result = true;

        $last_sync_time = number_format(get_option('likebtn_last_sync_time'), 0, '', '');

        $updated_after = '';
        if (!$full && get_option('likebtn_last_successfull_sync_time')) {
            $updated_after = get_option('likebtn_last_successfull_sync_time') - LIKEBTN_LAST_SUCCESSFULL_SYNC_TIME_OFFSET;
        }

        $url = "output=json&last_sync_time=" . $last_sync_time;
        if ($updated_after) {
            $url .= '&updated_after=' . $updated_after;
        }

        // retrieve first page
        $response = $this->apiRequest('stat', $url, $email, $api_key, $site_id);

        if (!$this->updateVotes($response)) {
            $sync_result = false;
        }

        // retrieve all pages after the first
        if (isset($response['response']['total']) && isset($response['response']['page_size'])) {
            $total_pages = ceil((int) $response['response']['total'] / (int) $response['response']['page_size']);

            for ($page = 2; $page <= $total_pages; $page++) {
                $response = $this->apiRequest('stat', $url . '&page=' . $page, $email, $api_key, $site_id);

                if (!$this->updateVotes($response)) {
                    $sync_result = false;
                }
            }
        }

        update_option('likebtn_last_sync_result', $response['result']);
        if ($sync_result) {
            update_option('likebtn_last_successfull_sync_time', $last_sync_time);
        } else {
            if (!empty($response['message'])) {
                update_option('likebtn_last_sync_message', $response['message']);
            } else {
                update_option('likebtn_last_sync_message', '');
            }
        }

        if ($full) {
            update_option('likebtn_last_sync_time', time());
        }

        return array(
            'result' => $response['result'],
            'message' => $response['message']
        );
    }

    /**
     * Test synchronization.
     *
     * @param type $account_api_key
     * @param type $site_api_key
     */
    public function testSync($email, $api_key, $site_id) {
        $email = trim($email);
        $api_key = trim($api_key);

        $response = $this->apiRequest('stat', 'output=json&page_size=1', $email, $api_key, $site_id);

        return $response;
    }


    /**
     * Check account parameters
     */
    public function checkAccount($email, $api_key, $site_id) {
        $response = $this->apiRequest('plan', '', $email, $api_key, $site_id);

        return $response;
    }

    /**
     * Decode JSON.
     */
    public function jsonDecode($jsong_string) {
        if (!is_string($jsong_string)) {
            return array();
        }

        return json_decode($jsong_string, true);
    }

    /**
     * Update votes in database from API response.
     */
    public function updateVotes($response) {
        $entity_updated = false;

        if (!empty($response['response']['items'])) {
            foreach ($response['response']['items'] as $item) {
                $likes = 0;
                if (!empty($item['likes'])) {
                    $likes = $item['likes'];
                }
                $dislikes = 0;
                if (!empty($item['dislikes'])) {
                    $dislikes = $item['dislikes'];
                }
                $url = '';
                if (isset($item['url'])) {
                    $url = $item['url'];
                }
                $entity_updated = $this->updateCustomFields($item['identifier'], $likes, $dislikes, $url);
            }
        }

        return $entity_updated;
    }

    /**
     * Update entity custom fields
     */
    public function updateCustomFields($identifier, $likes, $dislikes, $url = '') 
    {
        global $wpdb;

        $likebtn_entities = _likebtn_get_entities(true, true);

        preg_match("/^(.*)_(\d+)$/", $identifier, $identifier_parts);

        list($entity_name, $entity_id) = $this->parseIdentifier($identifier);

        $likes_minus_dislikes = null;
        if ($likes !== null && $dislikes !== null) {
            $likes_minus_dislikes = $likes - $dislikes;
        }

        $entity_updated = false;

        if (array_key_exists($entity_name, $likebtn_entities) && is_numeric($entity_id)) {

            // set Custom fields
            switch ($entity_name) {
                case LIKEBTN_ENTITY_COMMENT:
                    // Comment
                    $comment = get_comment($entity_id);

                    // check if post exists and is not revision
                    if (!empty($comment) && $comment->comment_type != 'revision') {
                        if ($likes !== null) {
                            if (count(get_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES)) > 1) {
                                delete_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES);
                                add_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES, $likes, true);
                            } else {
                                update_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES, $likes);
                            }
                        }
                        if ($dislikes !== null) {
                            if (count(get_comment_meta($entity_id, LIKEBTN_META_KEY_DISLIKES)) > 1) {
                                delete_comment_meta($entity_id, LIKEBTN_META_KEY_DISLIKES);
                                add_comment_meta($entity_id, LIKEBTN_META_KEY_DISLIKES, $dislikes, true);
                            } else {
                                update_comment_meta($entity_id, LIKEBTN_META_KEY_DISLIKES, $dislikes);
                            }
                        }
                        if ($likes_minus_dislikes !== null) {
                            if (count(get_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES)) > 1) {
                                delete_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES);
                                add_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes, true);
                            } else {
                                update_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes);
                            }
                        }
                        $entity_updated = true;
                    }
                    break;

                case LIKEBTN_ENTITY_BP_ACTIVITY_POST:
                case LIKEBTN_ENTITY_BP_ACTIVITY_UPDATE:
                case LIKEBTN_ENTITY_BP_ACTIVITY_COMMENT:
                case LIKEBTN_ENTITY_BP_ACTIVITY_TOPIC:
                    if (!_likebtn_is_bp_active()) {
                        break;
                    }
                    // BuddyPress Activity
                    /*$bp_activity_list = bp_activity_get(array(
                        'show_hidden'  => true,
                        'spam'  => 'all',
                        //'in'           => array((int)$entity_id)
                    ));*/
                    $bp_activity = $wpdb->get_row("
                        SELECT id
                        FROM ".$wpdb->prefix."bp_activity
                        WHERE id = {$entity_id}
                    ");

                    if (!empty($bp_activity)) {
                        if ($likes !== null) {
                            if (count(bp_activity_get_meta($entity_id, LIKEBTN_META_KEY_LIKES)) > 1) {
                                bp_activity_delete_meta($entity_id, LIKEBTN_META_KEY_LIKES);
                                bp_activity_add_meta($entity_id, LIKEBTN_META_KEY_LIKES, $likes, true);
                            } else {
                                bp_activity_update_meta($entity_id, LIKEBTN_META_KEY_LIKES, $likes);
                            }
                        }
                        if ($dislikes !== null) {
                            if (count(bp_activity_get_meta($entity_id, LIKEBTN_META_KEY_DISLIKES)) > 1) {
                                bp_activity_delete_meta($entity_id, LIKEBTN_META_KEY_DISLIKES);
                                bp_activity_add_meta($entity_id, LIKEBTN_META_KEY_DISLIKES, $dislikes, true);
                            } else {
                                bp_activity_update_meta($entity_id, LIKEBTN_META_KEY_DISLIKES, $dislikes);
                            }
                        }
                        if ($likes_minus_dislikes !== null) {
                            if (count(bp_activity_get_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES)) > 1) {
                                bp_activity_delete_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES);
                                bp_activity_add_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes, true);
                            } else {
                                bp_activity_update_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes);
                            }
                        }
                        $entity_updated = true;
                    }
                    break;

                case LIKEBTN_ENTITY_BP_MEMBER:
                    // BuddyPress Member Profile
                    $entity_updated = _likebtn_save_bp_member_votes($entity_id, $likes, $dislikes, $likes_minus_dislikes);
                    break;

                case LIKEBTN_ENTITY_BBP_USER:
                    // bbPress Member Profile
                    $entity_updated = _likebtn_save_user_votes($entity_id, $likes, $dislikes, $likes_minus_dislikes);
                    break;

                case LIKEBTN_ENTITY_USER:
                    // BuddyPress Member Profile
                    $entity_updated = _likebtn_save_bp_member_votes($entity_id, $likes, $dislikes, $likes_minus_dislikes);
                    // General user and bbPress Member Profile
                    $entity_updated = $entity_updated || _likebtn_save_user_votes($entity_id, $likes, $dislikes, $likes_minus_dislikes);
                    break;
                
                default:
                    // Post
                    $post = get_post($entity_id);

                    // check if post exists and is not revision
                    if (!empty($post) && !empty($post->post_type) && $post->post_type != 'revision') {
                        if ($likes !== null) {
                            if (count(get_post_meta($entity_id, LIKEBTN_META_KEY_LIKES)) > 1) {
                                delete_post_meta($entity_id, LIKEBTN_META_KEY_LIKES);
                                add_post_meta($entity_id, LIKEBTN_META_KEY_LIKES, $likes, true);
                            } else {
                                update_post_meta($entity_id, LIKEBTN_META_KEY_LIKES, $likes);
                            }
                        }
                        if ($dislikes !== null) {
                            if (count(get_post_meta($entity_id, LIKEBTN_META_KEY_DISLIKES)) > 1) {
                                delete_post_meta($entity_id, LIKEBTN_META_KEY_DISLIKES);
                                add_post_meta($entity_id, LIKEBTN_META_KEY_DISLIKES, $dislikes, true);
                            } else {
                                update_post_meta($entity_id, LIKEBTN_META_KEY_DISLIKES, $dislikes);
                            }
                        }
                        if ($likes_minus_dislikes !== null) {
                            if (count(get_post_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES)) > 1) {
                                delete_post_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES);
                                add_post_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes, true);
                            } else {
                                update_post_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes);
                            }
                        }
                        $entity_updated = true;
                    }
                    break;
            }
        }

        // Check custom item
        $item_db = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT likes, dislikes
                FROM ".$wpdb->prefix.LIKEBTN_TABLE_ITEM."
                WHERE identifier = %s",
                $identifier
            )
        );

        // Custom identifier
        if ($item_db || !$entity_updated) {

            if ($likes === null || $dislikes === null) {
                if ($item_db) {
                    if ($likes === null) {
                        $likes = $item_db->likes;
                    }
                    if ($dislikes === null) {
                        $dislikes = $item_db->dislikes;
                    }
                }
            }
            if ($likes !== null && $dislikes !== null) {
                $likes_minus_dislikes = $likes - $dislikes;
            }

            $item_data = array(
                'identifier' => $identifier,
                //'url' => $url,
                'likes' => $likes,
                'dislikes' => $dislikes,
                'likes_minus_dislikes' => $likes_minus_dislikes,
                'identifier_hash' => md5($identifier)
            );
            if ($url) {
                $item_data['url'] = $url;
            }

            $update_where = array('identifier' => $item_data['identifier']);
            $update_result = $wpdb->update($wpdb->prefix . LIKEBTN_TABLE_ITEM, $item_data, $update_where);
            if ($update_result) {
                $entity_updated = true;
            } else {
                $insert_result = $wpdb->insert($wpdb->prefix . LIKEBTN_TABLE_ITEM, $item_data);
                if ($insert_result) {
                    $entity_updated = true;
                }
            }
        }

        return $entity_updated;
    }

    /**
     * Update votes in database from API response.
     */
    public function deleteVotes($response) {
        $entity_updated = false;

        if (!empty($response['response']['items'])) {
            foreach ($response['response']['items'] as $item) {
                $entity_updated = $this->deleteCustomFields($item['identifier']);
            }
        }

        return $entity_updated;
    }

    /**
     * Update entity custom fields
     */
    public function deleteCustomFields($identifier) 
    {
        global $wpdb;

        $likebtn_entities = _likebtn_get_entities(true, true);

        list($entity_name, $entity_id) = $this->parseIdentifier($identifier);

        $entity_updated = false;

        if (array_key_exists($entity_name, $likebtn_entities) && is_numeric($entity_id)) {

            // set Custom fields
            switch ($entity_name) {
                case LIKEBTN_ENTITY_COMMENT:
                    // Comment
                    $comment = get_comment($entity_id);

                    // check if post exists and is not revision
                    if (!empty($comment) && $comment->comment_type != 'revision') {
                        delete_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES);
                        delete_comment_meta($entity_id, LIKEBTN_META_KEY_DISLIKES);
                        delete_comment_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES);
                        $entity_updated = true;
                    }
                    break;

                case LIKEBTN_ENTITY_BP_ACTIVITY_POST:
                case LIKEBTN_ENTITY_BP_ACTIVITY_UPDATE:
                case LIKEBTN_ENTITY_BP_ACTIVITY_COMMENT:
                case LIKEBTN_ENTITY_BP_ACTIVITY_TOPIC:
                    if (!_likebtn_is_bp_active()) {
                        break;
                    }
                    $bp_activity = $wpdb->get_row("
                        SELECT id
                        FROM ".$wpdb->prefix."bp_activity
                        WHERE id = {$entity_id}
                    ");

                    if (!empty($bp_activity)) {
                        bp_activity_delete_meta($entity_id, LIKEBTN_META_KEY_LIKES);
                        bp_activity_delete_meta($entity_id, LIKEBTN_META_KEY_DISLIKES);
                        bp_activity_delete_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES);
                        $entity_updated = true;
                    }
                    break;

                case LIKEBTN_ENTITY_BP_MEMBER:
                    // BuddyPress Member Profile
                    _likebtn_delete_bp_member_votes($entity_id);
                    $entity_updated = true;
                    break;

                case LIKEBTN_ENTITY_BBP_USER:
                    // bbPress Member Profile
                    _likebtn_delete_user_votes($entity_id);
                    $entity_updated = true;
                    break;

                case LIKEBTN_ENTITY_USER:
                    // BuddyPress Member Profile
                    $entity_updated = _likebtn_delete_bp_member_votes($entity_id);

                    // General user and bbPress Member Profile
                    $entity_updated = $entity_updated || _likebtn_delete_user_votes($entity_id);
                    break;
                
                default:
                    // Post
                    $post = get_post($entity_id);

                    // check if post exists and is not revision
                    if (!empty($post) && !empty($post->post_type) && $post->post_type != 'revision') {
                        delete_post_meta($entity_id, LIKEBTN_META_KEY_LIKES);
                        delete_post_meta($entity_id, LIKEBTN_META_KEY_DISLIKES);
                        delete_post_meta($entity_id, LIKEBTN_META_KEY_LIKES_MINUS_DISLIKES);
                        $entity_updated = true;
                    }
                    break;
            }
        }

        // Check custom item
        $item_db = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT likes, dislikes
                FROM ".$wpdb->prefix.LIKEBTN_TABLE_ITEM."
                WHERE identifier = %s",
                $identifier
            )
        );

        // Custom identifier
        if ($item_db || !$entity_updated) {
            $where = array('identifier' => $identifier);
            $result = $wpdb->delete($wpdb->prefix . LIKEBTN_TABLE_ITEM, $where);
            if ($result) {
                $entity_updated = true;
            }
        }

        return $entity_updated;
    }

    /**
     * Parse identifier.
     */
    public function parseIdentifier($identifier) {
        preg_match("/^(.*)_(\d+)$/", $identifier, $identifier_parts);

        $entity_name = '';
        if (!empty($identifier_parts[1])) {
            $entity_name = $identifier_parts[1];
        }
        
        $entity_id = '';
        if (!empty($identifier_parts[2])) {
            $entity_id = $identifier_parts[2];
        }

        return array(
            $entity_name,
            $entity_id
        );
    }

    /**
     * Run locales synchronization.
     */
    public function runSyncLocales() {
        if ($this->timeToSync(LIKEBTN_LOCALES_SYNC_INTERVAL, 'likebtn_last_locale_sync_time')) {
            $this->syncLocales();
        }
    }

    /**
     * Run styles synchronization.
     */
    public function runSyncStyles() {
        if ($this->timeToSync(LIKEBTN_STYLES_SYNC_INTERVAL, 'likebtn_last_style_sync_time')) {
            $this->syncStyles();
        }
    }

    /**
     * Run plan synchronization.
     */
    public function runSyncPlan() {
        if (get_option('likebtn_account_email') && 
            get_option('likebtn_account_api_key') && get_option('likebtn_site_id') &&
            $this->timeToSync(LIKEBTN_PLAN_SYNC_INTERVAL, 'likebtn_last_plan_sync_time')) 
        {
            $this->syncPlan();
        }
    }

    /**
     * Check if it is time to sync.
     */
    public function timeToSync($sync_period, $sync_variable) {

        $last_sync_time = get_option($sync_variable);

        $now = time();
        if (!$last_sync_time) {
            update_option($sync_variable, $now);
            return true;
        } else {
            if ($last_sync_time + $sync_period > $now) {
                return false;
            } else {
                update_option($sync_variable, $now);
                return true;
            }
        }
    }

    /**
     * Locales sync function.
     */
    public function syncLocales() {
        $url = LIKEBTN_API_URL . "?action=locale";

        $response_string = $this->curl($url);
        $response = $this->jsonDecode($response_string);

        if (isset($response['result']) && $response['result'] == 'success' && isset($response['response']) && count($response['response'])) {
            update_option('likebtn_locales', $response['response']);
        }
    }

    /**
     * Styles sync function.
     */
    public function syncStyles() {
        $url = LIKEBTN_API_URL . "?action=style";

        $response_string = $this->curl($url);
        $response = $this->jsonDecode($response_string);

        if (isset($response['result']) && $response['result'] == 'success' && isset($response['response']) && count($response['response'])) {
            update_option('likebtn_styles', $response['response']);
        }
    }

    /**
     * Styles plan function.
     */
    public function syncPlan() {
        $response = $this->apiRequest('plan');

        if (isset($response['result']) && $response['result'] == 'success' && isset($response['response']) && count($response['response'])) {
            if (isset($response['response']['plan'])) {
                $prev_plan = get_option('likebtn_plan');
                update_option('likebtn_plan', $response['response']['plan']);

                // Show notice on plan downgrade
                if ((int)$prev_plan > (int)$response['response']['plan']) {
                    update_option('likebtn_notice_plan', -1);
                }
                if ((int)$prev_plan < (int)$response['response']['plan']) {
                    update_option('likebtn_notice_plan', 1);
                }
                update_option('likebtn_last_plan_successfull_sync_time', time());
            }
            if (isset($response['response']['expires_in'])) {
                update_option('likebtn_plan_expires_in', $response['response']['expires_in']);
            }
            if (isset($response['response']['expires_on'])) {
                update_option('likebtn_plan_expires_on', $response['response']['expires_on']);
            }
        }

        return $response;
    }

    /**
     * Reset likes/dislikes using API
     *
     * @param type $account_api_key
     * @param type $site_api_key
     */
    public function reset($identifier) {
        $result = false;

        $url = "identifier_filter={$identifier}";
        $response = $this->apiRequest('reset', $url);

        // check result
        if (isset($response['response']['reseted']) && $response['response']['reseted']) {
           $result = $response['response']['reseted'];
        }

        return $result;
    }

    /**
     * Reset likes/dislikes using API
     *
     * @param type $account_api_key
     * @param type $site_api_key
     */
    public function delete($identifier) {
        $result = false;

        $url = "identifier_filter={$identifier}";
        $response = $this->apiRequest('delete', $url);

        // check result
        if (isset($response['response']['deleted']) && $response['response']['deleted']) {
           $result = $response['response']['deleted'];
        }

        return $result;
    }

    /**
     * Edit likes/dislikes using API
     *
     * @param type $account_api_key
     * @param type $site_api_key
     */
    public function edit($identifier, $type, $value) {
        $response = $this->apiRequest('edit', "identifier_filter={$identifier}&type={$type}&value={$value}");
        return $response;
    }

    /**
     * Get API URL
     *
     * @param type $identifier
     * @return string
     */
    public function apiRequest($action, $request = '', $email = '', $api_key = '', $site_id = '') {
        $apiurl = '';
        //if (!self::$apiurl) {
        if (!$email) {
            $email = trim(get_option('likebtn_account_email'));
        }
        $email = urlencode($email);
        
        if (!$api_key) {
            $api_key = trim(get_option('likebtn_account_api_key'));
        }

        // local_domain and subdirectory are kept for backward compatibility
        /*$subdirectory = trim(get_option('likebtn_subdirectory'));
        $local_domain = trim(get_option('likebtn_local_domain'));
        if ($local_domain) {
          $domain = $local_domain;
        }
        else {
          $parse_url = parse_url(get_site_url());
          $domain    = $parse_url['host'] . $subdirectory;
        }*/
        $domain_site_id = '';

        if (!$site_id) {
            $site_id = trim(get_option('likebtn_site_id'));
        }
        if ($site_id) {
            $domain_site_id .= "site_id={$site_id}&";
        } else {
            $parse_url = parse_url(get_site_url());
            $domain    = $parse_url['host'];

            $domain_site_id .= "domain={$domain}&";
        }

        $apiurl = LIKEBTN_API_URL . "?email={$email}&api_key={$api_key}&nocache=.php&source=wordpress&" . $domain_site_id;
        //}
        $url = $apiurl . "action={$action}&" . $request;

        $response_string = $this->curl($url);
        $response = $this->jsonDecode($response_string);

        if (!isset($response['result'])) {
            $response['result'] = 'error';
        }
        if (!isset($response['message'])) {
            $response['message'] = 'Could not retrieve data from LikeBtn API';
        }

        return $response;
    }

}
