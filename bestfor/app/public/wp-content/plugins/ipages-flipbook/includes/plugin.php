<?php

// If this file is called directly, abort.
if(!defined('ABSPATH')) {
	exit;
}

if(!class_exists('iPages_App')) :

class iPages_App {
	private $pluginBasename = NULL;
	
	private $ajax_action_item_update = NULL;
	private $ajax_action_item_update_status = NULL;
	private $ajax_action_settings_update = NULL;
	private $ajax_action_settings_get = NULL;
	private $ajax_action_delete_data = NULL;
	private $ajax_action_modal = NULL;
	
	private $flipbook_id = null;
	private $flipbook_version = null;
	private $shortcodes = array();
	private $previewPageSettings = null;
	
	function __construct($pluginBasename) {
		$this->pluginBasename = $pluginBasename;
	}
	
	function run() {
		$upload_dir = wp_upload_dir();
		$plugin_url = plugin_dir_url(dirname(__FILE__));
		
		define('IPGS_PLUGIN_UPLOAD_DIR', wp_normalize_path($upload_dir['basedir'] . '/' . IPGS_PLUGIN_NAME));
		define('IPGS_PLUGIN_UPLOAD_URL', $upload_dir['baseurl'] . '/' . IPGS_PLUGIN_NAME . '/');
		
		define('IPGS_PLUGIN_PLAN', 'lite');
		
		$user = wp_get_current_user(); //is_super_admin()
		$allowed_roles = $this->getAllowedRoles();
		if((array_intersect($allowed_roles, $user->roles) || current_user_can('manage_options'))&& is_admin()) {
			$this->ajax_action_item_update = IPGS_PLUGIN_NAME . '_ajax_item_update';
			$this->ajax_action_item_update_status = IPGS_PLUGIN_NAME . '_ajax_item_update_status';
			$this->ajax_action_settings_update = IPGS_PLUGIN_NAME . '_ajax_settings_update';
			$this->ajax_action_settings_get = IPGS_PLUGIN_NAME . '_ajax_settings_get';
			$this->ajax_action_delete_data =  IPGS_PLUGIN_NAME . '_ajax_delete_data';
			$this->ajax_action_modal = IPGS_PLUGIN_NAME . '_ajax_modal';
			
			load_plugin_textdomain(IPGS_PLUGIN_NAME, false, dirname(dirname(plugin_basename(__FILE__))) . '/languages/');
			
			add_action('admin_menu', array($this, 'admin_menu'));
			add_action('admin_notices', array($this, 'admin_notices'));
			add_action('in_admin_header', array($this, 'in_admin_header'));
			add_action('wp_loaded', array($this, 'page_redirects'));
			
			// important, because ajax has another url
			add_action('wp_ajax_' . $this->ajax_action_item_update, array($this, 'ajax_item_update'));
			add_action('wp_ajax_' . $this->ajax_action_item_update_status, array($this, 'ajax_item_update_status'));
			add_action('wp_ajax_' . $this->ajax_action_settings_update, array($this, 'ajax_settings_update'));
			add_action('wp_ajax_' . $this->ajax_action_settings_get, array($this, 'ajax_settings_get'));
			add_action('wp_ajax_' . $this->ajax_action_delete_data, array($this, 'ajax_delete_data'));
			add_action('wp_ajax_' . $this->ajax_action_modal, array($this, 'ajax_modal'));
		} else {
			add_shortcode(IPGS_SHORTCODE_NAME, array($this, 'shortcode'));
			add_filter('do_parse_request', array($this, 'do_parse_request'));
		}
	}
	
	function IsNullOrEmptyString($str) {
		return(!isset($str) || trim($str)==='');
	}
	
	function filesystem_method() {
		return 'direct';
	}
	
	function request_filesystem_credentials() {
		return true;
	}
	
	function getFileSystem() {
		global $wp_filesystem;
		$result = true;
		
		if(!$wp_filesystem) {
			require_once(ABSPATH . '/wp-admin/includes/file.php');
			
			add_filter('filesystem_method', array( $this, 'filesystem_method'));
			add_filter('request_filesystem_credentials', array( $this, 'request_filesystem_credentials'));
			
			$credentials = request_filesystem_credentials(site_url(), '', true, false, null );
			
			$result = WP_Filesystem($credentials);
			
			remove_filter('filesystem_method', array( $this, 'filesystem_method'));
			remove_filter('request_filesystem_credentials', array( $this, 'request_filesystem_credentials'));
		}
		
		if($result)
			return $wp_filesystem;
		return null;
	}
	
	function getAllowedRoles() {
		$allowed_roles = array('administrator');
		
		$settings_key = IPGS_PLUGIN_NAME . '_settings';
		$settings_value = get_option($settings_key);
		
		if($settings_value) {
			$settings = unserialize($settings_value);
			if(is_array($settings->roles)) $allowed_roles = array_merge($allowed_roles, $settings->roles);
		}
		
		return $allowed_roles;
	}
	
	function getPreviewPageSettings() {
		$obj = new stdClass();
		$obj->wpHead = false;
		$obj->wpFooter = false;
		
		$settings_key = IPGS_PLUGIN_NAME . '_settings';
		$settings_value = get_option($settings_key);
		if($settings_value) {
			$settings = unserialize($settings_value);
			if(property_exists($settings, 'wpHead')) {
				$obj->wpHead = $settings->wpHead;
			}
			if(property_exists($settings, 'wpFooter')) {
				$obj->wpFooter = $settings->wpFooter;
			}
		}
		
		return $obj;
	}
	
	function getCurrentUrl() {
		$home_path = rtrim(parse_url(home_url(), PHP_URL_PATH ), '/');
		$path = rtrim(substr(add_query_arg(array()), strlen( $home_path ) ), '/');
		return ($path === '') ? '/' : $path;
	}
	
	function getLoaderGlobalsName() {
		return IPGS_PLUGIN_NAME . '_globals';
	}
	
