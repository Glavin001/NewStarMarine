//formEffects.js
// jQuery
$(function() {
    $(window).resize(function() {
        if(this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function() {
            $(this).trigger('resizeEnd');
        }, 10);
    });
    
    $(window).bind('resizeEnd', function() {
        // Window hasn't changed size in 500ms
        var width = $(this).width();
        var height = $(this).height();
        console.log("Window Width:"+width+", height:"+height);
        // Page default settings
        var bodyFat = 20;
        var pageWidth = 980;
        var mainMenuItems = 10;
        var menuItemWidth = 195;    
        var menuHorFat = 2;
                
        // Check for display mode.
        if (width >= pageWidth+bodyFat+10) // Full/Desktop mode
        {
               
            $('body').width(width-bodyFat);
            //$('body').height(height);
            var perRow = Math.floor((width-bodyFat)/(menuItemWidth)); 
            console.log("perRow:"+perRow);
            
            console.log("if:"+mainMenuItems%perRow);
            if (mainMenuItems%perRow==0 || perRow>=mainMenuItems)
            {
                if (perRow > mainMenuItems) perRow = mainMenuItems;
                console.log("then1");
                // Fit more menu items
                // Top menu
                var newWidth = (width-bodyFat)/perRow-menuHorFat;
                $("ul#mainLinks li").width(newWidth);
                
                // Footer menu
                var copyrightWidth = 584;
                perRow = 2;
                var footerMenuWidth = (width-bodyFat-copyrightWidth)-menuHorFat*perRow;
                newWidth = (footerMenuWidth)/perRow-menuHorFat;
                $("div#footerMenu").width(footerMenuWidth);
                $("ul#footerLinks li").width(newWidth);

            }
            else
            {
                // Cannot fit more menu items
                // Just add width to menu items
                
                // Top menu
                var perRow = 5;
                var newWidth = (width-bodyFat)/perRow-menuHorFat;
                $("ul#mainLinks li").width(newWidth);
                
                // Footer menu
                var copyrightWidth = 584;
                perRow = 2;
                var footerMenuWidth = (width-bodyFat-copyrightWidth)-menuHorFat*perRow;
                newWidth = (footerMenuWidth)/perRow-menuHorFat;
                $("div#footerMenu").width(footerMenuWidth);
                $("ul#footerLinks li").width(newWidth);

                
            }


        }
        else (width < pageWidth)
        {
            
        }


   });

   // Initialize Window layout
   $(window).trigger('resizeEnd');

});
