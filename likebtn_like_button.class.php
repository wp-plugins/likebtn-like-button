<?php

define('LIKEBTN_LIKE_BUTTON_LAST_SUCCESSFULL_SYNC_TIME_OFFSET', 57600);
define('LIKEBTN_LIKE_BUTTON_API_URL', 'http://www.likebtn.com/api/');

class LikeBtnLikeButton {

    protected static $synchronized = false;

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
        if (!self::$synchronized && get_option('likebtn_like_button_account_email') && get_option('likebtn_like_button_account_api_key') && get_option('likebtn_like_button_sync_inerval') && $this->timeToSyncVotes(get_option('likebtn_like_button_sync_inerval') * 60) && function_exists('curl_init')) {
            $this->syncVotes(get_option('likebtn_like_button_account_email'), get_option('likebtn_like_button_account_api_key'));
        }
    }

    /**
     * Check if it is time to sync votes.
     */
    public function timeToSyncVotes($sync_period) {

        $last_sync_time = get_option('likebtn_like_button_last_sync_time');

//        $now = time();
//        update_option('likebtn_like_button_last_sync_time', $now);
//        return true;

        $now = time();
        if (!$last_sync_time) {
            update_option('likebtn_like_button_last_sync_time', $now);
            self::$synchronized = true;
            return true;
        } else {

            if ($last_sync_time + $sync_period > $now) {
                return false;
            } else {
                update_option('likebtn_like_button_last_sync_time', $now);
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

        $likebtn_version = _likebtn_like_button_get_plugin_version;
        $php_version = phpversion();
        $useragent = "WordPress $wp_version; likebtn plugin $likebtn_version; PHP $php_version";

        try {
            $http = new WP_Http();
            $response = $http->request($url, array('headers' => array("User-Agent" => $useragent)));
        } catch (Exception $e) {
            return '';
        }

        if (is_array($response) && !empty($response['body'])) {
            return $response['body'];
        } else {
            return '';
        }
    }

    /**
     * Comment sync function.
     */
    public function syncVotes($account_api_key, $site_api_key) {
        $last_sync_time = number_format(get_option('likebtn_like_button_last_sync_time'), 0, '', '');

        $email = trim(get_option('likebtn_like_button_account_email'));
        $api_key = trim(get_option('likebtn_like_button_account_api_key'));
        $parse_url = parse_url(get_site_url());
        $domain = $parse_url['host'];

        $updated_after = '';

        if (get_option('likebtn_like_button_last_successfull_sync_time')) {
            $updated_after = get_option('likebtn_like_button_last_successfull_sync_time') - LIKEBTN_LIKE_BUTTON_LAST_SUCCESSFULL_SYNC_TIME_OFFSET;
        }

        $url = LIKEBTN_LIKE_BUTTON_API_URL . "?action=stat&email={$email}&api_key={$api_key}&domain={$domain}&output=json&last_sync_time=" . $last_sync_time;

        if ($updated_after) {
            $url .= '&updated_after=' . $updated_after;
        }

        $response_string = $this->curl($url);
        $response = $this->jsonDecode($response_string);

        if ($this->updateVotes($response)) {
            update_option('likebtn_like_button_last_successfull_sync_time', $last_sync_time);
        }
    }

    /**
     * Decode JSON.
     */
    public function jsonDecode($jsong_string) {
        return json_decode($jsong_string, true);
    }

    /**
     * Update votes in database from API response.
     */
    public function updateVotes($response) {
        global $likebtn_like_button_entities;
        global $likebtn_like_button_custom_fields;

        $entity_updated = false;

        if (!empty($response['response']['items'])) {
            foreach ($response['response']['items'] as $item) {
                $identifier_parts = explode('_', $item['identifier']);
                $entity_name = '';
                if (!empty($identifier_parts[0])) {
                    $entity_name = $identifier_parts[0];
                }
                // check if entity is supported
                if (!array_key_exists($entity_name, $likebtn_like_button_entities)) {
                    continue;
                }
                $entity_id = '';
                if (!empty($identifier_parts[1])) {
                    $entity_id = $identifier_parts[1];
                    if (!is_numeric($entity_id)) {
                        continue;
                    }
                }

                $likes = 0;
                if (!empty($item['likes'])) {
                    $likes = $item['likes'];
                }
                $dislikes = 0;
                if (!empty($item['dislikes'])) {
                    $dislikes = $item['dislikes'];
                }

                $likes_minus_dislikes = $likes - $dislikes;

                $entity_updated = true;

                // set Custom fields
                if ($entity_name == 'comment') {
                    // entity is comment
                    if (count(get_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES)) > 1) {
                        delete_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES);
                        add_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES, $likes, true);
                    } else {
                        update_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES, $likes);
                    }
                    if (count(get_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES)) > 1) {
                        delete_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES);
                        add_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES, $dislikes, true);
                    } else {
                        update_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES, $dislikes);
                    }
                    if (count(get_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES)) > 1) {
                        delete_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES);
                        add_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes, true);
                    } else {
                        update_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes);
                    }
                } else {
                    // entity is post
                    if (count(get_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES)) > 1) {
                        delete_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES);
                        add_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES, $likes, true);
                    } else {
                        update_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES, $likes);
                    }
                    if (count(get_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES)) > 1) {
                        delete_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES);
                        add_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES, $dislikes, true);
                    } else {
                        update_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES, $dislikes);
                    }
                    if (count(get_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES)) > 1) {
                        delete_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES);
                        add_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes, true);
                    } else {
                        update_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes);
                    }
                }
            }
        }
        return $entity_updated;
    }

}
