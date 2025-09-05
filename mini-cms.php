<?php

/*
Plugin Name: Mini CMS
Description: A simple mini CMS with Articles & Reviews.
Version: 1.0
Author: Your Name
*/

    if ( ! defined( 'ABSPATH' ) ) exit;

    include_once plugin_dir_path(__FILE__) . 'includes/cpt.php';
    include_once plugin_dir_path(__FILE__) . 'includes/admin-dashboard.php';
    include_once plugin_dir_path(__FILE__) . 'includes/ajax.php';
    include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
    
