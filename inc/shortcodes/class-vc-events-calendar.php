<?php
if( class_exists('WPBakeryShortCode') ){
	class EASL_VC_Events_Calendar extends WPBakeryShortCode {
		private static $inline_scripts_once = false;
		
		public function string_to_array( $value ) {

			// Return if value is empty
			if ( !$value ) {
				return;
			}

			// Return if already an array
			if ( is_array( $value ) ) {
				return $value;
			}

			// Define output array
			$array = array();

			// Clean up value
			$items = preg_split( '/\,[\s]*/', $value );

			// Create array
			foreach ( $items as $item ) {
				if ( strlen( $item ) > 0 ) {
					$array[] = $item;
				}
			}

			// Return array
			return $array;
		}
		
		public function output_inline_script() {
			if(self::$inline_scripts_once){
				return;
			}
			self::$inline_scripts_once = true;
			ob_start();
			?>
			<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>
			<script type="text/javascript">
				window.addeventasync = function(){
					addeventatc.settings({
						css: false
					});
				};
			</script>
			<?php
			return ob_get_clean();
		}
		static public function load_events(){
			// Get reuest data
			if(!isset($_REQUEST['filters'])){
				return '';
			}
			
			$topics = $search = $meeting_type = $location = $form_date = $to_date = $event_type = $event_number = '';
			
			extract($_REQUEST['filters']);
			
			// get Last month text
			$previous_events_month = '';
			if(isset($_REQUEST['last_month_text'])){
				$previous_events_month = trim($_REQUEST['last_month_text']);
			}
			$css_animation = '';
			if(isset($_REQUEST['last_month_text'])){
				$css_animation= trim($_REQUEST['css_animation']);
			}
			// get row count
			$row_count = 0;
			if(isset($_REQUEST['row_count'])){
				$row_count = absint($_REQUEST['row_count']);
			}
			
			// Validate Event Type
			if( !in_array( $event_type, array('all', 'past', 'future', 'current') )){
				$event_type = 'future';
			}
			
			// Start building query args
			$event_args = array(
				'post_type' => EASL_Event_Config::get_event_slug(),
				'post_status' => 'publish',
				'posts_per_page' => $event_number,
				'order' => 'ASC',
				'orderby' => 'meta_value_num',
				'meta_key' => 'event_start_date',
			);
			
			if($row_count > 0){
				$event_args['offset'] = $row_count;
			}
			
			// search parameter
			if($search){
				$event_args['s'] = $search;
			}
			
			// Taxonomy query args
			$tax_query = array();
			// Topic
			if( is_array($topics) && count($topics) > 0){
			    $topics[] = 787;
				$tax_query[] = array(
					'taxonomy' => EASL_Event_Config::get_topic_slug(),
					'field' => 'term_id',
					'terms' => $topics,
				);
			}
			// Meeting Type
			if( $meeting_type){
				$tax_query[] = array(
					'taxonomy' => EASL_Event_Config::get_meeting_type_slug(),
					'field' => 'term_id',
					'terms' => array($meeting_type),
				);
			}
			// Check if there is any topic/meeting type
			if(count($tax_query) > 0){
				$tax_query['relation'] = 'AND';
				$event_args['tax_query'] = $tax_query;
			}
			
			// Meta query
			$meta_query = array();
			$now_time = time();
			// location
			if($location){
				$meta_query[] = array(
					'key' => 'event_location_country',
					'value' => $location,
					'compare' => '=',
				);
			}
			// Date range: form date
			if($form_date){
				$meta_query[] = array(
					'key' => 'event_start_date',
					'value' => strtotime($form_date) - 86399,
					'compare' => '>=',
					'type' => 'NUMERIC',
				);
			}
			// Date range: to date
			if($to_date){
				$meta_query[] = array(
					'key' => 'event_start_date',
					'value' => strtotime($to_date) - 86399,
					'compare' => '<=',
					'type' => 'NUMERIC',
				);
			}

            if(isset($organizer) ){
                $meta_query[] = array(
                    'relation' => 'AND',
                    array(
                        'key' => 'event_organisation',
                        'value' => $organizer,
                        'compare' => '=',
                        'type' => 'NUMERIC',
                    )
                );
            }
			// Ignor event type if formdate/todate is set
			if($form_date ||$to_date){
				$event_type = '';
			}
			// Get past/future/current events
			if('future' == $event_type){
				$event_args['order'] = 'ASC';
				$meta_query[] = array(
					'relation' => 'OR',
					array(
						'key' => 'event_start_date',
						'value' => $now_time - 86399,
						'compare' => '>=',
						'type' => 'NUMERIC',
					),
					array(
						'key' => 'event_end_date',
						'value' => $now_time - 86399,
						'compare' => '>=',
						'type' => 'NUMERIC',
					),
				);
			}elseif('past' == $event_type){
				$event_args['order'] = 'DESC';
				$meta_query[] = array(
					'relation' => 'AND',
					array(
						'key' => 'event_start_date',
						'value' => $now_time - 86399,
						'compare' => '<',
						'type' => 'NUMERIC',
					),
					array(
						'key' => 'event_end_date',
						'value' => $now_time - 86399,
						'compare' => '<',
						'type' => 'NUMERIC',
					),
				);
			}elseif('current' == $event_type){
				$event_args['order'] = 'ASC';
				$meta_query[] = array(
					'relation' => 'AND',
					array(
						'key' => 'event_start_date',
						'value' => $now_time - 86399,
						'compare' => '<',
						'type' => 'NUMERIC',
					),
					array(
						'key' => 'event_end_date',
						'value' => $now_time - 86399,
						'compare' => '>=',
						'type' => 'NUMERIC',
					),
				);
			}
			
			// Check if there is any meta queyr
			if(count($meta_query) > 0){
				$meta_query['relation'] = 'AND';
				$event_args['meta_query'] = $meta_query;
			}
			//var_dump($event_args);
			$event_query = new WP_Query($event_args);
            //var_dump($event_query);
			$rows = '';
			if($event_query->have_posts()){

				while ($event_query->have_posts()){
					$event_query->the_post();
					$row_count++;
					ob_start();
					include get_stylesheet_directory() . '/partials/event/event-calendar-row.php';
					$rows .= ob_get_clean();
				}
				wp_reset_postdata();
			}
			wp_send_json(array(
				'status' => 'OK',
				'rows' => $rows,
				'lastPage' => $event_query->found_posts <= $row_count
			));
			die();
		}
		public function get_related_links_data( $rlinks_param ) {
			$related_links_data = array();
			if ( strlen( $rlinks_param ) > 0 ) {
				$related_links_data = vc_param_group_parse_atts( $rlinks_param );
			}
			if ( empty( $related_links_data ) ) {
				$related_links_data = array();
			}
			$parsed_links_data = array();
			foreach ( $related_links_data as $link ) {
				if ( empty( $link[ 'rlink' ] ) ) {
					continue;
				}
				$p_link = $this->parse_url( $link[ 'rlink' ] );
				if ( strlen( $p_link[ 'url' ] ) > 0 ) {
					$parsed_links_data[] = $p_link;
				}
			}
			return $parsed_links_data;
		}

		public function parse_url( $link ) {
			//parse link
			$link = ( '||' === $link ) ? '' : $link;
			return vc_build_link( $link );
		}
	}
}

add_action('wp_ajax_easl_ec_get_events', array('EASL_VC_Events_Calendar', 'load_events'));
add_action('wp_ajax_nopriv_easl_ec_get_events', array('EASL_VC_Events_Calendar', 'load_events'));