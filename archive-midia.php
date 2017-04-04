<?php get_header();

global $redux_options, $themePrefix; ?>

	    <section class="fullwidth-background">

	        <div class="breadcrumb-wrapper">

	            <div class="container">

	               	<?php get_breadcrumbs();

	               	if(!empty($redux_options[$themePrefix.'ac_phrase_news'])){

	               		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_news'].'</h5>';

	               	} ?>

	            </div>
	        </div>
	    </section>
	    <div class="container">
            <div class="hr-invisible"></div>
            <section id="primary" class="page-with-sidebar with-right-sidebar">
            	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array('post_type' => $wp_query->query_vars['post_type'], 'paged' => $paged);
                if(isset($_GET)){
                    foreach($_GET as $key => $value){
                        if(isset($_GET[$key])){
                            if($key == 'ss'){
                                $args['s'] = $value;
                            }
                            $args[$key] = $value;
                        }
                    }
                }
				$query = new WP_Query($args);
				if($query->have_posts()){
					while ($query->have_posts() ){
						$query->the_post();

            			echo '<article class="blog-entry">';

	                    echo '<div class="entry-thumb">';

	                    echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_id(), 'midiaList', array('title'=>get_the_title(), 'alt'=>get_the_excerpt())).'</a>';

	                    echo '</div><div class="entry-details"><div class="entry-title">';

	                    echo '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';

	                    echo '</div><div class="entry-meta"><div class="date">'.get_the_date('d').'<span>'.get_the_date('M').'</span></div></div>';

	                    echo '<div class="entry-metadata"><p>'.get_the_excerpt().'</p>';

	                    echo '<div class="clear"></div>';

	                    echo '<div class="hr-invisible-very-small"></div>';

	                    echo '<div class="hr-separator"></div>';

	                    echo '<div class="author"><i class="fa fa-user"></i><span class="authorLabel">'.get_the_author_meta('user_nicename', get_the_author_id()).'</span|></div>';

	                    $tags = wp_get_post_tags(get_the_id());

	                    if(!empty($tags)){

	                    	echo '<div class="tags"><i class="fa fa-tag"></i>';

	                    	foreach($tags as $tag){

	                    		echo '<a href="'.get_term_link($tag, 'post_tag').'">'.$tag->name.'</a> ';

	                    	}

	                    }

	                    echo '</div><div class="comments"><a href="'.get_permalink(get_the_id()).'">';

	                    echo '<i class="fa fa-comment"></i>'.get_comments_number(get_the_id()).'</a></div>';

	                    echo '</div>';

                        echo '</article>';

		                echo ' <div class="hr-invisible-small"></div><div class="hr-separator"></div><div class="hr-invisible-small"></div>';

            		}

            		echo '<div class="hr-invisible-small"></div><div class="hr-invisible-very-very-small"></div>';

            		get_numeric_pagination();

            	} ?>

            </section>

            <?php get_sidebar(); ?>

        </div>

<?php get_footer(); ?> 