	function getLoaderGlobals($timestamp) {
		$plugin_url = plugin_dir_url(dirname(__FILE__));
		
		$globals = array(
			'plan' => IPGS_PLUGIN_PLAN,
			'book_version' => $timestamp,
			'theme_base_url' => $plugin_url . 'assets/themes/',
			'plugin_base_url' => $plugin_url . 'assets/js/lib/ipages/',
			'plugin_upload_base_url' => IPGS_PLUGIN_UPLOAD_URL,
			'plugin_version' => IPGS_PLUGIN_VERSION
		);
		
		return $globals;
	}
	
	function embedLoader($in_footer, $timestamp) {
		$plugin_url = plugin_dir_url(dirname(__FILE__));
		wp_enqueue_script(IPGS_PLUGIN_NAME . '_loader', $plugin_url . 'assets/js/loader.min.js', array('jquery'), IPGS_PLUGIN_VERSION, $in_footer);
		wp_localize_script(IPGS_PLUGIN_NAME . '_loader', $this->getLoaderGlobalsName(), $this->getLoaderGlobals($timestamp));
	}
	
	/**
	 * generate main css text
	 */
	function getMainCss($itemData, $itemId) {
		$upload_dir = wp_upload_dir();
		
		// create main css
		$main_css = '';
		$main_css .= '.ipgs-' . $itemId . ' {' . PHP_EOL;
		
		if(!$itemData->autoWidth) {
			$main_css .= ($itemData->containerWidth ? 'width:' . $itemData->containerWidth .';' . PHP_EOL : '');
		}
		
		if(!$itemData->autoHeight) {
			$main_css .= ($itemData->containerHeight ? 'height:' . $itemData->containerHeight .';' . PHP_EOL : '');
		}
		
		$main_css .= (!$this->IsNullOrEmptyString($itemData->background->color) ? 'background-color:' . $itemData->background->color . ';' . PHP_EOL : '');
		if(!$this->IsNullOrEmptyString($itemData->background->image->url)) {
			$imageUrl = ($itemData->background->image->relative ? $upload_dir['baseurl'] : '') . $itemData->background->image->url;
			$main_css .= 'background-image:url(' . $imageUrl . ');' . PHP_EOL;
		}
		$main_css .= ($itemData->background->size ? 'background-size:' . $itemData->background->size . ';' . PHP_EOL : '');
		$main_css .= ($itemData->background->repeat ? 'background-repeat:' . $itemData->background->repeat . ';' . PHP_EOL : '');
		$main_css .= ($itemData->background->position ? 'background-position:' . $itemData->background->position . ';' . PHP_EOL : '');
		
		$main_css .= '}' . PHP_EOL;
		
		$itemSelector = '.ipgs-' . $itemId;
		
		// create layers css
		$pageId = 0;
		foreach($itemData->pages as $pageKey => $page) {
			if(!$page->active) {
				continue;
			}
			
			$pageId++;
			$pageSelector = '[data-page-number="' . $pageId . '"]';
			
			$layerId = 0;
			foreach($page->layers as $layerKey => $layer) {
				if(!$layer->visible) {
					continue;
				}
				
				$layerId++;
				$layerSelector = '[data-layer-id="' . $layer->id . '"]';
				
				$selector = $itemSelector . ' ' . $layerSelector;
				
				$main_css .= $selector . ' {' . PHP_EOL;
				
				$main_css .= 'position:absolute;' . PHP_EOL;
				$main_css .= ($layer->y != NULL ? 'top:' . $layer->y . 'px;' . PHP_EOL : '');
				$main_css .= ($layer->x != NULL ? 'left:' . $layer->x . 'px;' . PHP_EOL : '');
				$main_css .= ($layer->width != NULL ? 'width:' . $layer->width . 'px;' . PHP_EOL : '');
				$main_css .= ($layer->height != NULL ? 'height:' . $layer->height . 'px;' . PHP_EOL : '');
				$main_css .= ($layer->angle != NULL ? 'transform:rotate(' . $layer->angle . 'deg);' . PHP_EOL : '');
				
				if($layer->type == 'image') {
					$main_css .= ($layer->background->color ? 'background-color:' . $layer->background->color . ';' . PHP_EOL : '');
					if(!$this->IsNullOrEmptyString($layer->background->image->url)) {
						$main_css .= 'background-image:url(' . $layer->background->image->url . ');' . PHP_EOL;
					}
					$main_css .= ($layer->background->size ? 'background-size:' . $layer->background->size . ';' . PHP_EOL : '');
					$main_css .= ($layer->background->repeat ? 'background-repeat:' . $layer->background->repeat . ';' . PHP_EOL : '');
					$main_css .= ($layer->background->position ? 'background-position:' . $layer->background->position . ';' . PHP_EOL : '');
				} else if($layer->type == 'text') {
					$main_css .= ($layer->text->color ? 'color:' . $layer->text->color . ';' . PHP_EOL : '');
					$main_css .= ($layer->text->fontFamily != NULL ? 'font-family:' . $layer->text->fontFamily . ';' . PHP_EOL : '');
					$main_css .= ($layer->text->size != NULL ? 'font-size:' . $layer->text->size . 'px;' . PHP_EOL : '');
					$main_css .= ($layer->text->lineHeight != NULL ? 'line-height:' . $layer->text->lineHeight . 'px;' . PHP_EOL : '');
					$main_css .= ($layer->text->align ? 'text-align:' . $layer->text->align . ';' . PHP_EOL : '');
					$main_css .= ($layer->text->letterSpacing != NULL ? 'letter-spacing:' . $layer->text->letterSpacing . 'px;' . PHP_EOL : '');
				}
				
				$main_css .= '}' . PHP_EOL;
			}
		}
		
		return $main_css;
	}
	
