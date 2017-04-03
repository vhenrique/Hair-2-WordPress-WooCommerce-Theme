<?php get_header();
global $themePrefix;
if(have_posts()): while(have_posts()): the_post(); ?>
	<div class="hr-separator"></div>
	<div id="main">
		<section class="fullwidth-background">
	        <div class="breadcrumb-wrapper">
	            <div class="container">
	               	<?php 
	               		get_breadcrumbs();
						getPageCustomTitle($wp_query->query_vars['post_type']); 
					?>
	            </div>
	        </div>                
	    </section>
	    <div class="container">    
	        <div class="content">
		        <div class="column dt-sc-two-fifth first">
		        	<?php if(strlen(get_post_meta(get_the_id(), $themePrefix.'imgFiles', true)) || is_array(get_post_meta(get_the_id(), $themePrefix.'imgFiles', true))){
	        			$imgFiles = get_post_meta(get_the_id(), $themePrefix.'imgFiles', true);
	        			echo '<div class="portfolio-single"><ul class="portfolio-slider">';
		        		foreach($imgFiles as $id=>$url){
		        			echo '<li>'.wp_get_attachment_image($id, 'singleSlider').'</li>';
		        		}
		        		echo '</ul></div>';
		        	} else{
		        		echo '<div class="portfolio-single">';
		        		echo get_the_post_thumbnail(get_the_id(), 'singleSlider');
		        		echo '</div>';
		        	} ?>
		        </div>
		        <div class="column dt-sc-three-fifth">
		            <div class="hr-invisible-medium"></div>
		            <h3 class="border-title"><?php echo get_the_title(); ?></h3>
		            <?php 
		            echo '<i>'.apply_filters('the_content', get_the_excerpt()).'</i>';
		            the_content();

		            if(strlen(wp_get_post_tags(get_the_id()))) {
		            	echo '<ul class="info portfolio-single"><li><span>Tags :</span><h4>';
		            		foreach(wp_get_post_tags(get_the_id()) as $tag){
		            			echo $tag->name . ' ';
		            		}
		            	echo '</h4></li></ul>';
		            }

		            if(is_mobile()){
						echo '<a class="dt-sc-button small transparent" href="whatsapp://send" title="'.get_the_title().'" data-text="'.get_the_title().'" data-href="'.get_permalink().'"><i class="fa fa-whatsapp"></i>&nbsp; &nbsp; Compartilhar</a>';
					} else if($wp_query->query_vars['post_type'] == 'faixas' || $wp_query->query_vars['post_type'] == 'midia'){ ?>
						<form clsas="contact-form" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					        <div class="column dt-sc-one-half first animate" data-delay="100" data-animation="animated fadeIn">
					            <p><input type="text" name="contactName" placeholder="Seu nome " required/> </p>
					            <p><input type="email" name="contactEmail" placeholder="Email " required/></p>
					            <p><input type="text" required maxlength="11" name="contactCell" placeholder="Celular "/></p>
					            <p><textarea class="message" required rows="10" placeholder="Mensagem" cols="5" name="contactMessage"></textarea></p>
					            <input type="submit" value="Enviar" name="submit">
					        </div>
					        <?php 
					        if(!empty($_POST)){
					        	$message = $_POST['contactName']." - ".$_POST['contactEmail']." - ".$_POST['contactCell'] ." \r\n Enviou uma mensagem através do formulário em ". get_the_title() ."\r\n ". $_POST['contactMessage'];
								wp_mail($redux_options[$themePrefix.'cs_email'], get_the_title(), $message);
								echo '<script>alert("Sua mensagem foi enviada.")</script>';
					       	} ?>
					    </form>
					<?php } ?>
		        </div>
	        	<div class="hr-invisible"></div>
	    	</div>
		    <div class="column dt-sc-one-full">                       
		        <div class="dt-sc-tabs-container animate" data-delay="100" data-animation="animated fadeInLeft">
		        	<?php $i = 0;
		        	$terms = wp_get_post_terms(get_the_id(), 'category');
		        	if(!empty($terms)){
		        		foreach($terms as $term){
		        			$categories[] = $term->slug;
		        		}
		        	}
		        	$relateds = get_posts(array('post_type'=>$wp_query->query_vars['post_type'], 'posts_per_page'=>4, 'post__not_in'=>array(get_the_id()), 'tax_query' => array(array('taxonomy'=>'category', 'field'=>'slug', 'terms'=>$categories))));
		        	if(!empty($relateds)){
		        		echo '<h3 class="border-title">Itens relacionados</h3>';
		        		foreach($relateds as $related){
		        			if($i == 0){
		        				echo '<div class="column dt-sc-one-fourth first">';
		        			} else{
		        				echo '<div class="column dt-sc-one-fourth">';
		        			}
		        			echo '<div class="dt-sc-team type2 animate" data-delay="100" data-animation="animated fadeIn">';
			                echo '<div class="image">'.get_the_post_thumbnail($related->ID, 'midiaList', array('title'=>$related->post_title)).'</div>';
			                echo '<div class="info-produtos"><h5><a href="'.get_permalink($related->ID).'">'.$related->post_title.'</a></h5>';
			                echo '<span><a class="dt-sc-button small" href="'.get_permalink($related->ID).'" >Ver</a></span>';
			               	echo '</div></div></div>';
			               	$i++;
		        		}
		        	} ?>
					<div class="hr-invisible"></div>
				</div>
				<?php comments_template(); ?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?php endwhile; else: ?>
		<p class="msg-info"><?php _e('Sorry, no records were found','lang'); ?></p>
<?php endif;
get_footer(); ?>