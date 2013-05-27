<?php
/*
  Plugin Name: LikeBtn Like Button
  Plugin URI: http://www.likebtn.com
  Description: <strong><a href="http://www.likebtn.com" target="_blank" title="Like Button">LikeBtn.com</a></strong> - is the service providing a fully customizable like button widget for websites. The Like Button can be installed on any website for FREE. The service also offers a range of plans giving access to additional options and tools - see <a href="http://www.likebtn.com/en/#plans_pricing" target="_blank" title="Like Button Plans">Plans & Pricing</a>. This module allows to integrate the LikeBtn Like Button into your WordPress website to allow visitors to like and dislike pages, posts and comments anonymously.
  Version: 1.0
  Author: likebtn
  Author URI: http://www.likebtn.com
 */

function likebtn_post($post_id = NULL) {
    global $post;
    if (empty($post_id)) {
        $post_id = $post->ID;
    }

    $html =<<<HTML
<!-- LikeBtn.com BEGIN -->
<span class="likebtn-wrapper" data-identifier="post_{$post_id}"></span>
<script type="text/javascript" src="http://www.likebtn.com/js/widget.js" async="async"></script>
<!-- LikeBtn.com END -->
HTML;

    echo $html;
}

function likebtn_comment($comment_id = NULL) {
    global $comment;
    if (empty($comment_id)) {
        $comment_id = get_comment_ID();
    }
    $html =<<<HTML
<!-- LikeBtn.com BEGIN -->
<span class="likebtn-wrapper" data-identifier="comment_{$comment_id}"></span>
<script type="text/javascript" src="http://www.likebtn.com/js/widget.js" async="async"></script>
<!-- LikeBtn.com END -->
HTML;

    echo $html;
}