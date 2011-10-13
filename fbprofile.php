<?php 
/*
	Plugin Name: Facebook Profile Theme
	Plugin URI: http://vedovini.net/plugins/?utm_source=wordpress&utm_medium=plugin&utm_campaign=fbprofile
	Description: This plugin enables you to add your blog to your Facebook profile.
	Author: Claude Vedovini
	Author URI: http://vedovini.net/?utm_source=wordpress&utm_medium=plugin&utm_campaign=fbprofile
	Version: 2.0.1
   
	# Thanks to Malan Joubert for its Facebook theme that inspired the theme
	# included in this plugin (http://www.foxinni.com/) and thanks to the
	# developers of the WPtouch plugin who showed me how to do it (http://bravenewcode.com/wptouch)
	
	# The code in this plugin is free software; you can redistribute the code aspects of
	# the plugin and/or modify the code under the terms of the GNU Lesser General
	# Public License as published by the Free Software Foundation; either
	# version 3 of the License, or (at your option) any later version.
	
	# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	# EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	# MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	# NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
	# LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
	# OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
	# WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
	#
	# See the GNU lesser General Public License for more details.
*/
define('FBPROFILE_PLUGIN_NAME', basename(dirname(__FILE__)));
define('FBPROFILE_DOMAIN', 'fbprofile-plugin');
define('FBPROFILE_DIR', WP_PLUGIN_DIR . '/' . FBPROFILE_PLUGIN_NAME .'/');


class FBProfilePlugin {
		
	function FBProfilePlugin() {
		add_filter( 'stylesheet', array(&$this, 'get_stylesheet') );
		add_filter( 'theme_root', array(&$this, 'theme_root') );
		add_filter( 'theme_root_uri', array(&$this, 'theme_root_uri') );
		add_filter( 'template', array(&$this, 'get_template') );
		add_action('init', array(&$this, 'init'));
	}
	
	function init() {
		if (is_admin()) {
			add_action('admin_menu', array(& $this, 'admin_menu'));
		}
	}
	
	function admin_menu() {
		load_plugin_textdomain(FBPROFILE_DOMAIN, FBPROFILE_DIR);
		add_options_page(__('Facebook Profile Theme Options', FBPROFILE_DOMAIN), __('Facebook Profile Theme', FBPROFILE_DOMAIN), 
			'manage_options', 'fbprofile_options', array(&$this, 'option_page'));
	}

	function option_page() { ?>
<div class="wrap">
<h2><?php _e('Facebook Profile Theme Options', FBPROFILE_DOMAIN); ?></h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><?php _e('Facebook App ID', FBPROFILE_DOMAIN); ?></th>
		<td><input id="FACEBOOK_APP_ID" name="FACEBOOK_APP_ID" type="text" value="<?php echo get_option('FACEBOOK_APP_ID'); ?>" />
			<p><em><?php _e('App ID/API Key as given in the Facebook application settings.', FBPROFILE_DOMAIN); ?></em></p>
		</td>
	</tr>
</table>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="FACEBOOK_APP_ID" />
<p class="submit"><input type="submit" name="submit"
	value="<?php _e('Save Changes'); ?>" /></p>
</form>
</div><?php
	}
	
	function from_facebook() {
		static $is_facebook;
		
		if (!isset($is_facebook)) {
			$is_facebook = isset($_REQUEST['signed_request']);
		}
		
		return $is_facebook;
	}
	
	function get_stylesheet($stylesheet) {
		if ($this->from_facebook()) {
			return 'default';
		} else {
			return $stylesheet;
		}
	}
		  
	function get_template($template) {
		if ($this->from_facebook()) {
			return 'default';
		} else {	   
			return $template;
		}
	}
		  
	function get_template_directory($value) {
		if ($this->from_facebook()) {
			return WP_PLUGIN_DIR . '/' . FBPROFILE_PLUGIN_NAME . '/themes';
		} else {
			return $value;
		}
	}
		  
	function theme_root($path) {
		if ($this->from_facebook()) {
			return WP_PLUGIN_DIR . '/' . FBPROFILE_PLUGIN_NAME . '/themes';
		} else {
			return $path;
		}
	}
		  
	function theme_root_uri($url) {
		if ($this->from_facebook()) {
			return WP_PLUGIN_URL . '/' . FBPROFILE_PLUGIN_NAME . '/themes';
		} else {
			return $url;
		}
	}
}
  
global $fbprofile_plugin;
$fbprofile_plugin = new FBProfilePlugin();
