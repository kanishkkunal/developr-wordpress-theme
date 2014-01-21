<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Developr
 */
?>
</div><!-- #content -->

	<div id="secondary" class="widget-area" role="complementary">
        <div class="container">
		    <?php do_action( 'before_sidebar' ); ?>
            <div class="row">
                <div class="col-sm-4">
                    <?php dynamic_sidebar( 'footer-1' ) ?>
                </div>
                <div class="col-sm-4">
                    <?php dynamic_sidebar( 'footer-2' ) ?>
                </div>
                <div class="col-sm-4">
                    <?php dynamic_sidebar( 'footer-3' ) ?>
                </div>
            </div>
        </div>
	</div><!-- #secondary -->
