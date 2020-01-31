<?php
// main background > keep it empty to make sure that no bg img is set
td_demo_misc::update_background('');

// mobile menu/search background
td_demo_misc::update_background_mobile('td_pic_1');

// login background
td_demo_misc::update_background_login('td_pic_1');

/*  ----------------------------------------------------------------------------
    Cloud Templates
*/

//cloud template - type header
$td_cloud_global_header_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Header Cloud Template - Travel PRO',
    'file' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/pages/header_cloud_template.txt',
    'template_type' => 'header',
));

// set - the default header template
td_demo_misc::update_global_header_template( 'tdb_template_' . $td_cloud_global_header_template_id );

//update mobile menu id in cloud header template
update_post_meta( $td_cloud_global_header_template_id, 'header_mobile_menu_id', $td_demo_mobile_menu_id );


//cloud template - type category
$td_cloud_cat_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Category Cloud Template - Travel PRO',
    'file' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/pages/cat_cloud_template.txt',
    'template_type' => 'category',
    'header_template_id' => $td_cloud_header_overlay_template_id
));

// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );


//cloud template - type single
$td_cloud_post_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Single Cloud Template - Travel PRO',
    'file' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/pages/post_cloud_template.txt',
    'template_type' => 'single',
    'header_template_id' => $td_cloud_header_overlay_template_id
));

// set the default (site wide) post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);


//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - Travel PRO',
    'file' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/pages/author_cloud_template.txt',
    'template_type' => 'author',
    'header_template_id' => $td_cloud_header_overlay_template_id
));

// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );


//cloud template - type 404 - global
$td_cloud_global_404_template_id = td_demo_content::add_cloud_template(array(
    'title' => '404 Cloud Template - Travel PRO',
    'file' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/pages/404_cloud_template.txt',
    'template_type' => '404',
    'header_template_id' => $td_cloud_header_overlay_template_id
));

// set - the default (global) cloud 404 template
td_demo_misc::update_global_404_template( 'tdb_template_' . $td_cloud_global_404_template_id );


//cloud template - type search - global
$td_cloud_global_search_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Search Cloud Template - Travel PRO',
    'file' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/pages/search_cloud_template.txt',
    'template_type' => 'search',
    'header_template_id' => $td_cloud_header_overlay_template_id
));

// set - the default (global) search template
td_demo_misc::update_global_search_template( 'tdb_template_' . $td_cloud_global_search_template_id );

/*  ----------------------------------------------------------------------------
    pages
*/

//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/pages/homepage.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'header_template_id' => $td_cloud_header_overlay_template_id,
    'homepage' => true
));

//footer page
$td_footerpage_id = td_demo_content::add_page(array(
    'title' => 'Footer',
    'file' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/pages/footer.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'sidebar_position' => 'no_sidebar',
    'homepage' => false
));

td_util::update_option( 'tds_footer_page', $td_footerpage_id);