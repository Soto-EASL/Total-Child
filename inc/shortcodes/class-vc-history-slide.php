<?php
/**
 * Created by PhpStorm.
 * User: mahbub
 * Date: 2019-01-22
 * Time: 17:37
 */
if(class_exists('WPBakeryShortCode')) {
	class EASL_VC_History_Slide extends WPBakeryShortCode {
		public function front_end_assets() {
			wp_enqueue_style('jquery-ui-lib-style',
				get_stylesheet_directory_uri() . '/assets/lib/jquery-ui-1.12.1.custom/jquery-ui.css');
			wp_enqueue_script('simple-jquery-timeline-Plugin',
				get_stylesheet_directory_uri() . '/assets/lib/Simple-jQuery-Timeline-Plugin-Timelinr/js/jquery.timelinr-0.9.7.js',
				['jquery'],
				false,
				true);
			wp_enqueue_script('jquery-ui-lib-script',
				get_stylesheet_directory_uri() . '/assets/lib/jquery-ui-1.12.1.custom/jquery-ui.js',
				['jquery'],
				false,
				true);

			wp_enqueue_script('history-timeline-slider-script',
				get_stylesheet_directory_uri() . '/assets/js/history_timeline_slider.js',
				['jquery', 'simple-jquery-timeline-Plugin', 'jquery-ui-lib-script'],
				false,
				true);
		}
	}
}