<script>
var data = 
{
    "hotspots": [
        <?php 
            $count = 0;
            $the_query = new WP_Query( array('post_type' => 'hotspot', 'posts_per_page' => -1) );
        ?>
        <?php if ($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post(); ?>
        {
            "id": "<?php print $post->post_name; ?>",
            "category": "stormwater",
            "image": "<?php the_field('image'); ?>",
            "position": {
                <?php if (get_field('bottom')): ?>"bottom": "<?php the_field('bottom'); ?>px",<?php endif; ?>
                <?php if (get_field('left')): ?>"left": "<?php the_field('left'); ?>px",<?php endif; ?>
                <?php if (get_field('z-index')): ?>"zindex": "<?php the_field('z-index'); ?>"<?php endif; ?>
            },
            "size": {
                <?php if (get_field('width')): ?>"width": "<?php the_field('width'); ?>px",<?php endif; ?>
                <?php if (get_field('height')): ?>"height": "<?php the_field('height'); ?>px"<?php endif; ?>
            },
            "modal": {
                <?php if (get_the_title()): ?>"title": <?php print json_encode($post->post_title); ?>,<?php endif; ?>
                <?php if (get_the_content()): ?>"description": <?php print json_encode($post->post_content); ?>,<?php endif; ?>
                <?php if (get_field('content_image')): ?>"image": "<?php the_field('content_image'); ?>",<?php endif; ?>
                <?php if (get_field('link')): ?>"link": "<?php the_field('link'); ?>"<?php endif; ?>
            }
        }<?php if($count < $the_query->found_posts){ echo ','; } $count++; ?>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    ]
}
</script>