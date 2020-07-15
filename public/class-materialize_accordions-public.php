<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Materialize_accordions
 * @subpackage Materialize_accordions/public
 * @author     Moe Himed <#>
 */
class Materialize_accordions_Public_pro {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('init', array($this, 'material_creation') );



	}

	/**
	 * Setup the Materialize Accordion Creation
	 *
	 * @since    1.0.0
	 */


 	 
	function material_creation() {


		 function material_creation_func_pro( $atts ) {

			global $post;
			//echo "<pre>";
			//print_r($atts);
			//  Check for and then RETRIEVE POST ID ATTRIBUTE
				if(!isset( $atts['id'])) 
				 {
					$MA_ID = "";
				 } 
				else 
				{
					$MA_ID =  $atts['id'];
				}


				
			    $accordion_args = array( 'p' => $MA_ID, 'post_type' => 'material_accordion');
			    $html_out ='<div class="materialize-wrapper">';


			    $loop = new WP_Query( $accordion_args );			
				while ( $loop->have_posts() ) : $loop->the_post();

	 		
				 $total_all_data_value = get_post_meta( get_the_ID(), '_total_all_data_value', true );
				 $post_title = get_the_title();
					//echo "<pre>";
					//print_r($post);
					$html_out .= '<div class="post-wrap" >';

					 // "Hide or show the section title" 
					if (get_post_meta( get_the_ID(), 'hide_section_title', true) == '1')  {
						     $html_out .=  "";  
					}
					else {
						     $html_out .=  '<h3 class="section-title">'. $post_title .'</h3>';
					}				  
			 
					 // "Show or hide the open/close all links" 
			 	  	 if (get_post_meta( get_the_ID(), 'show_hide_links', true) !== '1') {
 						 $show_hide_clr = ( isset(  get_post_custom( $MA_ID )['_show_hide_clr'][0] ) ) ?  get_post_custom( $MA_ID )['_show_hide_clr'][0] : '';
 						 $show_hide_font_clr = ( isset(  get_post_custom( $MA_ID )['_show_hide_font_clr'][0] ) ) ?  get_post_custom( $MA_ID )['_show_hide_font_clr'][0] : '';
 						  $show_hide_pos = ( isset(  get_post_custom( $MA_ID )['show_hide_pos'][0] ) ) ?  get_post_custom( $MA_ID )['show_hide_pos'][0] : '';
 

					     $html_out .=  '<div class="btn-container" style="text-align: ' . $show_hide_pos . ' ">
								     	<button class="btn bk-bkg-text open-button" type="button" style="background: ' . $show_hide_clr . '; color: ' . $show_hide_font_clr . ' "> Show All</button>
									    <button class="btn bk-bkg-text close-button" type="button" style="background: ' . $show_hide_clr . '; color: ' . $show_hide_font_clr . ' "> Hide All</button>
						   				</div>'; 

					}
			


							$custom = get_post_custom( $MA_ID );
					 		$title_bg_clr = ( isset( $custom['_title_bg_clr'][0] ) ) ? $custom['_title_bg_clr'][0] : '';
					 		$desc_bg_clr = ( isset( $custom['_desc_bg_clr'][0] ) ) ? $custom['_desc_bg_clr'][0] : '';
					 		$title_font_clr = ( isset( $custom['_title_font_clr'][0] ) ) ? $custom['_title_font_clr'][0] : '';
					 		$desc_font_clr = ( isset( $custom['_desc_font_clr'][0] ) ) ? $custom['_desc_font_clr'][0] : '';
					 		$icon_font_clr = ( isset( $custom['_icon_font_clr'][0] ) ) ? $custom['_icon_font_clr'][0] : '';
					 		$my_icon = ( isset( $custom['my_icon'][0] ) ) ? $custom['my_icon'][0] : '';
					 		$hide_icons = ( isset( $custom['hide_icon_checkbox'][0] ) ) ? $custom['hide_icon_checkbox'][0] : '';

					 		$font_family = ( isset( $custom['font_family'][0] ) ) ? $custom['font_family'][0] : '';
					 		$font_animation = ( isset( $custom['font_animation'][0] ) ) ? $custom['font_animation'][0] : '';
					 		$title_size = ( isset( $custom['title_size'][0] ) ) ? $custom['title_size'][0] : '';
					 		$title_border = ( isset( $custom['title_border'][0] ) ) ? $custom['title_border'][0] : '';
					 		$desc_size = ( isset( $custom['desc_size'][0] ) ) ? $custom['desc_size'][0] : '';
					 		$desc_border = ( isset( $custom['desc_border'][0] ) ) ? $custom['desc_border'][0] : '';
					 		$slower_tabs = ( isset( $custom['slower_tabs'][0] ) ) ? $custom['slower_tabs'][0] : '';

	 	 			 

						 for ($i = 0; $i <= $total_all_data_value; $i++) {

					 		$html_out .= '<ul class="collapsible expandable" data-collapsible="expandable">'; 

			 	 			// Show or hide icons
			 	 			if (get_post_meta( get_the_ID(), 'hide_icon_checkbox', true) == '1') {
			 	 				$hide_icons = "none"; 
			 	 			}
			 	 			else {
			 	 				$hide_icons = "block"; 
			 	 			}

			 	 			// For Adding the Class to Slow Down the Tabs
			 	 			if (get_post_meta( get_the_ID(), 'slower_tabs', true) == '1') {
			 	 				$slower_tabs = "slow-tabs";
			 	 			}
			 	 			else {
			 	 				$slower_tabs = ""; 
			 	 			}



				 	 			$html_out .= '<li class="single-section">';

	 			 						//  Determine Icon Position
	 			 						 if (get_post_meta( get_the_ID(), 'move_icon_checkbox', true) == '1') {
	 			 						 $html_out .= '<div class="collapsible-head '.$slower_tabs .'" tabindex="0" style="border-radius: '. $title_border .'px !important;background-color: ' . $title_bg_clr . ' !important; font-family:' . $font_family .';">'; 
	 			 						 $html_out .= '<i class="material-icons '.$my_icon.'" style="display:' . $hide_icons . '!important;color: ' . $icon_font_clr . '  " >';
	 			 						 $html_out .= $my_icon;
	 			 						 $html_out .= '</i>';
	 								     $html_out .=  '<div class="title" style="font-size: ' . $title_size . 'px;color: ' . $title_font_clr . ' ">';
	 									 $html_out .=  get_post_meta( get_the_ID(), '_title_meta_key_'.$i.'', true); 
	 									 $html_out .= '</div>';
	 									 $html_out .= '</div>';
	 			 						 }
	 			 						 else { 
	 							 		 $html_out .= '<div class="collapsible-head '.$slower_tabs .' " tabindex="0" style="border-radius: '. $title_border .'px !important ;background-color: ' . $title_bg_clr . ' !important;font-family: ' . $font_family .';">';
	 							 	     $html_out .=  '<div class="title" style="font-size: ' . $title_size . 'px;color: ' . $title_font_clr . ' ">';
	 							 		 $html_out .=  get_post_meta( get_the_ID(), '_title_meta_key_'.$i.'', true); 
	 							 		 $html_out .= '</div>';
	 							 		 $html_out .= '<i class="material-icons '.$my_icon.'"  style="display:' . $hide_icons . '!important;color: ' . $icon_font_clr . '  " >';
	 			 						 $html_out .= $my_icon;
	 			 						 $html_out .= '</i>';
	 							 		 $html_out .= '</div>';
	 			 						 }
	 			 						 // END OF ICON POSITIONING
	 			 						 
	 									 $html_out .= '<div class="collapsible-body" style="background-color: ' . $desc_bg_clr . ';color: ' . $desc_font_clr . ';font-size: ' . $desc_size . 'px; border-radius: ' . $desc_border . 'px; ">';
	 									 $html_out .= '<div class="'. $font_animation .'" style="font-family: ' . $font_family .';">';
	 									 $html_out .=  get_post_meta( get_the_ID(), '_content_editor_meta_key_'.$i.'', true);   
	 									 $html_out .= '</div>';
	 									 $html_out .= '</div>';


							 $html_out .= '</li>';
							 $html_out .= '</ul>';
 
 						 }	
 				

 						endwhile;

		   			 

		   				$html_out .='</div>';
		   				$html_out .='</div>';



				require('partials/materialize_fonts.php');

 				$custom_js =  (isset( $custom['custom_user_js'][0] ) ) ? $custom['custom_user_js'][0] : '';
 				$custom_css =  (isset( $custom['custom_user_css'][0] ) ) ? $custom['custom_user_css'][0] : '';



				?>
						<script>
			            jQuery(document).ready(function(jQuery){
			                <?php echo $custom_js; ?> 

				            })
				        </script>
				        			<style>
				                        <?php echo $custom_css; ?> 
				        	        </style>


				<?php
			 

 		

	   
	   	    return $html_out;


	   		wp_reset_postdata();


 
		}

	    add_shortcode( 'MA_shortcode', 'material_creation_func_pro' );
	}
 


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Materialize_accordions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Materialize_accordions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/materialize.min.css', array(), $this->version, 'all' );


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Materialize_accordions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Materialize_accordions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if( !wp_script_is('materialize.min.js') || !wp_script_is('materialize.js') ) { 
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/materialize-accordions.js', array( 'jquery' ), $this->version, false );
		}
		
 
	}

}