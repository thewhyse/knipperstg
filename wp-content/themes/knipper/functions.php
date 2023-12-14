<?php

/* // Remove p tags from category description
remove_filter('term_description', 'wpautop');
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

function remove_default_p_tags($content)
{
    $content = str_replace('<p>', '', $content);
    $content = str_replace('</p>', '', $content);
    return $content;
}
add_filter('the_content', 'remove_default_p_tags'); */

// WordPress Admin CSS
function admin_style()
{
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/adminstyles.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

// WordPress old CSS
function knipper_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'knipper_enqueue_styles');

if (!function_exists('et_get_safe_localization')) {

    function et_get_safe_localization($string)
    {
        return wp_kses($string, et_get_allowed_localization_html_elements());
    }
}
if (!function_exists('et_get_safe_localization')) {

    function et_get_safe_localization($string)
    {
        return wp_kses($string, et_get_allowed_localization_html_elements());
    }
}
if (!function_exists('et_get_allowed_localization_html_elements')) {

    function et_get_allowed_localization_html_elements()
    {
        $whitelisted_attributes = array(
            'id'    => array(),
            'class' => array(),
            'style' => array(),
        );

        $whitelisted_attributes = apply_filters('et_allowed_localization_html_attributes', $whitelisted_attributes);

        $elements = array(
            'a'      => array(
                'href'   => array(),
                'title'  => array(),
                'target' => array(),
            ),
            'b'      => array(),
            'em'     => array(),
            'p'      => array(),
            'span'   => array(),
            'div'    => array(),
            'strong' => array(),
        );

        $elements = apply_filters('et_allowed_localization_html_elements', $elements);

        foreach ($elements as $tag => $attributes) {
            $elements[$tag] = array_merge($attributes, $whitelisted_attributes);
        }

        return $elements;
    }
}
if (!function_exists('et_load_core_options')) {

    function et_load_core_options()
    {
        $options = require_once(get_stylesheet_directory() . esc_attr("/panel_options.php"));
    }
    add_action('init', 'et_load_core_options', 777);
}
if (!function_exists('et_load_core_options')) {

    function et_load_core_options()
    {
        $options = require_once(get_stylesheet_directory() . esc_attr("/panel_options.php"));
    }
    add_action('init', 'et_load_core_options', 888);
}
// Register & Enqueue all CSS & JS
function knipper_assets()
{
    wp_register_style('knipper-stylesheet', get_theme_file_uri() . '/dist/css/bundle.css', array(), '1.0.0', 'all');
    wp_enqueue_style('knipper-stylesheet');
    wp_enqueue_script('knipper_js', get_theme_file_uri() . '/dist/js/bundle.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('custom_js', get_stylesheet_directory_uri() . '/knipper.js', array(), '1.0.0', true);
    wp_enqueue_script('mobile_menu_js', get_stylesheet_directory_uri() . '/mobile-menu.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'knipper_assets', 999);
/**
 * Gravity Forms: Form Validation.
 *
 * The below looks for the words 'http' and 'https' upon after the user tries to submit the form.
 * During form validation, if the words appear within the form, the form will not submit.
 * The user will then be presented with a custom, informative, and actionable message.
 *
 * @link https://docs.gravityforms.com/gform_field_validation
 * @param array  $result The validation result to be filtered.
 * @param string $value The field value to be validated. Multi-input fields like Address will pass an array of values.
 * @param object $form Current form object.
 * @param object $field Current field object.
 */
function em_disable_urls_validation($result, $value, $form, $field)
{

    $pattern = '(http|https|www)'; // Looks for http and https.
    if (preg_match($pattern, $value)) {
        $result['is_valid'] = false;
        $result['message']  = 'Field cannot contain website addresses.';
    }

    if ('name' === $field->type) {
        $name_pattern = '(http|https|www|.ru|.net|.com|.edu)'; // Looks for a pattern.

        // Input values.
        $prefix = rgar($value, $field->id . '.2');
        $first  = rgar($value, $field->id . '.3');
        $middle = rgar($value, $field->id . '.4');
        $last   = rgar($value, $field->id . '.6');
        $suffix = rgar($value, $field->id . '.8');

        if (
            !empty($prefix) && !$field->get_input_property('2', 'isHidden') && preg_match($name_pattern, $prefix)
            || !empty($first) && !$field->get_input_property('3', 'isHidden') && preg_match($name_pattern, $first)
            || !empty($middle) && !$field->get_input_property('4', 'isHidden') && preg_match($name_pattern, $middle)
            || !empty($last) && !$field->get_input_property('6', 'isHidden') && preg_match($name_pattern, $last)
            || !empty($suffix) && !$field->get_input_property('8', 'isHidden') && preg_match($name_pattern, $suffix)
        ) {
            $result['is_valid'] = false;
            $result['message']  = empty($field->errorMessage) ? __('Fields cannot contain website addresses.', 'gravityforms') : $field->errorMessage;
        } else {
            $result['is_valid'] = true;
            $result['message']  = '';
        }
    }

    return $result;
}
add_filter('gform_field_validation', 'em_disable_urls_validation', 10, 4);

// Add HotJar script to page head
function hotjar_javascript()
{
?>
    <!-- Hotjar Tracking Code for https://knipper.com/ Start -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj =
                h.hj ||
                function() {
                    (h.hj.q = h.hj.q || []).push(arguments);
                };
            h._hjSettings = {
                hjid: 3469432,
                hjsv: 6
            };
            a = o.getElementsByTagName("head")[0];
            r = o.createElement("script");
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, "https://static.hotjar.com/c/hotjar-", ".js?sv=");
    </script>
    <!-- Hotjar Tracking Code for https://knipper.com/ End -->
<?php
}
add_action('wp_head', 'hotjar_javascript');

// Add Google Analytics script to page head
function ganalytics_javascript()
{
?>
    <!-- Start of Google Analytics Embed Code -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-204881422-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());
        gtag("config", "UA-204881422-1");
    </script>
    <!-- End of Google Analytics Embed Code -->
<?php
}
add_action('wp_head', 'ganalytics_javascript');

// Add Dealfront tracking script to page head
function dealfront_javascript()
{
?>
    <!-- Start of Dealfront Embed Code -->
    <script>
        (function(ss, ex) {
            window.ldfdr = window.ldfdr || function() {
                (
                    ldfdr._q = ldfdr._q || []).push([].slice.call(arguments));
            };
            (function(d, s) {
                fs = d.getElementsByTagName(s)[0];

                function ce(src) {
                    var cs = d.createElement(s);
                    cs.src = src;
                    cs.async = 1;
                    fs.parentNode.insertBefore(cs, fs);
                };
                ce('https://sc.lfeeder.com/lftracker_v1_' + ss + (ex ? '_' + ex : '') + '.js');
            })(document, 'script');
        })('ywVkO4XbE218Z6Bj');
    </script>
    <!-- End of Dealfront Embed Code -->
<?php
}
add_action('wp_head', 'dealfront_javascript');

// Add Google Tag Manager script to page head
function gtag_manager_javascript()
{
?>
    <!-- Start of Google Analytics Embed Code -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-5DNZT65");
    </script>
    <script>
        (function() {
            var zi = document.createElement("script");
            zi.type = "text/javascript";
            zi.async = true;
            zi.referrerPolicy = "unsafe-url";
            zi.src = "https://ws.zoominfo.com/pixel/62b0919c474437008fafe0a3";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(zi, s);
        })();
    </script>
    <!-- End of Google Tag Manager Embed Code -->
<?php
}
add_action('wp_head', 'gtag_manager_javascript');

function knipper_script_footer()
{
?>
    <script type='text/javascript'>
        piAId = '1019512';
        piCId = '';
        piHostname = 'www8.knipper.com';

        (function() {
            function async_load() {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + piHostname + '/pd.js';
                var c = document.getElementsByTagName('script')[0];
                c.parentNode.insertBefore(s, c);
            }
            if (window.attachEvent) {
                window.attachEvent('onload', async_load);
            } else {
                window.addEventListener('load', async_load, false);
            }
        })();
    </script>
<?php
}
add_action('wp_footer', 'knipper_script_footer', 20);
