=== Facebook Profile Wordpress plugin ===
Author: Claude Vedovini
Contributors: cvedovini
Donate link: http://vedovini.net/plugins/?utm_source=wordpress&utm_medium=plugin&utm_campaign=fbprofile
Tags: Facebook,profile
Requires at least: 2.7
Tested up to: 3.2.1
Stable tag: 2.0


== Description ==

This plugin enables you to create a Facebook page tab featuring your blog.


== Installation ==

This plugin follows the [standard WordPress installation method](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins):

1. Upload the `facebook-profile-theme` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Log in to the Facebook Developer application: http://www.facebook.com/developers/
1. Create a new application, more info: http://developers.facebook.com/get_started.php
1. Note down the App ID
1. Choose an App Namespace (your blog will be visible on http://apps.facebook.com/namespace) and fill the other `Basic Info` fields
1. In the section `Select how your app integrates with Facebook` select `Website`, `App on Facebook` and `Page Tab`
1. In the `Website` section, set `Site URL` to your blog's URL
1. In the `App on Facebook` section, set `Canvas URL` to your blog's URL and `Secure Canvas URL` to the secure version of your blog (you will need an SSL certificate)
1. In the `Page Tab`section choose `Page Tab Name` (your blog's name for example) and set the `Page Tab URL`and `Secure Page Tab URL` to `?from_page` 
1. In the `Advanced` tab set the `App Type` to `Web`, make sure the sandox mode is disabled and activate all migration options
1. Then in the `Canvas Settings` section set `Canvas Type` as `IFrame`, `Canvas Width` as `Fixed (760px)` and `Canvas Height` to `Settable (Default: 800px)` 
1. Set other options at your liking
1. Go to the plugin configuration page (wp-admin/options-general.php?page=fbprofile_options), fill the App ID and press `Save Changes`
 
To add your blog to your page tab:

1. Go to the application profile page (http://www.facebook.com/profile.php?id=APP_ID)
1. Click on the `Add to my page` link 
1. Authorize the application, you will be redirected to the profile page
1. Click again on the `Go to Application` button
1. Click on the `Add profile tab` button at the top of the page 

You will then have a new profile tab showing your last posts to people visiting your profile.

If you already installed the plugin in a version prior to 1.1 you will need to activate the `New Data Permissions` migration 
option on the `Migrations` tab of your application settings. However, Facebook should have activated it automatically after June the 30th.

== Screenshots ==

1. Screenshot Facebook profile tab 


== Changelog ==

= version 2.0 =
- Migrating to IFrame and signed_request

= version 1.1 =
- Using new authorization SDK, see installation instruction for migration instruction

= version 1.0.5 =
- fixing application authorization issue following Facebook new SDK release

= version 1.0.4 =
- various fixes in documentation

= version 1.0.0 =
- Initial release
