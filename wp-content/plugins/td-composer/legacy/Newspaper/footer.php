<?php
$tds_footer_page = td_util::get_option('tds_footer_page');
$footer_page = null;

if ($tds_footer_page !== '' && intval($tds_footer_page) !== get_the_ID()) {
	$footer_page = get_post( $tds_footer_page );
}

if ( $footer_page instanceof WP_Post ) {

    ?>

    <div class="td-footer-page td-footer-container td-container-wrap">
        <?php

        // Add suffix class to tdc_zone shortcode, to avoid wrapper in composer.
        // For the moment, it's necessary to not have more than 5 zones in composer (1 from content and 4 from header template)
        if ( td_util::tdc_is_live_editor_iframe() ) {
            tdc_zone::set_suffix_class( '-in-footer' );
        }

        // This action must be removed, because it's added by TagDiv Composer, and it affects footers with custom content
        remove_action( 'the_content', 'tdc_on_the_content', 10000 );
        remove_filter( 'the_content', 'wpautop' );

        /**
         * reset post data before getting the post content
         * fix for attachment img appearing before footer content on composer iframe when when editing an attachment template whit real data
         * @since 12.02.2019
         */
        if ( td_util::tdc_is_live_editor_iframe() ) {
            wp_reset_postdata();
        }

        $content = apply_filters( 'the_content', $footer_page->post_content );
        $content = str_replace( ']]>', ']]&gt;', $content );

        //bbpress removes all the filters
        //if is bbpress template run do_shortcode()
        if (td_global::$current_template == 'bbpress') {
            echo do_shortcode($content);
        }
        else {
            echo '<!-- footer content -->' . $content;
        }

        wp_reset_query();

        // Reset previous modified tdc_zone suffix class
        if ( td_util::tdc_is_live_editor_iframe() ) {
            tdc_zone::set_suffix_class( '' );
        }

        ?>
    </div>

    <?php

} else { ?>
    <div class="td-footer-page td-footer-container td-container-wrap">
        <div class="td-sub-footer-container td-container-wrap">
            <div class="td-container">
                <div class="td-pb-row">
                    <div class="td-pb-span td-sub-footer-menu">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_class'=> 'td-subfooter-menu',
                            'fallback_cb' => 'tagdiv_wp_no_footer_menu',
                        ));
                        ?>
                    </div>

                    <div class="td-pb-span td-sub-footer-copy">
                        &copy; Newspaper WordPress Theme by TagDiv
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</div><!--close td-outer-wrap-->

<?php wp_footer(); ?>

</body>
</html>