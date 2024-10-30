<?php
/**
 * Plugin Name: MH Display Prayer Times
 * Plugin URI: http://localhost/mh_display_prayer_times
 * Description: A widget for displaying prayer times by reading from database.
 * Version: 1.0
 * Author: Muhammad Haider
 * Author URI: http://localhost
 *
 * This program is distributed in the hope that it will be useful for umma,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

global $mh_dpt_db_version;
$mh_dpt_db_version = "1.0";

register_activation_hook(__FILE__,'mh_dpt_install');
//register_activation_hook(__FILE__,'mh_dpt_load_data');
/**
 * Add function to widgets_init that'll load our widget.
 * @since 1.0
 */
add_action( 'widgets_init', 'mh_dpt_load_widget' );

/**
 * Create tables that are required by the widget, if these tables don't existfunction.
 * @since 1.0
 */
function mh_dpt_install() {
   global $wpdb;
   global $mh_dpt_db_version;
   //
   $table_name = $wpdb->prefix . "mh_dpt_friday_times";
   $sql="SELECT count(*) FROM $table_name";
   $friday_result=$wpdb->get_results($sql);

   //
   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            name varchar(10) NOT NULL,
            hour varchar(2) NOT NULL DEFAULT '0',
            minutes varchar(2) NOT NULL DEFAULT '00',
            ampm varchar(2) NOT NULL,
            PRIMARY KEY (name)
    );";
   //
   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
   //
   $table_name = $wpdb->prefix . "mh_dpt_daily_times";
   $sql="SELECT count(*) FROM $table_name";
   $daily_result=$wpdb->get_results($sql);
   //
   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            month int(2) NOT NULL,
            day int(2) NOT NULL,
            name varchar(10) NOT NULL,
            hour varchar(2) NOT NULL DEFAULT '0',
            minutes varchar(2) NOT NULL DEFAULT '00',
            ampm varchar(2) NOT NULL,
            disp_order decimal(1,0) NOT NULL,
            PRIMARY KEY (month,day,name)
    );";
   //
   dbDelta($sql);
   if (!$friday_result && !$dail_result)
   {
      mh_dpt_load_data();
   }

   //
   add_option("mh_dpt_db_version", $mh_dpt_db_version);
}

/**
 * Create tables that are required by the widget, if these tables don't existfunction.
 * @since 1.0
 */

