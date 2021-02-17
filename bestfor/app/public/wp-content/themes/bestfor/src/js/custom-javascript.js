// Add your JS customizations here
jQuery("[data-trigger]").on("click", function(e){
    e.preventDefault();
    e.stopPropagation();
    var offcanvas_id =  jQuery(this).attr('data-trigger');
    jQuery(offcanvas_id).toggleClass("show");
    jQuery('body').toggleClass("offcanvas-active");
    jQuery(".screen-overlay").toggleClass("show");
  }); 
  
  jQuery(".btn-close, .screen-overlay").on("click",(function(e){
    jQuery(".screen-overlay").removeClass("show");
    jQuery(".mobile-offcanvas").removeClass("show");
    jQuery("body").removeClass("offcanvas-active");
  })); 
  

  