<section id="secondary" class="secondary-right-sidebar">
    <aside class="widget searchwidget">
        <form class="searchform" name="searchform" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">
            <p>
                <input type="text" required placeholder="Digite a palavra" name="ss">
                <input type="submit" class="icon-search" value="">
            </p>
        </form>
    </aside>
    <aside class="widget widget_recent_entries">
        <?php 
        $news = get_posts(array('post_type' => $wp_query->query_vars['post_type'], 'posts_per_page'=>3));
            if(!empty($news)){
                echo '<h3 class="border-title">Últimos post</h3>';
                echo '<div class="recent-posts-widget"><ul>';
                foreach($news as $new){
                    echo '<li class="entry-details"><a href="'.get_permalink($new->ID).'">'.get_the_post_thumbnail($new->ID, 'midiaNews', array('title'=>$new->post_title, 'alt'=>$new->post_excerpt)).'</a>';
                    echo '<div class="entry-meta"><div class="date">'.get_the_date('d', $new->ID) .'<span>'.get_the_date('M Y', $new->ID).'</span></div></div>';
                    echo '<div class="entry-metadata"><h3><a href="'.get_permalink($new->ID).'">'.$new->post_title.'</a></h3><div class="hr-separator"></div></div>';
                    echo '<div class="entry-body"><p>'.limitText($new->post_excerpt, 5).'</p></div></li>';
                }
                echo '</ul></div>';
            }   
        ?>
    </aside>        
    <div class="hr-invisible-very-small"></div>
    <div class="hr-invisible-very-very-small"></div>
    <div class="clear"></div>            
    <aside class="widget widget_categories">
        <?php $tags = get_terms('post_tag', array('hide_empty'=>0));
        if(!empty($tags)){
            echo '<h3 class="border-title">Categorias</h3><ul>';
            foreach($tags as $tag){
                echo '<li><a href="?tag='.$tag->slug.'" title="'.$tag->name.'">'.$tag->name.'<span>'.$tag->count.'</span></a></li>';
            }
            echo '</ul>';
        } ?>
    </aside>                

    <div class="hr-invisible-small"></div>
    <div class="clear"></div>            
    <aside class="widget commentbox">
        <?php $comments = get_comments(array('post_type'=>$wp_query->query_vars['post_type'], 'number'=>5));
        if(!empty($comments)){
            echo '<h3 class="border-title">Comentários recentes</h3><ul>';
            foreach($comments as $comment){
                echo '<li><p>'.limitText($comment->comment_content, 10).'</p><h4>'.human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' atrás'.'</h4></li>';
            }
            echo '</ul>';
        } ?>
        </ul>
    </aside>
    <div class="hr-invisible-small"></div>
    <div class="clear"></div>            
</section>