jQuery(document).ready(function() {

    jQuery(".collapsible-body").hide();

    jQuery(document).on('click', '.material-icons', function(event) {
    	event.stopPropagation();
      jQuery(this).closest('div').siblings(".collapsible-body").slideToggle(300);
    });

});