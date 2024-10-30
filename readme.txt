=== Agy - Age verification for WooCommerce ===
Contributors: patrickposner
Tags: age verification, age gate, age restriction, age popup, page gate, content warning
Requires at least: 4.6
Tested up to: 6.0
Stable tag: 4.3.2

== Description ==

Agy is a modern and responsive solution for age verification with WooCommerce.
Simply setup the texts, modify the design and your ready.

This comes specially handy if your content or products are about alcohol, gambling or other adult content.

== How to use ==

After activation move to Settings->Agy and begin to configure your age verification settings.

Start with your general settings: add your age value, set the cookie lifetime, your exit URL and decide if it should apply to registered users or not.

Move to the text settings and customise all your texts. This is also the place to apply any translations with WPML or Polylang - simply use the language switcher in the admin bar.

To exlude a specific post, page or product from the age gate simply check the metabox inside the editor (works also with Gutenberg).

== Features ==

* Let users verify their age on page visit
* SEO friendly - This plugin automatically let bots and crawlers bypass the age gate (including google page speed bots)
* Exclude specific posts/pages/products from the Age Gate
* Use one or two column mode for additonal explanations
* Add your own logo and set a unique teaser area (two column mode)
* Show the age gate only for non-registered users
* Modify every text, color, background image and more
* redirect failed logins to a specified page
* mobil-friendly design

