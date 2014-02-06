<?php

/*  Initialize the options before anything else. 
/* ------------------------------------ */
add_action( 'admin_init', 'custom_theme_options', 1 );


/*  Build the custom settings & update OptionTree.
/* ------------------------------------ */
function custom_theme_options() {
	
	// Get a copy of the saved settings array.
	$saved_settings = get_option( 'option_tree_settings', array() );

	// Custom settings array that will eventually be passed to the OptionTree Settings API Class.
	$custom_settings = array(

/*  Help pages
/* ------------------------------------ */	
	'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'Help',
          'content'   => '
			<h1>Anew</h1>
			<p>Thanks for using this theme! First, a friendly warning: Please remember that the "Reset Options" button resets <strong>ALL</strong> options. That means, if you reset your styling options, all your custom sidebars and other settings will be reset as well.</p>
			<h3>Frequently Asked Questions</h3>
			<p><i>Q: Why are social sharing buttons missing Google Plus?</i> &mdash; A: You need to enable urlCurl on your server for G+ to work. Ask your webhost to do so. If you are unable to, you can disable the buttons and use any other plugin instead.</p>
			<p><i>Q: My old thumbnails have different sizes, why?</i> &mdash; A: Thumbnails uploaded before changing theme will not be automatically re-cropped. To fix this, you need to run the <a target="_blank" href="http://wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a> plugin once.</p>
			<p><i>Q: I did not use featured images before and have many posts, what do I do?</i> &mdash; A: Use the <a target="_blank" href="http://wordpress.org/plugins/easy-add-thumbnail/">Easy Add Thumbnail</a> plugin to automatically make the first image uploaded to each post a featured image.</p>
			<p><i>Q: Why is my featured image not appearing on the single post page?</i> &mdash; A: You need to use the "Image" format option for it to show up, as not everyone wants to show the featured image at the top for the "Standard" post format.</p>
			<p><i>Q: My gallery format post shows images twice, why?</i> &mdash; A: This is because you insert a standard gallery into the post itself. This is not needed, as the gallery format post will auto-display attached images in the slider above.</p>
			<p><i>Q: My slider gallery includes images I only want to show in the content below</i> &mdash; A: The gallery format will always show all attached images. For it to not show up, go to Media > Add New and upload it there. Then go back to the post and add it.</p>
			<h3>Dynamic Styles</h3>
			<p>The dynamic styles will be added directly to the head of your theme. This is according to WordPress best practices, but if you do not want it printed out there, simply inspect the code of your page with the styling options set. Copy the CSS from head into your child theme\'s style.css file or this theme\'s custom.css (which you need to enable), and disable dynamic styling.</p>
			<h3>Theme Customization</h3>
			<p>When modifiying the theme you should always use a child theme, otherwise your customized files will be removed/overwritten when you update the theme. Download the sample child theme below and upload it via admin. Then activate your child theme and start customizing it!</p>
			<ul>
				<li>Read more how to use a child theme <a target="_blank" href="http://codex.wordpress.org/Child_Themes">here</a>.</li>
				<li>Download the Anew sample child theme <a href="https://github.com/AlxMedia/anew-child/archive/master.zip">here</a>.</li>
			</ul>
			<p>If you are <strong>not using a child theme</strong>, you must do this before each theme update:</p>
			<ol>
				<li>Backup your custom.css file if you have used it, it will be overwritten and needs to be re-added after the update.</li>
				<li>Backup your additional language files if you have created/modified any, they will be removed and need to be re-added after the update.</li>
				<li>Backup any other custom code.</li>
			</ol>
		'
        )
      )
    ),
	
/*  Admin panel sections
/* ------------------------------------ */	
	'sections'        => array(
		array(
			'id'		=> 'blog',
			'title'		=> 'Blog'
		),
		array(
			'id'		=> 'header',
			'title'		=> 'Header'
		),
		array(
			'id'		=> 'footer',
			'title'		=> 'Footer'
		),
		array(
			'id'		=> 'social-links',
			'title'		=> 'Social Links'
		),
		array(
			'id'		=> 'styling',
			'title'		=> 'Styling'
		),
	),
	
