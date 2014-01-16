<?php 

class Instagram extends WP_Widget {
	
	function Instagram() {
		$widget_opts = array( 'description' => __('Use this widget is to show the latest image of a specific user.') );
		parent::WP_Widget(false, 'Instagram', $widget_opts);
	}
	function form($instance) {
		
		$username = (isset($instance['username'])) ? esc_attr($instance['username']) : '';  
        echo '<p><label>';
		echo _e('username:').'<input class="widefat" name="'. $this->get_field_name('username').'" type="text" value="'. $username.'" />';
        echo '</label></p>';

	}

	function update($new_instance, $old_instance){
		return $new_instance;
	}
	
	function widget($args, $instance) {
		$args['username'] = $instance['username'];
		$data = get_transient( 'instagram_data' );
		if(!$data){
			$result = file_get_contents('https://api.instagram.com/v1/users/self/media/recent?count=1&access_token=975210125.f59def8.22533e588c7e4073b663551c066ee3c9');
			$data = json_decode($result);
			$data = (isset($data->data[0])) ? $data->data[0] : null;
			set_transient( 'instagram_data', $data);
		}
		if(!empty($data)):
			echo $args['before_widget'];
		?>
			<a href="http://instagram.com/<?php echo $args['username'] ?>" >
				<div class="image">
					<img src="<?php echo $data->images->low_resolution->url; ?>" />
				</div>
				<footer class="footer">
			 		<p class="sackers small text-center" ><?php _e("Find us on Instagram", THEME_NAME); ?></p>
			 		<h3 class="no-margin username text-center">@<?php echo $args['username']; ?></h3>
			 	</footer>
		 	</a>
	 	<?php echo $args['after_widget']; ?>
		<?php endif; ?>
	 	<?php
	}
}

register_widget('Instagram');


?>
