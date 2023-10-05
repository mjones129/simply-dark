<?php
/**
* Plugin Name: Simply Dark
* Description: The simplest way to do a dark mode on the wp admin page.
* Author: Matt Jones
* Author URI: https://mattjones.tech
*
 */

 function sd_kill_the_lights() {
    wp_register_style('simply-dark', plugin_dir_url(__FILE__) . 'dark.css', array(), '1.0', 'all');
    wp_enqueue_style('simply-dark');
 }

 add_action('admin_enqueue_scripts', 'sd_kill_the_lights');

