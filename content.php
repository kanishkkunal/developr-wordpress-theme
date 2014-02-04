<?php
/**
 * @package Developr
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php if ( is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-star"></i> </span>'; ?><?php the_title(); ?></a></h2>	
	</header><!-- .entry-header -->
    <?php if ( 'post' == get_post_type() ) : ?>
        <div class="entry-meta">
		    
            <?php
			    /* translators: used between list items, there is a space after the comma */
			    $categories_list = get_the_category_list( __( ', ', 'developr' ) );
			    if ( $categories_list && developr_categorized_blog() ) :
		    ?>
		    <span class="cat-links">
			    <?php printf( __( '%1$s', 'developr' ), $categories_list ); ?>
		    </span>
		    <?php endif; // End if categories ?>

            <a href="<?php the_permalink(); ?>"><?php developr_posted_on(); ?></a>
	    </div><!-- .entry-meta -->
	<?php endif; ?>
    
	<?php if ( has_post_thumbnail() ): ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
			    <?php the_post_thumbnail('thumb-medium'); ?>
            </a>
	    </div><!--/.post-thumbnail-->
	<?php endif; ?>
		
	
	<div class="entry-summary">
        <?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
    <div class="more-tag">
        <a class="" href="<?php the_permalink(); ?>" ><?php echo __( 'Read More', 'developr' ) ?> &rarr;</a>
    </div>
</article><!-- #post-## -->
