<?php

/**
 *
 * @link              #
 * @since              1.0.0
 * @package           Materialize_accordions
 *
 * @wordpress-plugin
 * Plugin Name:       Materialize Accordions Pro
 * Plugin URI:        https://criticalwebsolutions.com
 * Description:       The premium version of Materialize Accordions
 * Version:           1.1.8
 * Author:            Critical Web Solutions
 * Author URI:        https://criticalwebsolutions.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       materialize_accordions
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'MATERIALIZE_ACCORDIONS_VERSION_PRO', '1.1.8' );




add_action( 'plugins_loaded', 'require_materialize_accordions_pro', 1 );

function require_materialize_accordions_pro() {



  if( ! class_exists( 'Smashing_Updater' ) ){
    include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
  }

  $updater = new Smashing_Updater( __FILE__ );
  $updater->set_username( 'MarvelMoe' );
  $updater->set_repository( 'materialize-accordions-premium-version' );
  $updater->authorize( 'fbb86a15bd019dd67b589e0b9437c936e3811177' );  
  $updater->initialize();



  /**
   * The code that runs during plugin activation.
   * This action is documented in includes/materialize_accordions-activator.php
   */
  function activate_materialize_accordions_pro() {
  	require_once plugin_dir_path( __FILE__ ) . 'includes/materialize_accordions-activator.php';
  	Materialize_accordions_Activator_pro::activate();
  }




  /**
   * The code that runs during plugin deactivation.
   * This action is documented in includes/materialize_accordions-deactivator.php
   */
  function deactivate_materialize_accordions_pro() {
  	require_once plugin_dir_path( __FILE__ ) . 'includes/materialize_accordions-deactivator.php';
  	Materialize_accordions_Deactivator_pro::deactivate();
  }




  register_activation_hook( __FILE__, 'activate_materialize_accordions_pro' );
  register_deactivation_hook( __FILE__, 'deactivate_materialize_accordions_pro' );


 


  /**
   * The core plugin class that is used to define internationalization,
   * admin-specific hooks, and public-facing site hooks.
   */
  require plugin_dir_path( __FILE__ ) . 'includes/materialize_accordions.php';



   

  /**
   * Begins execution of the plugin.
   *
   * Since everything within the plugin is registered via hooks,
   * then kicking off the plugin from this point in the file does
   * not affect the page life cycle.
   *
   * @since    1.0.0
   */
  function run_materialize_accordions_pro() {

  	$plugin = new Materialize_accordions_pro();
  	$plugin->run();

  }

  run_materialize_accordions_pro();

}