/*  Theme options
/* ------------------------------------ */
	'settings'        => array(
		
		// Blog: Single - Content or Excerpt
		array(
			'id'		=> 'post-text',
			'label'		=> 'Content or Excerpt',
			'desc'		=> 'More link appears at the bottom of both excerpt and content',
			'std'		=> 'excerpt',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => 'excerpt',
					'label' => 'Show Excerpt'
				),
				array( 
					'value' => 'content',
					'label' => 'Show Content'
				)
			)
		),
		// Blog: Excerpt Length
		array(
			'id'			=> 'excerpt-length',
			'label'			=> 'Excerpt Length',
			'desc'			=> 'Max number of words',
			'std'			=> '34',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,100,1'
		),
		// Blog: Single - Post Navigation
		array(
			'id'		=> 'post-nav',
			'label'		=> 'Single &mdash; Post Navigation',
			'desc'		=> 'Shows links to the next and previous article',
			'std'		=> 'content',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Disable'
				),
				array( 
					'value' => 'content',
					'label' => 'Below content'
				)
			)
		),
		// Header: Custom Logo
		array(
			'id'		=> 'custom-image',
			'label'		=> 'Custom Image',
			'desc'		=> 'Upload your custom Profile Image. Its highly recommended that you set your gravatar instead of setting this option.',
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Header: Site Description
		array(
			'id'		=> 'site-description',
			'label'		=> 'Site Description',
			'desc'		=> 'The description that appears below your site name in header',
			'type'		=> 'checkbox',
			'section'	=> 'header',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Disable'
				)
			)
		),
		// Footer: Copyright
		array(
			'id'		=> 'copyright',
			'label'		=> 'Footer Copyright',
			'desc'		=> 'Replace the footer copyright text',
			'type'		=> 'text',
			'section'	=> 'footer'
		),
		// Footer: Credit
		array(
			'id'		=> 'credit',
			'label'		=> 'Footer Credit',
			'desc'		=> 'Disable footer credit text',
			'std'		=> '',
			'type'		=> 'checkbox',
			'section'	=> 'footer',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Disable'
				)
			)
		),
		// Layout : Default Page
		array(
			'id'		=> 'layout-page',
			'label'		=> 'Default Page',
			'desc'		=> '[ <strong>is_page</strong> ] Default page layout - If a page has a set layout, it will override this.',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Social Links : List
		array(
			'id'		=> 'social-links',
			'label'		=> 'Social Links',
			'desc'		=> 'Create and organize your social links',
			'type'		=> 'list-item',
			'section'	=> 'social-links',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'social-icon',
					'label'		=> 'Icon Name',
					'desc'		=> 'Font Awesome icon names [<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><strong>View all</strong>]</a>  ',
					'std'		=> 'fa-',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-link',
					'label'		=> 'Link',
					'desc'		=> 'Enter the full url for your icon button',
					'std'		=> 'http://',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-color',
					'label'		=> 'Icon Color',
					'desc'		=> 'Set a unique color for your icon (optional, used in widget only)',
					'std'		=> '',
					'type'		=> 'colorpicker',
					'section'	=> 'styling'
				),
				array(
					'id'		=> 'social-target',
					'label'		=> 'Link Options',
					'desc'		=> '',
					'std'		=> '',
					'type'		=> 'checkbox',
					'choices'	=> array(
						array( 
							'value' => '_blank',
							'label' => 'Open in new window'
						)
					)
				)
			)
		),
		// Styling: Enable
		array(
			'id'		=> 'dynamic-styles',
			'label'		=> 'Dynamic Styles',
			'desc'		=> 'Turn styling options on / off',
			'type'		=> 'checkbox',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Enable to use the options below'
				)
			)
		),
		// General: Boxed Layout
		array(
			'id'		=> 'boxed',
			'label'		=> 'Boxed Layout',
			'desc'		=> 'Use a boxed layout',
			'type'		=> 'checkbox',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Enable'
				)
			)
		),
		// Styling: Font
		array(
			'id'		=> 'font',
			'label'		=> 'Font',
			'desc'		=> 'Select font for the theme',
			'type'		=> 'select',
			'std'		=> '30',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => 'lato',
					'label' => 'Lato, Latin (Self-hosted)'
				),
				array( 
					'value' => 'titillium-web',
					'label' => 'Titillium Web, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'droid-serif',
					'label' => 'Droid Serif, Latin (Google Fonts)'
				),
				array( 
					'value' => 'source-sans-pro',
					'label' => 'Source Sans Pro, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'ubuntu',
					'label' => 'Ubuntu, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'roboto-condensed',
					'label' => 'Roboto Condensed, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'roboto-condensed-cyr',
					'label' => 'Roboto Condensed, Latin / Cyrillic-Ext (Google Fonts)'
				),
				array( 
					'value' => 'open-sans',
					'label' => 'Open Sans, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'open-sans-cyr',
					'label' => 'Open Sans, Latin / Cyrillic-Ext (Google Fonts)'
				),
				array( 
					'value' => 'arial',
					'label' => 'Arial'
				),
				array( 
					'value' => 'georgia',
					'label' => 'Georgia'
				)
			)
		),
		// Styling: Container Width
		array(
			'id'			=> 'container-width',
			'label'			=> 'Website Max-width',
			'desc'			=> 'Max-width of the container. <br /><i>Note: For 680px media, 600px content (default) use <strong>1080px</strong> with sidebar active. If you use no sidebars anywhere, use <strong>740px</strong> (or more).</i>',
			'std'			=> '1080',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '740,1600,1'
		),
		// Styling: Primary Color
		array(
			'id'		=> 'color-accent',
			'label'		=> 'Primary Accent Color',
			'desc'		=> '<i>Default: #e8554e</i>',
			'std'		=> '#e8554e',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Topbar Background
		array(
			'id'		=> 'color-topbar',
			'label'		=> 'Topbar Background',
			'desc'		=> '<i>Default: #222222</i>',
			'std'		=> '#222222',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Header Background
		array(
			'id'		=> 'color-header',
			'label'		=> 'Header Background',
			'desc'		=> '<i>Default: #f2f2f2</i>',
			'std'		=> '#f2f2f2',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Header Light Text
		array(
			'id'		=> 'light-header-text',
			'label'		=> 'Header Text Color',
			'desc'		=> '',
			'std'		=> '',
			'type'		=> 'checkbox',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Use light header text'
				)
			)
		),
		// Styling: Footer Background
		array(
			'id'		=> 'color-footer',
			'label'		=> 'Footer Background',
			'desc'		=> '<i>Default: #222222</i>',
			'std'		=> '#222222',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Footer Toplink Color
		array(
			'id'		=> 'color-footer-toplink',
			'label'		=> 'Footer Toplink Color',
			'desc'		=> 'Suggestion - use the same color as your primary accent color<br /><i>Default: #333333</i>',
			'std'		=> '#333333',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Header Logo Max-height
		array(
			'id'			=> 'logo-max-height',
			'label'			=> 'Header Logo Image Max-height',
			'desc'			=> 'Your logo image should have the double height of this to be high resolution',
			'std'			=> '80',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '40,200,1'
		),
			// Styling: Formats
			array(
				'id'		=> 'color-audio',
				'label'		=> 'Format: Audio',
				'desc'		=> '<i>Default: #69bac8</i>',
				'std'		=> '#69bac8',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-chat',
				'label'		=> 'Format: Chat',
				'desc'		=> '<i>Default: #69bac8</i>',
				'std'		=> '#69bac8',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-gallery',
				'label'		=> 'Format: Gallery',
				'desc'		=> '<i>Default: #7eb66f</i>',
				'std'		=> '#7eb66f',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-image',
				'label'		=> 'Format: Image',
				'desc'		=> '<i>Default: #7eb66f</i>',
				'std'		=> '#7eb66f',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-link',
				'label'		=> 'Format: Link',
				'desc'		=> '<i>Default: #e8554e</i>',
				'std'		=> '#e8554e',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-quote',
				'label'		=> 'Format: Quote',
				'desc'		=> '<i>Default: #e7ba3a</i>',
				'std'		=> '#e7ba3a',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-status',
				'label'		=> 'Format: Status',
				'desc'		=> '<i>Default: #ffa500</i>',
				'std'		=> '#ffa500',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-video',
				'label'		=> 'Format: Video',
				'desc'		=> '<i>Default: #e8554e</i>',
				'std'		=> '#e8554e',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),			
		// Styling: Body Background
		array(
			'id'		=> 'body-background',
			'label'		=> 'Body Background',
			'desc'		=> 'Set background color and/or upload your own background image',
			'type'		=> 'background',
			'section'	=> 'styling'
		)
	)
);

/*  Settings are not the same? Update the DB
/* ------------------------------------ */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings ); 
	} 
}
