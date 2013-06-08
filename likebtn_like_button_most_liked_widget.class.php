<?php

class LikeBtnLikeButtonMostLikedWidget extends WP_Widget {

    function LikeBtnLikeButtonMostLikedWidget() {
        load_plugin_textdomain(LIKEBTN_LIKE_BUTTON_I18N_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
        $widget_ops = array('description' => __('Most liked posts and comments', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN));
        parent::WP_Widget(false, $name = __('LikeBtn Most Liked Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        global $LikeBtnLikeButtonMostLiked;
        $LikeBtnLikeButtonMostLiked->widget($args, $instance);
    }

    function update($new_instance, $old_instance) {
        if ($new_instance['title'] == '') {
            $new_instance['title'] = __('Most Liked Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
        }

//        if ((int) $new_instance['number'] < 1) {
//            $new_instance['number'] = 5;
//        }

        return $new_instance;
    }

    function form($instance) {
        global $likebtn_like_button_entities;

        if ($instance['title'] == '') {
            $instance['title'] = __('Most Liked Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
        }

//        if ((int) $new_instance['number'] < 1) {
//            $instance['number'] = 5;
//        }

        if (!$instance['entity_name'] || !is_array($instance['entity_name'])) {
            $instance['entity_name'] = array(LIKEBTN_LIKE_BUTTON_ENTITY_POST);
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('entity_name'); ?>"><?php _e('Items to show (use CTRL to choose)', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label><br/>
            <select name="<?php echo $this->get_field_name('entity_name'); ?>[]" id="<?php echo $this->get_field_id('entity_name'); ?>" multiple="multiple" size="6" style="height:auto !important;">
                <?php foreach ($likebtn_like_button_entities as $entity_name_value => $entity_title): ?>
                    <option value="<?php echo $entity_name_value; ?>" <?php echo (in_array($entity_name_value, $instance['entity_name']) ? 'selected="selected"' : ''); ?> ><?php _e($entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <?php endforeach ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of items to show:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" size="3" />
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_date']); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" value="1" />
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Display item date?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('show_likes'); ?>" name="<?php echo $this->get_field_name('show_likes'); ?>" value="1" <?php checked($instance['show_likes']); ?> />
            <label for="<?php echo $this->get_field_id('show_likes'); ?>"><?php _e('Show likes count', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('show_dislikes'); ?>" name="<?php echo $this->get_field_name('show_dislikes'); ?>" value="1" <?php checked($instance['show_dislikes']); ?> />
            <label for="<?php echo $this->get_field_id('show_dislikes'); ?>"><?php _e('Show dislikes count', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
        </p>
        <input type="hidden" id="wti-most-submit" name="wti-submit" value="1" />
        <?php
    }

}

class LikeBtnLikeButtonMostLiked {

    function LikeBtnLikeButtonMostLiked() {
        add_action('widgets_init', array(&$this, 'init'));
    }

    function init() {
        register_widget("LikeBtnLikeButtonMostLikedWidget");
    }

    function widget($args, $instance = array()) {
        global $wpdb;
        extract($args);

        $title = $instance['title'];
        $show_date = $instance['show_date'];
        $show_likes = $instance['show_likes'];
        $show_dislikes = $instance['show_dislikes'];

        $query_post_types = "'" . implode("','", $instance['entity_name']) . "'";

        $query_limit = '';
        if ((int) $instance['number'] > 0) {
            $query_limit = "LIMIT " . (int) $instance['number'];
        }

        // getting the most liked content
        $query = '';
        if (in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name']) && count($instance['entity_name']) > 1) {
            $query .= "SELECT * FROM (";
        }
        if (!in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name']) || count($instance['entity_name']) > 1) {
            $query .= "
                 SELECT
                    p.ID as 'post_id',
                    p.post_title,
                    p.post_date,
                    pm_likes.meta_value as 'likes',
                    pm_dislikes.meta_value as 'dislikes',
                    p.post_type
                 FROM {$wpdb->prefix}postmeta pm_likes
                 LEFT JOIN {$wpdb->prefix}posts p
                     ON (p.ID = pm_likes.post_id)
                 LEFT JOIN {$wpdb->prefix}postmeta pm_dislikes
                     ON (pm_dislikes.post_id = pm_likes.post_id AND pm_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES . "')
                 WHERE
                    pm_likes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES . "'
                    AND p.post_type in ({$query_post_types}) ";
        }
        if (in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name']) && count($instance['entity_name']) > 1) {
            $query .= " UNION ";
        }
        if (in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name'])) {
            $query .= "
                 SELECT
                    p.comment_ID as 'post_id',
                    p.comment_content as post_title,
                    p.comment_date as 'post_date',
                    pm_likes.meta_value as 'likes',
                    pm_dislikes.meta_value as 'dislikes',
                    'comment' as post_type
                 FROM {$wpdb->prefix}commentmeta pm_likes
                 LEFT JOIN {$wpdb->prefix}comments p
                    ON (p.comment_ID = pm_likes.comment_id)
                 LEFT JOIN {$wpdb->prefix}commentmeta pm_dislikes
                    ON (pm_dislikes.comment_id = pm_likes.comment_id AND pm_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES . "')
                 WHERE
                    pm_likes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES . "' ";
        }
        if (in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name']) && count($instance['entity_name']) > 1) {
            $query .= "
                ) main_query";
        }
        $query .= "
            ORDER BY
                likes DESC
             {$query_limit}";
//        echo "<pre>";
//        echo $query;
        $posts = $wpdb->get_results($query);

        $widget_data = $before_widget;
        $widget_data .= $before_title . $title . $after_title;
        $widget_data .= '<ul class="likebtn-like-button-most-liked-content">';

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $post_title = stripslashes($post->post_title);

                if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
                    $post_title = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($post_title);
                }
                if ($post->post_type == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
                    if (mb_strlen($post_title) > 30) {
                        $post_title = mb_substr($post_title, 0, 30) . '...';
                    }
                }

                if ($post->post_type != LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
                    $permalink = get_permalink($post->post_id);
                } else {
                    $permalink = get_comment_link($post->post_id);
                }

                $likes = $post->likes;
                $dislikes = $post->dislikes;

                $widget_data .= '<li><a href="' . $permalink . '" title="' . $post_title . '" rel="nofollow">' . $post_title . '</a>';

                if ($show_date == '1') {
                    $date = strtotime($post->post_date);
                    if ($date) {
                        $widget_data .= ' <span class="likebtn-like-button-item-date">[' . date_i18n(get_option('date_format'), $date) . ']</span>';
                    }
                }

                if ($show_likes == '1' || $show_dislikes == '1') {
                    $widget_data .= ' <span class="likebtn-like-button-likes">(';
                }
                $widget_data .= $show_likes == '1' ? $likes : '';
                if ($show_likes == '1' && $show_dislikes == '1') {
                    $widget_data .= '/';
                }
                $widget_data .= $show_dislikes == '1' ? $dislikes : '';
                if ($show_likes == '1' || $show_dislikes == '1') {
                    $widget_data .= ')</span> ';
                }

                $widget_data .= '</li>';
            }
        } else {
            $widget_data .= '<li>';
            $widget_data .= __('No items liked yet.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
            $widget_data .= '</li>';
        }

        $widget_data .= '</ul>';
        $widget_data .= $after_widget;

        echo $widget_data;
    }

}

$LikeBtnLikeButtonMostLiked = new LikeBtnLikeButtonMostLiked();