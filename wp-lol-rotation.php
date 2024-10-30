<?php
/**
 * @package WP LOL Rotation
 * @version 1.0
 */
/*
Plugin Name: WP LOL Rotation
Description: Plugin shows actually NA/EU rotation in widget and display Korean rotation in shortcode [rotation width="600" height="240"]
Author: worstguy
Version: 1.0
Author URL: http://lolrotation.ovh/
*/
function lolrotation_shortcode( $atts, $content = null) {
    global $post;extract(shortcode_atts(array(
        'width' => '',
		'height' => '',
    ), $atts));
     
    if(empty($width)) {
        $width='600';
    }
	if(empty($height)) {
        $height='240';
    }
	if(empty($content)) {
        $content='';
    }
	return '<div style="text-align:center;overflow:hidden;max-height:100%;padding0;margin-bottom:0px;z-index:10;">
<iframe src="http://lolrotation.ovh/rfreekr" scrolling="no" frameBorder="0" style="width:'.$width.'px; height:'.$height.'px;"></iframe>
</div>';
}

class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(
'wpb_widget', 

__('LOL Rotation Widget', 'wpb_widget_domain'), 

array( 'description' => __( 'League of Legends Rotation', 'wpb_widget_domain' ), ) 
);
}

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

//If plugin not display perfectly, use shortcode for display rotation and change width and height: [rotation width="600" height="240"]
	echo "<!-- WP LOL Rotation Plugin v1.0 --><div style='overflow:hidden;max-height:100%; padding 0; margin-bottom: -25px;'>
<iframe src='http://lolrotation.ovh/rfree' scrolling='no' frameBorder='0' style='width:100%; height:100%;'></iframe>
</div>";
echo $args['after_widget'];
}
		
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'WP LOL Rotation', 'wpb_widget_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
}

function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
add_shortcode('rotation', 'lolrotation_shortcode');
?>