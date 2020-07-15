jQuery(document).ready(function() {


    jQuery('.collapsible-head').click(function() {
        if (jQuery(this).hasClass('slow-tabs')) {
            jQuery(this).siblings(".collapsible-body").slideToggle(1500);
        } else {
            jQuery(this).siblings(".collapsible-body").slideToggle(300);
        }

    });




    jQuery('.collapsible-head').click(function() {

        jQuery.fn.extend({
            toggleText: function(a, b) {
                return this.text(this.text() == b ? a : b);
            }
        });


        if (jQuery(this).children().hasClass('add')) {
            jQuery(this).children('i.material-icons')
                .toggleText('remove', 'add');
        } else if (jQuery(this).children().hasClass('add_double')) {
            jQuery(this).children('i.material-icons')
                .toggleText('add', 'add');
        } else if (jQuery(this).children().hasClass('keyboard_arrow_up')) {
            jQuery(this).children('i.material-icons')
                .toggleText('keyboard_arrow_down', 'keyboard_arrow_up');
        } else if (jQuery(this).children().hasClass('arrow_drop_up')) {
            jQuery(this).children('i.material-icons')
                .toggleText('arrow_drop_down', 'arrow_drop_up');
        } else if (jQuery(this).children().hasClass('arrow_upward')) {
            jQuery(this).children('i.material-icons')
                .toggleText('arrow_downward', 'arrow_upward');
        }
        else if (jQuery(this).children().hasClass('vertical_align_top')) {
            jQuery(this).children('i.material-icons')
                .toggleText('vertical_align_bottom', 'vertical_align_top');
        }
    })


    // Show All
    jQuery('.open-button').on("click", function() {
        if (jQuery(this).parent().siblings().children().children().hasClass('slow-tabs')) {
            jQuery(this).parent().parent().closest('.materialize-wrapper').find(".collapsible-body").slideDown(1300);
        } else {
            jQuery(this).parent().parent().closest('.materialize-wrapper').find(".collapsible-body").slideDown(300);
        }


        jQuery(this).parent().parent().closest('.materialize-wrapper').find('.collapsible-head').each(function(index) {

            jQuery.fn.extend({
                toggleText: function(a, b) {
                    return this.text(this.text() == b ? a : b);
                }
            });


            if (jQuery(this).children().hasClass('add')) {
                jQuery(this).children('i.material-icons').text('remove');

            } else if (jQuery(this).children().hasClass('add_double')) {
                jQuery(this).children('i.material-icons').text('add');

            } else if (jQuery(this).children().hasClass('keyboard_arrow_up')) {
                jQuery(this).children('i.material-icons').text('keyboard_arrow_down');

            } else if (jQuery(this).children().hasClass('arrow_drop_up')) {
                jQuery(this).children('i.material-icons').text('arrow_drop_down');

            } else if (jQuery(this).children().hasClass('arrow_upward')) {
                jQuery(this).children('i.material-icons').text('arrow_downward');
            }
            else if (jQuery(this).children().hasClass('vertical_align_top')) {
              jQuery(this).children('i.material-icons').text('vertical_align_bottom');
            }
        });

    });



    // Hide All
    jQuery('.close-button').on("click", function() {
        jQuery(this).parent().parent().closest('.materialize-wrapper').find(".collapsible-body").slideUp(300)

        jQuery(this).parent().parent().closest('.materialize-wrapper').find('.collapsible-head').each(function(index) {

            if (jQuery(this).children().hasClass('add')) {
                jQuery(this).children('i.material-icons').text('add');
            } 
            else if (jQuery(this).children().hasClass('add_double')) {
                jQuery(this).children('i.material-icons').text('add');

            } else if (jQuery(this).children().hasClass('keyboard_arrow_up')) {
                jQuery(this).children('i.material-icons').text('keyboard_arrow_up');

            } else if (jQuery(this).children().hasClass('arrow_drop_up')) {
                jQuery(this).children('i.material-icons').text('arrow_drop_up');

            } else if (jQuery(this).children().hasClass('arrow_upward')) {
                jQuery(this).children('i.material-icons').text('arrow_downward');
            }
           else if (jQuery(this).children().hasClass('vertical_align_top')) {
                jQuery(this).children('i.material-icons').text('vertical_align_top');
             }
        });
    });



    // Keypress for accessibility for tabbing 
    jQuery('.collapsible-head').keypress(function(event) {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {

            if (jQuery(this).hasClass("active")) {
                jQuery(this).removeClass("active");
            } else {
                jQuery(this).addClass("active");
            }

            if (jQuery(this).parent().hasClass("active")) {
                jQuery(this).parent().removeClass("active");
            } else {
                jQuery(this).parent().addClass("active");
            }

        }
        jQuery(".collapsible").collapsible({
            accordion: true
        });
    });


    // Prevent accessibility line if clicked with a mouse
    jQuery('.collapsible-head, .open-button, .close-button').mousedown(function() {
        jQuery(this).css("outline", "none");
    });


    // Add ability to open tab via url #
     let url = jQuery(location).attr('href'),
         parts = url.split("/"),
         last_part = parts[parts.length-1];
        
            switch (last_part) {
                    case "#1":
              jQuery( ".entry-content .single-section:eq(0)" ).addClass("active");
              jQuery(".entry-content .single-section:eq(0) .collapsible-head").addClass("active");
              jQuery( ".entry-content .single-section .collapsible-body" ).first().css("display", "block"); 
                    break;
              case "#2":
              jQuery( " .single-section:eq(1)" ).addClass("active");
              jQuery(" .single-section:eq(1) .collapsible-head").addClass("active");
              jQuery( ".single-section:eq(1) .collapsible-body" ).css("display", "block");        
              break;
               case "#3":
              jQuery( ".single-section:eq(2)" ).addClass("active");
              jQuery(".single-section:eq(2) .collapsible-head").addClass("active");
              jQuery( " .single-section:eq(2) .collapsible-body" ).css("display", "block");         
              break;
               case "#4":
              jQuery( " .single-section:eq(3)" ).addClass("active");
              jQuery(" .single-section:eq(3) .collapsible-head").addClass("active");
              jQuery( " .single-section:eq(3) .collapsible-body" ).css("display", "block");         
              break;
               case "#5":
              jQuery( " .single-section:eq(4)" ).addClass("active");
              jQuery(" .single-section:eq(4) .collapsible-head").addClass("active");
              jQuery( ".single-section:eq(4) .collapsible-body" ).css("display", "block");        
              break;  
               case "#6":
              jQuery( ".single-section:eq(5)" ).addClass("active");
              jQuery(".single-section:eq(5) .collapsible-head").addClass("active");
              jQuery( ".single-section:eq(5) .collapsible-body" ).css("display", "block");        
              break;  
               case "#7":
              jQuery( ".single-section:eq(6)" ).addClass("active");
              jQuery(".single-section:eq(6) .collapsible-head").addClass("active");
              jQuery( ".single-section:eq(6) .collapsible-body" ).css("display", "block");        
              break;  
               case "#8":
              jQuery( ".single-section:eq(7)" ).addClass("active");
              jQuery(".single-section:eq(7) .collapsible-head").addClass("active");
              jQuery( ".single-section:eq(7) .collapsible-body" ).css("display", "block");        
              break;  
               case "#9":
              jQuery( ".single-section:eq(8)" ).addClass("active");
              jQuery(".single-section:eq(8) .collapsible-head").addClass("active");
              jQuery( ".single-section:eq(8) .collapsible-body" ).css("display", "block");        
              break;  
               case "#10":
              jQuery( ".single-section:eq(9)" ).addClass("active");
              jQuery(".single-section:eq(9) .collapsible-head").addClass("active");
              jQuery( ".single-section:eq(9) .collapsible-body" ).css("display", "block");        
              break;        
              default:
              break;
           }



});