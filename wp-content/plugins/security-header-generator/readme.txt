=== Security Header Generator ===
Contributors: kevp75
Donate link: https://paypal.me/kevinpirnie
Tags: security, security headers, content security policy, permissions, permissions policy
Requires at least: 5.6.10
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 4.0.01
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
 
This plugin generates the proper security HTTP response headers to keep your site secured.
 
== Description ==
 
This plugin generates the proper security HTTP response headers, attempts to generate a valid Content Security Policy, and sets browser permissions if configured. 
 
== Installation ==
 
1. Download the plugin, unzip it, and upload to your sites `/wp-content/plugins/` directory
    1. You can also upload it directly to your Plugins admin
2. Activate the plugin through the 'Plugins' menu in WordPress
 
== Frequently Asked Questions ==
 
= What is a Content Security Policy? =
 
A Content Security Policy is an added layer of security that helps to detect and mitigate certain types of attacks, including Cross Site Scripting (XSS) and data injection attacks.
 
= Will this detect every external source in my site? =
 
Unfortunately, no.   While it will make every best effort to do so, it cannot capture external resources inside already external resources.

= How do I automatically generate a Content Security Policy using your plugin? =

Login to shell for your site, change directory to your websites root folder, and run `wp csp generate`.  Have some patience because it can take some time to run. Please make sure to run it a few times, I cannot guarantee that it will get everything, but, in my tests on my own sites it did.
 
== Screenshots ==
 
1. Standard Header Settings
2. Content Security Policy Settings
3. Permissions Settings
4. Implementation
5. Documentation
6. Import/Export Settings
7. Headers Set
 
== Changelog ==

= 4.0.01
* Verified: Core Version 6.4 compliant
* Remove: `navigate-to` directive for Content Security Policy
    * Per: https://docs.w3cub.com/http/headers/content-security-policy/navigate-to no longer supported in any browser
* Add: `report-to` directive for Content Security Policy
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/report-to
    * Please be aware, this directive currently does nothing in Firefox and Safari
* Updated: Wordpress Defaults.  Compliant ONLY with the following:
    * Plugins: Gravity Forms
    * Themes: Twenty Twenty, Twenty Twenty-One, Twenty Twenty-Two, Twenty Twenty-Three
* Updated: Wordpress Core version requirements to 5.6.10

= 3.9.77 =
* Fix: Autofill on Basic Auth fields
* Add: Access-Control-Allow-Methods header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Methods
    * Default: GET, POST, HEAD
        * These are Wordpress default allowable methods for the REST API
    * Hook: `wpsh_acam_header`
* Add: Access-Control-Allow-Credentials
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Credentials
    * Default: true
    * Hook: `wpsh_acac_header`
* Updated: Documentation

= 3.9.12 =
* Update: Documentation
* Fix: Autoloader not including the settings
    * **NOTE** I had to manually include them, but not anymore :)
* Add: Directives to the COEP
    * `require-corp` and `unsafe-none`
    * **NOTE** `require-corp` will require you to configure the Cross-Origin-Resource-Policy header
* Remove older versions

= 3.9.01 =
* Fix: Deprecation notice in CLI
* Fix: Deprecated `get_page_by_title`
* Optimize: Class loading with Composers autoloader and it's optimizations
* Updated: JS libraries (codemirror, leaflet, etc).
* Improved: Some JS and CSS coding.

= 3.8.14 = 
* Fix: PHP 8.1 deprecation notice on `rtrim`
* Add: Cross-Origin-Resource-Policy header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Cross-Origin_Resource_Policy
    * Default: same-origin
    * Hook: `wpsh_corp_header`

= 3.8.01 =
* Fix: CSP Headers being set in admin when not configured to do so
    * change in WP core `send_headers` or `admin_init` actions between Core 6.2 and Core 6.2.2
* Add: More concise boolean checks
* Add: Option for applying Content Security Policy headers to admin separately from primary security headers application setting
* Add: Option for applying Feature Policy headers to admin separately from primary security headers application setting
* Fix: Default CSP Script and Styles headers WP Defaults
* Remove: Implementation page in settings  
    * No longer a need for this
* Update: Documentation for the above

= 3.7.23 =
* Remove: `document-domain` from the Permissions-Policy header
    * no longer supported: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/document-domain
* Remove: `execution-while-not-rendered` from the Permissions-Policy header
    * no longer supported: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/execution-while-not-rendered
* Remove: `execution-while-out-of-viewport` from the Permissions-Policy header
    * no longer supported: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/execution-while-out-of-viewport
* Remove: `navigation-override` from the Permissions-Policy header
    * completely removed
* Remove: `gamepad` from the Permissions-Policy header
    * no longer supported: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/gamepad
* Remove: The FLoC Permission Policy. 
    * completely removed
* Add: `hid` to the Permissions-Policy Header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/hid
* Add: `identity-credentials-get` to the Permissions-Policy Header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/identity-credentials-get
* Add: `idle-detection` to the Permissions-Policy Header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/idle-detection
* Add `publickey-credentials-create` to the Permissions-Policy Header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/publickey-credentials-create
* Add `screen-wake-lock` to the Permissions-Policy Header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/screen-wake-lock
* Add `serial` to the Permissions-Policy Header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/serial
* Add `web-share` to the Permissions-Policy Header
    * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Permissions-Policy/web-share