function mh_dpt_load_data() {
   global $wpdb;
   $welcome_name = "Dear Friend";
   $welcome_text = "Congratulations, you just completed the installation of [MH Prayer Times] widget!";

   //load mh_dpt_friday_times
   $table_name = $wpdb->prefix . "mh_dpt_friday_times";
   $rows_affected = $wpdb->insert( $table_name, array( 'name' => 'Khutbah', 'hour' => '1', 'minutes' => '00', 'ampm' => 'PM') );
   $rows_affected = $wpdb->insert( $table_name, array( 'name' => 'Prayer', 'hour' => '1', 'minutes' => '30', 'ampm' => 'PM') );
   //
   $now = date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 3600 );
   $month = date( 'm');
   $nextmonth=$month+1;
   $day = date('d');

   //load mh_dpt_daily_times
   $table_name = $wpdb->prefix . "mh_dpt_daily_times";
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'8','name'=>'Fajr','hour'=>'4','minutes'=>'09','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'7','name'=>'Fajr','hour'=>'4','minutes'=>'10','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'6','name'=>'Fajr','hour'=>'4','minutes'=>'12','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'5','name'=>'Fajr','hour'=>'4','minutes'=>'14','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'4','name'=>'Fajr','hour'=>'4','minutes'=>'16','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'3','name'=>'Fajr','hour'=>'4','minutes'=>'17','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'2','name'=>'Fajr','hour'=>'4','minutes'=>'19','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'1','name'=>'Fajr','hour'=>'4','minutes'=>'21','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'10','name'=>'Fajr','hour'=>'4','minutes'=>'05','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'11','name'=>'Fajr','hour'=>'4','minutes'=>'04','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'12','name'=>'Fajr','hour'=>'4','minutes'=>'02','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'13','name'=>'Fajr','hour'=>'4','minutes'=>'01','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'14','name'=>'Fajr','hour'=>'3','minutes'=>'59','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'15','name'=>'Fajr','hour'=>'3','minutes'=>'58','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'16','name'=>'Fajr','hour'=>'3','minutes'=>'56','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'17','name'=>'Fajr','hour'=>'3','minutes'=>'55','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'18','name'=>'Fajr','hour'=>'3','minutes'=>'53','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'19','name'=>'Fajr','hour'=>'3','minutes'=>'52','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'20','name'=>'Fajr','hour'=>'3','minutes'=>'51','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'21','name'=>'Fajr','hour'=>'3','minutes'=>'49','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'22','name'=>'Fajr','hour'=>'3','minutes'=>'48','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'23','name'=>'Fajr','hour'=>'3','minutes'=>'47','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'24','name'=>'Fajr','hour'=>'3','minutes'=>'46','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'25','name'=>'Fajr','hour'=>'3','minutes'=>'44','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'26','name'=>'Fajr','hour'=>'3','minutes'=>'43','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'27','name'=>'Fajr','hour'=>'3','minutes'=>'42','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'28','name'=>'Fajr','hour'=>'3','minutes'=>'41','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'29','name'=>'Fajr','hour'=>'3','minutes'=>'40','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'30','name'=>'Fajr','hour'=>'3','minutes'=>'39','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'31','name'=>'Fajr','hour'=>'3','minutes'=>'38','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'1','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'2','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'3','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'4','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'5','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'6','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'7','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'8','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'9','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'10','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'11','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'12','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'13','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'14','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'15','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'16','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'17','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'18','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'19','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'20','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'21','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'22','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'23','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'24','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'25','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'26','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'27','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'28','name'=>'Dhuhur','hour'=>'12','minutes'=>'52','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'29','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'30','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'31','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'1','name'=>'Asr','hour'=>'4','minutes'=>'46','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'2','name'=>'Asr','hour'=>'4','minutes'=>'46','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'3','name'=>'Asr','hour'=>'4','minutes'=>'47','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'4','name'=>'Asr','hour'=>'4','minutes'=>'47','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'5','name'=>'Asr','hour'=>'4','minutes'=>'47','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'6','name'=>'Asr','hour'=>'4','minutes'=>'48','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'7','name'=>'Asr','hour'=>'4','minutes'=>'48','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'8','name'=>'Asr','hour'=>'4','minutes'=>'48','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'9','name'=>'Asr','hour'=>'4','minutes'=>'49','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'10','name'=>'Asr','hour'=>'4','minutes'=>'49','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'11','name'=>'Asr','hour'=>'4','minutes'=>'49','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'12','name'=>'Asr','hour'=>'4','minutes'=>'50','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'13','name'=>'Asr','hour'=>'4','minutes'=>'50','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'14','name'=>'Asr','hour'=>'4','minutes'=>'50','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'15','name'=>'Asr','hour'=>'4','minutes'=>'51','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'16','name'=>'Asr','hour'=>'4','minutes'=>'51','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'17','name'=>'Asr','hour'=>'4','minutes'=>'51','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'18','name'=>'Asr','hour'=>'4','minutes'=>'52','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'19','name'=>'Asr','hour'=>'4','minutes'=>'52','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'20','name'=>'Asr','hour'=>'4','minutes'=>'52','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'21','name'=>'Asr','hour'=>'4','minutes'=>'53','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'22','name'=>'Asr','hour'=>'4','minutes'=>'53','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'23','name'=>'Asr','hour'=>'4','minutes'=>'53','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'24','name'=>'Asr','hour'=>'4','minutes'=>'54','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'25','name'=>'Asr','hour'=>'4','minutes'=>'54','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'26','name'=>'Asr','hour'=>'4','minutes'=>'54','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'27','name'=>'Asr','hour'=>'4','minutes'=>'55','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'28','name'=>'Asr','hour'=>'4','minutes'=>'55','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'29','name'=>'Asr','hour'=>'4','minutes'=>'55','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'30','name'=>'Asr','hour'=>'4','minutes'=>'55','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'31','name'=>'Asr','hour'=>'4','minutes'=>'56','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'1','name'=>'Maghrib','hour'=>'7','minutes'=>'56','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'2','name'=>'Maghrib','hour'=>'7','minutes'=>'57','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'3','name'=>'Maghrib','hour'=>'7','minutes'=>'58','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'4','name'=>'Maghrib','hour'=>'7','minutes'=>'59','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'5','name'=>'Maghrib','hour'=>'8','minutes'=>'00','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'6','name'=>'Maghrib','hour'=>'8','minutes'=>'01','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'7','name'=>'Maghrib','hour'=>'8','minutes'=>'02','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'8','name'=>'Maghrib','hour'=>'8','minutes'=>'03','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'9','name'=>'Maghrib','hour'=>'8','minutes'=>'04','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'10','name'=>'Maghrib','hour'=>'8','minutes'=>'06','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'11','name'=>'Maghrib','hour'=>'8','minutes'=>'07','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'12','name'=>'Maghrib','hour'=>'8','minutes'=>'08','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'13','name'=>'Maghrib','hour'=>'8','minutes'=>'09','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'14','name'=>'Maghrib','hour'=>'8','minutes'=>'10','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'15','name'=>'Maghrib','hour'=>'8','minutes'=>'11','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'16','name'=>'Maghrib','hour'=>'8','minutes'=>'12','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'17','name'=>'Maghrib','hour'=>'8','minutes'=>'13','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'18','name'=>'Maghrib','hour'=>'8','minutes'=>'14','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'19','name'=>'Maghrib','hour'=>'8','minutes'=>'15','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'20','name'=>'Maghrib','hour'=>'8','minutes'=>'16','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'21','name'=>'Maghrib','hour'=>'8','minutes'=>'17','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'22','name'=>'Maghrib','hour'=>'8','minutes'=>'18','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'23','name'=>'Maghrib','hour'=>'8','minutes'=>'19','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'24','name'=>'Maghrib','hour'=>'8','minutes'=>'20','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'25','name'=>'Maghrib','hour'=>'8','minutes'=>'21','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'26','name'=>'Maghrib','hour'=>'8','minutes'=>'22','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'27','name'=>'Maghrib','hour'=>'8','minutes'=>'22','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'28','name'=>'Maghrib','hour'=>'8','minutes'=>'23','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'29','name'=>'Maghrib','hour'=>'8','minutes'=>'24','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'30','name'=>'Maghrib','hour'=>'8','minutes'=>'25','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'31','name'=>'Maghrib','hour'=>'8','minutes'=>'26','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'1','name'=>'Ishaa','hour'=>'9','minutes'=>'25','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'2','name'=>'Ishaa','hour'=>'9','minutes'=>'26','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'3','name'=>'Ishaa','hour'=>'9','minutes'=>'28','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'4','name'=>'Ishaa','hour'=>'9','minutes'=>'30','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'5','name'=>'Ishaa','hour'=>'9','minutes'=>'31','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'6','name'=>'Ishaa','hour'=>'9','minutes'=>'33','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'7','name'=>'Ishaa','hour'=>'9','minutes'=>'34','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'8','name'=>'Ishaa','hour'=>'9','minutes'=>'36','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'9','name'=>'Ishaa','hour'=>'9','minutes'=>'37','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'10','name'=>'Ishaa','hour'=>'9','minutes'=>'39','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'11','name'=>'Ishaa','hour'=>'9','minutes'=>'40','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'12','name'=>'Ishaa','hour'=>'9','minutes'=>'42','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'13','name'=>'Ishaa','hour'=>'9','minutes'=>'43','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'14','name'=>'Ishaa','hour'=>'9','minutes'=>'45','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'15','name'=>'Ishaa','hour'=>'9','minutes'=>'46','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'16','name'=>'Ishaa','hour'=>'9','minutes'=>'48','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'17','name'=>'Ishaa','hour'=>'9','minutes'=>'49','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'18','name'=>'Ishaa','hour'=>'9','minutes'=>'51','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'19','name'=>'Ishaa','hour'=>'9','minutes'=>'52','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'20','name'=>'Ishaa','hour'=>'9','minutes'=>'54','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'21','name'=>'Ishaa','hour'=>'9','minutes'=>'55','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'22','name'=>'Ishaa','hour'=>'9','minutes'=>'57','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'23','name'=>'Ishaa','hour'=>'9','minutes'=>'58','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'24','name'=>'Ishaa','hour'=>'9','minutes'=>'59','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'25','name'=>'Ishaa','hour'=>'10','minutes'=>'01','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'26','name'=>'Ishaa','hour'=>'10','minutes'=>'02','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'27','name'=>'Ishaa','hour'=>'10','minutes'=>'03','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'28','name'=>'Ishaa','hour'=>'10','minutes'=>'05','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'29','name'=>'Ishaa','hour'=>'10','minutes'=>'06','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'30','name'=>'Ishaa','hour'=>'10','minutes'=>'07','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $month,'day'=>'31','name'=>'Ishaa','hour'=>'10','minutes'=>'08','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'1','name'=>'Fajr','hour'=>'3','minutes'=>'37','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'2','name'=>'Fajr','hour'=>'3','minutes'=>'36','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'3','name'=>'Fajr','hour'=>'3','minutes'=>'36','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'4','name'=>'Fajr','hour'=>'3','minutes'=>'35','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'5','name'=>'Fajr','hour'=>'3','minutes'=>'34','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'6','name'=>'Fajr','hour'=>'3','minutes'=>'34','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'7','name'=>'Fajr','hour'=>'3','minutes'=>'33','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'8','name'=>'Fajr','hour'=>'3','minutes'=>'32','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'9','name'=>'Fajr','hour'=>'3','minutes'=>'32','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'10','name'=>'Fajr','hour'=>'3','minutes'=>'31','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'11','name'=>'Fajr','hour'=>'3','minutes'=>'31','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'12','name'=>'Fajr','hour'=>'3','minutes'=>'31','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'13','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'14','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'15','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'16','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'17','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'18','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'19','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'20','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'21','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'22','name'=>'Fajr','hour'=>'3','minutes'=>'30','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'23','name'=>'Fajr','hour'=>'3','minutes'=>'31','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'24','name'=>'Fajr','hour'=>'3','minutes'=>'31','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'25','name'=>'Fajr','hour'=>'4','minutes'=>'31','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'26','name'=>'Fajr','hour'=>'4','minutes'=>'32','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'27','name'=>'Fajr','hour'=>'4','minutes'=>'32','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'28','name'=>'Fajr','hour'=>'4','minutes'=>'33','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'29','name'=>'Fajr','hour'=>'4','minutes'=>'33','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'30','name'=>'Fajr','hour'=>'4','minutes'=>'34','ampm'=>'AM','disp_order'=>'1'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'1','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'2','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'3','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'4','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'5','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'6','name'=>'Dhuhur','hour'=>'12','minutes'=>'53','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'7','name'=>'Dhuhur','hour'=>'12','minutes'=>'54','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'8','name'=>'Dhuhur','hour'=>'12','minutes'=>'54','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'9','name'=>'Dhuhur','hour'=>'12','minutes'=>'54','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'10','name'=>'Dhuhur','hour'=>'12','minutes'=>'54','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'11','name'=>'Dhuhur','hour'=>'12','minutes'=>'54','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'12','name'=>'Dhuhur','hour'=>'12','minutes'=>'55','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'13','name'=>'Dhuhur','hour'=>'12','minutes'=>'55','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'14','name'=>'Dhuhur','hour'=>'12','minutes'=>'55','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'15','name'=>'Dhuhur','hour'=>'12','minutes'=>'55','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'16','name'=>'Dhuhur','hour'=>'12','minutes'=>'55','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'17','name'=>'Dhuhur','hour'=>'12','minutes'=>'56','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'18','name'=>'Dhuhur','hour'=>'12','minutes'=>'56','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'19','name'=>'Dhuhur','hour'=>'12','minutes'=>'56','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'20','name'=>'Dhuhur','hour'=>'12','minutes'=>'56','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'21','name'=>'Dhuhur','hour'=>'12','minutes'=>'57','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'22','name'=>'Dhuhur','hour'=>'12','minutes'=>'57','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'23','name'=>'Dhuhur','hour'=>'12','minutes'=>'57','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'24','name'=>'Dhuhur','hour'=>'12','minutes'=>'57','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'25','name'=>'Dhuhur','hour'=>'1','minutes'=>'12','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'26','name'=>'Dhuhur','hour'=>'1','minutes'=>'13','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'27','name'=>'Dhuhur','hour'=>'1','minutes'=>'13','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'28','name'=>'Dhuhur','hour'=>'1','minutes'=>'13','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'29','name'=>'Dhuhur','hour'=>'1','minutes'=>'13','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'30','name'=>'Dhuhur','hour'=>'1','minutes'=>'13','ampm'=>'PM','disp_order'=>'2'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'1','name'=>'Asr','hour'=>'4','minutes'=>'56','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'2','name'=>'Asr','hour'=>'4','minutes'=>'56','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'3','name'=>'Asr','hour'=>'4','minutes'=>'56','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'4','name'=>'Asr','hour'=>'4','minutes'=>'56','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'5','name'=>'Asr','hour'=>'4','minutes'=>'57','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'6','name'=>'Asr','hour'=>'4','minutes'=>'57','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'7','name'=>'Asr','hour'=>'4','minutes'=>'57','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'8','name'=>'Asr','hour'=>'4','minutes'=>'58','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'9','name'=>'Asr','hour'=>'4','minutes'=>'58','ampm'=>'PM','disp_order'=>',3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'10','name'=>'Asr','hour'=>'4','minutes'=>'58','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'11','name'=>'Asr','hour'=>'4','minutes'=>'58','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'12','name'=>'Asr','hour'=>'4','minutes'=>'59','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'13','name'=>'Asr','hour'=>'4','minutes'=>'59','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'14','name'=>'Asr','hour'=>'4','minutes'=>'59','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'15','name'=>'Asr','hour'=>'5','minutes'=>'00','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'16','name'=>'Asr','hour'=>'5','minutes'=>'00','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'17','name'=>'Asr','hour'=>'5','minutes'=>'00','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'18','name'=>'Asr','hour'=>'5','minutes'=>'01','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'19','name'=>'Asr','hour'=>'5','minutes'=>'01','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'20','name'=>'Asr','hour'=>'5','minutes'=>'01','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'21','name'=>'Asr','hour'=>'5','minutes'=>'01','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'22','name'=>'Asr','hour'=>'5','minutes'=>'01','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'23','name'=>'Asr','hour'=>'5','minutes'=>'01','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'24','name'=>'Asr','hour'=>'5','minutes'=>'02','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'25','name'=>'Asr','hour'=>'5','minutes'=>'32','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'26','name'=>'Asr','hour'=>'5','minutes'=>'32','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'27','name'=>'Asr','hour'=>'5','minutes'=>'32','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'28','name'=>'Asr','hour'=>'5','minutes'=>'32','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'29','name'=>'Asr','hour'=>'5','minutes'=>'32','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'30','name'=>'Asr','hour'=>'5','minutes'=>'33','ampm'=>'PM','disp_order'=>'3'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'1','name'=>'Maghrib','hour'=>'8','minutes'=>'26','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'2','name'=>'Maghrib','hour'=>'8','minutes'=>'27','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'3','name'=>'Maghrib','hour'=>'8','minutes'=>'27','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'4','name'=>'Maghrib','hour'=>'8','minutes'=>'28','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'5','name'=>'Maghrib','hour'=>'8','minutes'=>'29','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'6','name'=>'Maghrib','hour'=>'8','minutes'=>'30','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'7','name'=>'Maghrib','hour'=>'8','minutes'=>'30','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'8','name'=>'Maghrib','hour'=>'8','minutes'=>'31','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'9','name'=>'Maghrib','hour'=>'8','minutes'=>'31','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'10','name'=>'Maghrib','hour'=>'8','minutes'=>'32','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'11','name'=>'Maghrib','hour'=>'8','minutes'=>'32','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'12','name'=>'Maghrib','hour'=>'8','minutes'=>'33','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'13','name'=>'Maghrib','hour'=>'8','minutes'=>'33','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'14','name'=>'Maghrib','hour'=>'8','minutes'=>'34','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'15','name'=>'Maghrib','hour'=>'8','minutes'=>'34','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'16','name'=>'Maghrib','hour'=>'8','minutes'=>'35','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'17','name'=>'Maghrib','hour'=>'8','minutes'=>'35','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'18','name'=>'Maghrib','hour'=>'8','minutes'=>'35','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'19','name'=>'Maghrib','hour'=>'8','minutes'=>'36','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'20','name'=>'Maghrib','hour'=>'8','minutes'=>'36','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'21','name'=>'Maghrib','hour'=>'8','minutes'=>'36','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'22','name'=>'Maghrib','hour'=>'8','minutes'=>'36','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'23','name'=>'Maghrib','hour'=>'8','minutes'=>'37','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'24','name'=>'Maghrib','hour'=>'8','minutes'=>'37','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'25','name'=>'Maghrib','hour'=>'8','minutes'=>'37','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'26','name'=>'Maghrib','hour'=>'8','minutes'=>'37','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'27','name'=>'Maghrib','hour'=>'8','minutes'=>'37','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'28','name'=>'Maghrib','hour'=>'8','minutes'=>'37','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'29','name'=>'Maghrib','hour'=>'8','minutes'=>'37','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'30','name'=>'Maghrib','hour'=>'8','minutes'=>'37','ampm'=>'PM','disp_order'=>'4'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'1','name'=>'Ishaa','hour'=>'10','minutes'=>'09','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'2','name'=>'Ishaa','hour'=>'10','minutes'=>'10','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'3','name'=>'Ishaa','hour'=>'10','minutes'=>'11','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'4','name'=>'Ishaa','hour'=>'10','minutes'=>'12','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'5','name'=>'Ishaa','hour'=>'10','minutes'=>'13','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'6','name'=>'Ishaa','hour'=>'10','minutes'=>'14','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'7','name'=>'Ishaa','hour'=>'10','minutes'=>'15','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'8','name'=>'Ishaa','hour'=>'10','minutes'=>'16','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'9','name'=>'Ishaa','hour'=>'10','minutes'=>'17','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'10','name'=>'Ishaa','hour'=>'10','minutes'=>'17','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'11','name'=>'Ishaa','hour'=>'10','minutes'=>'17','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'12','name'=>'Ishaa','hour'=>'10','minutes'=>'18','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'13','name'=>'Ishaa','hour'=>'10','minutes'=>'20','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'14','name'=>'Ishaa','hour'=>'10','minutes'=>'20','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'15','name'=>'Ishaa','hour'=>'10','minutes'=>'21','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'16','name'=>'Ishaa','hour'=>'10','minutes'=>'21','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'17','name'=>'Ishaa','hour'=>'10','minutes'=>'22','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'18','name'=>'Ishaa','hour'=>'10','minutes'=>'22','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'19','name'=>'Ishaa','hour'=>'10','minutes'=>'22','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'20','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'21','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'22','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'23','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'24','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'25','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'26','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'27','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'28','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'29','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));
   $rows_affected = $wpdb->insert( $table_name, array( 'month' => $nextmonth,'day'=>'30','name'=>'Ishaa','hour'=>'10','minutes'=>'23','ampm'=>'PM','disp_order'=>'5'));

}
/**
 * Register our widget.
 * 'MH_Display_Prayer_Times' is the widget class used below.
 *
 * @since 1.0
 */
