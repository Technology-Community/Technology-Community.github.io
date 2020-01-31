<?php
/**
 * Created by ra on 5/14/2015.
 */



/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/



/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */



/*  ----------------------------------------------------------------------------
    logo
 */



/*  ----------------------------------------------------------------------------
    footer text
 */



/*  ----------------------------------------------------------------------------
    socials
 */



/*  ----------------------------------------------------------------------------
    ads
 */



/*  ----------------------------------------------------------------------------
    sidebars
 */



/*  ----------------------------------------------------------------------------
    Cloud Templates
*/
//cloud template - type header - global
$td_cloud_global_header_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Global Header Cloud Template - Tech News Pro',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/global_header_cloud_template.txt',
    'template_type' => 'header',
));
// set - the default header template
td_demo_misc::update_global_header_template( 'tdb_template_' . $td_cloud_global_header_template_id );

//cloud template - type single
$td_cloud_post_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Single Cloud Template - Tech News Pro',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/post_cloud_template.txt',
    'template_type' => 'single',
));
// set the default site wide post template
td_util::update_option('td_default_site_post_template', 'tdb_template_' . $td_cloud_post_template_id);

//cloud template - type category
$td_cloud_cat_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Category Cloud Template - Tech News Pro',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/cat_cloud_template.txt',
    'template_type' => 'category',
));
// set - the default (global) cloud category template
td_demo_misc::update_global_category_template( 'tdb_template_' . $td_cloud_cat_template_id );

//cloud template - type author - global
$td_cloud_global_author_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Author Cloud Template - Tech News Pro',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/author_cloud_template.txt',
    'template_type' => 'author',
));
// set - the default (global) cloud author template
td_demo_misc::update_global_author_template( 'tdb_template_' . $td_cloud_global_author_template_id );

//cloud template - type search
$td_cloud_search_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Search Cloud Template - Tech News Pro',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/search_cloud_template.txt',
    'template_type' => 'search',
));
// set the default site wide search template
td_util::update_option( 'tdb_search_template', 'tdb_template_' . $td_cloud_search_template_id );

//cloud template - type date
$td_cloud_date_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Date Cloud Template - Tech News Pro',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/date_cloud_template.txt',
    'template_type' => 'date',
));
// set the default site wide date template
td_util::update_option( 'tdb_date_template', 'tdb_template_' . $td_cloud_date_template_id );

//cloud template - type tag
$td_cloud_tag_template_id = td_demo_content::add_cloud_template(array(
    'title' => 'Tag Cloud Template - Tech News Pro',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/tag_cloud_template.txt',
    'template_type' => 'tag',
));
// set the default site wide date template
td_util::update_option( 'tdb_tag_template', 'tdb_template_' . $td_cloud_tag_template_id );

//cloud template - type 404
$td_cloud_404_template_id = td_demo_content::add_cloud_template(array(
    'title' => '404 Cloud Template - Tech News Pro',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/404_cloud_template.txt',
    'template_type' => '404',
));
// set the default site wide 404 template
td_util::update_option( 'tdb_404_template', 'tdb_template_' . $td_cloud_404_template_id );


/*  ---------------------------------------------------------------------------
    categories
*/



/*  ----------------------------------------------------------------------------
    pages
 */
//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'Home',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/homepage.txt',
    'template' => 'page-pagebuilder-overlay.php',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => true
));
//footer template
$td_footertemplate_id = td_demo_content::add_page(array(
    'title' => 'footer-template',
    'file' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/pages/footer-template-no-content.txt',
    'template' => 'default',   // the page template full file name with .php, for default no extension needed
    'td_layout' => '',
    'homepage' => false
));
td_util::update_option( 'tds_footer_page', $td_footertemplate_id);

/*  ----------------------------------------------------------------------------
    menu
 */