= 3.6.79 =
* Remove: `prefetch-src` from the Content-Security-Policy
    * no longer supported: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/prefetch-src

= 3.6.46 =
* Fix: Implementation Page
    * now accurately reflects the confguration set

= 3.6.44 =
* Verify: Up to 6.3 Compliant
* Fix: PHP 8.2 deprecation notices in field Framework

= 3.6.33 = 
* Test: Up to 6.2 compliant

= 3.6.22 =
* Add: setting for allowing an access control origin
    * This should help out with CORS issues, especially from google

= 3.6.11 =
* Fix: PHP 8 warning messages
    * `Warning: Undefined array key "Permissions-Policy"`
* Fix: PHP 8 fatal error on special circumstance
    * `KCP_CSPGEN_Headers::kp_get_generated_csp(): Return value must be of type array, string returned`

= 3.6.02 =
* Test: Up to 6.1.2 compliant
* Fixed: Directory traversal in plugin
* Fixed: Added check/uncheck all option for checkbox field.
* Updated: Google Web Fonts array added new fonts.
* Updated: JS libraries (codemirror, leaflet, etc).
* Improved: Some JS and CSS coding.

= 3.5.17 =
* Test: Up to 6.1.1 compliant
* Remove: Server identifiers removers. 
* Rework: Broke out the front-end and admin headers to separate methods
* Fix: Check for duplicate headers, or already set headers

= 3.4.28 =
* Fix: Typo in versioning

= 3.4.27 =
* Test: Up to 6.0.2 compliant
* Tech: force PHP 7.4 minimum
* Remove: Upgrader hook
    * this is no longer needed
* Remove: X-XSS-Protection Header
    * was depracated in version 2.2.13. Only compatible browsers as of 7/14/2022 are Edge and and Safari
      Use CSP to mitigate XSS

= 3.3.01 =
* Test: Up to 6.0 compliant
* Test: Up to PHP 8.1 Compliant
* New: Plugin Icon =)
* Updated: Settings Field Framework
    * Added: Number field "min", "max", "step" options.
    * Updated: Google Web Fonts array added new fonts.
    * Updated: JS libraries (codemirror, leaflet, etc).
    * Improved: Group field "custom title and prefix" option (samples added).
    * Improved: Some JS and CSS coding.

= 3.2.37 =
* Fix: Eval and Inline for empty directives

= 3.2.34 =
* Fix: Forgot a debugging var_dump... SMH

= 3.2.33 =
* Fix: Include blank directives:
    * Even if the directives are blank for the CSP, they should still be included with the 'self' flag
* Test: Up to 5.9.2 compliant
* Fix: CLI performance.  
    * Was timing out, then skipping some directives on larger sites.

= 3.1.02 =
* Fix: Default WP CSP headers not being set
* Fix: Implementation now includes Default WP
* Feature: Implement debug check to queue unminified style and scripts
* Fix: Implementation from the CLI pulls

= 3.0.77 = 
* Update: Settings framework

= 3.0.68 =
* Fix: OR to ||
    * forgot about it in the main plugin file
* Update: translatable resources
    * New: /languages/security-header-generator.pot

= 3.0.10 =
* Fix: Array issue
* Fix: Strict typing issue

= 3.0.09 =
* Feature: Implement post update hook to try to properly migrate existing settings to the new format
* Update: Change exportable/importable settings names, more legible
    * While I will do my best to automate this, please note it may not be perfect... I am only human after all ;)
    * If you export your settings before updating, you can import them again after updating and the below will be 
      taken care of for you.
    * Just in case it does not work 100%, please export your settings before updating to this version and 
      perform a search and replace for the string to remove it:
        * Search: "kp_cspgen_"
        * Replace: null|nothing|empty
    * NOTE: If you do not export your settings I will not guarantee that you will not have to reconfigure the plugin.
      Although... I did take a backup ;) You will need to hop into your database to grab it though, it will be in your
      options table, and it is called: `wpsh_TEMP_settings`.  I will have this automatically removed in a future update
* Add: Option to remove server advertising.
* Add: Expect-CT header
    * The Expect-CT header lets sites opt in to reporting and/or enforcement of Certificate Transparency requirements, 
      to prevent the use of misissued certificates for that site from going unnoticed.
    * Doc: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Expect-CT
    * Hook: `wpsh_expectct_header`
* Updated: Feature Policies.
    * Removed the following: battery, layout-animations, legacy-image-formats, oversized-images, screen-wake-lock, 
      unoptimized-images, unsized-media, web-share
    * The above no longer have any browser support.
    * Added: Descriptive descriptions for each directive
* Updated: Content Security Policy
    * Added: the following fetch directives: 
        * child-src, manifest-src, object-src, prefetch-src, script-src-elem, 
          script-src-attr, style-src-elem, style-src-attr, worker-src, navigate-to
    * Added: Unsafe Inline and Unsafe Eval settings on each CSP directive
    * Added: Descriptive descriptions for each directive
    * Reworked: Settings for the entire section, which of course caused me to rewrite the way they are implemented.