	/**
	 * Shortcode output for the plugin
	 */
	function shortcode($atts) {
		extract(shortcode_atts(array('id'=>0, 'class'=>NULL, 'width'=>NULL,'height'=>NULL), $atts));
		
		if(!$id) {
			return '<p>' . esc_html__('Error: invalid ipages flipbook shortcode attributes', IPGS_PLUGIN_NAME) . '</p>';
		}
		
		if($width && preg_match('/^\d+$/',$width)) {
			$width = $width . 'px';
		}
		
		if($height && preg_match('/^\d+$/',$height)) {
			$height = $height . 'px';
		}
		
		global $wpdb;
		$table = $wpdb->prefix . IPGS_PLUGIN_NAME;
		$upload_dir = wp_upload_dir();
		
		$query = $wpdb->prepare('SELECT * FROM ' . $table . ' WHERE id=%s', $id);
		$item = $wpdb->get_row($query, OBJECT);
		if($item) {
			if(!$item->active) {
				return;
			}
			
			$version = strtotime(mysql2date('Y-m-d H:i:s', $item->modified));
			$itemData = unserialize($item->data);
			
			array_push($this->shortcodes, array(
				'id'      => $item->id,
				'version' => $version
			));
			
			if(sizeof($this->shortcodes) == 1) {
				$this->embedLoader(true, $version);
			}
			
			// debug
			//ob_start();
			//var_dump($value);
			//$data = ob_get_clean();
			//$fp = fopen("c:\debug.txt", "w");
			//fwrite($fp, $data);
			//fclose($fp);
			
			ob_start(); // turn on buffering
			
			echo PHP_EOL;
			echo '<!-- ipages begin -->' . PHP_EOL;
			
			echo '<div ';
			echo 'class="ipgs-flipbook' . ' ipgs-' . $id . ($class ? ' ' . $class : '') . ($itemData->bookClass ? ' ' . $itemData->bookClass : '') . '"';
			echo ' data-json-src="'. IPGS_PLUGIN_UPLOAD_URL . $item->id . '/config.json?ver=' . $version . '" ';
			echo ' data-item-id="' . $item->id . '" ';
			
			$inlineStyles  = "display:none;";
			if($itemData->background->inline) {
				$inlineStyles .= (!$this->IsNullOrEmptyString($itemData->background->color) ? 'background-color:' . $itemData->background->color . ';' : '');
				if(!$this->IsNullOrEmptyString($itemData->background->image->url)) {
					$imageUrl = ($itemData->background->image->relative ? $upload_dir['baseurl'] : '') . $itemData->background->image->url;
					$inlineStyles .= 'background-image:url(' . $imageUrl . ');';
				}
				$inlineStyles .= ($itemData->background->size ? 'background-size:' . $itemData->background->size . ';' : '');
				$inlineStyles .= ($itemData->background->repeat ? 'background-repeat:' . $itemData->background->repeat . ';' : '');
				$inlineStyles .= ($itemData->background->position ? 'background-position:' . $itemData->background->position . ';' : '');
			}
			
			if($width || $height) {
				$inlineStyles .= ($width ? 'width:' . $width . ';' : '');
				$inlineStyles .= ($height ? 'height:' . $height . ';' : '');
			}
			
			echo 'style="' . $inlineStyles . '"';
			
			echo '>' . PHP_EOL;
			echo '</div>' . PHP_EOL;
			echo '<!-- ipages end -->' . PHP_EOL;
			
			$output = ob_get_contents(); // get the buffered content into a var
			ob_end_clean(); // clean buffer
			
			return $output;
		} else {
			return '<p>' . esc_html__('Error: invalid ipages flipbook database record', IPGS_PLUGIN_NAME) . '</p>';
		}
	}
	
	/**
	* output preview header data
	*/
	function do_preview_head() {
		$plugin_url = plugin_dir_url(dirname(__FILE__));
		
		if($this->previewPageSettings->wpHead) {
			wp_enqueue_style(IPGS_PLUGIN_NAME . '-preview', $plugin_url . 'assets/css/preview.min.css', array(), IPGS_PLUGIN_VERSION, 'all');
			
			wp_head();
		} else if($this->previewPageSettings->wpFooter) {
			wp_enqueue_style(IPGS_PLUGIN_NAME . '-preview', $plugin_url . 'assets/css/preview.min.css', array(), IPGS_PLUGIN_VERSION, 'all');
		} else {
			$preview_css_src = $plugin_url . 'assets/css/preview.min.css?ver=' . IPGS_PLUGIN_VERSION;
			$loader_js_src = $plugin_url . 'assets/js/loader.min.js?ver=' . IPGS_PLUGIN_VERSION;
			$jquery_js_src = null;
			
			global $wp_scripts;
			foreach($wp_scripts->registered as $dependency) :
				if($dependency->handle == 'jquery-core' && $dependency->src) {
					$jquery_js_src = (substr($dependency->src,0,1)=='/' ? get_site_url() . $dependency->src : $dependency->src);
					break;
				};
			endforeach;
			
			$head = '';
			$head .= wp_sprintf('<link rel="stylesheet" type="text/css" href="%s">', $preview_css_src) . PHP_EOL;
			$head .= wp_sprintf('<script type="text/javascript" src="%s"></script>', ($jquery_js_src ? $jquery_js_src : 'http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js')) . PHP_EOL;
			$head .= wp_sprintf('<script type="text/javascript">') . PHP_EOL;
			$head .= wp_sprintf('/* <![CDATA[ */') . PHP_EOL;
			$head .= wp_sprintf('var %s=%s;',$this->getLoaderGlobalsName(), json_encode($this->getLoaderGlobals($this->flipbook_version))) . PHP_EOL;
			$head .= wp_sprintf('/* ]]> */') . PHP_EOL;
			$head .= wp_sprintf('</script>') . PHP_EOL;
			$head .= wp_sprintf('<script type="text/javascript" src="%s"></script>', $loader_js_src) . PHP_EOL;
			
			echo $head;
		}
	}
	
	/**
	* output preview content
	*/
	function do_preview() {
		$atts = array('id'=>$this->flipbook_id);
		echo $this->shortcode($atts);
	}
	
	/**
	* output preview footer data
	*/
	function do_preview_footer() {
		if($this->previewPageSettings->wpFooter) {
			wp_footer();
		}
	}
	
