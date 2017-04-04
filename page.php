<?php get_header(); ?>

	<?php if(have_posts()): while(have_posts()): the_post(); ?>

		<section class="fullwidth-background">

            <div class="breadcrumb-wrapper">

                <div class="container">

                   <div class="breadcrumb">

                        <a href="index.html">Home</a>

                        <span class="fa fa-angle-right"> </span>

                        <h4><?php the_title(); ?></h4>

                        <h5 class="breadcrumb-title">Quem somos</h5>

                   </div> 

                </div>

            </div>                

        </section>



        <div class="hr-invisible"></div>

            <div class="clear"></div>

            <section id="primary" class="content-full-width">

                <div class="container">

                    <h2 class="border-title aligncenter"><?php the_title();?></h2>

                    <div class="column dt-sc-one-half first">

                        <?php the_content(); ?>

                    </div>

                    <div class="column dt-sc-one-half">

                    	<?php echo get_the_post_thumbnail(get_the_id(), 'page', array('class'=>'dt-sc-border-radius')); ?>

                    </div>

                </div>

                <div class="hr-invisible"></div>

               

                <div class="clear"></div>

                <div class="hr-invisible"></div>

            </section>  

	<?php endwhile; else: ?>

		<p class="msg-info"><?php _e('Sorry, no records were found','lang'); ?></p>

	<?php endif; ?>

<?php get_footer(); ?>