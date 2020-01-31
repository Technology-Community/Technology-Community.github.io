<?php
require_once TAGDIV_ROOT_DIR . '/includes/wp-booster/wp-admin/tagdiv-view-header.php';

//require_once TEMPLATEPATH . '/includes/demos/blog_baby/td_import.php';
//die;
/*

td_demo_widgets::remove();
td_demo_widgets::add_sidebar('td_demo_xxx');


td_demo_content::remove();
td_demo_content::add_page(array(
    'title' => 'About Me',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/about.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php
    'td_layout' => '',
    'homepage' => false,
    'sidebar_id' => 'td_demo_xxx'
));
*/
/*
td_demo_content::remove();
$td_aboutme_id = td_demo_content::add_page(array(
    'title' => 'About Me',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/about.txt',
    'template' => 'page-pagebuilder-title.php',   // the page template full file name with .php
    'td_layout' => '',
    'homepage' => false,
    'sidebar_position' => 'no_sidebar'
));
*/
/*
td_demo_media::remove();
td_demo_content::remove();
td_demo_media::add_image_to_media_gallery('td_pic_1',                   "http://td_cake.themesafe.com/Newspaper_6/blog/1.jpg");
$td_aboutme_id = td_demo_content::add_page(array(
    'title' => 'About Me',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/about.txt',
    'template' => 'page-pagebuilder-title.php',   // the page template full file name with .php
    'td_layout' => '',
    'homepage' => false
));
*/
/*
td_demo_content::remove();
td_demo_content::add_post(array(
    'title' => 'Are You Already Wearing the Hottest Brands in Your City?',
    'file' => td_global::$get_template_directory . '/includes/demos/video/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT)),
    'featured_image_td_id' => 'td_pic_1',
    'featured_video_url' => 'https://www.youtube.com/watch?v=rVeMiVU77wo&list=RD1FH-q0I1fJY&index=4',
    'template' => 'single_template_10',
    'post_format' => 'video'
));
*/
/*
td_demo_widgets::remove();

td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
    array (
        'spot_title' => '- Advertisement -',
        'spot_id' => 'sidebar'
    )
);


die;
/*
td_demo_content::remove();
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Newseeeeeeeexxxx',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php
    'homepage' => true,
    'td_layout' => 5
));

die;
*/
/*
if (isset($_GET['puiu_test']) and TD_DEPLOY_MODE == 'dev') {
    // clean the user settings
    //td_demo_media::remove();
    td_demo_content::remove();
    td_demo_category::remove();
    td_demo_menus::remove();
    td_demo_widgets::remove();


    $td_demo_installer = new td_demo_installer();

    // remove panel settings and recompile the css as empty
    foreach (td_global::$td_options as $option_id => $option_value) {
        td_global::$td_options[$option_id] = '';
    }
    //typography settings
    td_global::$td_options['td_fonts'] = '';
    //css font files (google) buffer
    td_global::$td_options['td_fonts_css_files'] = '';
    //compile user css if any
    td_global::$td_options['tds_user_compile_css'] = td_css_generator();
    update_option(TD_THEME_OPTIONS_NAME, td_global::$td_options);

    td_demo_state::update_state($_GET['puiu_test'], 'full');

    // load panel settings
    $td_demo_installer->import_panel_settings(td_global::$demo_list[$_GET['puiu_test']]['folder'] . 'td_panel_settings.txt');
    // load the media import script
    //require_once(td_global::$demo_list[$td_demo_id]['folder'] . 'td_media_1.php');
    require_once(td_global::$demo_list[$_GET['puiu_test']]['folder'] . 'td_import.php');

}
*/

?>