	/**
	* Run a filter to obtain some custom url settings, compare them to the current url
	* and if a match is found the custom callback is fired, the custom view is loaded
	* and request is stopped.
	*/
	function do_parse_request($result) {
		if(current_filter() !== 'do_parse_request') {
			return $result;
		}
		
		$current = $this->getCurrentUrl();
		if(preg_match('/ipages\/flipbook\/([a-z0-9_-]+)/', $current, $matches)) {
			if(is_numeric($matches[1])) {
				$flipbook_id = $matches[1];
				$shortcode = false;
				if($flipbook_id != null) {
					global $wpdb;
					$table = $wpdb->prefix . IPGS_PLUGIN_NAME;
					
					$query = $wpdb->prepare('SELECT * FROM ' . $table . ' WHERE id=%d', $flipbook_id);
					$item = $wpdb->get_row($query, OBJECT);
					
					if($item) {
						if(!$item->active) {
							return;
						}
						
						$this->flipbook_id = $item->id;
						$this->flipbook_version = strtotime(mysql2date('Y-m-d H:i:s', $item->modified));
						
						$shortcode = true;
					}
				}
			} else {
				$flipbook_slug = $matches[1];
				$shortcode = false;
				if($flipbook_slug != null) {
					global $wpdb;
					$table = $wpdb->prefix . IPGS_PLUGIN_NAME;
					
					$query = $wpdb->prepare('SELECT * FROM ' . $table . ' WHERE slug=%s', $flipbook_slug);
					$item = $wpdb->get_row($query, OBJECT);
					
					if($item) {
						if(!$item->active) {
							return;
						}
						
						$this->flipbook_id = $item->id;
						$this->flipbook_version = strtotime(mysql2date('Y-m-d H:i:s', $item->modified));
						
						$shortcode = true;
					}
				}
			}
			
			if($shortcode) {
				$this->previewPageSettings = $this->getPreviewPageSettings();
				
				require_once(plugin_dir_path(dirname(__FILE__)) . 'includes/page-preview.php');
				exit();
			}
		}
		
		return $result;
	}
	
	/**
	 * Prepare upload directory
	 */
	function admin_notices() {
		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
		
		if(!($page===IPGS_PLUGIN_NAME ||
			 $page===IPGS_PLUGIN_NAME . '_settings')) {
				return;
		}
		
		$wp_filesystem = $this->getFileSystem();
		
		if($wp_filesystem == null) {
			echo '<div class="notice notice-error is-dismissible">';
			echo '<p>' . esc_html__('Something has gone wrong. Can\'t get access to the WordPress file system. The plugin can\'t work properly, please check the permissions.', IPGS_PLUGIN_NAME) . '</p>';
			echo '</div>';
			return;
		}
		
		if(!file_exists(IPGS_PLUGIN_UPLOAD_DIR)) {
			$wp_filesystem->mkdir(IPGS_PLUGIN_UPLOAD_DIR);
		}
		
		if(!file_exists(IPGS_PLUGIN_UPLOAD_DIR)) {
			echo '<div class="notice notice-error is-dismissible"><p>';
			echo sprintf(esc_html__('The plugin can\'t create the "%s" directory. It\'s used to store the items data.', IPGS_PLUGIN_NAME) . '<br>', '<b>' . IPGS_PLUGIN_NAME . '</b>');
			echo esc_html__('Please check the permissions and owner of the WordPress upload directory.', IPGS_PLUGIN_NAME) . '<br>';
			echo '</p></div>';
			return;
		}
		
		if(!wp_is_writable(IPGS_PLUGIN_UPLOAD_DIR)) {
			echo '<div class="notice notice-error is-dismissible"><p>';
			echo sprintf(esc_html__('The "%s" directory is not writable, therefore the item config files cannot be saved.', IPGS_PLUGIN_NAME) . '<br>', '<b>' . IPGS_PLUGIN_NAME . '</b>');
			echo esc_html__('Please check the permissions and owner of the WordPress upload directory.', IPGS_PLUGIN_NAME) . '<br>';
			echo '</p></div>';
			return;
		}
		
		if(!file_exists(IPGS_PLUGIN_UPLOAD_DIR . '/' . 'index.php')) {
			$data = '<?php' . PHP_EOL . '// silence is golden' . PHP_EOL . '?>';
			$wp_filesystem->put_contents(IPGS_PLUGIN_UPLOAD_DIR . '/' . 'index.php', $data, FS_CHMOD_FILE);
		}
	}
	
	/**
	 * Fires at the beginning of the content section in an admin page
	 */
	function in_admin_header() {
		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
		
		if(!(($page===IPGS_PLUGIN_NAME) ||
			 ($page===IPGS_PLUGIN_NAME . '_item') ||
			 ($page===IPGS_PLUGIN_NAME . '_settings'))) {
			return;
		}
		
		remove_all_actions('admin_notices');
		remove_all_actions('all_admin_notices');
		add_action('admin_notices', array($this, 'admin_notices'));
	}
	
	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 */
	function admin_menu() {
		// add "edit_posts" if we want to give access to author, editor and contributor roles
		add_menu_page(esc_html__('iPages Flipbook', IPGS_PLUGIN_NAME), esc_html__('iPages Flipbook', IPGS_PLUGIN_NAME), 'read', IPGS_PLUGIN_NAME, array( $this, 'admin_menu_page_items' ), 'dashicons-book-alt');
		add_submenu_page(IPGS_PLUGIN_NAME, esc_html__('iPages Flipbook', IPGS_PLUGIN_NAME), esc_html__('All Books', IPGS_PLUGIN_NAME), 'read', IPGS_PLUGIN_NAME, array( $this, 'admin_menu_page_items' ));
		add_submenu_page(IPGS_PLUGIN_NAME, esc_html__('iPages Flipbook', IPGS_PLUGIN_NAME), esc_html__('Add New', IPGS_PLUGIN_NAME), 'read', IPGS_PLUGIN_NAME . '_item', array( $this, 'admin_menu_page_item' ));
		add_submenu_page(IPGS_PLUGIN_NAME, esc_html__('iPages Flipbook', IPGS_PLUGIN_NAME), esc_html__('Settings', IPGS_PLUGIN_NAME), 'manage_options', IPGS_PLUGIN_NAME . '_settings', array( $this, 'admin_menu_page_settings' ));
	}
	
