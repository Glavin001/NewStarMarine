//formEffects.js
// jQuery
$(function() {
   // Via change
    $("form input[type=checkbox]").change(function() {
        // $(this).parent().parent().addClass("curFocus");
        $(this).parent().parent().effect("highlight", {}, 1000);
    });
    
    // Via focus
    $("form input, form select, form textarea").focus(function() { 
        $(this).parent().parent().addClass("curFocus");
        $(this).effect("highlight", {}, 500);
        $(this).parent().parent().effect("highlight", {}, 1000);
    });
    
    $("form input, form select, form textarea").blur(function() {
        $(this).parent().parent().removeClass("curFocus");
    });
    
    var $fields = $("form fieldset");
    $fields.focusin(function() {
        $fields.removeClass("active-form");
        $(this).addClass("active-form");        
    });
    $fields.focusout(function() {
        $fields.removeClass("active-form");
    });

});
