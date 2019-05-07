<?php
if (!class_exists('Suf_Widget_ShareLink')) {
    return;
}

/**
 * Class Thim_Widget_Layout_Builder.
 *
 * @since 0.8.2
 */
class Suf_Widget_ShareLink extends WP_Widget
{
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
    function __construct()
    {
        parent::__construct(false, __('Suf Share Buttons', 'suf-lang'));
        add_action('wp_enqueue_scripts', array($this, 'suf_custom_styles_sharelink'), 1);
    }


    public function widget($args, $instance)
    {

        $title                   = apply_filters('widget_title', $instance['title']);
        $suf_sharelink_facebook  = (!empty($instance['suf_sharelink_facebook'])) ? esc_attr($instance['suf_sharelink_facebook']) : '';
        $suf_sharelink_twitter   = (!empty($instance['suf_sharelink_twitter'])) ? esc_attr($instance['suf_sharelink_twitter']) : '';
        $suf_sharelink_google    = (!empty($instance['suf_sharelink_google'])) ? esc_attr($instance['suf_sharelink_google']) : '';
        $suf_sharelink_instagram = (!empty($instance['suf_sharelink_instagram'])) ? esc_attr($instance['suf_sharelink_instagram']) : '';
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        if (!empty($suf_sharelink_facebook))
                echo '<a href="' . $suf_sharelink_facebook . '" class="suf_sharelink_link suf_sharelink_facebook sufshare-social-facebook" target="_blank"></a>';
        if (!empty($suf_sharelink_twitter))
                echo '<a href="' . $suf_sharelink_twitter . '" class="suf_sharelink_link suf_sharelink_twitter sufshare-social-twitter" target="_blank"></a>';
        if (!empty($suf_sharelink_google))
                echo '<a href="' . $suf_sharelink_google . '" class="suf_sharelink_link suf_sharelink_google sufshare-social-googleplus" target="_blank"></a>';
        if (!empty($suf_sharelink_instagram))
                echo '<a href="' . $suf_sharelink_instagram . '" class="suf_sharelink_link suf_sharelink_instagram sufshare-social-instagram-outline" target="_blank"></a>';
//        echo __('Hello, World!', 'wpb_widget_domain');
        echo $args['after_widget'];
    }

// Widget Backend
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('');
        }
        $suf_sharelink_facebook  = (!empty($instance['suf_sharelink_facebook'])) ? esc_attr($instance['suf_sharelink_facebook']) : '';
        $suf_sharelink_twitter   = (!empty($instance['suf_sharelink_twitter'])) ? esc_attr($instance['suf_sharelink_twitter']) : '';
        $suf_sharelink_google    = (!empty($instance['suf_sharelink_google'])) ? esc_attr($instance['suf_sharelink_google']) : '';
        $suf_sharelink_instagram = (!empty($instance['suf_sharelink_instagram'])) ? esc_attr($instance['suf_sharelink_instagram']) : '';
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('suf_sharelink_facebook'); ?>"><?php _e('Facebook:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('suf_sharelink_facebook'); ?>"
                   name="<?php echo $this->get_field_name('suf_sharelink_facebook'); ?>" type="text"
                   value="<?php echo esc_attr($suf_sharelink_facebook); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('suf_sharelink_twitter'); ?>"><?php _e('Twitter:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('suf_sharelink_twitter'); ?>"
                   name="<?php echo $this->get_field_name('suf_sharelink_twitter'); ?>" type="text"
                   value="<?php echo esc_attr($suf_sharelink_twitter); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('suf_sharelink_google'); ?>"><?php _e('Google+:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('suf_sharelink_google'); ?>"
                   name="<?php echo $this->get_field_name('suf_sharelink_google'); ?>" type="text"
                   value="<?php echo esc_attr($suf_sharelink_google); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('suf_sharelink_instagram'); ?>"><?php _e('Instagram:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('suf_sharelink_instagram'); ?>"
                   name="<?php echo $this->get_field_name('suf_sharelink_instagram'); ?>" type="text"
                   value="<?php echo esc_attr($suf_sharelink_instagram); ?>"/>
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance                            = array();
        $instance['title']                   = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['suf_sharelink_facebook']  = (!empty($new_instance['suf_sharelink_facebook'])) ? strip_tags($new_instance['suf_sharelink_facebook']) : '';
        $instance['suf_sharelink_twitter']   = (!empty($new_instance['suf_sharelink_twitter'])) ? strip_tags($new_instance['suf_sharelink_twitter']) : '';
        $instance['suf_sharelink_google']    = (!empty($new_instance['suf_sharelink_google'])) ? strip_tags($new_instance['suf_sharelink_google']) : '';
        $instance['suf_sharelink_instagram'] = (!empty($new_instance['suf_sharelink_instagram'])) ? strip_tags($new_instance['suf_sharelink_instagram']) : '';
        return $instance;
    }

    public function suf_custom_styles_sharelink()
    {
        /*Enqueue The Styles*/
        wp_enqueue_style('suf-cssgroup-widget-sharelink', __SUFPLUGINURI__ . '/assets/css/share-link.css', false, SUF_ADDONS_VERSION, 'screen, print');

    }
}

function Suf_Widget_ShareLink_Reg()
{
    register_widget('Suf_Widget_ShareLink');
}

add_action('widgets_init', 'Suf_Widget_ShareLink_Reg');