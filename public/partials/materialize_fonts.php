<?php

/**
 * Provide a public view for the plugin
 *
 *
 * @link       #
 * @since       1.0.0
 *
 * @package    Materialize_accordions
 * @subpackage Materialize_accordions/admin/partials
 */
 

if ( $font_family == "Alegreya" || $font_family == "B612"|| $font_family == "Montserrat" || $font_family == "Raleway" || $font_family == "Muli"|| $font_family == "Titillium Web" || $font_family == "Varela" || $font_family == "Vollkorn" || $font_family == "IBM Plex"  || $font_family == "Crimson Text" || $font_family == "Cairo" || $font_family == "BioRhyme" || $font_family == "Karla" || $font_family == "Lora"  || $font_family == "Frank Ruhl Libre" || $font_family == "Playfair Display" || $font_family == "Archivo" || $font_family == "Spectral" || $font_family == "Fjalla One"  || $font_family == "Roboto" || $font_family == "Rubik" || $font_family == "Source Sans"  || $font_family == "Cardo" || $font_family == "Cormorant" || $font_family == "Work Sans"  || $font_family == "Rakkas" || $font_family == "Concert One" || $font_family == "Yatra One"  || $font_family == "Arvo" || $font_family == "Lato" || $font_family == "Abril FatFace"  || $font_family == "Ubuntu" || $font_family == "PT Serif" || $font_family == "Old Standard TT"  || $font_family == "Oswald" || $font_family == "PT Sans" || $font_family == "Poppins"  || $font_family == "Fira Sans" || $font_family == "Nunito" || $font_family == "Oxygen"  || $font_family == "Exo 2" || $font_family == "Open Sans" || $font_family == "Merriweather"  || $font_family == "Noto Sans" || $font_family ==  'Source Sans Pro' ) { 
			?>
	   		 	<script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js">
	   		 	</script> 
	   		<?php
	   		 
	   		 		wp_register_script(
	   		 		      'web-font-loader',
	   		 		      '//ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js',
	   		 		      array(),
	   		 		      null );

	   		 		      ?>
	   		 		      <script>	
	   		 		      	WebFont.load({
	   		 		      	   google: {
	   		 		      	     families: ['<?php echo $font_family; ?>']
	   		 		      	   }
	   		 		      	 });
	   		 		      </script>
	   		 		      <?php  }