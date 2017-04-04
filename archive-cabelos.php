<?php get_header();
global $redux_options, $themePrefix; ?>
	    <section class="fullwidth-background">
	        <div class="breadcrumb-wrapper">
	            <div class="container">
	               	<?php get_breadcrumbs();
	               	if(!empty($redux_options[$themePrefix.'ac_phrase_hair'])){
	               		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_hair'].'</h5>';
	               	} ?>
	            </div>
	        </div>
	    </section>
	    <div class="container">
	    	<div class="hr-invisible"></div>
			<section id="primary" class="content-full-width">
			    <div class="fullwidth-section">
			    	<div class="container">
                        <div class="dt-sc-sorting-container">
                        <?php $terms = get_terms('tax_tones', array('hide_empty'=>1)); 
                        if(!empty($terms)){
                        	echo '<a data-filter=".all-sort" class="active-sort" href="#" >Todas</a>';
                        	foreach($terms as $term){
                        		echo '<a data-filter=".'.$term->slug.'" href="#" >'.$term->name.'</a>';
                        	}
                        } ?>
                        </div>
                    </div>

			        <div class="hr-invisible-medium"></div>
			        <div class="dt-sc-portfolio-container isotope no-space">
			        	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                		$args = array('post_type' => $wp_query->query_vars['post_type'], 'paged' => $paged);
			        	$query = new WP_Query($args);
						if($query->have_posts()){
							while ($query->have_posts() ){
								$query->the_post();
								$ton = wp_get_post_terms(get_the_id(), 'tax_tones');
			        			echo '<div class="portfolio dt-sc-one-fourth column no-space all-sort '.$ton[0]->slug.'">';
				                echo '<div class="dt-sc-team type4 padding" data-delay="100" data-animation="animated fadeIn">';
			                    echo '<div class="image">'.get_the_post_thumbnail(get_the_id(), 'hairList').'</div>';
			                    echo '<div class="info-foto">';
			                    echo '<h3>'.get_the_title().'</h3>';
			                    echo '<p>'.get_the_excerpt().'</p>';

			                    if(is_mobile()){
			                    	echo '<p><a class="dt-sc-button small transparent" href="whatsapp://send" title="'.get_the_title().'" data-text="'.get_the_title().'" data-href="'.get_permalink().'"><i class="fa fa-whatsapp"></i>&nbsp; &nbsp; Compartilhar</a></p>';
			                    } else{
			                    	echo '<p><a class="dt-sc-button small transparent" href="'.get_permalink().'" title="'.get_the_title().'">Ver detalhes</a></p>';
			                    }
			                    echo '</div></div></div>';
			        		}
			        		echo '<div class="aligncenter">'.get_numeric_pagination().'</div>';
			        	} ?>
			        </div>
			    </div>
			    <div class="clear"></div>
			</section>
	    </div>
<?php get_footer(); ?>