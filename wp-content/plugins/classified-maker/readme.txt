=== Classified Maker ===
	Contributors: pickplugins
	Donate link: http://pickplugins.com
	Tags:  classified, classified ads, classified maker, classified script, classified theme, classifieds, classifieds script, classifieds theme, wp classified, wp classifieds
	Requires at least: 4.1
	Tested up to: 4.9
	Stable tag: 1.0.18
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

	Create Awesome Classified Website in a Minute

== Description ==


Creating Classified website for WordPress made easy by “Classified Maker” plugin. Based on short-code made easy to use anywhere displaying listings, single item page & etc.

Easy to customizable made this plugin supper developer friendly , you can add your own values for some options via filter hook. You can create unlimited themes for archive page & single page by filter hook.

### Classified Maker by http://pickplugins.com
* [Live Demo!&raquo;](http://www.pickplugins.com/demo/classified-maker/)
* [Plugin details!&raquo;](http://www.pickplugins.com/item/classified-maker)
* [Documentation!&raquo;](https://www.pickplugins.com/documentation/classified-maker/)


<strong>Tutorials</strong>

* [Classified Maker - How to install](https://www.youtube.com/watch?v=4jwzy3MNKHA)
* [Classified Maker - Settings](https://www.youtube.com/watch?v=IzPYlIb6Bbk)
* [Classified Maker - How to publish Ads](https://www.youtube.com/watch?v=YOfpn02C548)
* [Classified Maker - How to edit Ads](https://www.youtube.com/watch?v=MzMovseYVcM)


<strong>Plugin Features</strong>

* schema.org support.
* Ads archive page with pagination support via short-codes.
* Ads single page.
* Extensible supported setting page by filter hook.
* reCAPTCHA for ads submission form.
* Extensible supported ads meta input by filter hook.
* Front-End ads submission form via short-codes.
* Front-End ads edit form via short-codes.




<strong>Archive Page Features</strong>

* Query ads by URL parameter, (`http://www.pickplugins.com/demo/classified-maker/?location=Dhaka&listing_for=sell`).
* Display ads by query keywords, (`http://www.pickplugins.com/demo/classified-maker/?keywords=Lorem%20Ipsum`).
* Display ads by meta query location, (`http://www.pickplugins.com/demo/classified-maker/?location=Dhaka`).
* Display ads by meta query featured ads, (`http://www.pickplugins.com/demo/classified-maker/?featured=yes`).
* Display ads by meta query owner type, (`http://www.pickplugins.com/demo/classified-maker/?owner_type=personal`).
* Display ads by meta query listing for, (`http://www.pickplugins.com/demo/classified-maker/?listing_for=sell`).
* Display ads by meta query price, (`http://www.pickplugins.com/demo/classified-maker/?price=50`).
* Display ads by meta query price range, (`http://www.pickplugins.com/demo/classified-maker/?price_range=20%7C100`).
* Display ads by query publish date, (`http://www.pickplugins.com/demo/classified-maker/?date=05-05-2016`).
* Display ads by query publish date range, (`http://www.pickplugins.com/demo/classified-maker/?date_range=03-05-2016%7C06-05-2016`).
* Display ads by query category slug, (`http://www.pickplugins.com/demo/classified-maker/?category=clothing`).
* Featured ads marker background color.


<strong>Ads list page</strong>

Use this short-code `[classified_maker_archive]` to display list of ads with pagination.


<strong>Ads submission page</strong>

Use this short-code `[classified_maker_post_ads]` to display ads submission form.


<strong>Ads Edit page</strong>

Use this short-code `[classified_maker_edit_ads]` to display Edit ads form.


<strong>My Account page</strong>

Use this short-code `[classified_maker_dashboard]` to display Account page.




<strong>Translation</strong>

Pluign is transaltion ready , please find the 'en.po' for default transaltion file under 'languages' folder and add your own translation. you can also contribute in translation, please contact us http://www.pickplugins.com/contact/

* [Nur Hasan - Bengali ](http://www.pickplugins.com)



== Frequently Asked Questions ==

= Single ads page showing 404 error , how to solve ? =

Pelase go "Settings > Permalink Settings" and save again to reset permalink.


= Single ads page style broken, what should i do ? =

Please add follwoing action on your theme fucntions.php file , you need to edit container based on your theme
`
add_action('classified_maker_action_before_single_ads', 'classified_maker_action_before_single_ads', 10);
add_action('classified_maker_action_after_single_ads', 'classified_maker_action_after_single_ads', 10);

function classified_maker_action_before_single_ads() {
  echo '<div id="main" class="site-main">';
}

function classified_maker_action_after_single_ads() {
  echo '</div>';
}

`




== Installation ==

1. Install as regular WordPress plugin.<br />
2. Go your plugin setting via WordPress Dashboard and find "<strong>Classified Maker</strong>" activate it.<br />


== Screenshots ==

1. Screenshot 1
2. Screenshot 2
3. Screenshot 3
4. Screenshot 4
5. Screenshot 5
6. Screenshot 6
7. Screenshot 7
8. Screenshot 8
9. Screenshot 9
10. Screenshot 10



== Changelog ==


= 1.0.18 =
* 19/09/2017 add - added some widgets.

= 1.0.16 =
* 19/09/2017 fix - CSS conflict on settings page.
* 19/09/2017 fix - empty ads id on ads edit page.

= 1.0.15 =
* 20/04/2017 add - minor php issue fixed.

= 1.0.14 =
* 04/04/2017 add - admin meta input.
* 03/02/2017 removed - removed account page from settigns.
* 03/02/2017 add - added dashboard page settigns.
* 03/02/2017 add - added new [classified_maker_dashboard].


= 1.0.13 =
* 15/11/2016 add - owner type on archive.

= 1.0.12 =
* 29/09/2016 add - phone number fields for ads.

= 1.0.11 =
* 11/09/2016 add - addons menu added.

= 1.0.10 =
* 11/09/2016 add - create demo ads category on plugin activation.

= 1.0.9 =
* 24/08/2016 add - email templte for edit/update ads.

= 1.0.8 =
* 01/08/2016 fix - some minor php issue fixed.

= 1.0.7 =
* 01/08/2016 fix - ads can be submitted main category.
* 01/08/2016 add - Bengali translation added.	

= 1.0.6 =
* 19/07/2016 fix - editor text fromating issue fixed.

= 1.0.5 =
* 19/06/2016 fix - minor php issue fixed.

= 1.0.4 =
* 24/05/2016 improve - ads subission form image input improved.
* 24/05/2016 add - Featured image for ads.	

= 1.0.3 =
* 06/05/2016 add - Empty input fields check validation.

= 1.0.2 =
* 06/05/2016 add - Email templates added.

= 1.0.1 =
* 06/05/2016 add - added meta query to archive shortcode.
* 06/05/2016 add - added query parameter via url for archive shortcode.
* 06/05/2016 fix - minor bug fixed on front end edit ads shortcode.		

= 1.0.0 =
* 28/04/2016 Initial release.
