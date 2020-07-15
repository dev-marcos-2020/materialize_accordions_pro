<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Materialize_accordions
 * @subpackage Materialize_accordions/admin
 * @author     Moe Himed <#>
 */
 
 
class Materialize_accordions_Admin_pro {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
 
 
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct( $plugin_name, $version) {
 
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box_side' ) );
        add_action('save_post', array( $this, 'save_side_meta') );
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save_metadata' ) );
        add_action('init', array($this, 'material_post_type') );
        add_action( 'manage_edit-material_accordion_columns', array($this, 'material_manage_columns' ), 10, 2 );
        add_action( 'manage_material_accordion_posts_custom_column', array($this, 'material_custom_column' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array($this, 'load_wpadmin_scripts' ) );
		add_action( 'admin_action_material_duplicate_post_as_draft', array($this, 'material_duplicate_post_as_draft') );
		add_filter( 'post_row_actions',array($this, 'material_duplicate_post_link'), 10, 2 );

                  
        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }



 
	  /**
     * Adds the side meta box.
     */
	public function add_meta_box_side( $post_type ) {
    
            add_meta_box(
                'material_settings',
                  'Material Options',
                array( $this, 'add_side_meta_box' ),
                'material_accordion',
                'side',
                'low'
            );
         
    }


    public function add_side_meta_box( $post ) {
 
		wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
		$hide_section_title = get_post_meta( $post->ID, 'hide_section_title', true );
		$show_hide_links = get_post_meta( $post->ID, 'show_hide_links', true );

 		$hide_icon = get_post_meta( $post->ID, 'hide_icon_checkbox', true );
 		$font_family   = (get_post_meta( $post->ID, 'font_family', true )) ? get_post_meta( $post->ID, 'font_family', true ) : '';
 		$my_icon  = (get_post_meta( $post->ID, 'my_icon', true )) ? get_post_meta( $post->ID, 'my_icon', true ) : 'add';
 		$move_icon_checkbox   = (get_post_meta( $post->ID, 'move_icon_checkbox', true )) ? get_post_meta( $post->ID, 'move_icon_checkbox', true ) : '';
 		$font_animation   = (get_post_meta( $post->ID, 'font_animation', true )) ? get_post_meta( $post->ID, 'font_animation', true ) : '';
 		$title_size = (get_post_meta( $post->ID, 'title_size', true )) ? get_post_meta( $post->ID, 'title_size', true ) : '17';
 		$title_border = (get_post_meta( $post->ID, 'title_border', true )) ? get_post_meta( $post->ID, 'title_border', true ) : '5';
 		$desc_size = (get_post_meta( $post->ID, 'desc_size', true )) ? get_post_meta( $post->ID, 'desc_size', true ) : '16';
 		$desc_border = (get_post_meta( $post->ID, 'desc_border', true )) ? get_post_meta( $post->ID, 'desc_border', true ) : '2';
 		$slower_tabs = (get_post_meta( $post->ID, 'slower_tabs', true )) ? get_post_meta( $post->ID, 'slower_tabs', true ) : '';
 		$show_hide_pos = (get_post_meta( $post->ID, 'show_hide_pos', true )) ? get_post_meta( $post->ID, 'show_hide_pos', true ) : 'right';
		$custom = get_post_custom( $post->ID );
 		$title_bg_clr = ( isset( $custom['_title_bg_clr'][0] ) ) ? $custom['_title_bg_clr'][0] : '';
 		$desc_bg_clr = ( isset( $custom['_desc_bg_clr'][0] ) ) ? $custom['_desc_bg_clr'][0] : '';
 		$title_font_clr = ( isset( $custom['_title_font_clr'][0] ) ) ? $custom['_title_font_clr'][0] : '';
 		$desc_font_clr = ( isset( $custom['_desc_font_clr'][0] ) ) ? $custom['_desc_font_clr'][0] : '';
 		$icon_font_clr = ( isset( $custom['_icon_font_clr'][0] ) ) ? $custom['_icon_font_clr'][0] : '';
 		$show_hide_clr = ( isset( $custom['_show_hide_clr'][0] ) ) ? $custom['_show_hide_clr'][0] : '';
 		$show_hide_font_clr = ( isset( $custom['_show_hide_font_clr'][0] ) ) ? $custom['_show_hide_font_clr'][0] : '';

		require('settings.php');

	}


	public function save_side_meta( $post_id ) {


		$nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';
 
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
 
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
 
        // Check if not an autosave or revision
        if ( wp_is_post_autosave( $post_id ) ||   wp_is_post_revision( $post_id ) ) {
            return;
        }
 

	        $values = [ 'hide_section_title', 'show_hide_links', 'hide_icon_checkbox', 'show_hide_pos',
	          'move_icon_checkbox', 'show_hide_pos', 'my_icon', 'font_family', 'title_border',
	          'desc_size','desc_border', 'slower_tabs', 'font_animation'];
	        foreach( $values as $value ) {
	            if (isset($_POST[$value]) )   {
	              update_post_meta( $post_id, $value, sanitize_option($value, $_POST[$value] ) );
	            }
	            else {
	              update_post_meta( $post_id, $value , 0 );
	            }
	         }

		
	         $other_values = ['_title_bg_clr', '_desc_bg_clr','_title_font_clr', '_desc_font_clr','_icon_font_clr', '_show_hide_clr', '_show_hide_font_clr', 'custom_user_js', 'custom_user_css'];
	         foreach ($other_values as $other ) {
	          if ( isset($_POST[$other]) ) {
	         	update_post_meta($post_id, $other, sanitize_text_field($_POST[$other])  );
	          	}
	         }


	}

 
 

    /**
     * Adds the main meta box container.
     */
    public function add_meta_box( $post_type ) {
    
            add_meta_box(
                'material-meta-box',
                  'Materialize Accordion',
                array( $this, 'render_meta_box_content' ),
                'material_accordion',
                'advanced',
                'high'
            );
         
    }
 
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */

    public function save_metadata( $post_id ) {
 	 

         //  If our nonce is set..cool...if not, end script
        if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) ) {
            return $post_id;
        }

