<?php
/*
	Developr Social Follow Widget
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
	Copyright: (c) 2013 Kanishk Kunal - http://kanishkkunal.in
	
		@package developr
		@version 1.0
*/

class DeveloprSocial extends WP_Widget {

/*  Constructor
/* ------------------------------------ */
	function DeveloprSocial() {
		parent::__construct( false, 'Developr Social Buttons', array('description' => 'Displays Social Follow buttons set in the Theme Options -> Social Links', 'classname' => 'widget_developr_social') );;	
	}
	
/*  Widget
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );
		$instance['title']? NULL: $instance['title']='';
		$title = apply_filters('widget_title', $instance['title']);
		echo $before_widget."\n";
		if($title)
			echo $before_title.$title.$after_title;
		
		developr_social_links(TRUE);
		
		echo $after_widget."\n";
	}
	
/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = esc_attr($new['title']);
		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>

	<div class="developr-options-social">
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>
	</div>
<?php

}

}

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'develop_register_social_widget' ) ) {

	function develop_register_social_widget() { 
		register_widget( 'DeveloprSocial' );
	}
	
}
add_action( 'widgets_init', 'develop_register_social_widget' );
