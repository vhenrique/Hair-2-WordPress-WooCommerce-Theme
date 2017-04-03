<?php get_header(); ?>
	<div id="content">
		<?php if(have_posts()): ?>
			<h2 class="page-title">
				<?php
					if(is_category()){
						single_cat_title();
					} elseif(is_tag()){
						echo 'Posts com a tag <strong>'; single_tag_title(); echo '</strong>';
					} elseif(is_day()){
						echo 'Arquivo de '; the_time('d F, Y');
					} elseif(is_month()){
						echo 'Arquivo de '; the_time('F, Y');
					} elseif(is_year()){
						echo 'Arquivo de '; the_time('Y');
					} elseif(is_author()){
						echo 'Arquivo do autor';
					} elseif(isset($_GET['paged']) && !empty($_GET['paged'])){
						echo 'Arquivos do blog';
					}
				?>
			</h2>
			<?php while(have_posts()): the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h1 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<p class="post-meta">Postado em <?php the_time('j/m/y'); ?>, em <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); comments_popup_link('Sem comentários &#187;', '1 comentário &#187;', '% comentários &#187;'); ?></p>
					<div class="entry">
						<?php the_content('Leia o resto deste post »'); ?>
					</div>
				</div>
			<?php endwhile; ?>

			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Posts mais antigos') ?></div>
				<div class="alignright"><?php previous_posts_link('Posts mais novos &raquo;') ?></div>
			</div>

			<?php if(function_exists("get_numeric_pagination")) get_numeric_pagination(); ?>

		<?php else :
			if(is_category()){ // If this is a category archive
				printf("<p class='msg-info'>Não há nenhum post na categoria '%s' ainda.</p>", single_cat_title('',false));
			} else if(is_date()){ // If this is a date archive
				echo("<p class='msg-info'>Não há nenhum post com esta data.</p>");
			} else if(is_author()){ // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf("<p class='msg-info'>Não há nenhum post por %s ainda.</p>", $userdata->display_name);
			} else {
				echo("<p class='msg-info'>Nenhum post encontrado.</p>");
			}
		endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>