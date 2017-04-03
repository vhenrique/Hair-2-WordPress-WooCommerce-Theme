<?php get_header(); ?>
	<div id="content">
		<?php if(have_posts()): ?>
			<h2 class="page-title">Resultados da busca</h2>
			<?php while(have_posts()): the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<p class="post-meta">Postado em <?php the_time('j/m/y'); ?>, em <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); comments_popup_link('Sem comentários &#187;', '1 comentário &#187;', '% comentários &#187;'); ?></p>
					<div class="entry">
						<?php the_content('<p>Leia o resto deste post »</p>'); ?>
					</div>
				</div>
			<?php endwhile; ?>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Posts mais antigos') ?></div>
				<div class="alignright"><?php previous_posts_link('Posts mais novos &raquo;') ?></div>
			</div>
		<?php else : ?>
			<p class="msg-info">Nenhum post encontrado. Tente uma busca diferente.</p>
		<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>