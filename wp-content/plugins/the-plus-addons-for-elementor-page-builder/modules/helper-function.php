<?php
use TheplusAddons\Theplus_Element_Load;

//Get Page Ids
function theplus_get_pages_list() {
   $page_ids=get_all_page_ids();
    if ( empty( $page_ids ) ) {
        $options = [ '0' => __( 'Not Page List', 'theplus' ) ];
    } else {
        $options = [ '0' => __( 'Select Page', 'theplus' ) ];
        
        foreach ( $page_ids as $page ) {
            $options[ $page ] = get_the_title($page);
        }
    }

    return $options;
}
/*-contact form 7-*/
function theplus_get_contact_form_post() {
	$contact_forms = array();
	$cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
		if ($cf7) {
			foreach ($cf7 as $cform) {
				$contact_forms[$cform->ID] = $cform->post_title;
			}
		} else {
			$contact_forms[0] = __('No contact forms found', 'theplus');
		}
	return $contact_forms;
}
/*-contact form 7-*/
function theplus_get_style_list($max=4,$none='') {
	$options=array();
	if($none=='yes'){
		$options[ 'none' ] = 'None';
	}
	for( $i=1;$i<=$max;$i++) {
		$options[ 'style-'.$i ] = 'Style '.$i;
	}
    return $options;
}
function theplus_get_numbers()
{
	$option=array();
	for( $i=0;$i<=25;$i++) {
            $options[ $i ] = $i;
        }
    return $options;
}
function theplus_get_gradient_styles()
{
    return array(
		'linear' => __('Linear', 'theplus'),
		'radial' => __('Radial', 'theplus'),
    );
}
function theplus_get_border_style()
{
    return array(
        'solid' => __( 'Solid', 'theplus' ),
		'dashed' => __( 'Dashed', 'theplus' ),
		'dotted' => __( 'Dotted', 'theplus' ),
		'groove' => __( 'Groove',  'theplus' ),
		'inset' => __( 'Inset','theplus' ),
		'outset' => __( 'Outset','theplus' ),
		'ridge' => __( 'Ridge', 'theplus' ),
    );
}
function theplus_get_list_layout_style()
{
    return array(
        'grid'  => __( 'Grid', 'theplus' ),
		'masonry' => __( 'Masonry', 'theplus' ),
		'metro' => __( 'Metro', 'theplus' ),
		'carousel' => __( 'Carousel', 'theplus' ),
    );
}
function theplus_get_columns_list()
{
    return array(
        '2' => __( 'Column 6', 'theplus' ),
		'3' => __( 'Column 4', 'theplus' ),
		'4' => __( 'Column 3', 'theplus' ),
		'6' => __( 'Column 2', 'theplus' ),
		'12'  => __( 'Column 1', 'theplus' ),
	);
}
function theplus_get_categories() {

	$categories = get_categories();

	if ( empty( $categories ) || ! is_array( $categories ) ) {
		return array();
	}
	return wp_list_pluck( $categories, 'name', 'term_id' );
	
}
function theplus_get_tags() {

	$tags = get_tags();
	
	if ( empty( $tags ) || ! is_array( $tags ) ) {
		return array();
	}
	return wp_list_pluck( $tags, 'name', 'term_id' );
	
}
function theplus_get_testimonial_categories() {
	
		$testimonial=theplus_testimonial_post_category();
		if($testimonial!=''){
			$categories = get_categories(array('taxonomy' => $testimonial,'hide_empty' => 0));
			
			if ( empty( $categories ) || ! is_array( $categories ) ) {
				return array();
			}	
		}
	return wp_list_pluck( $categories, 'name', 'term_id' );
}
function theplus_get_client_categories() {
	
		$clients=theplus_client_post_category();
		if($clients!=''){
			$categories = get_categories(array('taxonomy' => $clients,'hide_empty' => 0));
			
			if ( empty( $categories ) || ! is_array( $categories ) ) {
				return array();
			}	
		}
	return wp_list_pluck( $categories, 'name', 'term_id' );
}
function theplus_get_team_member_categories() {
	
		$teams=theplus_team_member_post_category();
		if($teams!=''){
			$categories = get_categories(array('taxonomy' => $teams,'hide_empty' => 0));
			
			if ( empty( $categories ) || ! is_array( $categories ) ) {
				return array();
			}	
		}
	return wp_list_pluck( $categories, 'name', 'term_id' );
}
function theplus_orderby_arr() {
	return array(
		'none'          => esc_html__( 'None', 'theplus' ),
		'ID'            => esc_html__( 'ID', 'theplus' ),
		'author'        => esc_html__( 'Author', 'theplus' ),
		'title'         => esc_html__( 'Title', 'theplus' ),
		'name'          => esc_html__( 'Name (slug)', 'theplus' ),
		'date'          => esc_html__( 'Date', 'theplus' ),
		'modified'      => esc_html__( 'Modified', 'theplus' ),
		'rand'          => esc_html__( 'Rand', 'theplus' ),
		'comment_count' => esc_html__( 'Comment Count', 'theplus' ),
	);
}
function theplus_order_arr() {

	return array(
		'DESC' => esc_html__( 'Descending', 'theplus' ),
		'ASC'  => esc_html__( 'Ascending', 'theplus' ),
	);

}
function theplus_woo_product_display() {

	return array(
		'all' => esc_html__( 'All', 'theplus' ),
		'recent'  => esc_html__( 'Recent', 'theplus' ),
		'featured'  => esc_html__( 'Featured', 'theplus' ),
		'on_sale'  => esc_html__( 'On sale', 'theplus' ),
		'top_rated'  => esc_html__( 'Top rated', 'theplus' ),
		'top_sales'  => esc_html__( 'Top sales', 'theplus' ),
	);

}
function theplus_metro_style_layout($columns='1',$metro_column='3',$metro_style='style-1'){
	$i=($columns!='') ? $columns : 1;
	if(!empty($metro_column)){
		//style-3
		if($metro_column=='3' && $metro_style=='style-1'){
			$i=($i<=10) ? $i : ($i%10);			
		}
	}
	return $i;
}
function theplus_get_layout_list_class($layout=''){
	$layout_class='';
	
	$layout_class=' list-isotope ';
	if($layout=='grid'){
		$layout_class=' list-isotope ';
	}else if($layout=='masonry'){
		$layout_class=' list-isotope ';
	}else if($layout=='metro'){
		$layout_class=' list-isotope-metro ';
	}
	
	return $layout_class;
}

