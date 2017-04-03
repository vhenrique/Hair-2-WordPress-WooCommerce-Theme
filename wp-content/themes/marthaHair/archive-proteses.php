<?php get_header();
global $redux_options, $themePrefix;
if(have_posts()): 
	while(have_posts()): the_post(); ?>
	    <section class="fullwidth-background">
	        <div class="breadcrumb-wrapper">
	            <div class="container">
	               	<?php get_breadcrumbs();
	               	if(!empty($redux_options[$themePrefix.'ac_phrase_prothesis'])){
	               		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_prothesis'].'</h5>';
	               	} ?>
	            </div>
	        </div>                
	    </section>
	    <div class="container">
	    	<div class="hr-invisible"></div>
			<section id="primary" class="content-full-width">
			    <div class="fullwidth-section">
			        <div class="hr-invisible-medium"></div>
			        <div class="dt-sc-portfolio-container isotope no-space">
			        	<?php 
			        	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                		$args = array('post_type' => $wp_query->query_vars['post_type'], 'paged' => $paged);
			        	$query = new WP_Query($args);
						if($query->have_posts()){
							while ($query->have_posts() ){
								$query->the_post();
			        			echo '<div class="portfolio dt-sc-one-fourth column no-space all-sort">';
				                echo '<div class="dt-sc-team type4 padding" data-delay="100" data-animation="animated fadeIn">';
			                    echo '<div class="image">'.get_the_post_thumbnail(get_the_id(), 'hairList').'</div>';
			                    echo '<div class="info-foto">';
			                    echo '<h3>'.get_the_title().'</h3>';
			                    echo '<p>'.get_the_excerpt().'</p>';
			                    echo '<p><a class="dt-sc-button small transparent" href="'.get_permalink().'" title="'.get_the_title().'"><i class="fa fa-whatsapp"></i>&nbsp &nbspVer detalhes</a></p>';
			                    echo '</div></div></div>';
			        		}
			        	} ?>
			        </div>
			    </div>
			    <div class="clear"></div>
			</section>
	    </div>
<?php endwhile; endif;
get_footer(); ?>