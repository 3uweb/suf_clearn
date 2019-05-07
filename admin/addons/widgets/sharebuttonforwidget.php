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
    private $twitter_icon;
    private $facebook_icon;
    private $google_icon;
    private $instagram_icon;

    /**
     * Thim_Widget_Layout_Builder constructor.
     *
     * @since 0.8.2
     */
    function __construct()
    {
        parent::__construct(false, __('Suf Share Buttons', 'suf-lang'));
        add_action('wp_enqueue_scripts', array($this, 'suf_custom_styles_sharelink'), 1);
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_footer-widgets.php', array($this, 'print_scripts'), 9999);
    }


    public function widget($args, $instance)
    {

        $title                   = apply_filters('widget_title', $instance['title']);
        $color                   = (!empty($instance['color'])) ? $instance['color'] : '#fff';
        $suf_sharelink_facebook  = (!empty($instance['suf_sharelink_facebook'])) ? esc_attr($instance['suf_sharelink_facebook']) : '';
        $suf_sharelink_twitter   = (!empty($instance['suf_sharelink_twitter'])) ? esc_attr($instance['suf_sharelink_twitter']) : '';
        $suf_sharelink_google    = (!empty($instance['suf_sharelink_google'])) ? esc_attr($instance['suf_sharelink_google']) : '';
        $suf_sharelink_instagram = (!empty($instance['suf_sharelink_instagram'])) ? esc_attr($instance['suf_sharelink_instagram']) : '';
        $this->suf_sharelink_icondata($color);
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        if (!empty($suf_sharelink_facebook))
            if (!empty($this->facebook_icon))
                echo '<a href="' . $suf_sharelink_facebook . '" class="suf_sharelink_link suf_sharelink_facebook" target="_blank"><img src=\'data:image/svg+xml;utf8,' . $this->facebook_icon . '\'></a>';
        if (!empty($suf_sharelink_twitter))
            if (!empty($this->twitter_icon))
                echo '<a href="' . $suf_sharelink_twitter . '" class="suf_sharelink_link suf_sharelink_twitter" target="_blank"><img src=\'data:image/svg+xml;utf8,' . $this->twitter_icon . '\'></a>';
        if (!empty($suf_sharelink_google))
            if (!empty($this->google_icon))
                echo '<a href="' . $suf_sharelink_google . '" class="suf_sharelink_link suf_sharelink_google" target="_blank"><img src=\'data:image/svg+xml;utf8,' . $this->google_icon . '\'></a>';
        if (!empty($suf_sharelink_instagram))
            if (!empty($this->instagram_icon))
                echo '<a href="' . $suf_sharelink_instagram . '" class="suf_sharelink_link suf_sharelink_instagram" target="_blank"><img src=\'data:image/svg+xml;utf8,' . $this->instagram_icon . '\'></a>';
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
        $color                   = (!empty($instance['color'])) ? $instance['color'] : '#fff';
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
            <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color:'); ?></label><br>
            <input type="text" name="<?php echo $this->get_field_name('color'); ?>" class="color-picker"
                   id="<?php echo $this->get_field_id('color'); ?>" value="<?php echo $color; ?>"
                   data-default-color="#fff"/>
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
        $instance['color']                   = strip_tags($new_instance['color']);
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

    public function enqueue_scripts($hook_suffix)
    {
        if ('widgets.php' !== $hook_suffix) {
            return;
        }

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('underscore');
    }

    public function print_scripts()
    {
        ?>
        <script>
            (function ($) {
                function initColorPicker(widget) {
                    widget.find('.color-picker').wpColorPicker({
                        change: _.throttle(function () { // For Customizer
                            $(this).trigger('change');
                        }, 3000)
                    });
                }

                function onFormUpdate(event, widget) {
                    initColorPicker(widget);
                }

                $(document).on('widget-added widget-updated', onFormUpdate);

                $(document).ready(function () {
                    $('#widgets-right .widget:has(.color-picker)').each(function () {
                        initColorPicker($(this));
                    });
                });
            }(jQuery));
        </script>
        <?php
    }

    public function suf_sharelink_icondata($color = 'gray', $target = null)
    {
        $twitter = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><defs><style>.a{fill:' . $color . ';}</style></defs><title>twitter</title><path class="a" d="M43.61,17c0,.4,0,.79,0,1.18,0,12-9.14,25.85-25.84,25.85A25.64,25.64,0,0,1,3.84,39.92,17.55,17.55,0,0,0,6,40a18.17,18.17,0,0,0,11.28-3.88,9.09,9.09,0,0,1-8.49-6.3,10.66,10.66,0,0,0,1.71.14,9.43,9.43,0,0,0,2.39-.31,9.08,9.08,0,0,1-7.28-8.91v-.11a9.24,9.24,0,0,0,4.1,1.15,9.1,9.1,0,0,1-4-7.57A9,9,0,0,1,6.93,9.66a25.86,25.86,0,0,0,18.73,9.51,10.37,10.37,0,0,1-.22-2.09,9.09,9.09,0,0,1,15.72-6.21,17.77,17.77,0,0,0,5.76-2.19,9,9,0,0,1-4,5,18.37,18.37,0,0,0,5.23-1.4A19.48,19.48,0,0,1,43.61,17Z"/></svg>';

        $facebook = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><defs><style>.a{fill:' . $color . ';}</style></defs><title>facebook</title><path class="a" d="M31.89,14h3.39V8.25A47.48,47.48,0,0,0,30.35,8c-4.89,0-8.24,3-8.24,8.46v5H16.72v6.4h5.39V44h6.61V27.9H33.9l.82-6.4h-6V17.09c0-1.85.51-3.11,3.17-3.11Z"/></svg>';

        $instagram = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><defs><style>.a{fill:' . $color . ';}</style></defs><title>imstagram</title><path class="a" d="M26,16.77A9.23,9.23,0,1,0,35.23,26,9.22,9.22,0,0,0,26,16.77ZM26,32a6,6,0,1,1,6-6,6,6,0,0,1-6,6ZM37.76,16.39a2.15,2.15,0,1,1-2.15-2.15A2.15,2.15,0,0,1,37.76,16.39Zm6.12,2.19c-.14-2.89-.8-5.44-2.91-7.55s-4.66-2.76-7.54-2.9S21.55,8,18.57,8.13,13.14,8.92,11,11s-2.76,4.66-2.91,7.54S8,30.45,8.12,33.42,8.92,38.86,11,41s4.66,2.76,7.54,2.9,11.88.17,14.86,0S38.86,43.08,41,41s2.76-4.66,2.91-7.55.17-11.87,0-14.84ZM40,36.61A6.06,6.06,0,0,1,36.62,40c-2.37.94-8,.73-10.62.73S17.75,41,15.39,40A6.06,6.06,0,0,1,12,36.61c-.94-2.37-.72-8-.72-10.61S11,17.75,12,15.39A6.06,6.06,0,0,1,15.39,12c2.37-.94,8-.73,10.61-.73S34.25,11,36.62,12A6.09,6.09,0,0,1,40,15.39c.94,2.37.72,8,.72,10.61S41,34.25,40,36.61Z"/></svg>';

        $google = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><defs><style>.a{fill:' . $color . ';}</style></defs><title>googleplus</title><path class="a" d="M36.89,23.42a15.49,15.49,0,0,1,.29,3C37.18,36.71,30.28,44,19.89,44a18,18,0,0,1,0-36A17.21,17.21,0,0,1,32,12.71l-4.89,4.7a10.08,10.08,0,0,0-7.17-2.78,11.37,11.37,0,0,0,0,22.74c7.12,0,9.8-5.13,10.22-7.76H19.89V23.42Zm8-8.78V9.41H39.63v5.23H34.41v5.25h5.22v5.22h5.25V19.89h5.23V14.64Z"/></svg>';

        switch ($target) {
            case 'twitter':
                $this->twitter_icon = $twitter;
                break;
            case 'facebook':
                $this->facebook_icon = $facebook;
                break;
            case 'instagram':
                $this->instagram_icon = $instagram;
                break;
            case 'google':
                $this->google_icon = $google;
                break;
            default:
                $this->facebook_icon  = $facebook;
                $this->twitter_icon   = $twitter;
                $this->instagram_icon = $instagram;
                $this->google_icon = $google;
                break;
        }
    }
}

function Suf_Widget_ShareLink_Reg()
{
    register_widget('Suf_Widget_ShareLink');
}

add_action('widgets_init', 'Suf_Widget_ShareLink_Reg');