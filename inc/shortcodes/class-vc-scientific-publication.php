<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
if ( !class_exists( 'EASL_VC_Scientific_Publication' ) ) {

	class EASL_VC_Scientific_Publication extends WPBakeryShortCode {
		/**
		 * Suggest Publication Categories for autocomplete
		 *
		 * @since 2.1.0
		 */
		static public function vcex_suggest_publication_categories( $search_string ) {
			$publication_categories	 = array();
			$get_terms				 = get_terms(
			'publication_category', array(
				'hide_empty' => false,
				'search'	 => $search_string,
			) );

			if ( $get_terms ) {
				foreach ( $get_terms as $term ) {
					if ( $term->parent ) {
						$parent	 = get_term( $term->parent, 'publication_category' );
						$label	 = $term->name . ' (' . $parent->name . ')';
					} else {
						$label = $term->name;
					}
					$publication_categories[] = array(
						'label'	 => $label,
						'value'	 => $term->term_id,
					);
				}
			}
			return $publication_categories;
		}

		/**
		 * Renders Publication Categories for autocomplete
		 *
		 * @since 2.1.0
		 */
		static public function vcex_render_publication_categories( $data ) {
			$value	 = $data[ 'value' ];
			$term	 = get_term_by( 'term_id', intval( $value ), 'publication_category' );
			if ( is_object( $term ) ) {
				if ( $term->parent ) {
					$parent	 = get_term( $term->parent, 'publication_category' );
					$label	 = $term->name . ' (' . $parent->name . ')';
				} else {
					$label = $term->name;
				}
				return array(
					'label'	 => $label,
					'value'	 => $value,
				);
			}
			return $data;
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

// Admin filters
if ( is_admin() ) {

	// Get autocomplete suggestion
	add_filter( 'vc_autocomplete_easl_scientific_publication_include_categories_callback', array( 'EASL_VC_Scientific_Publication', 'vcex_suggest_publication_categories' ), 10, 1 );
	add_filter( 'vc_autocomplete_easl_scientific_publication_exclude_categories_callback', array( 'EASL_VC_Scientific_Publication', 'vcex_suggest_publication_categories' ), 10, 1 );
	add_filter( 'vc_autocomplete_easl_scientific_publication_filter_active_category_callback', array( 'EASL_VC_Scientific_Publication', 'vcex_suggest_publication_categories' ), 10, 1 );

	// Render autocomplete suggestions
	add_filter( 'vc_autocomplete_easl_scientific_publication_include_categories_render', array( 'EASL_VC_Scientific_Publication', 'vcex_render_publication_categories' ), 10, 1 );
	add_filter( 'vc_autocomplete_easl_scientific_publication_exclude_categories_render', array( 'EASL_VC_Scientific_Publication', 'vcex_render_publication_categories' ), 10, 1 );
	add_filter( 'vc_autocomplete_easl_scientific_publication_filter_active_category_render', array( 'EASL_VC_Scientific_Publication', 'vcex_render_publication_categories' ), 10, 1 );
}