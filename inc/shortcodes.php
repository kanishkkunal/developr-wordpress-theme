<?php
/* ------------------------------------------------------------------------- *
 *  Developr Shortcodes
/* ------------------------------------------------------------------------- */

/*  Behance Portfolio
/* ------------------------------------ */
	function developr_behance_shortcode($atts,$content=NULL) {

        $output_content = "";
		// put your behance feed in the string http://www.behance.net/YOURFEED.xml
        $rss = fetch_feed('http://www.behance.net/'.$content.'.xml');

        if ( is_wp_error( $rss ) ) {
            return "";
        }

        // set the number of items, now there are 9 items
        $maxitems = $rss->get_item_quantity(9);

        // get the items
        $rss_items = $rss->get_items(0, $maxitems);
    
        $output_content .= '<div id="behance" class="row">';

        // handle if there is no feed or an empty feed
        if (!$rss_items) :
	        $output_content .= '<p>No items.</p>';
        else : 

        // function to get the image out of the description tag in the feed
        // http://www.catswhocode.com/blog/10-php-code-snippets-for-working-with-strings
        function GetBetween($content,$start,$end) {
	        $r = explode($start, $content);
	        if (isset($r[1])){
		        $r = explode($end, $r[1]);
		        return $r[0];
	        }
	        return '';
        }

        foreach ( $rss_items as $item ) :

        $output_content .= '<div class="col-sm-4 col-xs-12"><div class="thumbnail" style="border:none;min-height:240px;">';
        $output_content .=        '<a target="_blank" href="'. $item->get_permalink().'" title="'. $item->get_title().'">';
        $output_content .=         "<img src='".GetBetween($item->get_description(), "<img src='", "'")."' alt='".html_entity_decode($item->get_title())."'>";
        $output_content .=         '<div class="caption"><h3 class="h6 text-center">'.html_entity_decode($item->get_title()).'</h3></div>';
        $output_content .=         '</a>';
        $output_content .= '</div></div>';
      
        endforeach;
 
        $output_content .= '</div>';

        endif;

        return $output_content;
	}

	add_shortcode('behance','developr_behance_shortcode');
	