Learn more on [patrickposner.dev/docs](https://patrickposner.dev/docs)

== Pro ==

Agy Pro is for advanced WooCommmere shops which like to take a more advanced and secured way to age verification.
The advanced pro features are not needed for an average WordPress website.

* More design layouts: age slider and datepicker
* Add an age checkbox to registration and checkout
* Save the information if the user is old enough in the account
* blacklist specific products, when the user does not match the age (works also with unregistered customers)
* Sofort Ident for WooCommerce - add an advanced age verification with the Sofort Ident API. It verifies the users age with their bank account.
* Advanced technical support directly from the developer 

Get pro on [patrickposner.dev/plugins/agy](https://patrickposner.dev/plugins/agy/)

== Support ==

The free support is exclusively limited to the wordpress.org support forum.
Any kind of email priority support, customisation and integration help need a valid premium license.

=== CODING STANDARDS MADE IN GERMANY ===

Agy is coded with modern PHP and WordPress standards in mind. It’s fully OOP coded. It’s highly extendable for developers through several action and filter hooks.
Agy has your website performance in mind -  every script and style is minified and loaded conditionally.


=== MULTI-LANGUAGE ===

Agy is completly translatable with WPML and Polylang.
Simply use the age switcher and translate all settings in Settings -> Agy.

== Installation ==

= Default Method =
1. Go to Settings > Plugins in your administrator panel.
1. Click `Add New`
1. Search for Agy
1. Click install.

= Easy Method =
1. Download the zip file.
1. Login to your `Dashboard`
1. Open your plugins bar and click `Add New`
1. Click the `upload tab`
1. Choose `content-warning-v2` from your downloads folder
1. Click `Install Now`
1. All done, now just activate the plugin
1. Go to Settings -> Agy and configure it
1. Save, and you're all good.

= Old Method =
1. Upload `content-warning-v2` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress


== Screenshots ==

1. Two-Column mode
2. One-Column mode
3. Customizer Settings
3. Admin settings

== Changelog ==

= 4.3.2 =

* improved blacklist checkup in cart/checkout
* updated cookie js
* dynamic version number

= 4.3.1 =

* Freemius SDK update

= 4.3.0 =

* improved Sofort Ident API 
* new admin settings for Sofort Ident
* Adapted to latest Sofort Ident API modifications

= 4.2.9 =

* better checkup for blacklisted product in cart

= 4.2.8 =

* fixed scroll bug
* added option to allow shortcode in message
* removed default apply_filters('the_content') which caused problems with Divi and Elementor
* PHP 8 compatibility

= 4.2.7 =

* better default styles to prevent scroll box
* settings to adjust height if the box
* setting to adjust max width of logo
* better and cleaner freemius integration

= 4.2.6.4 =

* support release
* fixed notice for deactivating age gate
* makes sure scripts are handeled correctly when option is off

= 4.2.6.3 =

* better activation handling
* shortcodes in description and other fields
* scrollable box if to much content included
* redirect to settings URL instead of 404 template
* option to deactivate age gate

= 4.2.6.2 =

* bugfix release
* better sofort ident checkup
* check if cart has blacklisted item failsafe checkup
* fixing PHP notices for blacklist settings in tags
* improved translation


= 4.2.6.1 =

* fixed admin redirect
* better error handling
* check if WooCommerce is active before activate Agy

= 4.2.6 =

* compatibility with WooCommerce 4.9 (and later)
* Add option to delete settings (save mode)
* Added blacklist by product tag
* Added blacklist restrictions for WooCommerce checkout and Sofort Ident API
* enhanced get_defaults() with new options
* move settings page under WooCommerce menu

= 4.2.5 =

* fixed WooCommerce blacklist error
* added filter for conditional Sofort Ident API

= 4.2.4 =

* better error handling
* activate age gate only if settings are configured
* add options to modify woocommerce checkbox text and error message
* prevent fatal error while upgrading
* latest freemius sdk

= 4.2.3 =
* customizer bugfix for WordPress 5.5
* use <button> instead of <a> elements for buttons
* removed unused img files
* limit assets to settings page with get_current_screen()

= 4.2.2 =
* compatibility WordPress 5.5
* new version fo wp alpha color picker
* modified admin styles for better color picker usage

= 4.2.1 =
* Bugfix for Multisite activations
* Fixed Sofort Ident checkup in checkout
* compatibility divi checkout with restriction

= 4.2 =
* better WooCommerce blacklist handling
* bugfix for Sofort Ident API
* Whitelist-Mode for inverting blacklist
* modified descriptions and translations
* CSS bugfixes for alpha color select
* removed migration message

= 4.1.4 =
* position fixed for .box
* hover state for buttons
* better prefix for run_plugin to avoid conflicts
* readding debug mode
* dynamic cookie lifetime fixed
* fix for closing migration notice (without migration)
* WPML config file for translation

= 4.1.3 =
* Support release
* check if WooCommerce conditional functions exists before using them

= 4.1.2 =
* Support release
* fixed woocommerce_options vs. woocommerce_settings
* made Sofort Ident an optional (and activatable) feature
* better preventing naming issues with consequent namespacing
* fixed notice for age_result checks

= 4.1.1 =
* Support release
* fixed Is_user_logged_in() namespace error

= 4.1 =
* cookie option
* new admin UI 
* move customizer settings to options
* more efficient blacklist solution with post meta settings
* add migrator for customizer settings
* add new Sofort Ident API features

= 4.0.8 =
* prevents collision if free and pro version installed
* check if migrate_page_authorization exists before using it

= 4.0.7 =
* security fix freemius sdk
* background image option

= 4.0.6 =
* fix center mode for IE 9 - 11

= 4.0.5 =
* z-index options in customizer
* prevent whitelist option update on plugin update

= 4.0.4 =
* compatibility bridge theme
* fix modifiy height settings
* translation fixes for german admin

= 4.0.3 =
* fixed some migration problems
* set z-index for the box
* fixed [age] shortcode in output
* fixed age gate check on page load
* optimized responsive design

= 4.0.2 =
* improved migration from content-warning-v2

= 4.0.1 =
* improved initial configuration
* improved migration for headline, message, exit and enter buttons
* fixed namespace for PSAG_Helper
* add notice with customizer link
* improved readme
* modified some default values for the customizer

= 4.0 =
* under new development
* complete redevelopment of the current age verification plugin
* adding migration options for Upgrade

= 3.7.2 =
* Removed some rogue logging methods.

= 3.7.1 =
* Fixed category saving in options Fixes [#59](https://github.com/JayWood/content-warning-v3/issues/59)

= 3.7 =
* Fixed an opacity bug where if user set opacity to 0, it was ignored. This should no longer happen.
* Move to the settings API, drop JW Simple Options framework ( I was a newbie when I made it ). Fixes [#45](https://github.com/JayWood/content-warning-v3/issues/45)
* Use Select2 for categories
* Use a better check method for checkboxes and multi-select - fixes [#49](https://github.com/JayWood/content-warning-v3/issues/49)
* Set opacity step to 0.1 - Fixes [#55](https://github.com/JayWood/content-warning-v3/issues/55)

= 3.6.9 =
* Small cleanup
* Force text color to be black - fixes [#43](https://github.com/JayWood/content-warning-v3/issues/43)
* Use `COOKIEPATH` instead of `SITECOOKIEPATH` constants, compatibility fix for sub-folder installs - fixes [#42](https://github.com/JayWood/content-warning-v3/issues/42)

= 3.6.8 =
* Use background-image css property instead of just background - thanks to [95CivicSi](https://github.com/95CivicSi)

= 3.6.7 =
* Fixed conditional being too strict [#34](https://github.com/JayWood/content-warning-v3/issues/34)
* Fixed plugin homepage link [#31](https://github.com/JayWood/content-warning-v3/issues/31)
* Removed uninstall hook for now - Options API needs to be updated
* Fixed denial toggle to actually remove denial text if it was once on, but now off.

= 3.6.6 =
* Fixed CSS issues for background images and css overrides

= 3.6.5 =
* Zero day ( 0 ) cookies should use sessions instead of NOT setting the cookie. [Issue #29](https://github.com/JayWood/content-warning-v3/issues/29)
* New filter for display condition - [See Wiki](https://github.com/JayWood/content-warning-v3/wiki/Dev-Documentation#hide-the-dialog-on-certain-pages-regardless-of-cookies) - [Issue #26](https://github.com/JayWood/content-warning-v3/issues/26)

= 3.6.4 =
* Fixed denial redirects. [Issue #28](https://github.com/JayWood/content-warning-v3/issues/28)
* Fixed multiple undefined index errors on admin
* Changed yes/no on post columns to locked dash-icon, less clutter
* Clean up meta saving logic
* Added @since tags for future development
* Better PHP documentation
* Add /lang directory for I18n
* Update Tested Up To version
* [Development Documentation](https://github.com/JayWood/content-warning-v3/wiki/Dev-Documentation)
* Passified all PHPcs complaints

= 3.6.3 =
* Category fix, fixes [#18](https://github.com/JayWood/content-warning-v3/issues/18)
* Alphabetize method names, because why not!?
* Few docblock changes

= 3.6.2 =
* Dialog re-sizing fixes.

= 3.6.1 =
* Cookie HOTFIX

= 3.6.0 =
* Split methods and hooks from main class file, will prevent overhead, also separates admin from front-end.
* Moved to use of cookie.js
* Created API file for methods.
* New filters & actions for developers
* Began development of API file, currently only support JS outputs.
* **NEW** Filters for content outputs, see `inc/api.php` more to come.
* Switched CSS priority, to allow custom css to override bg image and opacity
* Converted sass file to nested sass and uses classes instead of IDs
* [stacyk](https://github.com/stacyk) - Made buttons visible on popup at all times.
* [stacyk](https://github.com/stacyk) - CSS Fixes for new popup.
* New Popup coding, dropped colorbox in favor of my own popup code. ( Less bloat )
* BIG THANKS to Stacy for helping me with some initial CSS issues.

== Upgrade Notice ==
= 2.0 =
Adds a ton more features from v1 by rajeevan.  Along with a few security fixes.
