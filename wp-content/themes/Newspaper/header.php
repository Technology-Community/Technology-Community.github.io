<?php
do_action( 'tdc_header' );
if ( has_action( 'tdc_header' ) ) {
    return;
}
?>
<!doctype html >
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' );?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('tagdiv-small-theme') ?> itemscope="itemscope" itemtype="https://schema.org/WebPage">


    <!-- Mobile Search -->
    <div class="td-search-background"></div>
    <div class="td-search-wrap-mob">
        <div class="td-drop-down-search" aria-labelledby="td-header-search-button">
            <form method="get" class="td-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="td-search-close">
                    <a href="#"><i class="td-icon-close-mobile"></i></a>
                </div>
                <div role="search" class="td-search-input">
                    <span><?php esc_attr_e('Search', 'newspaper' )?></span>
                    <label for="td-header-search-mob">
                        <input id="td-header-search-mob" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
                    </label>
                </div>
            </form>
            <div id="td-aj-search-mob"></div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="td-menu-background"></div>
    <div id="td-mobile-nav">
        <div class="td-mobile-container">
            <!-- mobile menu top section -->
            <div class="td-menu-socials-wrap">
                <!-- close button -->
                <div class="td-mobile-close">
                    <a href="#"><i class="td-icon-close-mobile"></i></a>
                </div>
            </div>

            <!-- menu section -->
            <div class="td-mobile-content">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header-menu',
                        'menu_class'=> 'td-mobile-main-menu',
                        'fallback_cb' => 'tagdiv_wp_no_mobile_menu',
                        'link_after' => '<i class="td-icon-menu-right td-element-after"></i>'
                    ));

                // if no menu
                function tagdiv_wp_no_mobile_menu() {
                    if ( current_user_can( 'switch_themes' ) ) {
                        echo '<ul class="">';
                        echo '<li class="menu-item-first"><a href="' . esc_url(home_url('/')) . 'wp-admin/nav-menus.php?action=locations">Add menu</a></li>';
                        echo '</ul>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div id="td-outer-wrap" class="td-theme-wrap">
        <div class="td-header-wrap td-header-style-1">
            <div class="td-banner-wrap-full td-logo-wrap-full td-container-wrap">
                <div class="td-header-sp-logo">
                    <?php
                        $td_logo_text = get_bloginfo('name');
                        $td_tagline_text = get_bloginfo('description');

                        // H1 on logo when there's no title with H1 in page
                        $td_use_h1_logo = false;
                        if (is_home()) {
                            $td_use_h1_logo = true;
                        } ?>

                    <div class="td-logo-text-wrap">
                        <div class="td-logo-text-container">
                            <?php
                            if($td_use_h1_logo === true) {
                                echo '<h1 class="td-logo">';
                            };
                            ?>
                            <a class="td-logo-wrap" href="<?php echo esc_url(home_url( '/' )); ?>">
                                <span class="td-logo-text"><?php if(!$td_logo_text) { echo "NEWSPAPER"; } else { echo esc_attr($td_logo_text); } ?></span>
                            </a>
                            <?php
                            if($td_use_h1_logo === true) {
                                echo '</h1>';
                            };
                            ?>
                            <span class="td-tagline-text"><?php if(!$td_tagline_text) { echo "DISCOVER THE ART OF PUBLISHING"; } else { echo esc_attr($td_tagline_text); } ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="td-header-menu-wrap-full td-container-wrap">
                <div class="td-header-menu-wrap td-header-gradient">
                    <div class="td-container td-header-row td-header-main-menu">
                        <div id="td-header-menu" role="navigation">
                            <div id="td-top-mobile-toggle"><a href="#"><i class="td-icon-font td-icon-mobile"></i></a></div>

                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'header-menu',
                                    'fallback_cb' => 'tagdiv_wp_page_menu',
                                    'menu_class'=> 'sf-menu tagdiv-small-theme-menu',
                                ));

                            //if no menu
                            function tagdiv_wp_page_menu() {
                                if ( current_user_can( 'switch_themes' ) ) {
                                    echo '<ul class="sf-menu">';
                                    echo '<li class="menu-item-first"><a href="' . esc_url(home_url('/')) . 'wp-admin/nav-menus.php?action=locations">Add menu</a></li>';
                                    echo '</ul>';
                                }
                            }
                            ?>
                        </div>

                        <div class="header-search-wrap">
                            <div class="td-search-btns-wrap">
                                <a id="td-header-search-button" href="#" role="button"><i class="td-icon-search"></i></a>
                                <a id="td-header-search-button-mob" href="#" role="button"><i class="td-icon-search"></i></a>
                            </div>

                            <div class="td-drop-down-search" aria-labelledby="td-header-search-button">
                                <form method="get" class="td-search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
                                    <div role="search" class="td-head-form-search-wrap">
                                        <input id="td-header-search" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
                                        <input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="<?php esc_attr_e('Search', 'newspaper')?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>