<div class=" about-wrap td-admin-wrap theme-browser">
    <h1><?php echo TD_THEME_NAME ?> demos</h1>
    <div class="about-text">
        <p>
            <?php echo TD_THEME_NAME ?> brings you a number of unique designs for your website. Our demos were carefully tested so you don’t have to create everything from scratch.  With the theme demos you know exactly which predefined template is perfectly designed to start building upon. Each demo is fully customizable (fonts, colors and layouts) -
            <a href="<?php echo TD_THEME_DEMO_DOC_URL?>" target="_blank">read more</a>.
        </p>
    </div>


	<?php if (td_api_features::is_enabled('require_vc') && !class_exists('Vc_Manager', false)) { ?>
		<div class="td-admin-box-text td-admin-required-plugins">
			<div class="td-admin-required-plugins-wrap">
                <p><strong>Please install and activate the WPBakery Page Builder plugin - </strong> WPBakery Page Builder is a required plugin for this theme to work best.</p>
                <a class="button button-primary" href="admin.php?page=td_theme_plugins">Go to plugin installer</a>
			</div>
		</div>
	<?php } ?>


    <?php if (td_api_features::is_enabled('require_td_composer') && !td_util::tdc_is_installed()) { ?>
		<div class="td-admin-box-text td-admin-required-plugins">
			<div class="td-admin-required-plugins-wrap">
                <p><strong>Please install and activate the tagDiv Composer plugin - </strong> Our plugin is required for this theme to work best.</p>
                <a class="button button-primary" href="admin.php?page=td_theme_plugins">Go to plugin installer</a>
			</div>
		</div>
	<?php } ?>
    <hr/>

    <div class="td-demo-page-content">

        <div class="td-admin-columns td-install-demos">
            <?php

            $installed_demo = td_demo_state::get_installed_demo();
            $td_demo_names = array();
            $td_demo_names_with_req_plugins = array();
            $td_demo_with_plugins_list = array();

            $plugin_list = array();

            foreach ( tagdiv_global::$theme_plugins_list as $plugin ) {
                $plugin_list[ $plugin['name'] ] = $plugin[ 'td_class' ];
            }

            foreach ( td_global::$demo_list as $demo_id => $stack_params ) {
                $td_demo_names[$stack_params['text']] = $demo_id;

                $tmp_class = '';
                if ( $installed_demo !== false and $installed_demo['demo_id'] == $demo_id ) {
                    $tmp_class = 'td-demo-installed';
                }

                $demo_required_plugins_array = array();
                $demo_req_plugin_class = '';

                if ( !empty ($stack_params['required_plugins']) ) {

                    foreach ( $stack_params['required_plugins'] as $demo_req_plugin ) {

                        if ( isset( $plugin_list[ $demo_req_plugin ] ) && ! class_exists( $plugin_list[ $demo_req_plugin ], false) ) {
                            $demo_required_plugins_array[] = $demo_req_plugin;
                        }
                    }

                    if ( !empty ($demo_required_plugins_array) ) {
                        $demo_req_plugin_class = 'td-demo-req-plugins-disabled';
                        $td_demo_names_with_req_plugins[] = $stack_params['text'];
                        $td_demo_with_plugins_list[$demo_id] =  $demo_required_plugins_array;
                    }
                }

                ?>

                <div class="td-demo-<?php echo esc_attr( $demo_id ) ?> td-wp-admin-demo theme <?php echo esc_attr( $tmp_class . ' ' . $demo_req_plugin_class ) ?>">

                    <!-- Import content -->
                    <div class="theme-screenshot">
                        <div class="td-progress-bar-wrap"><div class="td-progress-bar"></div></div>
                        <img class="td-demo-thumb" src="<?php echo td_global::$demo_list[$demo_id]['img'] ?>"/>
                    </div>

                    <div class="td-demo-meta">
                        <div class="td-admin-title">
                            <h3 class="theme-name"><?php printf( '%1$s', $stack_params['text'] ) ?></h3>
                        </div>

                        <div class="theme-actions">
                            <a class="button button-secondary td-button-demo-preview" href="<?php echo td_global::$demo_list[$demo_id]['demo_url'] ?>" target="_blank">Preview</a>
                            <?php
                            // check if we have all the required plugins
                            if ( empty( $demo_required_plugins_array )) {
	                            ?>
                                <a class="button button-secondary td-button-install-demo" href="#" data-demo-id="<?php echo esc_attr( $demo_id ) ?>">Install</a>
	                            <?php
                            } else {
	                            $plugins_list_html = '';
	                            $plugins_list_html .= '<h3>' . $stack_params['text'] . ' demo info:</h3>';
	                            $plugins_list_html .= '<span>For this demo to work properly you will need to install and activate the following theme plugins:</span>';
	                            $plugins_list_html .= '<ul>';

	                            foreach ( $demo_required_plugins_array as $demo_req_plugin ) {
		                            $plugins_list_html .= '<li><span>' . $demo_req_plugin . '</span></li>';
	                            }

	                            $plugins_list_html .= '</ul>';

	                            echo '<a href="#" class="button button-secondary td-tooltip td-req-demo-disabled disabled" data-position="right" data-content-as-html="true" title="' . esc_attr($plugins_list_html) . '">Install</a>';

                            }
                            ?>
                            <a class="button button-primary td-button-uninstall-demo" href="#" data-demo-id="<?php echo esc_attr( $demo_id ) ?>">Uninstall</a>
                            <a class="button button-primary disabled td-button-installing-demo" href="#" data-demo-id="<?php echo esc_attr( $demo_id ) ?>">Installing...</a>
                            <a class="button button-secondary disabled td-button-demo-disabled" href="#">Install</a>
                            <a class="button button-primary disabled td-button-uninstalling-demo" href="#" data-demo-id="<?php echo esc_attr( $demo_id ) ?>">Uninstalling...</a>
                        </div>

                        <div class="td-admin-checkbox td-small-checkbox">
                            <div class="td-demo-install-content">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_import_theme_styles',
                                    'option_id' => 'td_import_menus',
                                    'true_value' => '',
                                    'false_value' => 'no'
                                ));
                                ?>
                                <p>Include content</p>
                            </div>
                            <p class="td-installed-text">
                                <?php
                                if (!empty(td_global::$demo_list[$demo_id]['demo_installed_text'])) {
                                    echo td_global::$demo_list[$demo_id]['demo_installed_text'];
                                } else {
                                    echo 'Demo installed!';
                                }
                                ?>
                            </p>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>

        <div class="td-demos-summary">
            <span>Quick Install</span>
            <ul>
                <?php
                ksort($td_demo_names);

                foreach ($td_demo_names as $td_name => $demo_id) {

	                $tmp_class = '';
                    $plugins_list_html= '';

	                if ( $installed_demo !== false and $installed_demo['demo_id'] == $demo_id ) {
		                $tmp_class = 'td-demo-installed';
	                }

                    if ( in_array($td_name, $td_demo_names_with_req_plugins)) {
                        $tmp_class = $tmp_class . ' td-req-demo-disabled';
                    }

                    if ( array_key_exists($demo_id, $td_demo_with_plugins_list)) {
                        $plugins_list_html = '';
                        $plugins_list_html .= '<h3>' . $td_name . ' demo info:</h3>';
                        $plugins_list_html .= '<span>For this demo to work properly you will need to install and activate the following theme plugins:</span>';
                        $plugins_list_html .= '<ul>';

                        foreach ( $td_demo_with_plugins_list[$demo_id] as $plugin_name ) {
                            $plugins_list_html .= '<li><span>' . $plugin_name . '</span></li>';
                        }
                        echo '<li><a class="td-wp-admin-demo td-demo-' . $demo_id . ' td-button-install-demo-quick ' . $tmp_class . ' td-tooltip" data-demo-id="'. $demo_id . '" href="#" title="' . $plugins_list_html . '" data-position="right" data-content-as-html="true">' . $td_name . '</a></li>';
                    } else {
                        echo '<li><a class="td-wp-admin-demo td-demo-' . $demo_id . ' td-button-install-demo-quick ' . $tmp_class . '" data-demo-id="'. $demo_id . '" href="#">' . $td_name . '</a></li>';
                    }
                }?>
            </ul>
        </div>
    </div>

</div>


