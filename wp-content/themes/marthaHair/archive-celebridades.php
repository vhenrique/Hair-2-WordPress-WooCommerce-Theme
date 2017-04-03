<?php get_header();
global $redux_options, $themePrefix; ?>
    <section class="fullwidth-background">
        <div class="breadcrumb-wrapper">
            <div class="container">
               	<?php get_breadcrumbs();
               	if(!empty($redux_options[$themePrefix.'ac_phrase_celebrity'])){
               		echo '<h5 class="breadcrumb-title">'.$redux_options[$themePrefix.'ac_phrase_celebrity'].'</h5>';
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
		        	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            		$args = array('post_type' => $wp_query->query_vars['post_type'], 'paged' => $paged);
		        	$query = new WP_Query($args);
					if($query->have_posts()){
						while ($query->have_posts() ){
							$query->the_post();
		        			echo '<div class="portfolio dt-sc-one-third  column no-space all-sort">';
	                        echo '<figure>'.get_the_post_thumbnail(get_the_id(), 'celebrityList');
	                        echo '<figcaption><div class="fig-content"><a class="link" href="'.get_permalink().'"></a>';
	                        echo '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
	                        echo '</div></figcaption></figure></div>';
		        		}
		        	} ?>
		        </div>
		        <div class="hr-invisible"></div>
		        <div class="aligncenter">
                    <?php get_numeric_pagination(); ?>
                </div>
            </div>
            <div class="hr-invisible"></div>
        </section>
	</div>
<?php get_footer(); ?>