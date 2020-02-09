<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }
		
global $theplus_options,$post_type_options;
		
add_image_size( 'tp-image-grid', 700, 700, true);

class Theplus_MetaBox {
	
	public static function get($name) {
		global $post;
		
		if (isset($post) && !empty($post->ID)) {
			return get_post_meta($post->ID, $name, true);
		}
		
		return false;
	}
}
function theplus_get_option($options_type,$field){
	$theplus_options=get_option( 'theplus_options' );
	$post_type_options=get_option( 'post_type_options' );
	$values='';
	if($options_type=='general'){
		if(isset($theplus_options[$field]) && !empty($theplus_options[$field])){
			$values=$theplus_options[$field];
		}
	}
	if($options_type=='post_type'){
		if(isset($post_type_options[$field]) && !empty($post_type_options[$field])){
			$values=$post_type_options[$field];
		}
	}
	return $values;
}
function theplus_testimonial_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$testi_post_type=$post_type_options['testimonial_post_type'];
	$post_name='theplus_testimonial';
	if(isset($testi_post_type) && !empty($testi_post_type)){
		if($testi_post_type=='themes'){
			$post_name=theplus_get_option('post_type','testimonial_theme_name');
		}elseif($testi_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','testimonial_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','testimonial_plugin_name');
			}
		}elseif($testi_post_type=='themes_pro'){
			$post_name='testimonial';
		}
	}else{
		$post_name='theplus_testimonial';
	}
	return $post_name;
}
function theplus_testimonial_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$testi_post_type=$post_type_options['testimonial_post_type'];
	$taxonomy_name='theplus_testimonial_cat';
	if(isset($testi_post_type) && !empty($testi_post_type)){
		if($testi_post_type=='themes'){
			$taxonomy_name=theplus_get_option('post_type','testimonial_category_name');
		}else if($testi_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','testimonial_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$taxonomy_name=theplus_get_option('post_type','testimonial_category_plugin_name');
			}
		}elseif($testi_post_type=='themes_pro'){
			$taxonomy_name='testimonial_category';
		}
	}else{
		$taxonomy_name='theplus_testimonial_cat';
	}
	return $taxonomy_name;
}
function theplus_client_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$client_post_type=$post_type_options['client_post_type'];
	$post_name='theplus_clients';
	if(isset($client_post_type) && !empty($client_post_type)){
		if($client_post_type=='themes'){
			$post_name=theplus_get_option('post_type','client_theme_name');
		}elseif($client_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','client_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','client_plugin_name');
			}
		}elseif($client_post_type=='themes_pro'){
			$post_name='clients';
		}
	}else{
		$post_name='theplus_clients';
	}
	return $post_name;
}
function theplus_client_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$client_post_type=$post_type_options['client_post_type'];
	$post_name='theplus_clients_cat';
	if(isset($client_post_type) && !empty($client_post_type)){
		if($client_post_type=='themes'){
			$post_name=theplus_get_option('post_type','client_category_name');
		}else if($client_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','client_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','client_category_plugin_name');
			}
		}elseif($client_post_type=='themes_pro'){
			$post_name='clients_category';
		}
	}else{
		$post_name='theplus_clients_cat';
	}
	return $post_name;
}
function theplus_team_member_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$team_post_type=$post_type_options['team_member_post_type'];
	$post_name='theplus_team_member';
	if(isset($team_post_type) && !empty($team_post_type)){
		if($team_post_type=='themes'){
			$post_name=theplus_get_option('post_type','team_member_theme_name');
		}elseif($team_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','team_member_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','team_member_plugin_name');
			}
		}elseif($team_post_type=='themes_pro'){
			$post_name='team_member';
		}
	}else{
		$post_name='theplus_team_member';
	}
	return $post_name;
}
function theplus_team_member_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$team_post_type=$post_type_options['team_member_post_type'];
	$taxonomy_name='theplus_team_member_cat';
	if(isset($team_post_type) && !empty($team_post_type)){
		if($team_post_type=='themes'){
			$taxonomy_name=theplus_get_option('post_type','team_member_category_name');
		}else if($team_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','team_member_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$taxonomy_name=theplus_get_option('post_type','team_member_category_plugin_name');
			}
		}elseif($team_post_type=='themes_pro'){
			$taxonomy_name='team_member_category';
		}
	}else{
		$taxonomy_name='theplus_team_member_cat';
	}
	return $taxonomy_name;
}
function theplus_excerpt($limit) {
	 if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
            WPBMap::addAllMappedShortcodes();
        }
	global $post;
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
function theplus_loading_image_grid($postid='',$type=''){
	global $post;
	$content_image='';
	if($type!='background'){
		
		$image_url=THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
			$content_image='<img src="'.esc_url($image_url).'" alt="'.esc_attr(get_the_title()).'"/>';
			return $content_image;
	}elseif($type=='background'){
		$image_url=THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
		$data_src='style="background:url('.esc_url($image_url).') #f7f7f7;" ';
		return $data_src;
	}
}
function theplus_loading_bg_image($postid=''){
	global $post;
	$content_image='';
	if(!empty($postid)){
		$featured_image=get_the_post_thumbnail_url($postid,'full');
		if(empty($featured_image)){
			$featured_image=theplus_get_thumb_url();
		}
		$content_image='style="background:url('.esc_url($featured_image).') #f7f7f7;"';
		return $content_image;
	}else{
	return $content_image;
	}
}
function theplus_array_flatten($array) {
	  if (!is_array($array)) { 
		return FALSE; 
	  } 
	  $result = array(); 
	  foreach ($array as $key => $value) { 
		if (is_array($value)) { 
		  $result = array_merge($result, theplus_array_flatten($value)); 
		} 
		else { 
		  $result[$key] = $value; 
		} 
	  } 
	  return $result; 
}
function theplus_createSlug($str, $delimiter = '-'){

    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;

} 

function theplus_key_notice_ajax(){
	if ( get_option( 'theplus-notice-dismissed' ) !== false ) {
		update_option( 'theplus-notice-dismissed', '1' );
	} else {
		$deprecated = null;
		$autoload = 'no';
		add_option( 'theplus-notice-dismissed','1', $deprecated, $autoload );
	}
}
add_action('wp_ajax_theplus_key_notice','theplus_key_notice_ajax');
add_action('wp_ajax_nopriv_theplus_key_notice', 'theplus_key_notice_ajax');