	/**
	 * Custom redirects
	 */
	function page_redirects() {
		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
		
		if($page===IPGS_PLUGIN_NAME) {
			$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
			if($action == 'duplicate' || $action == 'delete') {
				$url = admin_url('admin.php?page=' . $page);
				header('Refresh:0; url="' . $url . '"', true, 303);
				//wp_redirect($url); // does not work delete and dublicate operations on XAMPP
			}
		}
	}
	
	/**
	 * Show admin menu items page
	 */
	function admin_menu_page_items() {
		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
		
		if($page===IPGS_PLUGIN_NAME) {
			$plugin_url = plugin_dir_url( dirname(__FILE__) );
			$upload_dir = wp_upload_dir();
			
			// styles
			wp_enqueue_style(IPGS_PLUGIN_NAME . '-admin', $plugin_url . 'assets/css/admin.min.css', array(), IPGS_PLUGIN_VERSION, 'all' );
			wp_enqueue_style(IPGS_PLUGIN_NAME . '-fontawesome', $plugin_url . 'assets/css/font-awesome.min.css', array(), IPGS_PLUGIN_VERSION, 'all' );
			
			// scripts
			wp_enqueue_script(IPGS_PLUGIN_NAME . '-admin', $plugin_url . 'assets/js/admin.min.js', array('jquery'), IPGS_PLUGIN_VERSION, false );
			
			// global settings to help ajax work
			$globals = array(
				'plan' => IPGS_PLUGIN_PLAN,
				'msg_pro_title' => esc_html__('Available only in Pro version', IPGS_PLUGIN_NAME),
				'upload_url' => $upload_dir['baseurl'],
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( IPGS_PLUGIN_NAME . '_ajax' ),
				'ajax_msg_error' => esc_html__('Uncaught Error', IPGS_PLUGIN_NAME) //Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information
			);
			
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
			$nonce = filter_input(INPUT_GET, '_wpnonce', FILTER_SANITIZE_STRING);
			
			if($action && $nonce && wp_verify_nonce($nonce, IPGS_PLUGIN_NAME)) {
				global $wpdb;
				$table = $wpdb->prefix . IPGS_PLUGIN_NAME;
				
				if($action=='duplicate') {
					$result = false;
					
					$query = $wpdb->prepare( 'SELECT * FROM ' . $table . ' WHERE id=%s', $id);
					$item = $wpdb->get_row($query, OBJECT);
					
					if($item && (current_user_can('manage_options') || get_current_user_id()==$item->author) ) {
						$itemData = unserialize($item->data);
						$itemData->slug = sanitize_title(($itemData->slug ? $itemData->slug : $itemData->title));
						$itemData->title = esc_html__('[Duplicate] ', IPGS_PLUGIN_NAME) . $itemData->title;
						$itemConfig = unserialize($item->config);
						
						$result = $wpdb->insert(
							$table,
							array(
								'title' => $itemData->title,
								'slug' => $itemData->slug,
								'active' => $itemData->active,
								'data' => serialize($itemData),
								'config' => serialize($itemConfig),
								'author' => get_current_user_id(),
								'editor' => get_current_user_id(),
								'created' => current_time('mysql', 1),
								'modified' => current_time('mysql', 1)
						));
						
						//======================================
						// [filemanager] create an external file
						if($result && wp_is_writable(IPGS_PLUGIN_UPLOAD_DIR)) {
							$file_json = 'config.json';
							$file_main_css = 'main.css';
							$file_custom_css = 'custom.css';
							$file_root_path = IPGS_PLUGIN_UPLOAD_DIR . '/' . $wpdb->insert_id . '/';
							
							$wp_filesystem = $this->getFileSystem();
							
							if($wp_filesystem) {
								if(!$wp_filesystem->is_dir($file_root_path)) {
									$wp_filesystem->mkdir($file_root_path);
								}
								
								$wp_filesystem->put_contents($file_root_path . $file_json, json_encode($itemConfig), FS_CHMOD_FILE);
								$wp_filesystem->put_contents($file_root_path . $file_main_css, $this->getMainCss($itemData, $wpdb->insert_id), FS_CHMOD_FILE);
								$wp_filesystem->put_contents($file_root_path . $file_custom_css, $itemData->customCSS->data, FS_CHMOD_FILE);
							}
						}
						//======================================
						exit;
					}
				}
				if($action=='delete') {
					$result = false;
					
					$query = $wpdb->prepare('SELECT * FROM ' . $table . ' WHERE id=%s', $id);
					$item = $wpdb->get_row($query, OBJECT);
					if($item && (current_user_can('manage_options') || get_current_user_id()==$item->author) ) {
						$result = $wpdb->delete( $table, ['id'=>$id], ['%d']);
						
						//======================================
						// [filemanager] delete file
						if($result && wp_is_writable(IPGS_PLUGIN_UPLOAD_DIR)) {
							$file_json = 'config.json';
							$file_main_css = 'main.css';
							$file_custom_css = 'custom.css';
							$file_root_path = IPGS_PLUGIN_UPLOAD_DIR . '/' . $id . '/';
							
							$wp_filesystem = $this->getFileSystem();
							
							if($wp_filesystem) {
								$wp_filesystem->delete($file_root_path . $file_json);
								$wp_filesystem->delete($file_root_path . $file_main_css);
								$wp_filesystem->delete($file_root_path . $file_custom_css);
								
								if($wp_filesystem->is_dir($file_root_path)) {
									$wp_filesystem->rmdir($file_root_path);
								}
							}
						}
						//======================================
						exit;
					}
				}
			}
			
			$globals['ajax_action_update'] = $this->ajax_action_item_update_status;
			
			require_once( plugin_dir_path( dirname(__FILE__) ) . 'includes/list-table-items.php' );
			require_once( plugin_dir_path( dirname(__FILE__) ) . 'includes/page-items.php' );
			
			// set global settings
			wp_localize_script(IPGS_PLUGIN_NAME . '-admin', IPGS_PLUGIN_NAME . '_globals', $globals);
		}
	}
	
