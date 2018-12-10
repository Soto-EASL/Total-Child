<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$limit         = 5;
$current_topic = ! empty( $_GET['recent_items_topic'] ) ? $_GET['recent_items_topic'] : '';
if ( $current_topic == 'all' ) {
	$current_topic = '';
}

$count = 0;
$merged_items = array();
$now_time = time();

$current_item_color = '';
$curent_topic_term = '';
if($current_topic){
	$curent_topic_term = get_term_by('slug', $current_topic, EASL_Event_Config::get_topic_slug());
}
if($curent_topic_term){
	$current_item_color = get_term_meta( $curent_topic_term->term_id, 'easl_tax_color', true );
}


$query_args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'posts_per_page' => 3,
	'tax_query'      => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => array( 23, 24, 34, 35, 36, 37, 38, 39, 88 ),
			'operator' => 'NOT IN',
		),
	)
);
$news = new WP_Query($query_args);
while ($news->have_posts()){
	$news->the_post();
	$post = get_post();
	$merged_items[] = array(
		'id' => get_the_ID(),
		'date' => $post->post_date,
		'title' => get_the_title(),
		'permalink' => get_the_permalink(),
		'color' => $current_item_color ? $current_item_color : 'blue',
	);
}
wp_reset_query();

$query_args = array(
	'post_type'      => 'publication',
	'post_status'    => 'publish',
	'meta_key' => 'publication_date',
	'orderby'        => 'meta_value_num',
	'order'          => 'DESC',
	'posts_per_page' => 2,
);
if($current_topic) {
	$query_args['tax_query'] = array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'publication_topic',
			'field' => 'slug',
			'terms' => array($current_topic),
		)
	);
}
$cpgs = new WP_Query($query_args);
while ($cpgs->have_posts()){
	$cpgs->the_post();
	$post = get_post();
	$merged_items[] = array(
		'id' => get_the_ID(),
		'date' => $post->post_date,
		'title' => get_the_title(),
		'permalink' => get_the_permalink(),
		'color' => $current_item_color ? $current_item_color : easl_get_publication_topic_color(get_the_ID()),
	);
}
wp_reset_query();

$query_args = array(
	'post_type' => EASL_Event_Config::get_event_slug(),
	'post_status' => 'publish',
	'posts_per_page' => 1,
	'order' => 'ASC',
	'orderby' => 'meta_value_num',
	'meta_key' => 'event_start_date',
	'meta_query' => array(
		'relation' => 'AND',
		array(
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
		)
	)
);

if($current_topic) {
	$query_args['tax_query'][] = array(
		'taxonomy' => 'event_topic',
		'field' => 'slug',
		'terms' => array($current_topic),
	);
}
$events = new WP_Query($query_args);

while ($events->have_posts()){
	$events->the_post();
	$merged_items[] = array(
		'id' => get_the_ID(),
		'date' => get_post_meta(get_the_ID(), 'event_start_date', true),
		'title' => get_the_title(),
		'permalink' => get_the_permalink(),
		'color' => $current_item_color ? $current_item_color : easl_get_events_topic_color(get_the_ID()),
	);
}
wp_reset_query();

if(count($merged_items) > 0):
?>
<div class="easl-recent-items-list">
	<ul>
	<?php foreach ($merged_items as $item): ?>
		<li class="easl-color-<?php echo $item['color']; ?>">
			<a href="<?php echo $item['permalink']; ?>"><?php echo $item['title']; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>