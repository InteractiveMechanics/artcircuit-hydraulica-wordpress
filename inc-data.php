<script>
var data = 
{
    "hotspots": [
        <?php 
            $the_query = new WP_Query( array('post_type' => 'hotspot', 'posts_per_page' => -1) );
        ?>
        <?php if ($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post(); ?>
        {
            "id": "<?php print $post->post_name; ?>",
            "category": "stormwater",
            "position": {
                <?php if (get_field('bottom')): ?>"bottom": "<?php the_field('bottom'); ?>%",<?php endif; ?>
                <?php if (get_field('left')): ?>"left": "<?php the_field('left'); ?>px"<?php endif; ?>
            },
            "size": {
                <?php if (get_field('width')): ?>"width": "<?php the_field('width'); ?>px",<?php endif; ?>
                <?php if (get_field('height')): ?>"height": "<?php the_field('height'); ?>px"<?php endif; ?>
            },
            "modal": {
                <?php if (get_the_content()): ?>"description": <?php print json_encode($post->post_content); ?><?php endif; ?>
            }
        }
        <?php endwhile; endif; wp_reset_postdata(); ?>
    ]
}
</script>