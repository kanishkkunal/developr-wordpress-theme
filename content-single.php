<?php
/**
 * @package Developr
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="entry-meta">
		    
            <?php the_category(', '); ?>

            <a href="<?php the_permalink(); ?>"><?php developr_posted_on(); ?></a>
            <?php edit_post_link( __( 'Edit', 'developr' ), '<span class="edit-link">', '</span>' ); ?>
	    </div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'developr' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
			<?php the_tags('<p class="post-tags"><span>'.__('TAGS:','developr').'</span> <span class="label label-default">','</span> <span class="label label-default">','</span></p>'); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
