<?php
/* ------------------------------------------------------------------------- *
 *  Dynamic styles
/* ------------------------------------------------------------------------- */

/*  Convert hexadecimal to rgb
/* ------------------------------------ */
if ( ! function_exists( 'developr_hex2rgb' ) ) {

	function developr_hex2rgb( $hex, $array=false ) {
		$hex = str_replace("#", "", $hex);

		if ( strlen($hex) == 3 ) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$rgb = array( $r, $g, $b );
		if ( !$array ) { $rgb = implode(",", $rgb); }
		return $rgb;
	}
	
}

/*  Lighten or darken a color
/* ------------------------------------ */
if ( ! function_exists( 'developr_lighten_darken' ) ) {
    function developr_lighten_darken($color_code,$percentage_adjuster = 0) {

        $percentage_adjuster = round($percentage_adjuster/100,2);

        if(is_array($color_code)) {

            $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);

            $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);

            $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);

 

            return array("r"=> round(max(0,min(255,$r))),

                "g"=> round(max(0,min(255,$g))),

                "b"=> round(max(0,min(255,$b))));

        }

        else if(preg_match("/#/",$color_code)) {

            $hex = str_replace("#","",$color_code);

            $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));

            $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));

            $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));

            $r = round($r - ($r*$percentage_adjuster));

            $g = round($g - ($g*$percentage_adjuster));

            $b = round($b - ($b*$percentage_adjuster));


            return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)

                .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)

                .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);
        }
    }
}

/*  Google fonts
/* ------------------------------------ */
if ( ! function_exists( 'developr_google_fonts' ) ) {

	function developr_google_fonts () {
		if ( ot_get_option('dynamic-styles') ) {
			if ( ot_get_option( 'font' ) == 'titillium-web-ext' ) { echo '<link href="http://fonts.googleapis.com/css?family=Titillium+Web:300italic,400italic,700italic,400,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'droid-serif' ) { echo '<link href="http://fonts.googleapis.com/css?family=Droid+Serif:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'source-sans-pro' ) { echo '<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300italic,400italic,700italic,400,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'lato' ) { echo '<link href="http://fonts.googleapis.com/css?family=Lato:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'ubuntu' ) { echo '<link href="http://fonts.googleapis.com/css?family=Ubuntu:300italic,400italic,700italic,400,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'roboto-condensed' ) { echo '<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'roboto-condensed-cyr' ) { echo '<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'open-sans' ) { echo '<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'open-sans-cyr' ) { echo '<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
		}
	}
	
}
add_action( 'wp_head', 'developr_google_fonts', 2 );


/*  Dynamic css output
/* ------------------------------------ */
if ( ! function_exists( 'developr_dynamic_css' ) ) {

	function developr_dynamic_css() {
		if ( ot_get_option('dynamic-styles') ) {
			
			// start output
			$styles = '<style type="text/css">'."\n";		
			
			// google fonts
			if ( ot_get_option( 'font' ) == 'titillium-web' ) { $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: "Titillium Web", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'droid-serif' ) { $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: "Droid Serif", sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'source-sans-pro' ) { $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: "Source Sans Pro", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'lato' ) { $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: "Lato", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'ubuntu' ) { $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: "Ubuntu", Arial, sans-serif; }'."\n"; }	
			if ( ( ot_get_option( 'font' ) == 'roboto-condensed' ) || ( ot_get_option( 'font' ) == 'roboto-condensed-cyr' ) ) { $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: "Roboto Condensed", Arial, sans-serif; }'."\n"; }			
			if ( ( ot_get_option( 'font' ) == 'open-sans' ) || ( ot_get_option( 'font' ) == 'open-sans-cyr' ) )	{ $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: "Open Sans", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'arial' ) { $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'georgia' ) { $styles .= 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: Georgia, serif; }'."\n"; }
			
			// primary accent color
			if ( ot_get_option('color-accent') != '#e67e22' ) {
				$styles .= '

a,
.link {
  color: '.ot_get_option('color-accent').';
}
a:hover, a:focus {
  color: '.developr_lighten_darken(ot_get_option('color-accent'), -30).';
}

.site-title a {
    color: #fbfbfb;
}

input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
    border: 1px solid '.ot_get_option('color-accent').';
}

input[type="submit"] {
background: '.ot_get_option('color-accent').';
}

input[type="submit"]:hover {
    background: '.developr_lighten_darken(ot_get_option('color-accent'), 20).';
}

.widget_calendar caption { background: '.ot_get_option('color-accent').'; }

.wp-pagenavi a { color: '.ot_get_option('color-accent').'; }
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current { border-bottom: 3px solid '.ot_get_option('color-accent').' !important; }
	
				'."\n";
			}	
			$styles .= '</style>'."\n";
			// end output
			
			echo $styles;		
		}
	}
	
}
add_action( 'wp_head', 'developr_dynamic_css', 100 );