	/**
	 * Show admin menu item page
	 */
	function admin_menu_page_item() {
		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
		
		if($page===IPGS_PLUGIN_NAME . '_item') {
			$plugin_url = plugin_dir_url(dirname(__FILE__));
			$upload_dir = wp_upload_dir();
			
			// styles
			wp_enqueue_style(IPGS_PLUGIN_NAME . '-admin', $plugin_url . 'assets/css/admin.min.css', array(), IPGS_PLUGIN_VERSION, 'all' );
			wp_enqueue_style(IPGS_PLUGIN_NAME . '-fontawesome', $plugin_url . 'assets/css/font-awesome.min.css', array(), IPGS_PLUGIN_VERSION, 'all' );
			
			// scripts
			wp_enqueue_script(IPGS_PLUGIN_NAME . '-ace', $plugin_url . 'assets/js/lib/ace/ace.js', array(), IPGS_PLUGIN_VERSION, false );
			wp_enqueue_script(IPGS_PLUGIN_NAME . '-url', $plugin_url . 'assets/js/lib/url/url.min.js', array(), IPGS_PLUGIN_VERSION, false );
			wp_enqueue_script(IPGS_PLUGIN_NAME . '-pdf', $plugin_url . 'assets/js/lib/ipages/pdf.min.js', array(), IPGS_PLUGIN_VERSION, false );
			wp_enqueue_script(IPGS_PLUGIN_NAME . '-pdf-worker', $plugin_url . 'assets/js/lib/ipages/pdf.worker.min.js', array(), IPGS_PLUGIN_VERSION, false );
			wp_enqueue_script(IPGS_PLUGIN_NAME . '-admin', $plugin_url . 'assets/js/admin.min.js', array('jquery'), IPGS_PLUGIN_VERSION, false );
			
			wp_enqueue_media();
			
			// global settings to help ajax work
			$globals = array(
				'plan' => IPGS_PLUGIN_PLAN,
				'msg_pro_title' => esc_html__('Available only in Pro version', IPGS_PLUGIN_NAME),
				'msg_edit_text' => esc_html__('Edit your text here', IPGS_PLUGIN_NAME),
				'msg_custom_js_error' => esc_html__('Custom js code error', IPGS_PLUGIN_NAME),
				'wp_base_url' => get_site_url(),
				'upload_base_url' => $upload_dir['baseurl'],
				'plugin_base_url' => $plugin_url,
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( IPGS_PLUGIN_NAME . '_ajax' ),
				'ajax_msg_error' => esc_html__('Uncaught Error', IPGS_PLUGIN_NAME) //Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information
			);
			
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			
			$globals['ajax_action_get'] = $this->ajax_action_settings_get;
			$globals['ajax_action_update'] = $this->ajax_action_item_update;
			$globals['ajax_action_modal'] = $this->ajax_action_modal;
			$globals['ajax_item_id'] = $id;
			$globals['settings'] = NULL;
			$globals['config'] = NULL;
			
			$settings_key = IPGS_PLUGIN_NAME . '_settings';
			$settings_value = get_option($settings_key);
			if($settings_value) {
				$globals['settings'] = json_encode(unserialize($settings_value));
			}
			
			// get item data from DB
			if($id) {
				global $wpdb;
				$table = $wpdb->prefix . IPGS_PLUGIN_NAME;
				
				$query = $wpdb->prepare('SELECT * FROM ' . $table . ' WHERE id=%s', $id);
				$item = $wpdb->get_row($query, OBJECT);
				if($item && (current_user_can('manage_options') || get_current_user_id()==$item->author)) {
					//{
					//id: null,
					//title: null,
					//active: true,
					//config: {...}
					//}
					$globals['config'] = json_encode(unserialize($item->data));
				} else {
					exit;
				}
			} else {
				// new item
				$item = (object) array(
					'author' => get_current_user_id(),
					'editor' => get_current_user_id(),
					'created' => current_time('mysql', 1),
					'modified' => current_time('mysql', 1)
				);
			}
			
			require_once( plugin_dir_path( dirname(__FILE__) ) . 'includes/page-item.php' );
			
			// set global settings
			wp_localize_script(IPGS_PLUGIN_NAME . '-admin', IPGS_PLUGIN_NAME . '_globals', $globals);
		}
	}
	
	/**
	 * Show admin menu settings page
	 */
	function admin_menu_page_settings() {
		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
		
		if($page===IPGS_PLUGIN_NAME . '_settings') {
			$plugin_url = plugin_dir_url(dirname(__FILE__));
			
			// styles
			wp_enqueue_style(IPGS_PLUGIN_NAME . '-admin', $plugin_url . 'assets/css/admin.min.css', array(), IPGS_PLUGIN_VERSION, 'all' );
			wp_enqueue_style(IPGS_PLUGIN_NAME . '-fontawesome', $plugin_url . 'assets/css/font-awesome.min.css', array(), IPGS_PLUGIN_VERSION, 'all' );
			
			// scripts
			wp_enqueue_script(IPGS_PLUGIN_NAME . '-admin', $plugin_url . 'assets/js/admin.min.js', array('jquery'), IPGS_PLUGIN_VERSION, false );
			
			// global settings to help ajax work
			$globals = array(
				'plan' => IPGS_PLUGIN_PLAN,
				'msg_pro_title' => esc_html__('Available only in Pro version', IPGS_PLUGIN_NAME),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( IPGS_PLUGIN_NAME . '_ajax' ),
				'ajax_msg_error' => esc_html__('Uncaught Error', IPGS_PLUGIN_NAME) //Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information
			);
			
			$globals['ajax_action_update'] = $this->ajax_action_settings_update;
			$globals['ajax_action_get'] = $this->ajax_action_settings_get;
			$globals['ajax_action_modal'] = $this->ajax_action_modal;
			$globals['ajax_action_delete_data'] = $this->ajax_action_delete_data;
			$globals['config'] = NULL;
			
			// read settings
			$settings_key = IPGS_PLUGIN_NAME . '_settings';
			$settings_value = get_option($settings_key);
			if($settings_value) {
				$globals['config'] = json_encode(unserialize($settings_value));
			}
			
			require_once(plugin_dir_path( dirname(__FILE__) ) . 'includes/page-settings.php' );
			
			// set global settings
			wp_localize_script(IPGS_PLUGIN_NAME . '-admin', IPGS_PLUGIN_NAME . '_globals', $globals);
		}
	}
	
