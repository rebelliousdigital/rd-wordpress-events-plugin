# Rebellious Digital Events

**Plugin Name:** Rebellious Digital Events  
**Plugin URI:** [https://rebelliousdigital.co.uk](https://rebelliousdigital.co.uk)  
**Description:** A simple and user-friendly plugin for displaying events on your WordPress site. Ideal for businesses, organisations, or individuals looking to showcase their events in a visually appealing manner. Easily manage and display event information, including start and end dates and shortcode support.

**Version:** 1.0  
**Author:** Rebellious Digital  
**Author URI:** [https://rebelliousdigital.co.uk](https://rebelliousdigital.co.uk)  
**License:** GPL-2.0+  
**License URI:** [http://www.gnu.org/licenses/gpl-2.0.html](http://www.gnu.org/licenses/gpl-2.0.html)

## Description

A simple and user-friendly plugin for displaying events on your WordPress site. Ideal for businesses, organisations, or individuals looking to showcase their events in a visually appealing manner. Easily manage and display event information, including start and end dates and shortcode support.


### Key Features

- **Event Management:** Create and manage events with start and end date fields.
- **Shortcode Support:** Use the `[rd-events]` shortcode to display a list of upcoming events anywhere on your site.
 - **Shortcode Support:** Use the `[rd-past-events]` shortcode to display a list of past events anywhere on your site.
- **Custom Templates:** Display events using the `rd-events-card` template, which you can customize to fit your theme’s design.
- **Date Formatting:** Automatically format event dates for clear and user-friendly display.
- **User Interface:** Add event details using a simple meta box interface in the WordPress admin panel.

## Installation

1. Upload the `rebellious-digital-events` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use the `[rd-events]` shortcode to display the latest events on any page or post.

## Usage

To display the latest events, simply add the `[rd-events]` shortcode to any page or post where you want the events to appear. Customize the display by editing the `rd-events-card.php` template located in the `templates` directory of the plugin.

## Frequently Asked Questions

**Q: How do I customize the appearance of the event cards?**  
A: You can customize the appearance of event cards by editing the `rd-events-card.php` template file located in the `templates` directory of the plugin.

**Q: Can I change the format of the event dates?**  
A: Yes, you can modify the date format in the `event_card` method of the `RebelliousDigitalEvents` class to suit your needs.

**Q: How do I add more fields to the event post type?**  
A: To add more fields, you can extend the `RebelliousDigitalEventsMeta` class or modify the `rd-post-type.php` file to include additional custom fields.

## Changelog

**1.0**  
- Initial release with basic event management and display functionality.

## Upgrade Notice

**1.0**  
This is the initial release. Please report any bugs or issues you encounter on the [plugin support page](https://rebelliousdigital.co.uk).
