<?php
/**
 * The template for displaying search forms in Developr
 *
 * @package Developr
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'developr' ); ?></span>
        <input type="text" class="search form-control" name="s" onblur="if(this.value=='')this.value='<?php _e('To search type and hit enter','developr'); ?>';" onfocus="if(this.value=='<?php _e('To search type and hit enter','anew'); ?>')this.value='';" value="<?php _e('To search type and hit enter','developr'); ?>" />
	</div>
</form>