	/**
	 * Ajax update item state
	 */
	function ajax_item_update_status() {
		$error = false;
		$data = array();
		$config = filter_input(INPUT_POST, 'config', FILTER_UNSAFE_RAW);
		
		if(check_ajax_referer(IPGS_PLUGIN_NAME . '_ajax', 'nonce', false)) {
			global $wpdb;
			
			$table = $wpdb->prefix . IPGS_PLUGIN_NAME;
			$config = json_decode($config);
			$result = false;
			
			if(isset($config->id) && isset($config->active)) {
				$query = $wpdb->prepare('SELECT * FROM ' . $table . ' WHERE id=%s', $config->id);
				$item = $wpdb->get_row($query, OBJECT );
				
				if($item && (current_user_can('manage_options') || get_current_user_id()==$item->author) ) {
					$itemData = unserialize($item->data);
					$itemData->active = $config->active;
					
					$result = $wpdb->update(
						$table,
						array(
							'active'=> $itemData->active,
							'data' => serialize($itemData)
						),
						array('id'=>$config->id));
				}
			}
			
			if($result) {
				$data['id'] = $config->id;
				$data['msg'] = esc_html__('Item updated', IPGS_PLUGIN_NAME);
			} else {
				$error = true;
				$data['msg'] = esc_html__('The operation failed, can\'t update item', IPGS_PLUGIN_NAME);
			}
		} else {
			$error = true;
			$data['msg'] = esc_html__('The operation failed', IPGS_PLUGIN_NAME);
		}
		
		if($error) {
			wp_send_json_error($data);
		} else {
			wp_send_json_success($data);
		}
		
		wp_die(); // this is required to terminate immediately and return a proper response
	}
	
	/**
	 * Ajax update item data
	 */
	function ajax_item_update() {
		$error = false;
		$data = array();
		
		if(check_ajax_referer(IPGS_PLUGIN_NAME . '_ajax', 'nonce', false)) {
			global $wpdb;
			$table = $wpdb->prefix . IPGS_PLUGIN_NAME;
			
			$inputId = filter_input(INPUT_POST, 'id', FILTER_UNSAFE_RAW);
			$inputData = filter_input(INPUT_POST, 'data', FILTER_UNSAFE_RAW);
			$inputConfig = filter_input(INPUT_POST, 'config', FILTER_UNSAFE_RAW);
			$itemData = json_decode($inputData);
			$itemConfig = json_decode($inputConfig);
			$flag = true;
			
			if(IPGS_PLUGIN_PLAN == 'lite') {
				$rowcount = $wpdb->get_var('SELECT COUNT(*) FROM ' . $table );
				
				if(!($rowcount == 0 || ($rowcount == 1 && $inputId))) {
					$flag = false;
					$error = true;
					$data['msg'] = esc_html__('The operation failed, you can work only with one book. To create more, buy the pro version.', IPGS_PLUGIN_NAME);
				}
			}
			
			if($flag) {
				if($inputId) {
					$result = false;
					
					$query = $wpdb->prepare('SELECT * FROM ' . $table . ' WHERE id=%s', $inputId);
					$item = $wpdb->get_row($query, OBJECT);
					if($item && (current_user_can('manage_options') || get_current_user_id()==$item->author) ) {
						$itemData->slug = sanitize_title(($itemData->slug ? $itemData->slug : $itemData->title));
						
						$result = $wpdb->update(
							$table,
							array(
								'title' => $itemData->title,
								'slug' => $itemData->slug,
								'active' => $itemData->active,
								'data' => serialize($itemData),
								'config' => serialize($itemConfig),
								//'author' => get_current_user_id(),
								'editor' => get_current_user_id(),
								//'created' => NULL,
								'modified' => current_time('mysql', 1)
							),
							array('id'=>$inputId));
					}
					
					if($result) {
						$data['id'] = $inputId;
						$data['msg'] = esc_html__('Item updated', IPGS_PLUGIN_NAME);
					} else {
						$error = true;
						$data['msg'] = esc_html__('The operation failed, can\'t update item', IPGS_PLUGIN_NAME);
					}
				} else {
					$itemData->slug = sanitize_title(($itemData->slug ? $itemData->slug : $itemData->title));
					
					$result = $wpdb->insert(
						$table,
						array(
							'title' => $itemData->title,
							'slug' => $itemData->slug,
							'active' => $itemData->active,
							'data' => serialize($itemData),
							'config' => serialize($itemConfig),
							'author' => get_current_user_id(),
							'editor' => get_current_user_id(),
							'created' => current_time('mysql', 1),
							'modified' => current_time('mysql', 1)
						));
					
					if($result) {
						$data['id'] = $inputId = $wpdb->insert_id;
						$data['msg'] = esc_html__('Item created', IPGS_PLUGIN_NAME);
					} else {
						$error = true;
						$data['msg'] = esc_html__('The operation failed, can\'t create item', IPGS_PLUGIN_NAME);
					}
				}
			}
			
			//======================================
			// [filemanager] create an external file
			if(!$error && wp_is_writable(IPGS_PLUGIN_UPLOAD_DIR)) {
				$file_json = 'config.json';
				$file_main_css = 'main.css';
				$file_custom_css = 'custom.css';
				$file_root_path = IPGS_PLUGIN_UPLOAD_DIR . '/' . $inputId . '/';
				
				$wp_filesystem = $this->getFileSystem();
				
				if($wp_filesystem) {
					if(!$wp_filesystem->is_dir($file_root_path)) {
						$wp_filesystem->mkdir($file_root_path);
					}
					
					$wp_filesystem->put_contents($file_root_path . $file_json, json_encode($itemConfig), FS_CHMOD_FILE);
					$wp_filesystem->put_contents($file_root_path . $file_main_css, $this->getMainCss($itemData, $inputId), FS_CHMOD_FILE);
					$wp_filesystem->put_contents($file_root_path . $file_custom_css, $itemData->customCSS->data, FS_CHMOD_FILE);
				}
			}
			//======================================
		} else {
			$error = true;
			$data['msg'] = esc_html__('The operation failed', IPGS_PLUGIN_NAME);
		}
		
		if($error) {
			wp_send_json_error($data);
		} else {
			wp_send_json_success($data);
		}
		
		wp_die(); // this is required to terminate immediately and return a proper response
	}
	
