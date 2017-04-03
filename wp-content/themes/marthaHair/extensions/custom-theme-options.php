<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
  To find another icons, visit: http://elusiveicons.com/icons/
 * */

if (!class_exists('Redux_Framework_sample_config')) {

	class Redux_Framework_sample_config {

		public $args		= array();
		public $sections	= array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if (!class_exists('ReduxFramework')) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if (  true == Redux_Helpers::isTheme(__FILE__) ) {
				$this->initSettings();
			} else {
				add_action('plugins_loaded', array($this, 'initSettings'), 10);
			}

		}

		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();

			if (!isset($this->args['opt_name'])) { // No errors please
				return;
			}
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
		}

		/**

		  This is a test function that will let you see when the compiler hook occurs.
		  It only runs if a field	set with compiler=>true is changed.

		 * */
		function compiler_action($options, $css, $changed_values) {
			echo '<h1>The compiler hook has run!</h1>';
			echo "<pre>";
			print_r($changed_values); // Values that have changed since the last save
			echo "</pre>";
		}

		/**

		  Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		  Simply include this function in the child themes functions.php file.

		  NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		  so you must use get_template_directory_uri() if you want to use any of the built in icons

		 * */
		function dynamic_section($sections) {
			//$sections = array();
			$sections[] = array(
				'title' => __('Section via hook', 'redux-framework-demo'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
				'icon' => 'el-icon-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array()
			);

			return $sections;
		}

		/**

		  Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		 * */
		function change_arguments($args) {
			//$args['dev_mode'] = true;

			return $args;
		}

		/**

		  Filter hook for filtering the default value of any given field. Very useful in development mode.

		 * */
		function change_defaults($defaults) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if (class_exists('ReduxFrameworkPlugin')) {
				remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
			}
		}

		public function setSections() {

			/**
			  Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 * */
			// Background Patterns Reader
			$sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url	= ReduxFramework::$_url . '../sample/patterns/';
			$sample_patterns		= array();

			if (is_dir($sample_patterns_path)) :

				if ($sample_patterns_dir = opendir($sample_patterns_path)) :
					$sample_patterns = array();

					while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

						if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
							$name = explode('.', $sample_patterns_file);
							$name = str_replace('.' . end($name), '', $sample_patterns_file);
							$sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
						}
					}
				endif;
			endif;

			ob_start();

			$ct			 = wp_get_theme();
			$this->theme	= $ct;
			$item_name	  = $this->theme->get('Name');
			$tags		   = $this->theme->Tags;
			$screenshot	 = $this->theme->get_screenshot();
			$class		  = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
			
			?>
			<div id="current-theme" class="<?php echo esc_attr($class); ?>">
			<?php if ($screenshot) : ?>
				<?php if (current_user_can('edit_theme_options')) : ?>
						<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
							<img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
						</a>
				<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
				<?php endif; ?>

				<h4><?php echo $this->theme->display('Name'); ?></h4>

				<div>
					<ul class="theme-info">
						<li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
						<li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
						<li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
			<?php
			if ($this->theme->parent()) {
				printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
			} 
			?>
				</div>
			</div>

			<?php
			$item_info = ob_get_contents();

			ob_end_clean();

			$sampleHTML = '';
			if (file_exists(dirname(__FILE__) . '/info-html.html')) {
				Redux_Functions::initWpFilesystem();
				
				global $wp_filesystem;

				$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
			}



			/*
			********************************************
			**************** THEME PANELS **************
			********************************************
			*/

			// Theme prefix
			global $themePrefix;

			// Header
			$this->sections[] = array(
				'title'		=> __('Header'),
				'heading' 	=> __('This section is about the settings of your site header.'),
				'icon'    	=> 'el-icon-hand-up',
				'desc'		=> '<p class="description">'.__('Header settings').'</p>',
				'fields'	=> array(
					array( // Logo
						'id'		=> $themePrefix . 'logo_url',
						'type'		=> 'media',
						'title'		=> 'Logo',
						'subtitle'	=> __('Make your logo image upload.')
					),
					array( // Favicon
						'id'		=> $themePrefix . 'favicon_url',
						'type'		=> 'media',
						'title'		=> 'Favicon',
						'subtitle'	=> __('Upload a small image(16x16) to make your favicon.')
					),
				)
			);

			$this->sections[] = array(
				'title'		=> __('General'),
				'heading' 	=> __('This section is about the general settings of your site.'),
				'icon'    	=> 'el-icon-wrench',
				'desc'		=> '<p class="description">'.__('General settings').'</p>',
				'fields'	=> array(
					array( // Welcome message
						'id'		=> $themePrefix . 'welcome_thumbnail',
						'type'		=> 'media',
						'title'		=> __('Featured image')
					),
					array( // Welcome message
						'id'		=> $themePrefix . 'welcome_message',
						'type'		=> 'text',
						'title'		=> __('Welcome message'),
						'subtitle'	=> __('Say something good to your visitors.')
					),
					array( // secondary message
						'id'		=> $themePrefix . 'secondary_message',
						'type'		=> 'text',
						'title'		=> __('Secondary message')
					),
					array( // Fisrt Parallax background
						'id'		=> $themePrefix . 'fisrt_parallax',
						'type'		=> 'media',
						'title'		=> __('First parallax image')
					),
					array( // Second Parallax background
						'id'		=> $themePrefix . 'second_parallax',
						'type'		=> 'media',
						'title'		=> __('Second parallax image')
					)
				)
			);

			// Social networks
			$this->sections[] = array(
				'title'		=> __('Social networks'),
				'heading' 	=> __('Social networks'),
				'icon'    	=> 'el-icon-share',
				'desc'		=> '<p class="description">'.__('Settings of social networks.').'</p>',
				'fields'	=> array(
					array( // Facebook
						'id'		=> $themePrefix.'facebook_url',
						'type'		=> 'text',
						'title'		=> 'Facebook',
						'subtitle'	=> __('Facebook url.'),
						'default'	=> 'http://www.facebook.com/'
					),
					array( // Twitter
						'id'		=> $themePrefix.'twitter_url',
						'type'		=> 'text',
						'title'		=> 'Twitter',
						'subtitle'	=> __('Twitter url.'),
						'default'	=> 'http://www.twitter.com/'
					),
					array( // Instagram
						'id'		=> $themePrefix.'instagram_url',
						'type'		=> 'text',
						'title'		=> 'Instagram',
						'subtitle'	=> __('Instagram url.'),
						'default'	=> 'http://www.instagram.com/'
					)
				)
			);

			// Contact
			$this->sections[] = array(
				'title'		=> __('Contact'),
				'heading' 	=> __('Put here all the information related about the contact. '),
				'icon'    	=> 'el-icon-bell',
				'desc'		=> '<p class="description">'.__('Contact settings').'</p>',
				'fields'	=> array(
			       	array( // Email
						'id'		=> $themePrefix.'cs_email',
						'type'		=> 'text',
						'title'		=> __('Email to Client Service'),
						'subtitle'	=> __('The email that will be receive all the messages sended by Client Service.'),
						'desc'		=> __('It have to be an email address.')
					),
					array( // Telephone
						'id'		=> $themePrefix.'cs_telephone',
						'type'		=> 'text',
						'title'		=> __('Telephone'),
						'subtitle'	=> __('Follow the format: 00 0 0000-000'),
					),
					array( // Complete Address
						'id'		=> $themePrefix.'cs_address',
						'type'		=> 'text',
						'title'		=> __('Address'),
						'subtitle'	=> __('Complete address.'),
						'desc'		=> __('Like <i>Test Avenue, 1544 - 15th Floor<i>')
					),
					array( // City state
						'id'		=> $themePrefix.'cs_neightborhood_city_state',
						'type'		=> 'text',
						'title'		=> __('Neighborhood, city and state'),
						'subtitle'	=> __('Complete address.'),
						'desc'		=> __('Like <i>Paraíso, São Paulo - SP<i>')
					)
			    ),
			);

			// Archive
			$this->sections[] = array(
				'title'		=> __('Archive pages'),
				'heading' 	=> __('This section is about the settings of your site archive pages.'),
				'icon'    	=> 'el-icon-lines',
				'desc'		=> '<p class="description">'.__('Archives settings').'</p>',
				'fields'	=> array(
			      	array( // Hair
						'id'		=> $themePrefix.'ac_phrase_hair',
						'type'		=> 'text',
						'title'		=> __('Hair archive page'),
						'subtitle'	=> __('Phrase of impact at Hair archive page'),
						'desc'		=> __('This text would be in a page that list all the posts in Hair post type.'),
						'default'	=> __('Our hairs')
					),
					array( // Celebrity
						'id'		=> $themePrefix.'ac_phrase_celebrity',
						'type'		=> 'text',
						'title'		=> __('Celebrity archive page'),
						'subtitle'	=> __('Phrase of impact at Celebrity archive page'),
						'desc'		=> __('This text would be in a page that list all the posts in Celebrity post type.'),
						'default'	=> __('Celebrities')
					),
					array( // Media
						'id'		=> $themePrefix.'ac_phrase_news',
						'type'		=> 'text',
						'title'		=> __('Media archive page'),
						'subtitle'	=> __('Phrase of impact at Media archive page'),
						'desc'		=> __('This text would be in a page that list all the posts in Media post type.'),
						'default'	=> __('Media')
					),
					array( // Prosthesis
						'id'		=> $themePrefix.'ac_phrase_prothesis',
						'type'		=> 'text',
						'title'		=> __('Prothesis archive page'),
						'subtitle'	=> __('Phrase of impact at Prothesis archive page'),
						'desc'		=> __('This text would be in a page that list all the posts in Phrotesis post type.'),
						'default'	=> __('Prothesis')
					),
					array( // Before and after
						'id'		=> $themePrefix.'ac_phrase_beforeandafter',
						'type'		=> 'text',
						'title'		=> __('Before and after archive page'),
						'subtitle'	=> __('Phrase of impact at Before and after archive page'),
						'desc'		=> __('This text would be in a page that list all the posts in Before and after post type.'),
						'default'	=> __('Before and after')
					)
			    ),
			);

			// Footer
			$this->sections[] = array(
				'title'		=> __('Footer'),
				'heading' 	=> __('This section is about the settings of your site footer.'),
				'icon'    	=> 'el-icon-hand-down',
				'desc'		=> '<p class="description">'.__('Footer settings').'</p>',
				'fields'	=> array(
			      	array( // Copright
						'id'		=> $themePrefix.'ft_copright',
						'type'		=> 'text',
						'title'		=> __('Copright'),
						'subtitle'	=> __('Rights of site'),
						'desc'		=> __('This text will be show at footer.'),
						'default'	=> __('All rights reserved.')
					)
			    ),
			);

			/************ END THEME PANELS **************/

			if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
				$tabs['docs'] = array(
					'icon'	  => 'el-icon-book',
					'title'	 => __('Documentation', 'redux-framework-demo'),
					'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
				);
			}
		}

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'		=> 'redux-help-tab-1',
				'title'	 => __('Theme Information 1', 'redux-framework-demo'),
				'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			$this->args['help_tabs'][] = array(
				'id'		=> 'redux-help-tab-2',
				'title'	 => __('Theme Information 2', 'redux-framework-demo'),
				'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
		}

		/**

		  All the possible arguments for Redux.
		  For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'		  => 'redux_options',			// This is where your data is stored in the database and also becomes your global variable name.
				'display_name'	  => $theme->get('Name'),	 // Name that appears at the top of your panel
				'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
				'menu_type'		 => 'menu',				  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'	=> true,					// Show the sections below the admin menu item or not
				'menu_title'		=> __('Opções do tema', 'redux-framework-demo'),
				'page_title'		=> __('Opções do tema', 'redux-framework-demo'),
				
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key' => '', // Must be defined to add google fonts to the typography module
				
				'async_typography'  => true,					// Use a asynchronous font on the front end or font string
				//'disable_google_fonts_link' => true,					// Disable this in case you want to create your own google fonts loader
				'admin_bar'		 => true,					// Show the panel pages on the admin bar
				'global_variable'   => '',					  // Set a different name for your global variable other than the opt_name
				'dev_mode'		  => false,					// Show the time the page took to load, etc
				'customizer'		=> true,					// Enable basic customizer support
				//'open_expanded'	 => true,					// Allow you to start the panel in an expanded way initially.
				//'disable_save_warn' => true,					// Disable the save warning when a user changes a field

				// OPTIONAL -> Give you extra features
				'page_priority'	 => null,					// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'	   => 'themes.php',			// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'  => 'manage_options',		// Permissions needed to access the options panel.
				'menu_icon'		 => '',					  // Specify a custom URL to an icon
				'last_tab'		  => '',					  // Force your panel to always open to a specific tab (by id)
				'page_icon'		 => 'icon-themes',		   // Icon displayed in the admin panel next to your menu_title
				'page_slug'		 => '_options',			  // Page slug used to denote the panel
				'save_defaults'	 => true,					// On load save the defaults to DB before user clicks save or not
				'default_show'	  => false,				   // If true, shows the default value next to each field that is not the default value.
				'default_mark'	  => '',					  // What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export' => true,				   // Shows the Import/Export panel when not used as a field.
				
				// CAREFUL -> These options are for advanced use only
				'transient_time'	=> 60 * MINUTE_IN_SECONDS,
				'output'			=> true,					// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'		=> true,					// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				// 'footer_credit'	 => '',				   // Disable the footer credit of Redux. Please leave if you can help it.
				
				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'			  => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'system_info'		   => false, // REMOVE

				// HINTS
				'hints' => array(
					'icon'		  => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'	=> 'lightgray',
					'icon_size'	 => 'normal',
					'tip_style'	 => array(
						'color'		 => 'light',
						'shadow'		=> true,
						'rounded'	   => false,
						'style'		 => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'	=> array(
						'show'		  => array(
							'effect'		=> 'slide',
							'duration'	  => '500',
							'event'		 => 'mouseover',
						),
						'hide'	  => array(
							'effect'	=> 'slide',
							'duration'  => '500',
							'event'	 => 'click mouseleave',
						),
					),
				)
			);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
			$this->args['share_icons'][] = array(
				'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
				'title' => 'Visit us on GitHub',
				'icon'  => 'el-icon-github'
				//'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
			);
			$this->args['share_icons'][] = array(
				'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
				'title' => 'Like us on Facebook',
				'icon'  => 'el-icon-facebook'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'http://twitter.com/reduxframework',
				'title' => 'Follow us on Twitter',
				'icon'  => 'el-icon-twitter'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'http://www.linkedin.com/company/redux-framework',
				'title' => 'Find us on LinkedIn',
				'icon'  => 'el-icon-linkedin'
			);

			// Panel Intro text -> before the form
			if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
				if (!empty($this->args['global_variable'])) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace('-', '_', $this->args['opt_name']);
				}
				$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
			} else {
				$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
			}

			// Add content after the form.
			$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');
		}

	}
	
	global $reduxConfig;
	$reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
	function redux_my_custom_field($field, $value) {
		print_r($field);
		echo '<br/>';
		print_r($value);
	}
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
	function redux_validate_callback_function($field, $value, $existing_value) {
		$error = false;
		$value = 'just testing';

		/*
		  do your validation

		  if(something) {
			$value = $value;
		  } elseif(something else) {
			$error = true;
			$value = $existing_value;
			$field['msg'] = 'your custom error message';
		  }
		 */

		$return['value'] = $value;
		if ($error == true) {
			$return['error'] = $field;
		}
		return $return;
	}
endif;
