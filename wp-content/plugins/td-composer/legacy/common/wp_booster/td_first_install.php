<?php

/**
 * This setup runs just on first theme installation
 */
function td_first_install_setup() {

	$td_isFirstInstall = td_util::get_option('firstInstall' );

	if ( empty( $td_isFirstInstall ) ) {

		td_options::update('firstInstall', 'themeInstalled' );
		td_options::update('td_log_status', 'off' );

		/*
         * add the theme featured category
         */
		wp_insert_term( 'Featured', 'category', array(
			'description' => 'Featured posts',
			'slug' => 'featured',
			'parent' => 0
		));

		// bulk enable all the theme thumbs!
		$td_theme_thumbs = td_api_thumb::get_all();
		foreach ( $td_theme_thumbs as $td_theme_thumb_id => $td_theme_thumb_params ) {
			td_options::update('tds_thumb_' . $td_theme_thumb_id, 'yes' );
		}
	}
}
td_first_install_setup();

function td_remove_googleplus_social() {
	$social_drag_and_drop = td_options::get_array('td_social_drag_and_drop');

	if (array_key_exists('googleplus', $social_drag_and_drop)) {
		unset($social_drag_and_drop['googleplus']);
	}

	$td_social_networks = td_options::get_array('td_social_networks');
	if (array_key_exists('googleplus', $td_social_networks)) {
		unset($td_social_networks['googleplus']);
	}

	td_options::update_array('td_social_drag_and_drop', $social_drag_and_drop);
	td_options::update_array('td_social_networks', $td_social_networks);

}
td_remove_googleplus_social();

function td_add_new_social_network() {
	$social_drag_and_drop = td_options::get_array('td_social_drag_and_drop');

	if ($social_drag_and_drop != '' && array_key_exists('naver', $social_drag_and_drop) != true) {
		$social_drag_and_drop += array('naver' => '');
	}

	td_options::update_array('td_social_drag_and_drop', $social_drag_and_drop);
}
td_add_new_social_network();

function td_theme_migration() {
	$td_db_version = td_util::get_option('td_version');


	// update TO version 8.6 - add social networks
    // @since 14.12.2017
	if (version_compare($td_db_version, '8.6', '<') || TD_DEPLOY_MODE == 'dev') {
	    $social_drag_and_drop = td_options::get('td_social_drag_and_drop');
        if ($social_drag_and_drop == '') {
            td_options::update_array('td_social_drag_and_drop', array (
                'facebook'      => true,
                'twitter'       => true,
                'pinterest'     => true,
                'whatsapp'      => true,
                'linkedin'      => '',
                'reddit'        => '',
                'mail'          => '',
                'print'         => '',
                'tumblr'        => '',
                'telegram'      => '',
                'stumbleupon'   => '',
                'vk'            => '',
                'digg'          => '',
                'line'          => '',
                'viber'         => '',
				'naver'         => ''
			));
        }
    }


    // empty -> any version older version - probably 6?
	if (empty($td_db_version)) {

		// wp_parse_args format
		$args = array(
			'post_type' => array('page', 'post'),
			'numberposts' => '200',
			'orderby' => 'post_date',
			'order' => 'DESC',

			'meta_query' => array(
				'relation' => 'OR',
				array('key' => 'td_homepage_loop_filter'),
				array('key' => 'td_unique_articles'),
				array('key' => 'td_smart_list'),
				array('key' => 'td_review')
			),
			'update_post_term_cache' => false,
		);

		$recent_posts = wp_get_recent_posts($args);

		foreach ($recent_posts as $recent_post) {

			// page settings
			$update_td_homepage_loop = false;
			$td_homepage_loop = td_util::get_post_meta_array($recent_post['ID'], 'td_homepage_loop');
			$td_page = td_util::get_post_meta_array($recent_post['ID'], 'td_page');
			$td_homepage_loop_filter = td_util::get_post_meta_array($recent_post['ID'], 'td_homepage_loop_filter');
			$td_unique_articles = td_util::get_post_meta_array($recent_post['ID'], 'td_unique_articles');

			if (!empty($td_homepage_loop_filter) and is_array($td_homepage_loop_filter) and (count($td_homepage_loop_filter) > 0)) {
				foreach ($td_homepage_loop_filter[0] as $filter_key => $filter_value) {
					$td_homepage_loop[0][$filter_key] = $filter_value;
				}
				$update_td_homepage_loop = true;
			}

			if (!empty($td_unique_articles) and is_array($td_unique_articles) and (count($td_unique_articles) > 0)) {
				foreach ($td_unique_articles[0] as $filter_key => $filter_value) {
					$td_homepage_loop[0][$filter_key] = $filter_value;
					$td_page[0][$filter_key] = $filter_value;
				}
				$update_td_homepage_loop = true;
			}

			if ($update_td_homepage_loop === true) {
				update_post_meta($recent_post['ID'], 'td_homepage_loop', $td_homepage_loop[0]);
				update_post_meta($recent_post['ID'], 'td_page', $td_page[0]);
			}





			// post settings
			$update_td_post_theme_settings = false;
			$td_post_theme_settings = td_util::get_post_meta_array($recent_post['ID'], 'td_post_theme_settings');
			$td_smart_list = td_util::get_post_meta_array($recent_post['ID'], 'td_smart_list');
			$td_review = td_util::get_post_meta_array($recent_post['ID'], 'td_review');

			if (!empty($td_review) and is_array($td_review) and (count($td_review) > 0)) {
				foreach ($td_review[0] as $filter_key => $filter_value) {
					$td_post_theme_settings[0][$filter_key] = $filter_value;
				}
				$update_td_post_theme_settings = true;
			}

			if (!empty($td_smart_list) and is_array($td_smart_list) and (count($td_smart_list) > 0)) {
				foreach ($td_smart_list[0] as $filter_key => $filter_value) {
					$td_post_theme_settings[0][$filter_key] = $filter_value;
				}
				$update_td_post_theme_settings = true;
			}

			if ($update_td_post_theme_settings === true) {
				update_post_meta($recent_post['ID'], 'td_post_theme_settings', $td_post_theme_settings[0]);
			}

			//delete_post_meta($recent_post['ID'], 'td_homepage_loop_filter');
			//delete_post_meta($recent_post['ID'], 'td_unique_articles');
			//delete_post_meta($recent_post['ID'], 'td_smart_list');
			//delete_post_meta($recent_post['ID'], 'td_review');
		}

		// the following delete operations must be done
		//delete_post_meta_by_key('td_homepage_loop_filter');
		//delete_post_meta_by_key('td_unique_articles');
		//delete_post_meta_by_key('td_smart_list');
		//delete_post_meta_by_key('td_review');
	}


	// update the database version
    if ($td_db_version != TD_THEME_VERSION) {
        td_util::update_option('td_version', TD_THEME_VERSION);
    }
}
td_theme_migration();