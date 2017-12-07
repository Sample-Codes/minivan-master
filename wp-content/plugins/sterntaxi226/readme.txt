=== Stern taxi fare ===
Contributors: sternwebagency
version: 2.2.6
Donate link: http://www.sternwebagency.com/
Plugin Name: Stern taxi fare
Description: This plugin calculates fare, distance and duration. It uses Woocommerce to pay online. Use [stern-taxi-fare] shortcode to display fare calculator for wordpress
Plugin URI: http://stern-taxi-fare.sternwebagency.com/
Author: Stern taxi fare
Author URI: http://www.sternwebagency.com/
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Contributors: ZoutPeper for Dutch language translation
Tested up to: 4.3.1
Stable tag: 4.3
Requires at least: 3.0.1
Tags: cab, calculator, estimate, fare calculator, google map, map fare calculator, online paiement, rules calculation, taxi fare, taxi fare calculator, VTC, woocommerce

   
== Description ==
Fare calculator is an utility plugin to allow taxi companies to give an option to their customer to calculate taxi fare before taking a ride. Customer can pay online thanks to Woocommerce plugin.
We have several years of expertise in developing auto dispatching taxi system with mobile and web interface. The purpose of this plugin is to assist companies related to taxi business to allow their customers to calculate the ride fare.  Please give us your feedback on any additions you would like to see here. Customer can pay online thanks to Woocommerce plugin.
Please use shortcode [stern-taxi-fare] to display and use the plugin wherever you want in the WordPress environment for WordPress.

Stern taxi fare plugin for Wordpress is very simple and powerful plugin.


Features
check if Woocommerce is installed before activated this plugin
button Show/hide a map in the form
Option in backoffice to show or not map in form
Option in backoffice to show or not map in checkout
Bootstrap validator for the main form
Select country to show on the map
Add manually ApiGoogleKey in back office
choice in admin to empty WooCommerce cart before using taxi form
choose background color in admin
choose in back office how many seats are available
Choose in back office template form to show
select Ajax loader picture
Set a minimum fare in back office
show or hide labels in form
Currency symbol inherits from WooCommerce
Chose to show pickup-time in form or in order woocommerce section
Edit text of the ‘book now’ button in backoffice
Includes Fare per toll
Select Time Format (24hr or 12hr)
Select Unit Systems (Miles or Km)
Nb of seats is linked with type of car
Max suitcases per type of cars
Available in English & french
Fixed price for airport
Rules integration for price, based on address or city
Possibility to set next date available in  the future in hours
 

= Fare Calculation =
From the settings screen in the admin section you can enter settings

== Installation == 
Install woocommerce plugin first!
Copy the plugin in plugin folder and then activate it from the admin side.
After installation please add short code [stern-taxi-fare] on your website page for displaying the fare calculator.

== Upgrade Notice ==
NA

== Changelog ==

= 1.0.3 - 11/19/2015 =
* Improvement - Rules optimization
* language - Rules optimization

= 1.0.3 - 11/16/2015 =

* Language - Add French translation
* Improvement - Overview table background color
* Improvement - Use shipping class of variation to calculate shipping cost
* Fix - Notice on overview table when no shipping cost are filled in
* Add - Filter for the matching values 'was_match_condition_values'

= 1.0.2 - 13/12/2014 =

* Fix - Weight mismatches in rare cases
* Fix - Row actions for shipping methods visibility
* Improvement - Use WC() singleton instead of $woocommerce global
* Improvement - Different loading stucture of files and classes for more control

= 1.0.1 - 02/11/2015 =

* Add - 'Contains shipping class' condition
* Fix - Error on WC check
* Fix - Load textdomains
* Fix - Tax calculation
* Improvement - Remove globals, use WAS() function now
* Improvement - Even better code comments/quality
* Improvement - Add filter 'was_shipping_rate'
* Improvement - Add filter 'was_calculate_shipping_costs'
* Improvement - Remove duplicate 'or' when removing condition group

= 1.0.0 - 30/10/2015 =

* First version
== Screenshots ==
NA

== Frequently Asked Questions ==
NA

