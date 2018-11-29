<?php
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class EASL_VC_News_List extends WPBakeryShortCode {
		public function get_years() {
			global $wpdb;
			$years = $wpdb->get_col( "SELECT DISTINCT YEAR( post_date ) AS year FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC" );
			if(!$years || !is_array($years)){
				$years = array();
			}
			return $years;
		}
	}
}