	/**
	 * Ajax update settings data
	 */
	function ajax_settings_update() {
		$error = false;
		$data = array();
		$config = filter_input(INPUT_POST, 'config', FILTER_UNSAFE_RAW);
		
		if(check_ajax_referer(IPGS_PLUGIN_NAME . '_ajax', 'nonce', false)) {
			$settings_key = IPGS_PLUGIN_NAME . '_settings';
			$settings_value = serialize(json_decode($config));
			$result = false;
			
			if(get_option($settings_key) == false) {
				$deprecated = null;
				$autoload = 'no';
				$result = add_option($settings_key, $settings_value, $deprecated, $autoload);
			} else {
				$old_settings_value = get_option($settings_key);
				if($old_settings_value === $settings_value) {
					$result = true;
				} else {
					$result = update_option($settings_key, $settings_value);
				}
			}
			
			if($result) {
				$data['msg'] = esc_html__('Settings updated', IPGS_PLUGIN_NAME);
			} else {
				$error = true;
				$data['msg'] = esc_html__('The operation failed, can\'t update settings', IPGS_PLUGIN_NAME);
			}
		}
		
		if($error) {
			wp_send_json_error($data);
		} else {
			wp_send_json_success($data);
		}
		
		wp_die(); // this is required to terminate immediately and return a proper response
	}
	
	/**
	 * Ajax settings get data
	 */
	function ajax_settings_get() {
		$error = false;
		$data = array();
		$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
		
		if(check_ajax_referer(IPGS_PLUGIN_NAME . '_ajax', 'nonce', false)) {
			switch($type) {
				case 'roles': {
					$data['list'] = array();
					
					$roles = wp_roles()->roles;
					foreach($roles as $key => $role) {
						if(array_key_exists('read', $role['capabilities'])) {
							array_push($data['list'], array('id' => $key, 'name' =>  translate_user_role($role['name'])));
						}
					}
				}
				break;
				case 'book-themes': {
					$data['list'] = array();
					$files = glob(plugin_dir_path( dirname(__FILE__) ) . 'assets/themes/*', GLOB_ONLYDIR);
					
					foreach($files as $file) {
						$filename = basename($file, '.min.css');
						array_push($data['list'], array('id' => $filename, 'title' => str_replace('-', ' ', $filename)));
					}
				}
				break;
				case 'editor-themes': {
					$data['list'] = array();
					$files = glob(plugin_dir_path( dirname(__FILE__) ) . 'assets/js/lib/ace/theme-*.js');
					
					foreach($files as $file) {
						$filename = str_replace('theme-','',basename($file, '.js'));
						array_push($data['list'], array('id' => $filename, 'title' => str_replace('_', ' ', $filename)));
					}
				}
				break;
				default: {
					$error = true;
					$data['msg'] = esc_html__('The operation failed', IPGS_PLUGIN_NAME);
				}
				break;
			}
		} else {
			$error = true;
			$data['msg'] = esc_html__('The operation failed', IPGS_PLUGIN_NAME);
		}
		
		if($error) {
			wp_send_json_error($data);
		} else {
			wp_send_json_success($data);
		}
		
		wp_die(); // this is required to terminate immediately and return a proper response
	}
	
	/**
	 * Ajax delete all data from tables
	 */
	function ajax_delete_data() {
		$error = true;
		$data = array();
		$data['msg'] = esc_html__('The operation failed, can\'t delete data', IPGS_PLUGIN_NAME);
		
		if(check_ajax_referer(IPGS_PLUGIN_NAME . '_ajax', 'nonce', false)) {
			global $wpdb;
			$table = $wpdb->prefix . IPGS_PLUGIN_NAME;
			
			foreach($wpdb->get_results('SELECT id FROM ' . $table) as $key=>$item) {
				//======================================
				// [filemanager] delete file
				if(wp_is_writable(IPGS_PLUGIN_UPLOAD_DIR)) {
					$file_json = 'config.json';
					$file_main_css = 'main.css';
					$file_custom_css = 'custom.css';
					$file_root_path = IPGS_PLUGIN_UPLOAD_DIR . '/' . $item->id . '/';
					
					$wp_filesystem = $this->getFileSystem();
					
					if($wp_filesystem) {
						$wp_filesystem->delete($file_root_path . $file_json);
						$wp_filesystem->delete($file_root_path . $file_main_css);
						$wp_filesystem->delete($file_root_path . $file_custom_css);
						
						if($wp_filesystem->is_dir($file_root_path)) {
							$wp_filesystem->rmdir($file_root_path);
						}
					}
				}
				//======================================
			}
			
			$query = 'TRUNCATE TABLE ' . $table;
			$result = $wpdb->query($query);
			
			if($result) {
				$error = false;
				$data['msg'] = esc_html__('All data deleted', IPGS_PLUGIN_NAME);
			}
		}
		
		if($error) {
			wp_send_json_error($data);
		} else {
			wp_send_json_success($data);
		}
		
		wp_die(); // this is required to terminate immediately and return a proper response
	}
	
	/**
	 * Ajax settings get data
	 */
	function ajax_modal() {
		if(check_ajax_referer(IPGS_PLUGIN_NAME . '_ajax', 'nonce', false)) {
			$modalName = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
			$modalPath = plugin_dir_path(dirname(__FILE__)) . 'includes/modal-' . $modalName . '.php';
			
			if(file_exists($modalPath)) {
				require_once($modalPath);
			}
		}
		
		wp_die(); // this is required to terminate immediately and return a proper response
	}
}

endif;

?>