function theplus_get_layout_list_attr($layout=''){
	$layout_attr='';
	if($layout=='grid'){
		$layout_attr .=' data-layout-type="fitRows" ';
	}else if($layout=='masonry'){
		$layout_attr .=' data-layout-type="masonry" ';
	}else if($layout=='metro'){
		$layout_attr .=' data-layout-type="metro" ';		
	}
	return $layout_attr;
}

function theplus_get_position_options()
{
    return array(
        'center center' => __( 'Center Center', 'theplus' ),
		'center left' => __( 'Center Left', 'theplus' ),
		'center right' => __( 'Center Right', 'theplus' ),
		'top center' => __( 'Top Center',  'theplus' ),
		'top left' => __( 'Top Left','theplus' ),
		'top right' => __( 'Top Right','theplus' ),
		'bottom center' => __( 'Bottom Center', 'theplus' ),
		'bottom left' => __( 'Bottom Left','theplus' ),
		'bottom right' => __( 'Bottom Right','theplus' ),
    );
}
function theplus_get_image_position_options()
{
    return array(
        '' => __( 'Default','theplus' ),
		'top left' => __( 'Top Left','theplus' ),
		'top center' => __( 'Top Center','theplus' ),
		'top right' => __( 'Top Right','theplus' ),
		'center left' => __( 'Center Left','theplus' ),
		'center center' => __( 'Center Center','theplus' ),
		'center right' => __( 'Center Right', 'theplus' ),
		'bottom left' => __( 'Bottom Left', 'theplus' ),
		'bottom center' => __( 'Bottom Center','theplus' ),
		'bottom right' => __( 'Bottom Right','theplus' ),
    );
}
function theplus_get_image_attachment_options()
{
    return array(
        '' => __( 'Default', 'theplus' ),
		'scroll' => __( 'Scroll', 'theplus' ),
		'fixed' => __( 'Fixed', 'theplus' ),
    );
}
function theplus_get_content_hover_effect_options()
{
    return array(
		''   => __( 'Select Hover Effect', 'theplus' ),
		'grow'  => __( 'Grow (PRO)', 'theplus' ),
		'push' => __( 'Push', 'theplus' ),
		'bounce-in' => __( 'Bounce In (PRO)', 'theplus' ),
		'float' => __( 'Float (PRO)', 'theplus' ),
		'wobble_horizontal' => __( 'Wobble Horizontal (PRO)', 'theplus' ),
		'wobble_vertical' => __( 'Wobble Vertical (PRO)', 'theplus' ),
		'float_shadow' => __( 'Float Shadow (PRO)', 'theplus' ),
		'grow_shadow' => __( 'Grow Shadow (PRO)', 'theplus' ),
		'shadow_radial' => __( 'Shadow Radial (PRO)', 'theplus' ),
    );
}
function theplus_get_image_reapeat_options()
{
    return array(
        '' => __( 'Default', 'theplus' ),
		'no-repeat' => __( 'No-repeat', 'theplus' ),
		'repeat' => __( 'Repeat', 'theplus' ),
		'repeat-x' => __( 'Repeat-x','theplus' ),
		'repeat-y' => __( 'Repeat-y','theplus' ),
    );
}
function theplus_get_image_size_options()
{
    return array(
        '' => __( 'Default', 'theplus' ),
		'auto' => __( 'Auto', 'theplus' ),
		'cover' => __( 'Cover', 'theplus' ),
		'contain' => __( 'Contain', 'theplus' ),
    );
}
function theplus_get_animation_options()
{
    return array(
        'no-animation' => __( 'No-animation', 'theplus' ),
		'transition.fadeIn' => __( 'FadeIn', 'theplus' ),
		'transition.flipXIn' => __( 'FlipXIn', 'theplus' ),
		'transition.flipYIn' => __( 'FlipYIn', 'theplus' ),
		'transition.flipBounceXIn' => __( 'FlipBounceXIn', 'theplus' ),
		'transition.flipBounceYIn' => __( 'FlipBounceYIn', 'theplus' ),
		'transition.swoopIn' => __( 'SwoopIn', 'theplus' ),
		'transition.whirlIn' => __( 'WhirlIn', 'theplus' ),
		'transition.shrinkIn' => __( 'ShrinkIn', 'theplus' ),
		'transition.expandIn' => __( 'ExpandIn', 'theplus' ),
		'transition.bounceIn' => __( 'BounceIn', 'theplus' ),
		'transition.bounceUpIn' => __( 'BounceUpIn', 'theplus' ),
		'transition.bounceDownIn' => __( 'BounceDownIn', 'theplus' ),
		'transition.bounceLeftIn' => __( 'BounceLeftIn', 'theplus' ),
		'transition.bounceRightIn' => __( 'BounceRightIn', 'theplus' ),
		'transition.slideUpIn' => __( 'SlideUpIn', 'theplus' ),
		'transition.slideDownIn' => __( 'SlideDownIn', 'theplus' ),
		'transition.slideLeftIn' => __( 'SlideLeftIn', 'theplus' ),
		'transition.slideRightIn' => __( 'SlideRightIn', 'theplus' ),
		'transition.slideUpBigIn' => __( 'SlideUpBigIn', 'theplus' ),
		'transition.slideDownBigIn' => __( 'SlideDownBigIn', 'theplus' ),
		'transition.slideLeftBigIn' => __( 'SlideLeftBigIn', 'theplus' ),
		'transition.slideRightBigIn' => __( 'SlideRightBigIn', 'theplus' ),
		'transition.perspectiveUpIn' => __( 'PerspectiveUpIn', 'theplus' ),
		'transition.perspectiveDownIn' => __( 'PerspectiveDownIn', 'theplus' ),
		'transition.perspectiveLeftIn' => __( 'PerspectiveLeftIn', 'theplus' ),
		'transition.perspectiveRightIn' => __( 'PerspectiveRightIn', 'theplus' ),
    );
	
}
function theplus_get_animation_easing()
{
    return array(
        '' => __( 'Default', 'theplus' ),
		'swing' => __( 'Swing', 'theplus' ),
		'easeInSine' => __( 'EaseInSine', 'theplus' ),
		'easeOutSine' => __( 'EaseOutSine', 'theplus' ),
		'easeInOutSine' => __( 'EaseInOutSine', 'theplus' ),
		'easeInQuad' => __( 'EaseInQuad', 'theplus' ),
		'easeOutQuad' => __( 'EaseOutQuad', 'theplus' ),
		'easeInOutQuad' => __( 'EaseInOutQuad', 'theplus' ),
		'easeInCubic' => __( 'EaseInCubic', 'theplus' ),
		'easeOutCubic' => __( 'EaseOutCubic', 'theplus' ),
		'easeInOutCubic' => __( 'EaseInOutCubic', 'theplus' ),
		'easeInQuart' => __( 'EaseInQuart', 'theplus' ),
		'easeOutQuart' => __( 'EaseOutQuart', 'theplus' ),
		'easeInOutQuart' => __( 'EaseInOutQuart', 'theplus' ),
		'easeInQuint' => __( 'EaseInQuint', 'theplus' ),
		'easeOutQuint' => __( 'EaseOutQuint', 'theplus' ),
		'easeInOutQuint' => __( 'EaseInOutQuint', 'theplus' ),
		'easeInExpo' => __( 'EaseInExpo', 'theplus' ),
		'easeOutExpo' => __( 'EaseOutExpo', 'theplus' ),
		'easeInOutExpo' => __( 'EaseInOutExpo', 'theplus' ),
		'easeInCirc' => __( 'EaseInCirc', 'theplus' ),
		'easeOutCirc' => __( 'EaseOutCirc', 'theplus' ),
		'easeInOutCirc' => __( 'EaseInOutCirc', 'theplus' ),
		'easeInBack' => __( 'EaseInBack', 'theplus' ),
		'easeOutBack' => __( 'EaseOutBack', 'theplus' ),
		'easeInOutBack' => __( 'EaseInOutBack', 'theplus' ),
		'easeInElastic' => __( 'EaseInElastic', 'theplus' ),
		'easeOutElastic' => __( 'EaseOutElastic', 'theplus' ),
		'easeInOutElastic' => __( 'EaseInOutElastic', 'theplus' ),
		'easeInBounce' => __( 'EaseInBounce', 'theplus' ),
		'easeOutBounce' => __( 'EaseOutBounce', 'theplus' ),
		'easeInOutBounce' => __( 'EaseInOutBounce', 'theplus' ),
    );
	
}

function theplus_get_tags_options()
{
    return array(
        'h1' => __( 'H1', 'theplus' ),
		'h2' => __( 'H2', 'theplus' ),
		'h3' => __( 'H3', 'theplus' ),
		'h4' => __( 'H4', 'theplus' ),
		'h5' => __( 'H5', 'theplus' ),
		'h6' => __( 'H6', 'theplus' ),
		'h6' => __( 'H6', 'theplus' ),
		'div' => __( 'div', 'theplus' ),
		'p' => __( 'p', 'theplus' ),
    );
}

function theplus_get_thumb_url(){
	return THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
}

function theplus_pro_ver_notice(){
	return '<span class="theplus-pro">Get the access of all power packed Widgets, Ready Design Templates, Premium Support and much more.<a href="'.THEPLUS_PRO.'" target="_blank">Buy Premium Version</a> Today.</span>';
}