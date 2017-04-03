<?php

// Title that appears at Archives and Singles
function getPageCustomTitle($postType){
	global $redux_options, $themePrefix;
	if($postType == 'celebridades'){
		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_celebrity'].'</h5>';
	} else if($postType == 'cabelos'){
		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_hair'].'</h5>';
	} else if($postType == 'antesedepois'){
		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_beforeandafter'].'</h5>';
	} else if($postType == 'midia'){
		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_news'].'</h5>';
	} else if($postType == 'proteses'){
		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_prothesis'].'</h5>';
	} else{
		echo '<h5 class="breadcrumb-title">'.get_bloginfo('name').'</h5>';
	}
}

function is_mobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function limitText($text, $limit){
	$text = explode(' ', $text);
	for($i = 0; $i < $limit; $i++){
		$words[] = $text[$i];
	}
	return implode(' ', $words);
}

// Custom numeric pagination function
	function get_numeric_pagination(){
		global $wp_query;
		global $numpages;
		$total_pages	= $wp_query->max_num_pages;
		$big			= 999999999; // need an unlikely integer
		if($total_pages > 1){
			echo '<div class="pagination">';
			echo paginate_links(
				array(
					'base'		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format'	=> '/page/%#%',
					'current'	=> max(1, get_query_var('paged')),
					'total'		=> $wp_query->max_num_pages,
					'type'		=> 'list',
					'prev_text'	=> '&laquo anterior',
					'next_text'	=> 'próxima &raquo'
				)
			);
			echo '</div>';
		}
	}

// Breadcrumbs
	function get_breadcrumbs(){
		$delimiter = '<span class="fa fa-angle-right"> </span>';
		$currentBefore = '<h4>';
		$currentAfter = '</h4>';
		echo '<div class="breadcrumb">';
		if(!is_home() && !is_front_page() || is_paged()){
			global $post;
			$home = get_bloginfo('url');
			echo '<a href="' . $home . '" title="Home">Home</a> ' . $delimiter . ' ';
			if(is_single() && !is_attachment()){
				$cat = get_the_category(); $cat = $cat[0];
				global $wp_query;
				// var_dump($wp_query->query_vars);
				echo '<a href="'.get_home_url().'/'.$wp_query->query_vars['post_type'].'/">'.$wp_query->query_vars['post_type'].'</a>'.$delimiter;
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} elseif(is_attachment()){
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} elseif(is_page() && !$post->post_parent){
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} elseif(is_page() && $post->post_parent){
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} elseif(is_search()){
				echo $currentBefore . 'Resultados da busca por &#39;' . get_search_query() . '&#39;' . $currentAfter;
			} elseif(is_tag()){
				echo $currentBefore . 'Posts com a tag &#39;';
				single_tag_title();
				echo '&#39;' . $currentAfter;
			} elseif(is_404()){
				echo $currentBefore . 'Erro 404' . $currentAfter;
			} elseif(is_archive()){
				global $wp_query;
				$ptTitle = get_post_type_object($wp_query->query_vars['post_type']);
				if($ptTitle->labels->name == 'Notícias'){
					echo $currentBefore . 'Mídia' . $currentBefore;
				} else{
					echo $currentBefore . $ptTitle->labels->name . $currentBefore;
				}
			}
		}
		echo '</div>';
	}
?>