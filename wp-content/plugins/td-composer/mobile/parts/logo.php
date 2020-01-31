<?php

// read the mobile logo + retina logo
$td_mobile_customLogo = td_util::get_option('tds_logo_menu_upload');
$td_mobile_customLogoR = td_util::get_option('tds_logo_menu_upload_r');

// read the header logo + retina logo
$td_header_logo = td_util::get_option('tds_logo_upload');
$td_header_logoR = td_util::get_option('tds_logo_upload_r');

// read the header text logo + tagline
$td_logo_text = stripslashes(td_util::get_option('tds_logo_text'));
$td_tagline_text = stripslashes(td_util::get_option('tds_tagline_text'));

$td_logo_alt = td_util::get_option('tds_logo_alt');
$td_logo_title = td_util::get_option('tds_logo_title');

if (!empty($td_logo_title)) {
    $td_logo_title = ' title="' . $td_logo_title . '"';
}


if (!empty($td_mobile_customLogo)) {

    // mobile logo here
    if (!empty($td_mobile_customLogoR)) {
        //if retina
        ?>

        <a class="td-mobile-logo" href="<?php echo esc_url(home_url('/')); ?>">
            <img class="td-retina-data"
                 data-retina="<?php echo esc_attr($td_mobile_customLogoR) ?>"
                 src="<?php echo $td_mobile_customLogo ?>"
                 alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
        </a>
    <?php
    } else {
        //not retina
        if (!empty($td_mobile_customLogo)) {
            ?>
            <a class="td-mobile-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo $td_mobile_customLogo ?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
            </a>
        <?php
        }
    }

} else {

    // header logo here
    if (!empty($td_header_logoR)) {
        //if retina
        ?>

        <a class="td-header-logo" href="<?php echo esc_url(home_url('/')); ?>">
            <img class="td-retina-data"
                 data-retina="<?php echo esc_attr($td_header_logoR) ?>"
                 src="<?php echo $td_header_logo ?>"
                 alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
        </a>
    <?php
    } else {
        //not retina
        if (!empty($td_header_logo)) {
            ?>
            <a class="td-header-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo $td_header_logo ?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
            </a>
        <?php
        } else { ?>
            <div class="td-logo-text-wrap">
                <span class="td-logo-text-container">
                    <a class="td-logo-wrap" href="<?php echo esc_url(home_url( '/' )); ?>">
                        <span class="td-logo-text"><?php if(!$td_logo_text) { echo TD_THEME_NAME; } else { echo $td_logo_text; } ?></span>
                        <span class="td-tagline-text"><?php if(!$td_tagline_text) { echo "DISCOVER THE ART OF PUBLISHING"; } else { echo $td_tagline_text; } ?></span>
                    </a>
                </span>
            </div>
	        <?php
        }
    }
}