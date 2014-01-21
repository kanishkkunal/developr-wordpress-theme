<?php
/**
 * @package Developr
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><?php if ( is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-star"></i> </span>'; ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>	
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
	</header><!-- .entry-header -->

    
	<?php if ( has_post_thumbnail() ): ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
			    <?php the_post_thumbnail('thumb-medium'); ?>
            </a>
	    </div><!--/.post-thumbnail-->
	<?php endif; ?>
		
	
	<div class="entry-summary">
        <?php the_excerpt(); ?>

         <?php if ( 'post' == get_post_type() ) : ?>
		    <div class="entry-meta">
			    <?php
				    /* translators: used between list items, there is a space after the comma */
				    $tags_list = get_the_tag_list( '', __( ', ', 'developr' ) );
				    if ( $tags_list ) :
			    ?>
			    <div class="tags-links">
				    <?php printf( __( '<i class="fa fa-tags"></i> %1$s', 'developr' ), $tags_list ); ?>
			    </div>
			    <?php endif; // End if $tags_list ?>

		    </div><!-- .entry-meta -->
		 <?php endif; ?>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->