        // Add nonce field to a variable
        $nonce = $_POST['myplugin_inner_custom_box_nonce'];

        // Verify that the nonce we created in following function is valid.
        if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) ) {
            return $post_id;
        }

         // If autosave, our form has not been submitted so we don't do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        // Check the user's permissions.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
         }
		


 		$total_all_data_value = $_POST['total_all_data_content'];

 		// Sanitize title and wp_editor areas
		for ($i = 0; $i <= $total_all_data_value; $i++) {
			update_post_meta( $post_id, '_title_meta_key_'.$i, sanitize_text_field($_POST['material_accordion_title'][$i])  );
			update_post_meta( $post_id, '_content_editor_meta_key_'.$i, wp_kses($_POST['material_accordion_field'][$i], 'post') );
		}
		
		$total_all_data_content =  $_POST['total_all_data_content'];

		update_post_meta( $post_id, '_total_all_data_value', $total_all_data_content );
    }
 
 
    /**
     * Render Meta Box content.
     */
    public function render_meta_box_content( $post ) {
 
	        // Add an nonce field that we can check for in save_metadata function
	        wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

	        // For cutom area in admin
	        $custom_js = (get_post_meta( $post->ID, 'custom_user_js', true )) ? get_post_meta( $post->ID, 'custom_user_js', true ) : '';
	        $custom_css = (get_post_meta( $post->ID, 'custom_user_css', true )) ? get_post_meta( $post->ID, 'custom_user_css', true ) : '';
	 
	        // Use get_post_meta to retrieve an existing value from the database.
			$total_all_data_value = get_post_meta( $post->ID, '_total_all_data_value', true );
			if ( empty($total_all_data_value ) ) {
				$total_all_data_value = 0;
			}
	        ?>


			<div class="metabox-wrapper" >

				<div class="advanced-sortables" id="advanced-sortables">
						<?php for ($i = 0; $i <= $total_all_data_value; $i++) {
							$title_contents_data = get_post_meta( $post->ID, '_title_meta_key_'.$i.'', true );
							$editor_value_contents_data = get_post_meta( $post->ID, '_content_editor_meta_key_'.$i.'', true );
						
							
						?>
						<div class="accordion-section"  id="accordion">

							<div class="collapsible-head" tabindex="0">
								<i class="material-icons">add</i>	
		 						<label for="material_accordion_title_<?php echo $i; ?>">
		 						<h2 class="material-labels">ACCORDION TITLE</h2>
		 						</label>
		 						<input type="text" class="material-accordion-title" id="material_accordion_title_<?php echo $i; ?>" name="material_accordion_title[]" value="<?php echo esc_attr( $title_contents_data ); ?>" size="25" />
		 						
							</div>
						
							<div class="accordion-admin-wrap panel-collapse collapsible-body">
								<label for="material_accordion_field_<?php echo $i; ?>">
								<h2 class="material-labels"> ACCORDION DESCRIPTION</h2>
								</label>
								

								<?php
								
								wp_editor( $editor_value_contents_data, 'material_accordion_field_' . $i, 
									$settings = array(
													'tinymce'      
													 => array(
												        'toolbar1'      => 'bold,italic,underline,strikethrough , bullist, numlist,separator, blockquote hr, wp_more, separator, alignleft,aligncenter,alignright,separator,link,unlink,wp_adv',
												        'toolbar2'      => 'formatselect, alignjustify, forecolor, pastetext, removeformat ,charmap , outdent ,indent , undo, redo '				 
												    ),
													'quicktags' => array(
													      'buttons' => 'strong,em,underline,ul,ol,li,link,code'
													  ),
									'textarea_name'=>'material_accordion_field[]') );
								?>
							</div>

							<br>
							 
								
							<a class="content-delete" href="#">Delete Section</a>
				
					</div>

						<?php } ?>
						<input type="hidden" name="total_all_data_content" id="total_all_data_content" class="total_all_data_content" value="<?php echo $total_all_data_value;?>" />		
						
						
				</div>
		 </div>

         <div class="accordion-btn-wrapper">
         	<div class="accordion-btns">
				<a class="accordion-add " id="add_content"> 
    			Add A New Accordion Section
		  		</a>     		 
    		</div>
         </div>


         <div id="tabs">
           <ul>
             <li><a href="#tabs-1">  ADD CUSTOM JAVASCRIPT</a></li>
             <li><a href="#tabs-2">ADD CUSTOM  CSS</a></li>
           </ul>

           <div id="tabs-1">
	          <div class="custom-user-js" style="text-align: center;">
	          	<label for="custom_user_js">
	          	<h2 class="material-labels">  Add Javascript without Script Tags</h2>
	          	</label>                 	 
	               <textarea  rows="10" cols="50"
	 			  name="custom_user_js"  id="custom_user_js" style="margin: 20px"><?php echo esc_attr( $custom_js ); ?></textarea>
	          </div>
           </div>
           <div id="tabs-2">
             <div class="custom-user-css" style="text-align: center;">
              	<label for="custom_user_css">
              	<h2 class="material-labels">  Add CSS without Style Tags</h2>
              	</label>                 	 
                   <textarea  rows="10" cols="50"
     			  name="custom_user_css"  id="custom_user_css" style="margin: 20px"><?php echo esc_attr( $custom_css ); ?></textarea>
              </div>
           </div>
         </div>


 

         <script>
		 jQuery(document).ready(function($) {
		  wp.codeEditor.initialize($('#custom_user_js'), cm_settings);
		})

		 jQuery(document).ready(function($) {
		   wp.codeEditor.initialize($('#custom_user_css'), cm_settings_deux);
		  })

		 jQuery( function() {
		    jQuery( "#tabs" ).tabs();
		  });
         </script>
     

         <div class="admin-shortcode"> 
         	<h4>Your Accordion Shortcode</h4>
         	<input type="text" value="[MA_shortcode id=<?php echo $post->ID ?>] " readonly="readonly" />
         	<p>Copy and paste the above in any page or post to show the accordion</p>
         </div>

      


	<?php

   		require('partials/materialize_sections.php');

    }
 
 

	/****************************************************************************************
	 * Register the custom post type
	 */
	public function material_post_type() {


		$labels = array(
			'name'                  => _x( 'Materialize Accordions', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Materialize Accordion', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Materialize Accordion', 'text_domain' ),
			'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Accordions', 'text_domain' ),
			'add_new_item'          => __( 'Add New Item', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Item', 'text_domain' ),
			'update_item'           => __( 'Update Item', 'text_domain' ),
			'view_item'             => __( 'View Item', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
			'search_items'          => __( 'Search Item', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Accordion', 'text_domain' ),
			'description'           => __( 'Post Type Description', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
	        'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M384 1184v64q0 13-9.5 22.5t-22.5 9.5h-64q-13 0-22.5-9.5t-9.5-22.5v-64q0-13 9.5-22.5t22.5-9.5h64q13 0 22.5 9.5t9.5 22.5zm0-256v64q0 13-9.5 22.5t-22.5 9.5h-64q-13 0-22.5-9.5t-9.5-22.5v-64q0-13 9.5-22.5t22.5-9.5h64q13 0 22.5 9.5t9.5 22.5zm0-256v64q0 13-9.5 22.5t-22.5 9.5h-64q-13 0-22.5-9.5t-9.5-22.5v-64q0-13 9.5-22.5t22.5-9.5h64q13 0 22.5 9.5t9.5 22.5zm1152 512v64q0 13-9.5 22.5t-22.5 9.5h-960q-13 0-22.5-9.5t-9.5-22.5v-64q0-13 9.5-22.5t22.5-9.5h960q13 0 22.5 9.5t9.5 22.5zm0-256v64q0 13-9.5 22.5t-22.5 9.5h-960q-13 0-22.5-9.5t-9.5-22.5v-64q0-13 9.5-22.5t22.5-9.5h960q13 0 22.5 9.5t9.5 22.5zm0-256v64q0 13-9.5 22.5t-22.5 9.5h-960q-13 0-22.5-9.5t-9.5-22.5v-64q0-13 9.5-22.5t22.5-9.5h960q13 0 22.5 9.5t9.5 22.5zm128 704v-832q0-13-9.5-22.5t-22.5-9.5h-1472q-13 0-22.5 9.5t-9.5 22.5v832q0 13 9.5 22.5t22.5 9.5h1472q13 0 22.5-9.5t9.5-22.5zm128-1088v1088q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-1088q0-66 47-113t113-47h1472q66 0 113 47t47 113z"/></svg>'),
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'public' => false,
		);
		register_post_type( 'material_accordion', $args );

	}


  /**
	Update Admin columns
	 */
	public function material_manage_columns( $columns ){
	     $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'The Accordions' ),
            'shortcode' => __( 'The Accordion Shortcode' ),
            'date' => __( 'Date Published' )
        );
        return $columns;
	
	}

	public function material_custom_column( $column, $post_id ) {
	 	global $post;
	 	switch( $column ) {
	 	  case 'shortcode' :
	 	    echo '<input type="text" value="[MA_shortcode id='.$post_id.'] " readonly="readonly" style="width: 31%;" />';
	 	    break;
	 	    case 'footer' :
	 	echo "<script> jQuery( '<p>Test</p>' ).appendTo( '#wpcontent' );</script>";
	 	}

	 }

	/**
	 Load the editor scripts  
	 */
	public function load_wpadmin_scripts() {
		
	    wp_enqueue_editor();
	    
	 }


	public function material_duplicate_post_as_draft() {
		  global $wpdb;
		  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'material_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		    wp_die('No post to duplicate has been supplied!');
		  }
		 
		  /*
		   * Nonce verification
		   */
		  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		    return;
		 
		  /*
		   * get the original post id
		   */
		  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
		  /*
		   * and all the original post data then
		   */
		  $post = get_post( $post_id );
		 
		  /*
		   * if you don't want current user to be the new post author,
		   * then change next couple of lines to this: $new_post_author = $post->post_author;
		   */
		  $current_user = wp_get_current_user();
		  $new_post_author = $current_user->ID;
		 
		  /*
		   * if post data exists, create the post duplicate
		   */
		  if (isset( $post ) && $post != null) {
		 
		    /*
		     * new post data array
		     */
		    $args = array(
		      'post_author'    => $new_post_author,
		      'post_content'   => $post->post_content,
		      'post_name'      => $post->post_name,
		      'post_parent'    => $post->post_parent,
		      'post_status'    => 'draft',
		      'post_title'     => 'Copy of ' .$post->post_title,
		      'post_type'      => $post->post_type,
		      'menu_order'     => $post->menu_order
		    );
		 
		    /*
		     * insert the post by wp_insert_post() function
		     */
		    $new_post_id = wp_insert_post( $args );
		 
		    /*
		     * get all current post terms ad set them to the new post draft
		     */
		    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		    foreach ($taxonomies as $taxonomy) {
		      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
		      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		    }
		 
		    /*
		     * duplicate all post meta just in two SQL queries
		     */
		    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		    if (count($post_meta_infos)!=0) {
		      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
		      foreach ($post_meta_infos as $meta_info) {
		        $meta_key = $meta_info->meta_key;
		        if( $meta_key == '_wp_old_slug' ) continue;
		        $meta_value = addslashes($meta_info->meta_value);
		        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
		      }
		      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
		      $wpdb->query($sql_query);
		    }
		 
		 
		    /*
		     * finally, redirect to the edit post screen for the new draft
		     */
		    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		    exit;
		  } else {
		    wp_die('Post creation failed, could not find original post: ' . $post_id);
		  }

	}
	  


	/*
	 * Add the duplicate link to action list for post_row_actions
	 */
	public function material_duplicate_post_link( $actions, $post ) {
	  if (current_user_can('edit_posts')) {
	    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=material_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	  }
	  return $actions;
	}


	 

	/******************************************************************************************
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */  
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/materialize_accordions-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style('wp-codemirror');
 
	}
 
	/****************************************************************************************
	 * Register the JavaScript/jQuery for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
 		if( !wp_script_is('jquery-ui') ) { 
    		 wp_enqueue_script( 'jquery-ui' , 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js' );
			}
		if( !wp_script_is('wp-color-picker') ) {
			wp_enqueue_script( 'wp-color-picker');
			}
			
			wp_enqueue_script( 'jquery-custom' ,  plugin_dir_url( __FILE__ ) . 'js/admin-jquery.js', array('jquery') );

			 $cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/javascript'));
			  wp_localize_script('jquery', 'cm_settings', $cm_settings);

			 $cm_settings_deux['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
			  wp_localize_script('jquery', 'cm_settings_deux', $cm_settings_deux);

			 
			  wp_enqueue_script('wp-theme-plugin-editor');

			 
 	} 

}