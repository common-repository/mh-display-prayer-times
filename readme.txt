=== MH Dispaly Prayer Times widget===
Contributors: Muhammad Haider.
Donate link: https://www.paypal.com/us/cgi-bin/webscr?cmd=_flow&SESSION=rxBS7lh34ENcr3WlhpB9yjhW3vM2fb50BfeRyJJAqvnKn9yw1geNuWafK6i&dispatch=5885d80a13c0db1f8e263663d3faee8dcbcd55a50598f04d927139403713ca13
Tags: widget, Islam, Salaat, Namaaz, Prayer, Times
Requires at least: 3.1
Tested up to: 3.3
Stable tag: 3.3

== Description ==

This is a Simple widget that creates following tables if they don't already exist and loads sample data into 

1) Daily Prayer Table

	$wpdb->prefix . mh_dpt_daily_times 

   Structure of Table:


    month int(2) NOT NULL, //values are 01,02...12
    day int(2) NOT NULL, //values are 1...31
    name varchar(10) NOT NULL, //values are Fajr, Dhuhur, Asr, Maghrib, Ishaa
    hour varchar(2) NOT NULL DEFAULT '0', //values are 01,02..12
    minutes varchar(2) NOT NULL DEFAULT '00', //values are 01..59
    ampm varchar(2) NOT NULL, //values are AM or PM
    disp_order decimal(1,0) NOT NULL, // 1..5 used for ordering values while displaying in html table.
    PRIMARY KEY (month,day,name)

1) Daily Prayer Table

	$wpdb->prefix . mh_dpt_friday_times 

   Structure of Table:

            name varchar(10) NOT NULL,
            hour varchar(2) NOT NULL DEFAULT '0',
            minutes varchar(2) NOT NULL DEFAULT '00',
            ampm varchar(2) NOT NULL,
            PRIMARY KEY (name)


== Installation ==

= Install =

1. Unzip the `mh_display_prayer_times.zip` file. 
2. Upload the the `mh_display_prayer_times` folder (not just the files in it!) to your `wp-contents/plugins` folder. If you're using FTP, use 'binary' mode.

= Activate =

1. In your WordPress administration, go to the Plugins page
2. Activate the MH Display Prayer Times Widget plugin
3. Go to the Appearance > Widget page and place the widget in your sidebar in the Design
4. Set the following values
  i) Title: Prayer Times (Default value)
 ii) Prayer/Iqama Heading BgColor: #000000 (Default value of background color for Prayer  Iqamatimes table heading.
iii) Prayer/Iqama Heading Text color: #FFFFFF (Default value of Text color for heading)
iv) Prayer Rows Alternate BgColor1: #FFFFFF (Default value of html table odd rows)
iv) Prayer Rows Alternate BgColor2: #FFFFFF (Default value of html table even rows)

Please visit the forum for questions or comments: http://wordpress.org/tags/mh_display_prayer_times/

= Requirements =

* PHP 5.1 or above
* WordPress 3.0 or above

== Screenshots ==

1. MH Dispaly Prayer Times Widget settings screen.
2. Plugins screen.
3. MH Dispaly Prayer Times Widget on the front of a plain Wordpress install.

== Frequently Asked Questions ==

= Where do I go to file a bug or ask a question? =

Please visit the forum for questions or comments: http://wordpress.org/tags/mh_display_prayer_times/