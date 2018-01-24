<?php
/*
Plugin Name: HFF Recent Post List
Description: Displays a list of your latest posted articles.
Version: 0.1
Author: Julian Tapping
*/

class HFFRecentPostsWidget extends WP_Widget {
    function HFFRecentPostsWidget() {
        parent::WP_Widget(false, $name = 'HFF Recent Posts');	
    }

 
function form($instance) {				
        $title = esc_attr($instance['title']);
        $dis_posts = esc_attr($instance['dis_posts']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
     		<p><label for="<?php echo $this->get_field_id('dis_posts'); ?>"><?php _e('Number of Posts Displayed:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('dis_posts'); ?>" name="<?php echo $this->get_field_name('dis_posts'); ?>" type="text" value="<?php echo $dis_posts; ?>" /></label></p>
        <?php 
    }

 
function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $dis_posts = $instance['dis_posts'];
    ?>
      <?php echo $before_widget; ?>
         <?php if ( $title )
            echo $before_title . $title . $after_title; ?>

			<ul>
			    <?php
			        global $post;
			        $args = array( 'numberposts' => $dis_posts);
			        $myposts = get_posts( $args );
			        foreach( $myposts as $post ) : setup_postdata($post); ?>
			        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			        <?php endforeach; ?>
			</ul>

         <?php echo $after_widget; ?>
<?php
    }
}
?>
 
<?php add_action('widgets_init', create_function('', 'return register_widget("HFFRecentPostsWidget");')); ?>