function mh_dpt_load_widget() {
	register_widget( 'MH_Display_Prayer_Times' );
}

/**
 * MH Display Prayer Times class.
 * This class handles everything that needs to be handled with the widget:
 * the settings.
 *
 * @since 1.0
 */
class MH_Display_Prayer_Times extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function MH_Display_Prayer_Times() {
		/* Widget settings. */
		//$widget_ops = array( 'classname' => 'mh_display_prayer_times_cls', 'description' => __('An widget that displays prayer times by reading from database.', 'mh_display_prayer_times_cls') );
        $widget_ops = array( 'classname' => '', 'description' => __('An widget that displays prayer times by reading from database.', 'mh_display_prayer_times_cls') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'mh_display_prayer_times' );

		/* Create the widget. */
		$this->WP_Widget( 'mh_display_prayer_times', __('MH Display Prayer Times', 'mh_display_prayer_times_cls'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$DIVBG = $instance['DIVBG'];
		$PIHBgc = $instance['PIHBgc'];
		$PIHTc  = $instance['PIHTc'];
		$PRBgc1 = $instance['PRBgc1'];
		$PRBgc2 = $instance['PRBgc2'];
		$PRBT = $instance['PRBT'];
		$BZGRP1 = $instance['BZGRP1'];
        echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/mh-display-prayer-times/css/mh-display-prayer-times.css" />' . "\n";

        /*---*/
        $now = date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 3600 );
        $month = date( 'm');
        $day = date('d');
        /*---*/
        global $wpdb;
        $table_name = $wpdb->prefix . "mh_dpt_daily_times";
        $query = "
        SELECT p.month month, p.day day, p.name name, p.hour hour, p.minutes minutes,
               p.ampm ampm
        FROM $table_name p
        WHERE ( month = '$month' AND day = '$day' )
        ORDER BY p.disp_order"
        ;
        $daily_prayer_rows = $wpdb->get_results($query);
        //
        $table_name = $wpdb->prefix . "mh_dpt_friday_times";
        $query = "
          SELECT name, hour, minutes, ampm
          FROM $table_name
          ORDER BY name"
        ;
        $friday_prayer_rows = $wpdb->get_results($query);

		/* Before widget (defined by themes). */
		echo $before_widget;

        echo '<div id=\'mh_prayer_times\' class=\'mh_display_prayer_times_cls\' style=\'padding: 0px 5px 5px 5px; background-color:'.$DIVBG.'\' >';
        echo '<h3 style=\'color:'.$PIHTc.'\'>' . $title . '</h3>';
        echo ' <table width=\'100%\' style=\'border:'.$PRBT.' '. $BZGRP1.'\'>';
        echo '  <tr width=\'100%\' style=\'background-color:'.$PIHBgc.'; color:'.$PIHTc.'\'>';
        echo '	 <td width=\'30%\'>';
        echo '	  <h2 style=\'background-color:'.$PIHBgc.'; color:'.$PIHTc.'\'><bold>Prayer</bold></h2>';
        echo '	 </td>    ';
        echo '   <td width=\'35%\' style=\'text-align:right\'>';
        echo '	   <h2 style=\'background-color:'.$PIHBgc.'; color:'.$PIHTc.'\'><bold>Iqama Times</bold></h2>';
        echo '	 </td>         ';
        echo '	</tr>          ';
        echo ' </table>        ';
        echo '          <table width=\'100%\' style=\'border:'.$PRBT.' '. $BZGRP1.'\'>';
        $i=0;
        $vBgColor="#FFFFFF";
        foreach ($daily_prayer_rows as $daily_prayer_row) {
        $i=$i+1;
        if ($i%2 == 0){
         $vBgColor=$PRBgc1;
         }
        else{
         $vBgColor=$PRBgc2;
         }
        echo '              <tr width=\'100%\' style=\'background-color:'.$vBgColor.'\'>';
        echo '                <td width=\'30%\' style=\'border:'.$PRBT.' '. $BZGRP1.'\'>';
        echo                   $daily_prayer_row->name;
        echo '                </td>';
        echo '                <td width=\'35%\' style=\'border:'.$PRBT.' '. $BZGRP1.'; text-align:right\'>';
        echo                  $daily_prayer_row->hour.':'.$daily_prayer_row->minutes.' '.$daily_prayer_row->ampm.'.';
        echo '                </td>';
        echo '              </tr>';
        }
        echo '            </table>';
        echo '          <table width=\'100%\' style=\'border:'.$PRBT.' '. $BZGRP1.'\'>';
        echo '              <tr width=\'100%\' style=\'background-color:'.$PIHBgc.'; color:'.$PIHTc.'\'><td colspan=\'2\'><h2 style=\'background-color:'.$PIHBgc.'; text-color:'.$PIHTc.'\'><bold>Friday Prayer</bold></h2></td></tr>';
        $i=0;
        $vBgColor="#FFFFFF";
        foreach ($friday_prayer_rows as $friday_prayer_row) {
        $i=$i+1;
        if ($i%2 == 0){
         $vBgColor=$PRBgc1;
         }
        else{
         $vBgColor=$PRBgc2;
         }
        echo '              <tr width=\'100%\' style=\'background-color:'.$vBgColor.'\'>';
        echo '                <td width=\'30%\' style=\'border:'.$PRBT.' '. $BZGRP1.'\'>';
        echo                   $friday_prayer_row->name;
        echo '                </td>';
        echo '                <td width=\'35%\' style=\'border:'.$PRBT.' '. $BZGRP1.'; text-align:right\'>';
        echo                  $friday_prayer_row->hour.':'.$friday_prayer_row->minutes.' '.$friday_prayer_row->ampm.'.';
        echo '                </td>';
        echo '              </tr>';
        }
        echo '            </table>';
        echo '</div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['PIHBgc'] = strip_tags( $new_instance['PIHBgc'] );
		$instance['PIHTc'] = strip_tags( $new_instance['PIHTc'] );
		$instance['PRBgc1'] = strip_tags( $new_instance['PRBgc1'] );
		$instance['PRBgc2'] = strip_tags( $new_instance['PRBgc2'] );
        $instance['PRBT'] = strip_tags( $new_instance['PRBT'] );
        $instance['BZGRP1'] = strip_tags( $new_instance['BZGRP1'] );
        $instance['DIVBG'] = strip_tags( $new_instance['DIVBG'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Prayer Times', 'mh_display_prayer_times_cls'), 'DIVBG' => '#33CCFF', 'PIHBgc' => __('#000000', 'mh_display_prayer_times_cls'), 'PIHTc' => '#FFFFFF', 'PRBgc1' => '#FFFFFF', 'PRBgc2' => '#B8D5C2', 'PRBT' => 'dotted', 'BZGRP1' => '1px' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Prayer Widget BG Color: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'DIVBG' ); ?>"><?php _e('Widget BgColor:', 'mh_display_prayer_times_cls'); ?></label>
			<input id="<?php echo $this->get_field_id( 'DIVBG' ); ?>" name="<?php echo $this->get_field_name( 'DIVBG' ); ?>" value="<?php echo $instance['DIVBG']; ?>" style="width:100%;" />
		</p>

		<!-- Prayer Heading BG Color: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Prayer/Iqama Heading BgColor:', 'mh_display_prayer_times_cls'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'PIHBgc' ); ?>" value="<?php echo $instance['PIHBgc']; ?>" style="width:100%;" />
		</p>

		<!-- Prayer Heading TextColor: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'PIHTc' ); ?>"><?php _e('Prayer/Iqama Heading Text Color:', 'mh_display_prayer_times_cls'); ?></label>
			<input id="<?php echo $this->get_field_id( 'PIHTc' ); ?>" name="<?php echo $this->get_field_name( 'PIHTc' ); ?>" value="<?php echo $instance['PIHTc']; ?>" style="width:100%;" />
		</p>

		<!-- Prayer Row1 BG Color: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'PRBgc1' ); ?>"><?php _e('Prayer Rows Alternate BgColor1:', 'mh_display_prayer_times_cls'); ?></label>
			<input id="<?php echo $this->get_field_id( 'PRBgc1' ); ?>" name="<?php echo $this->get_field_name( 'PRBgc1' ); ?>" value="<?php echo $instance['PRBgc1']; ?>" style="width:100%;" />
		</p>

		<!-- Prayer Row1 BG Color: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'PRBgc2' ); ?>"><?php _e('Prayer Rows Alternate BgColor2:', 'mh_display_prayer_times_cls'); ?></label>
			<input id="<?php echo $this->get_field_id( 'PRBgc2' ); ?>" name="<?php echo $this->get_field_name( 'PRBgc2' ); ?>" value="<?php echo $instance['PRBgc2']; ?>" style="width:100%;" />
		</p>

