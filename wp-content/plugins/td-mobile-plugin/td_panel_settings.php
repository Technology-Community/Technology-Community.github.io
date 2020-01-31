<!-- PLUGIN SETTINGS -->
<?php

echo td_panel_generator::box_start('Mobile settings', true);

$tdm_amp_set_disabled = ! td_util::is_amp_plugin_installed() ? ' tdm_setting_disabled' : '';

?>

<!-- Amp Settings -->
<div class="td-box-row td-box-row-amp-options">

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">AMP settings</span>
            <p><a href="https://ampproject.org" target="_blank">The AMP Project</a> is a Google-led initiative that dramatically improves loading speeds on phones and tablets.
            </p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <ul>
                <li>To use this feature, first, you need to install and activate the <a target="_blank" href="https://wordpress.org/plugins/amp/">Official AMP Plugin for WordPress</a>.</li>
                <li>Together with the AMP plugin, the Mobile Theme generates the AMP markup and provides the best solution for your site's AMP pages.</li>
                <li>Find out more about this feature in the <a target="_blank" href="https://tagdiv.com/amp-newspaper-theme/">theme's docs</a>.</li>
            </ul>
        </div>
    </div>

    <div class="td-box-section-separator"></div>

    <div class="td-box-row">
        <div class="td-box-description">
			<span class="td-box-title">Use Mobile Theme for:</span>
			<p>Select the option according to the desired behavior
				<?php td_util::tooltip_html('
                        <p><b>Mobile</b> - Displays content using the Mobile Theme on small screen devices</p>
                        <p><b>Mobile+Amp</b> - Displays content using the Mobile Theme on both mobiles and AMP</p>
                        <p><b>AMP</b> - Uses the responsive version on the small screen devices and Mobile Theme only on AMP</p>
                ', 'right')?>

			</p>
        </div>
        <div class="td-box-control-full<?php echo $tdm_amp_set_disabled ?>">
			<?php
			echo td_panel_generator::radio_button_control( array(
				'ds' => 'td_option',
				'option_id' => 'tdm_amp',
				'values' => array(
					array('text' => 'Mobile', 'val' => ''),
					array('text' => 'Mobile + AMP', 'val' => 'mobile_amp'),
					array('text' => 'AMP', 'val' => 'amp'),
				)
			));
			?>
        </div>
    </div>

    <div class="td-box-section-separator"></div>

</div>

<!-- General Settings -->
<?php
if (defined('TD_DEPLOY_MODE') && TD_DEPLOY_MODE === 'dev') {
?>

<!-- Enable mobile -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">SHOW MOBILE</span>
		<p>Show or hide the mobile version on desktop</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::checkbox(array(
			'ds' => 'td_option',
			'option_id' => td_mobile_theme::TDM_MOBILE_ON_DESKTOP,
			'true_value' => 'no',
			'false_value' => ''
		));
		?>
	</div>
</div>

<div class="td-box-section-separator"></div>

<?php } ?>

<!-- MAIN MENU -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">Main menu</span>
		<p>Select a menu for the mobile menu section</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::dropdown(array(
			'ds' => 'wp_theme_menu_spot',
			'option_id' => 'header-menu-mobile',
			'values' => td_panel_generator::get_user_created_menus()
		));
		?>
	</div>
</div>

<!-- FOOTER MENU -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">Footer menu</span>
		<p>Select a menu for the sub-footer menu section</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::dropdown(array(
			'ds' => 'wp_theme_menu_spot',
			'option_id' => 'footer-menu-mobile',
			'values' => td_panel_generator::get_user_created_menus()
		));
		?>
	</div>
</div>

<!-- Sign In / Join: enable disable -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">Show sign in / join</span>
		<p>Show or hide the Sign In / Join section</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::checkbox(array(
			'ds' => 'td_option',
			'option_id' => 'tds_login_mobile',
			'true_value' => '',
			'false_value' => 'hide'
		));
		?>
	</div>
</div>

<?php echo td_panel_generator::box_end();?>

<!-- COLORS -->
<?php require_once('panel/td_panel_colors.php'); ?>

<!-- FONTS -->
<?php require_once('panel/td_panel_fonts.php'); ?>

<!-- MENU BACKGROUND -->
<?php require_once('panel/td_panel_menu_background.php'); ?>

<!-- ADS -->
<?php require_once('panel/td_panel_ads.php'); ?>

<?php

/**
 * when the AMP -default WP plugin- is available include the amp ads/analytics settings
 */
if ( td_util::is_amp_plugin_installed() ){
	require_once('panel/td_panel_amp_ads.php');
	require_once('panel/td_panel_amp_analytics.php');
}

?>

<!-- EXCERPTS -->
<?php require_once('panel/td_panel_excerpts.php'); ?>

<!-- CUSTOM CODE -->
<?php require_once('panel/td_panel_custom_code.php'); ?>

<!-- GRIDS/LATEST ART SETTINGS -->
<?php require_once('panel/td_panel_mob_grids.php'); ?>

<!-- MODULES -->
<?php require_once('panel/td_panel_mob_modules.php'); ?>











