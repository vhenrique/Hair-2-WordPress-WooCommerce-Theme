<?php get_header(); 

global $redux_options, $themePrefix; ?>

	<div id="main">

		<div id="slider">

			<div id="layerslider_30" class="ls-wp-container" style="width:100%;height:500px;max-width:1920px;margin:0 auto;margin-bottom: 0px;">

	        	<div class="ls-slide" data-ls="slidedelay:10000;transition2d:4;">

	        		<img src="<?php echo $redux_options[$themePrefix.'welcome_thumbnail']['url']; ?>" class="ls-bg" alt="bg1" />

	        		<div class="ls-l" style="top:188px;left:25px;text-align:center; text-shadow: 1px 1px #000; z-index:500;width:300px;padding-left:0px;font-family:'Lato', 'Open Sans', sans-serif;font-size:30px;line-height:46px;color:#fff;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:-100;durationin:2000;delayin:1500;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">

	        			<span class="wel"><?php echo $redux_options[$themePrefix.'welcome_message']; ?></span>

	                </div>

	                <div class="ls-l" style="top:275px;left:25px;font-weight:300;z-index:300;background: rgba(0, 0, 0, 0.80);font-family:'Lato';font-size:24px;line-height:80px;color:#ffffff;padding-right:50px;padding-bottom:;padding-left:50px;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:2500;rotatexin:90;">

	                	<?php echo $redux_options[$themePrefix.'secondary_message']; ?>

	                </div>

	                

	            </div>

	            <?php $highlights = get_posts(array('post_type'=>'celebridades', 'posts_per_page'=>5, 'meta_key'=> $themePrefix.'featured', 'meta_value'=>'on'));

	            if(!empty($highlights)){

	            	foreach($highlights as $featured){ ?>

	            		<div class="ls-slide" data-ls="slidedelay:10000;transition2d:4;">

			        	<?php echo get_the_post_thumbnail($featured->ID, 'mainSlider', array('class'=>'ls-bg')); ?>

			        	<div class="ls-l" style="top:188px;left:25px;text-align:center; text-shadow: 1px 1px #000; z-index:500;width:300px;padding-left:0px;font-family:'Lato', 'Open Sans', sans-serif;font-size:30px;line-height:46px;color:#fff;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:-100;durationin:2000;delayin:1500;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">

			        	<span class="wel"><?php echo $featured->post_title; ?></span>

			            </div>

			            <div class="ls-l" style="top:275px;left:25px;font-weight:300;z-index:300;background: rgba(0, 0, 0, 0.80);font-family:'Lato';font-size:24px;line-height:80px;color:#ffffff;padding-right:50px;padding-bottom:;padding-left:50px;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:2500;rotatexin:90;">

						<?php echo $featured->post_excerpt.'</div></div>';

	            	}

	            } ?>

		    </div>

		</div>

		            

	    <div class="container">                 

	    	<div class="hr-invisible-small"></div>

	        <h2 class="border-title aligncenter animate" data-delay="100" data-animation="animated fadeInDown">Quem usa nossos cabelos</h2>

	        <div class="hr-invisible-very-very-small"></div>                

	        <?php $celebrities = get_posts(array('post_type'=>'celebridades', 'posts_per_page'=>5, 'orderby'=>'date', 'order'=>'DESC'));

	        if(!empty($celebrities)){

	        	$i = 0;

	        	foreach($celebrities aS $celebrity){

	        		if($i == 0){

	        			echo '<div class="column dt-sc-one-fifth first animate" data-delay="100" data-animation="animated fadeIn">';

	        		} else{

	        			echo '<div class="column dt-sc-one-fifth animate" data-delay="100" data-animation="animated fadeIn">';

	        		}

	                echo '<div class="dt-sc-team type2"><div class="image">'.get_the_post_thumbnail($celebrity->ID, 'celebrityListHome', array('title'=>$celebrity->post_title, 'alt'=>$celebrity->post_excerpt));

	                echo '<div class="team-details-social-icons">';

	                echo '<a class="fa fa-facebook" href="#"> </a>';

	                echo '<a class="fa fa-twitter" href="#"> </a>';

	                echo '</div></div><h5><a href="'.get_permalink($celebrity->ID).'">'.$celebrity->post_title.'</a></h5></div></div>';

	                $i++;

	        	}

	        } ?>

	        <div class="hr-invisible-very-small"></div>   

	        <h3 class="aligncenter"><a href="<?php echo get_home_url(); ?>/celebridades/">Ver todas as celebridades</a></h3>

	    </div>

	</div>

	<?php if(!empty($redux_options[$themePrefix.'fisrt_parallax'])){

		echo '<div class="fullwidth-section dt-sc-parallax-section dt-sc-counters" style="background: url('.$redux_options[$themePrefix.'fisrt_parallax']['url'].')">';

	} else{

		echo '<div class="fullwidth-section dt-sc-parallax-section dt-sc-counters">';

	}?>

    	<div class="fullwidth-bg">

            <div class="container">

	            <div class="hr-invisible-small"></div>

	            <?php $page = 56; ?>

	            <h2 class="border-title aligncenter animate" data-delay="100" data-animation="animated fadeInDown"><?php echo get_the_title($page)?></h2>

	            <div class="column dt-sc-one-half first">

	                <h3 class="border-title none"><?php echo get_bloginfo('site_name')?></h3>

	                <div class="clear"></div>

	                <?php echo apply_filters('the_content', get_post_field('post_content', $page)); ?>

	            </div>



	            <div class="column dt-sc-one-fourth">

	                <div class="hr-invisible-small"></div>

	                <?php echo get_the_post_thumbnail($page); ?>

	            </div>

	            <div class="hr-invisible"></div>

            </div> 

        </div>

    </div>



    <div class="clear"></div>

    <div class="hr-invisible-small"></div>

    <div class="fullwidth-section dt-service-hme">

    	<div class="container">

            <h2 class="border-title aligncenter animate" data-delay="100" data-animation="animated fadeInDown">Vídeos</h2>

            <div class="column dt-sc-one-half first" data-delay="100" data-animation="animated fadeIn">

            	<iframe width="515" height="315" src="https://www.youtube.com/embed/4BE6E8maTjU" frameborder="0" allowfullscreen></iframe>

            </div>



            <div class="column dt-sc-one-half" data-delay="100" data-animation="animated fadeIn">

            	<iframe width="515" height="315" src="https://www.youtube.com/embed/PDDBqjMSUwE" frameborder="0" allowfullscreen></iframe>

            </div>

        </div>

	</div>



    <div class="clear"></div>

    <div class="hr-invisible-small"></div>

    <div class="fullwidth-section dt-service-hme">

    	<div class="container">

            <h2 class="border-title aligncenter animate" data-delay="100" data-animation="animated fadeInDown">Faixas de cabelos</h2>

            <?php $bands = get_posts(array('post_type'=>'faixas', 'posts_per_page'=> 4));

            if(!empty($bands)){

            	$i = 0;

            	foreach($bands as $band){

            		if($i == 0){

            			echo '<div class="column dt-sc-one-fourth first animate" data-delay="100" data-animation="animated fadeIn">';

            		} else{

            			echo '<div class="column dt-sc-one-fourth animate" data-delay="100" data-animation="animated fadeIn">';

            		}

                	echo '<div class="dt-sc-service type1"><h3><a href="'.get_permalink($band->ID).'">'.$band->post_title.'</a></h3>';

                    echo '<a href="'.get_permalink($band->ID).'" title="'.$band->post_title.'"><figure class="gallery-thumb">';

                   	echo get_the_post_thumbnail($band->ID, 'bands', array('class'=>'attachment-gallery-with-shape first-img', 'title'=>get_the_title($band->ID)));

                   	echo get_the_post_thumbnail($band->ID, 'bands', array('class'=>'attachment-gallery-with-shape second-img', 'title'=>get_the_title($band->ID)));

                    echo '</figure></a>';

                    echo '<div class="gallery-details"><p>'.$band->post_excerpt.'</p></div></div></div>';

                    $i++;

            	}

            } ?>           

        </div>

	</div>



	<div class="clear"></div>

	<?php if(!empty($redux_options[$themePrefix.'fisrt_parallax'])){

		echo '<div class="fullwidth-section dt-sc-parallax-section dt-sc-client-testimonial" style="background: url('.$redux_options[$themePrefix.'second_parallax']['url'].')">';

	} else{

		echo '<div class="fullwidth-section dt-sc-parallax-section dt-sc-client-testimonial">';

	}?>

    	<div class="fullwidth-bg">

            <div class="container">

                <div class="hr-invisible"></div>

                <h2 class="border-title aligncenter animate" data-delay="100" data-animation="animated fadeInDown">O que estão falando de nós. </h2>

                <div class="dt-sc-testimonial-carousel-wrapper">

                	<ul class="dt-sc-testimonial-carousel">

	                    <?php $opinions = get_posts(array('post_type'=>'opinioes', 'posts_per_page'=>4));

	                    if(!empty($opinions)){

	                    	foreach($opinions as $opinion){

	                    		echo '<li><div class="dt-sc-testimonial">';

	                    		if(strlen(get_post_meta($opinion->ID, $themePrefix.'opinion_video', true)) > 0){

	                    			echo '<iframe width="450" height="250" src="'.get_post_meta($opinion->ID, $themePrefix.'opinion_video', true).'"></iframe>';

	                    		}
	                            echo '<div class="author"><span class="hexagon2"></span><div class="hexagon-image"><div class="hexagon-in1"><div class="hexagon-in2">'.get_the_post_thumbnail($opinion->ID, 'opinionIcon', array('title'=>get_post_meta($opinion->ID, $themePrefix.'opinion_author', true))).'</div></div></div></div>';
	                            echo '<div class="author-detail">'.get_post_meta($opinion->ID, $themePrefix.'opinion_author', true).'<span> '.get_post_meta($opinion->ID, $themePrefix.'opinion_where', true).' </span></div>';
                                echo '<blockquote><q>'.$opinion->post_excerpt.'</q></blockquote>';
                                echo '</div></li>';
	                    	}

	                    } ?>

	                    </ul>

	                </div>

                <div class="hr-invisible"></div>

            </div>

        </div>

    </div>



	<div class="clear"></div>

    <div class="hr-invisible"></div>        

    <div class="container">

    	<h2 class="border-title aligncenter animate" data-delay="100" data-animation="animated fadeInDown">Saiu na mídia</h2>

        <div class="hr-invisible-very-very-small"></div>

        <?php $medias = get_posts(array('post_type'=>'midia', 'posts_per_page'=>3));

        if(!empty($medias)){

        	$i = 0;

        	foreach($medias as $media){

        		if($i == 0){

        			echo '<div class="column dt-sc-one-third first"><article class="blog-entry animate" data-delay="100" data-animation="animated fadeIn">';

        		} else{

        			echo '<div class="column dt-sc-one-third"><article class="blog-entry animate" data-delay="100" data-animation="animated fadeIn">';

        		}

                echo '<div class="entry-thumb"><a href="'.get_permalink($media->ID).'">'.get_the_post_thumbnail($media->ID, 'mediaListHome').'</a></div>';

                echo '<div class="entry-details"><div class="entry-title"><h4><a href="'.get_permalink($media->ID).'">'.$media->post_title.'</a></h4></div>';

                echo '<div class="entry-metadata"><p>'.$media->post_excerpt.'</p></div></div></article></div>';

                $i++;

        	}

        } ?>

        <div class="hr-invisible"></div>

	</div>



	<div class="fullwidth-section dt-sc-center">

    	<h2 class="border-title aligncenter align animate" data-delay="100" data-animation="animated fadeInDown">Entre em contato</h2>

    	<div class="container">

            <form class="contact-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <div class="column dt-sc-one-half first animate" data-delay="100" data-animation="animated fadeIn">

                    <p><input type="text" name="contactName" placeholder="Seu nome " required/> </p>

                    <p><input type="email" name="contactEmail" placeholder="Email " required/></p>

                </div>

                <div class="column dt-sc-one-half animate" data-delay="300" data-animation="animated fadeIn">

                    <p><input type="text" required maxlength="11" name="contactCell" placeholder="Celular "/></p>

                    <p><input type="text" required name="contactSubject" placeholder="Assunto"/></p>

                </div>

                <div class="column dt-sc-one-column animate" data-delay="500" data-animation="animated fadeIn">

                    <p><textarea class="message" required rows="10" placeholder="Mensagem" cols="5" name="contactMessage"></textarea></p>

                </div>

                <?php if(!empty($_POST)){

                	$message = $_POST['contactName']." - ".$_POST['contactEmail']." - ".$_POST['contactCell'] ." \r\n Enviou uma mensagem através do formulário de contato do site. \r\n ". $_POST['contactMessage'];

					wp_mail($redux_options[$themePrefix.'cs_telephone'], $_POST['contactSubject'], $message);

                    echo '<script>alert("Sua mensagem foi enviada.")</script>';

               	}?>



                <ul class="phone">

                    <li><i class="fa fa-mobile-phone"></i><?php echo $redux_options[$themePrefix.'cs_telephone']; ?></li>

                    <li><i class="fa fa-envelope-o"></i><a href="mailto:yourname@somemail.com"><?php echo $redux_options[$themePrefix.'cs_email']; ?></a></li>

                </ul>

                <div class="form-row aligncenter">

                    <input type="submit" value="Enviar" name="submit">

                </div>

            </form> 

            <div id="ajax_contactform_msg"> </div> 

        </div>

    </div>

<?php get_footer(); ?>