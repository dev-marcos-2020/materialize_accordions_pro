<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Materialize_accordions
 * @subpackage Materialize_accordions/admin/partials
 */
?>

		 <script>


		 	// FUNCTION FOR ADDING SECTIONS
			let startingContent = <?php echo $total_all_data_value; ?>;
			jQuery('#add_content').click(function(e) {
				e.preventDefault();
				startingContent++;
				let contentID = 'material_accordion_field_' + startingContent,
					contentRow = '<div class="accordion-section"><div class="collapsible-head" tabindex="0"><i class="material-icons">add</i><label for="material_accordion_title_<?php echo $i; ?>"><h2 class="material-labels">ACCORDION TITLE</h2></label> <input type="text" class="material-accordion-title data"" id="material_accordion_title_'+startingContent+' material_accordion_title" name="material_accordion_title[]" value="" class="" /></div><div class="accordion-admin-wrap collapsible-body"><label for="material_accordion_field_' + startingContent + '"><h2 class="material-labels">ACCORDION DESCRIPTION</h2></label><textarea name="material_accordion_field[]" id="material_accordion_field_' + startingContent + '" class="accordion-editor" rows="10"></textarea></div><br><a class="content-delete" href="#">Delete Section</a></div>';
	
				jQuery('.accordion-section').eq(jQuery('.accordion-section').length - 1).after(contentRow);
				jQuery('.total_all_data_content').val(startingContent);
				wp.editor.initialize(
					contentID,
				        	    	  { 
				        	    	    tinymce: { 
										  wpautop:true, 
										   plugins : 'charmap colorpicker compat3x directionality hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
          toolbar1: 'bold italic underline strikethrough  bullist numlist  blockquote hr wp_more  alignleft aligncenter alignright  link unlink   wp_adv,table',
          toolbar2: 'formatselect alignjustify forecolor  pastetext removeformat charmap  outdent indent  undo redo '
				        	    	       
				        	    	    }, 
				        	    	    quicktags: true ,
										 mediaButtons: true
				        	    	  }
				        	    	);
	 	     			 


			});

			// FUNCTION FOR DELETING SECTIONS
			jQuery(document).on('click', '.content-delete', function() {
				if (
					jQuery('.accordion-section').length > 1 &&
					confirm('Are you sure you want to delete this content?')
				) {
					jQuery(this).parent().remove();
					//jQuery(this).remove();
					let totalrowdata = jQuery( ".total_all_data_content" ).val();
					jQuery('.total_all_data_content').val(totalrowdata-1);
				}
			});
 

			// FUNCTION FOR  SORTING  SECTIONS
			jQuery('.advanced-sortables').sortable(  {

				 revert: true,
			
				 start: function(event, ui) { // turn TinyMCE off while sorting  

					 	textareaID = jQuery(ui.item).find('.wp-editor-area').attr('id');
	        			
	        			try { 
	        				
	        				wp.editor.remove(textareaID);
	        			} 
	        			catch(e){

	        			}
						
	        			textareaID = jQuery(ui.item).find('.accordion-editor').attr('id');
	        			
	        			try { 
	        				
	        				wp.editor.remove(textareaID);
	        			} 
	        			catch(e){

	        			}
    		},
		    stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				
				 textareaID = jQuery(ui.item).find('.wp-editor-area').attr('id');
		        wp.editor.initialize(
					textareaID,
				        	    	  { 
				        	    	    tinymce: { 
										  wpautop:true, 
										   plugins : 'charmap colorpicker compat3x directionality hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
								          toolbar1: 'bold italic underline strikethrough bullist numlist blockquote hr wp_more alignleft aligncenter alignright link unlink wp_adv',
								          toolbar2: 'formatselect alignjustify forecolor pastetext removeformat charmap outdent indent undo redo'
				        	    	       
				        	    	    }, 
				        	    	    quicktags: true ,
										 mediaButtons: true
				        	    	  }
				        	    	);
				
		        textareaID = jQuery(ui.item).find('.accordion-editor').attr('id');
		        wp.editor.initialize(
					textareaID,
				        	    	  { 
				        	    	    tinymce: { 
										  wpautop:true, 
										   plugins : 'charmap colorpicker compat3x directionality hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
								          toolbar1: 'bold italic underline strikethrough bullist numlist blockquote hr wp_more alignleft aligncenter alignright link unlink wp_adv',
								          toolbar2: 'formatselect alignjustify forecolor pastetext removeformat charmap outdent indent undo redo'
				        	    	       
				        	    	    }, 
				        	    	    quicktags: true ,
										 mediaButtons: true
				        	    	  }
				        	    	);

		    }
				
				
			  
		}).disableSelection();

		</script>