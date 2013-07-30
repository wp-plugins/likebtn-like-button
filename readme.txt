=== LikeBtn Like Button ===
Contributors: likebtn
Donate link: http://www.likebtn.com
Tags: like, likes, like button, comments, post, widget, widgets, like widget, dislike button, dislike, counter, voting, page, thumb up, thumb down, wp like button, facebook, twitter, likebutton, php, plugin, template, wordpress, like wordpress, sidebar, share, sharing, like button code, shortcode
Requires at least: 2.8
Tested up to: 3.5.2
Stable tag: 1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Like Button allows visitors to like and dislike pages, posts, custom post types and comments anonymously.

== Description ==

<strong><a href="http://www.likebtn.com" target="_blank" title="Like Button">LikeBtn.com</a></strong> - is the service providing a fully customizable like button widget for websites. The Like Button can be installed on any website for FREE. The service also offers a range of plans giving access to additional options and tools - see <a href="http://www.likebtn.com/en/#plans_pricing" target="_blank" title="Like Button Plans">Plans & Pricing</a>.

This plugin allows to integrate the LikeBtn Like Button into your WordPress website to allow visitors to like and dislike pages, posts, custom post types and comments anonymously.

**Demo:** <a href="http://wordpress.likebtn.com/wordpress-like-button-plugin/" target="_blank" title="wordpress like button demo">http://wordpress.likebtn.com</a>

= Features =
* Allows visitors to like and dislike pages, posts, custom post types and comments anonymously.
* Visitors do not have to register or log in to use the Like Button.
* After liking visitors can share a link in social networks: Facebook, Twitter etc.
* Adds "Likes", "Dislikes" and "Likes minus dislikes" Custom Fields to posts and comments (PRO, VIP).
* Statistics on vote results (PRO, VIP).
* Shortcode to place the Like Button inside the post/page content: <code>[likebtn]</code>
* Shortcode to place a list of the most liked content inside the post/page using a shortcode (PRO, VIP): <code>[likebtn_most_liked]</code>
* Widget displaying most liked content (PRO, VIP).
* Customizable position and alignment.
* Can be displayed depending on the post view mode, format, category, ID.
* Appearance is controlled through CSS.
* Built-in styles.
* Built-in support for a number of languages.
* Allows to change all labels texts.
* All <a href="http://www.likebtn.com/en/#settings" target="_blank" title="Like Button Settings">LikeBtn.com settings</a> are available.

== Installation ==

1. Upload `likebtn-like-button` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin in LikeBtn admin panel.

== Frequently Asked Questions ==

See also <a href="http://www.likebtn.com/en/faq" target="_blank" title="Like Button FAQ">LikeBtn FAQ</a>.

<strong>1. How can I place the Like Button inside the post/page content using a shortcode?</strong>

Use the following shortcode: `[likebtn]`

You can pass Like Button settings as parameters in the shortcode:
`[likebtn identifier="my_button_in_post" style="large"]`

If identifier parameter is not specified, post ID is used.

<strong>2. How can I display a list of the most liked content inside the post/page using a shortcode? (PRO, VIP)</strong>

Use the following shortcode:
`[likebtn_most_liked content_types="post,comment" title="Most liked posts and comments on my website" show_date="1" show_likes="0" show_dislikes="1" number="3"]`

Available content types: `post, page, attachment, revision, nav_menu_item, comment` and custom post types.



== Screenshots ==
1. Like Button
2. Plugin settings
3. Statistics
4. Most Liked Content Widget admin view
5. Most Liked Content Widget frontend view

== Changelog ==

= 1.0 =
* LikeBtn Like Button plugin launched.

= 1.1 =
* LikeBtn admin panel now available.

= 1.2 =
* Synchronization of the vote results from LikeBtn.com into website database.
* Statistics on vote results.
* Most liked content widget.
* Added center alignment.
* Added shortcode to place the Like Button inside the post/page content.

= 1.3 =
* Synchronization test.
* Added shortcode to place a list of the most liked content inside the post/page using a shortcode.
* Added Reset button in Settings.
* Added auto disabling/enabling options depending on the plan selected.

= 1.4 =
* Popup position options.
* Show copyright link in the share popup option.
* Popup style option.
* Time range option in Widget displaying most liked content.

= 1.5 =
* Import latest styles from LikeBtn.com in the background.
* Added JavaScript callback function serving as an event handler option.
* Added Show Like Button option.
* Added Reset likes and dislikes feature.

== Upgrade Notice ==

