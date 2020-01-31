<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.02.2016
 * Time: 13:55
 */

class vc_column_inner extends tdc_composer_block {

    private $atts;

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->get_att('tdc_css_class');

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @vertical_align */
                .$unique_block_class {
                    vertical-align: @vertical_align;
                }

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // vertical align
        $vertical_align = $res_ctx->get_shortcode_att('vertical_align');
        $res_ctx->load_settings_raw( 'vertical_align', 'baseline' );
        if( $vertical_align != '' ) {
            $res_ctx->load_settings_raw('vertical_align', $vertical_align);
        }

    }

	function render($atts, $content = null) {
		parent::render($atts);

        $this->atts = shortcode_atts( array(
			'width' => '1/1',
            'is_sticky' => '',
            'vertical_align' => ''
		), $atts);


		// Set inner column width
		// For 'page_title_sidebar' template, modify the $atts['width']
		if ($this->atts['width'] === '1/1') {
			td_global::set_inner_column_width($this->atts['width']);
		} else {
			td_global::set_inner_column_width($this->atts['width']);
		}


		$td_pb_class = '';

		switch ($this->atts['width']) {
			case '1/1': //full
				$td_pb_class = 'td-pb-span12';
				break;
			case '2/3': //2 of 3
				$td_pb_class = 'td-pb-span8';
				break;
			case '1/3': // 1 of 3
				$td_pb_class = 'td-pb-span4';
				break;
			case '1/2': // 1 of 2
				$td_pb_class = 'td-pb-span6';
				break;
			case '1/4': // 1 of 4
				$td_pb_class = 'td-pb-span3';
				break;
			case '3/4': // 3 of 4
				$td_pb_class = 'td-pb-span9';
				break;
			case '7': // 7 of 12
				$td_pb_class = 'td-pb-span7';
				break;
			case '5': // 5 of 12
				$td_pb_class = 'td-pb-span5';
				break;
		}

		$inner_column_class = 'tdc-inner-column';

		if ( td_global::get_in_element() && ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) ) {
		    $inner_column_class .= '-composer';
        }

        if ( ! empty( $this->atts['is_sticky'] ) ) {
			$td_pb_class .= ' td-is-sticky';
		}

        td_global::set_in_inner_column( true );


		$buffy = '<div class="' . $this->get_block_classes(array('wpb_column', 'vc_column_container', $inner_column_class, $td_pb_class)) . '">';

		// get_block_css is out of wpb_wrapper for FF
		$buffy .= $this->get_block_css();

			$buffy .= '<div class="vc_column-inner">'; // requiered to maintain vc compatibility
				$buffy .= '<div class="wpb_wrapper">';
					$buffy .= $this->do_shortcode($content);
				$buffy .= '</div>';
			$buffy .= '</div>';
		$buffy .= '</div>';

		td_global::set_in_inner_column( false );


//		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
//			$buffy = '<div class="tdc-inner-column">' . $buffy . '</div>';
//		}

		return $buffy;
	}
}