=== LikeBtn Like Button ===
Contributors: likebtn
Donate link: http://www.likebtn.com
Tags: like, likes, like button, comments, post, widget, widgets, like widget, dislike button, dislike, counter, voting, page, thumb up, thumb down, wp like button, facebook, twitter, likebutton, php, plugin, template, wordpress, like wordpress, sidebar, share, sharing, like button code, shortcode
Requires at least: 2.8
Tested up to: 3.5.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Like Button allows visitors to like and dislike pages, posts and comments anonymously.

== Description ==

<strong><a href="http://www.likebtn.com" target="_blank" title="Like Button">LikeBtn.com</a></strong> - is the service providing a fully customizable like button widget for websites. The Like Button can be installed on any website for FREE. The service also offers a range of plans giving access to additional options and tools - see <a href="http://www.likebtn.com/en/#plans_pricing" target="_blank" title="Like Button Plans">Plans & Pricing</a>.

This module allows to integrate the LikeBtn Like Button into your WordPress website to allow visitors to like and dislike pages, posts and comments anonymously.

**Demo:** <a href="http://wordpress.likebtn.com/wordpress-like-button-plugin/" target="_blank" title="wordpress like button demo">http://wordpress.likebtn.com</a>

= Features =
* Allows visitors to like and dislike pages, posts and comments anonymously.
* Visitors do not have to register or log in to use the Like Button.
* After liking visitors can share a link in social networks: Facebook, Twitter etc.
* Appearance is controlled through CSS.

== Installation ==

1) Upload `likebtn-like-button` to the `/wp-content/plugins/` directory

2) Activate the plugin through the 'Plugins' menu in WordPress

3) To add the Like Button to the pages add the following code to the page.php file of your current theme within the while-loop:
`<?php if (function_exists('likebtn_post')) { likebtn_post(); } ?>`

4) To add the Like Button to the posts add the following code to the single.php file of your current theme within the while-loop:
`<?php if (function_exists('likebtn_post')) { likebtn_post(); } ?>`

5) To add the Like Button to the comments add the following code to the functions.php file of your current theme after `<?php comment_text(); ?>`:
`<?php if (function_exists('likebtn_comment')) { likebtn_comment(); } ?>`

6) Plugin does not provide any backend admin panel.

== Frequently Asked Questions ==



== Screenshots ==
1. Like Button

== Changelog ==

= 1.0 =
* LikeBtn Like Button module launched.

== Upgrade Notice ==

