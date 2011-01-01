<?php
/*
Plugin Name: TMBG Fingertips
Plugin URI:
Description: In the grand tradition of Matt Mullenweg's Hello Dolly plug-in, TMBG Fingertips will insert a random They Might Be Giants Fingertip in the site footer.
Author: Becky Sweger
Version: 1.0
Author URI: http://beckysweger.com
*/

if (!class_exists('TmbgFingertips')) {
	class TmbgFingertips extends WP_Widget {
		
		//constructor
		function TmbgFingertips() {
			
			parent::WP_Widget('tmbg-fingertips', __('TMBG Fingertips'), array('description' => 'Display a random TMBG Fingertip from Apollo 18', classname => 'widget-fingertips-class'));
		}
		
		function widget($args, $instance) {
			
			extract($args);
			echo $before_widget;
			$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
			if ( !empty( $title ) ) { 
				echo $before_title . $title . $after_title; 
			};
		
			//get a random fingertip from TMBG Apollo 18
			$fingertips = "please pass the milk please
			what's that blue thing doing here?
			who's knockin on the wall?
			everything is catching on fire
			fingertips
			i hear the wind blow
			hey now, everybody
			who's that standing at the window?
			i found a new friend underneath my pillow
			come on and wreck my car
			aren't you the guy who hit me in the eye?
			leave me alone
			all alone
			something grabbed ahold of my hand
			i don't understand you
			i heard a sound
			mysterious whisper
			the day that love came to play
			i'm having a heart attack
			i walk along darkened corridors
			space suit";

			// Split the fingertips
			$fingertips = explode("\n", $fingertips);
		
			// And then randomly choose a fingertip
			$random_fingertip = wptexturize( $fingertips[ mt_rand(0, count($fingertips) - 1) ] );
			
			echo '<ul class="fingertips-class"><li>' . $random_fingertip . '</li></ul>';
			echo $after_widget;
		
		}
		
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}
		
		function form($instance) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' )); 
    		$title = strip_tags($instance['title']);
			
			?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
        <?php
		
		}
		
	} //end class
}
			
	//register the widget
	add_action('widgets_init', 'TmbgFingertipsInit');
	function TmbgFingertipsInit() {
		register_widget('TmbgFingertips');
	}
	
?>