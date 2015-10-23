<?php

if (class_exists('myCRED_Hook')) {

	class LikeBtn_MyCRED extends myCRED_Hook {

		const ID = 'likebtn';

		// Refence IDs
		const REF_LIKE = 'likebtn_like';
		const REF_GET_LIKE = 'likebtn_get_like';
		const REF_DISLIKE = 'likebtn_dislike';
		const REF_GET_DISLIKE = 'likebtn_get_dislike';

		public static $defaults = array(
			'like'    => array(
				'creds'  => 1,
				'log'    => '%plural% for liking content',
				'limit'  => '0/x'
			),
			'get_like'  => array(
				'creds'  => 1,
				'log'    => '%plural% for getting a content like',
				'limit'  => '0/x'
			),
			'dislike'  => array(
				'creds'  => 1,
				'log'    => '%plural% for disliking content',
				'limit'  => '0/x'
			),
			'get_dislike'  => array(
				'creds'  => -1,
				'log'    => '%plural% deduction for getting a content dislike',
				'limit'  => '0/x'
			)
		);

		/**
		 * Construct
		 */
		function __construct( $hook_prefs, $type ) {
			parent::__construct( array(
				'id'       => self::ID,
				'defaults' => self::$defaults
			), $hook_prefs, $type );
		}

		/**
		 * Hook into WordPress
		 */
		public function run() {
			add_action('likebtn_mycred_like', array($this, 'like'), 10, 2);
			add_action('likebtn_mycred_dislike', array($this, 'dislike'), 10, 2);
		}

		/**
		 * Check if the user qualifies for points
		 */
		public function like($entity_name, $entity_id) {
			$this->award($entity_name, $entity_id, 'like', self::REF_LIKE, self::REF_GET_LIKE);
		}


		/**
		 * Check if the user qualifies for points
		 */
		public function dislike($entity_name, $entity_id) {
			$this->award($entity_name, $entity_id, 'dislike', self::REF_DISLIKE, self::REF_GET_DISLIKE);
		}

		/**
		 * Award user and author
		 */
		public function award($entity_name, $entity_id, $instance, $ref_user, $ref_author) {
			$user_id 	= get_current_user_id();
			
			if (!$user_id) {
				return;
			}

			// Check if user is excluded (required)
			if ($this->core->exclude_user($user_id)) {
				return;
			}	

			$author_id 	= _likebtn_get_author_id($entity_name, $entity_id);

			// Do nothing is user liked own content
			if ($user_id == $author_id) {
				return;
			}

			// Award for liking content
			if ($this->prefs[$instance]['creds'] != 0) {
				$data = array('entity_name' => $entity_name);
				// Limit and make sure this is unique event
				if (!$this->over_hook_limit($instance, $ref_user, $user_id) &&
					!$this->core->has_entry($ref_user, $entity_id, $user_id, $data))
				{
					// Execute
					$this->core->add_creds(
						$ref_user,
						$user_id,
						$this->prefs[$instance]['creds'],
						$this->prefs[$instance]['log'],
						$entity_id,
						$data,
						$this->mycred_type
					);
				}
			}

			// Award post author for being liked
			if ($this->prefs['get_'.$instance]['creds'] != 0 && $author_id) {
				$data = array('entity_name' => $entity_name, 'user_id' => $user_id);
				// Limit and make sure this is unique event
				if (!$this->over_hook_limit('get_'.$instance, $ref_author, $user_id) &&
					!$this->core->has_entry($ref_author, $entity_id, $user_id, $data))
				{
					// Execute
					$this->core->add_creds(
						$ref_user,
						$author_id,
						$this->prefs['get_'.$instance]['creds'],
						$this->prefs['get_'.$instance]['log'],
						$entity_id,
						$data,
						$this->mycred_type
					);
				}
			}
		}

		/**
		 * Add Settings
		 */
		public function preferences() {
 
			$prefs = $this->prefs;
 
?>
<label class="subheader"><?php echo _e( 'Points for Liking Content', LIKEBTN_I18N_DOMAIN ); ?></label>
<ol>
	<li>
		<div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'like' => 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'like' => 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['like']['creds'] ); ?>" size="8" /></div>
	</li>
	<li class="empty"></li>
	<li>
		<label for="<?php echo $this->field_id( array( 'like' => 'limit' ) ); ?>"><?php _e( 'Limit', LIKEBTN_I18N_DOMAIN ); ?></label>
		<?php echo $this->hook_limit_setting( $this->field_name( array( 'like' => 'limit' ) ), $this->field_id( array( 'like' => 'limit' ) ), $prefs['like']['limit'] ); ?>
	</li>	
	<li class="empty"></li>
	<li>
		<label for="<?php echo $this->field_id( array( 'like' => 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
		<div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'like' => 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'like' => 'log' ) ); ?>" value="<?php echo esc_attr( $prefs['like']['log'] ); ?>" class="long" /></div>
		<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
	</li>