		<!-- Prayer Border Style: List Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'PRBT' ); ?>"><?php _e('Border Style:', 'mh_display_prayer_times_cls'); ?></label>
			<select id="<?php echo $this->get_field_id( 'PRBT' ); ?>" name="<?php echo $this->get_field_name( 'PRBT' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'dotted' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>dotted</option>
				<option <?php if ( 'solid' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>solid</option>
				<option <?php if ( 'none' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>none</option>
                <option <?php if ( 'dashed' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>dashed</option>
                <option <?php if ( 'double' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>double</option>
                <option <?php if ( 'groove' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>groove</option>
                <option <?php if ( 'ridge' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>ridge</option>
                <option <?php if ( 'inset' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>inset</option>
                <option <?php if ( 'outset' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>outset</option>
                <option <?php if ( 'inherit' == $instance['PRBT'] ) echo 'selected="selected"'; ?>>inherit</option>
			</select>
		</p>
		<!-- Border Size? Text -->
		<p>
			<label for="<?php echo $this->get_field_id( 'BZGRP1' ); ?>"><?php _e('Border Size:', 'mh_display_prayer_times_cls'); ?></label>
			<input id="<?php echo $this->get_field_id( 'BZGRP1' ); ?>" name="<?php echo $this->get_field_name( 'BZGRP1' ); ?>" value="<?php echo $instance['BZGRP1']; ?>" style="width:10%;" />
		</p>
	<?php
	}
}

?>