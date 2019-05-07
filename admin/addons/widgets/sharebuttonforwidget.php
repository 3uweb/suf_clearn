<?php
if ( !class_exists( 'Suf_Widget_Layout_Builder' ) ) {
    return;
}
/**
 * Class Thim_Widget_Layout_Builder.
 *
 * @since 0.8.2
 */
class Suf_Widget_ShareLink extends WP_Widget {
    /**
     * @var string
     *
     * @since 0.8.2
     */
    private static $id_base_ = null;

    /**
     * Thim_Widget_Layout_Builder constructor.
     *
     * @since 0.8.2
     */
    function __construct() {
        parent::__construct( false, __( 'Suf Share Buttons', 'suf-lang' ) );
        add_action('wp_enqueue_scripts', array($this, 'suf_custom_styles'), 1);
    }


    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
        echo __( 'Hello, World!', 'wpb_widget_domain' );
        echo $args['after_widget'];
    }

// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'wpb_widget_domain' );
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
    public function suf_custom_styles()
    {

        /*Enqueue The Styles*/
        wp_enqueue_style('suf-cssgroup-widget-sharelink', __SUFPLUGINURI__ . '/assets/css/share-link.css', false, SUF_ADDONS_VERSION, 'screen, print');
    }
}
function Suf_Widget_ShareLink_Reg() {
    register_widget( 'Suf_Widget_ShareLink' );
}
add_action( 'widgets_init', 'Suf_Widget_ShareLink_Reg');