</ol>
<label class="subheader"><?php _e( 'Points for Getting a Content Like', LIKEBTN_I18N_DOMAIN ); ?></label>
<ol>
	<li>
		<div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'get_like' => 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'get_like' => 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['get_like']['creds'] ); ?>" size="8" /></div>
	</li>
	<li class="empty"></li>
	<li>
		<label for="<?php echo $this->field_id( array( 'get_like' => 'limit' ) ); ?>"><?php _e( 'Limit', LIKEBTN_I18N_DOMAIN ); ?></label>
		<?php echo $this->hook_limit_setting( $this->field_name( array( 'get_like' => 'limit' ) ), $this->field_id( array( 'get_like' => 'limit' ) ), $prefs['get_like']['limit'] ); ?>
	</li>		
	<li class="empty"></li>
	<li>
		<label for="<?php echo $this->field_id( array( 'get_like' => 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
		<div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'get_like' => 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'get_like' => 'log' ) ); ?>" value="<?php echo esc_attr( $prefs['get_like']['log'] ); ?>" class="long" /></div>
		<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
	</li>
</ol>
<label class="subheader"><?php echo _e( 'Points for Disliking Content', LIKEBTN_I18N_DOMAIN ); ?></label>
<ol>
	<li>
		<div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'dislike' => 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'dislike' => 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['dislike']['creds'] ); ?>" size="8" /></div>
	</li>
	<li class="empty"></li>
	<li>
		<label for="<?php echo $this->field_id( array( 'dislike' => 'limit' ) ); ?>"><?php _e( 'Limit', LIKEBTN_I18N_DOMAIN ); ?></label>
		<?php echo $this->hook_limit_setting( $this->field_name( array( 'dislike' => 'limit' ) ), $this->field_id( array( 'dislike' => 'limit' ) ), $prefs['dislike']['limit'] ); ?>
	</li>
	<li class="empty"></li>
	<li>
		<label for="<?php echo $this->field_id( array( 'dislike' => 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
		<div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'dislike' => 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'dislike' => 'log' ) ); ?>" value="<?php echo esc_attr( $prefs['dislike']['log'] ); ?>" class="long" /></div>
		<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
	</li>
</ol>
<label class="subheader"><?php _e( 'Points for Getting a Content Dislike', LIKEBTN_I18N_DOMAIN ); ?></label>
<ol>
	<li>
		<div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'get_dislike' => 'creds' ) ); ?>" id="<?php echo $this->field_id( array( 'get_dislike' => 'creds' ) ); ?>" value="<?php echo $this->core->number( $prefs['get_dislike']['creds'] ); ?>" size="8" /></div>
	</li>
	<li class="empty"></li>
	<li>
		<label for="<?php echo $this->field_id( array( 'get_dislike' => 'limit' ) ); ?>"><?php _e( 'Limit', LIKEBTN_I18N_DOMAIN ); ?></label>
		<?php echo $this->hook_limit_setting( $this->field_name( array( 'get_dislike' => 'limit' ) ), $this->field_id( array( 'get_dislike' => 'limit' ) ), $prefs['get_dislike']['limit'] ); ?>
	</li>
	<li class="empty"></li>
	<li>
		<label for="<?php echo $this->field_id( array( 'get_dislike' => 'log' ) ); ?>"><?php _e( 'Log template', 'mycred' ); ?></label>
		<div class="h2"><input type="text" name="<?php echo $this->field_name( array( 'get_dislike' => 'log' ) ); ?>" id="<?php echo $this->field_id( array( 'get_dislike' => 'log' ) ); ?>" value="<?php echo esc_attr( $prefs['get_dislike']['log'] ); ?>" class="long" /></div>
		<span class="description"><?php echo $this->available_template_tags( array( 'general' ) ); ?></span>
	</li>
</ol>
<?php
 
		}
		
		/**
		 * Sanitise Preferences
		 */
		function sanitise_preferences($data) {

			foreach (self::$defaults as $key => $value) {
				if (isset( $data[$key]['limit'] ) && isset( $data[$key]['limit_by'] )) {
					$limit = sanitize_text_field($data[$key]['limit']);
					if ($limit == '') {
						$limit = 0;
					}
					$data[$key]['limit'] = $limit . '/' . $data[$key]['limit_by'];
					unset($data[$key]['limit_by']);
				}	
			}

			return $data;
		}
	}

}
