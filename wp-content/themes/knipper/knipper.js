(function($) {
  $(document).ready(function() {
    $(window).resize(function(){
      if ($(window).width() < 769) {
        $(".brochure-heading-row").click(function(){
          var rowID = $(this).attr('id');
           $('#'+rowID+'-content').toggleClass("active-content");
           $(this).toggleClass("open-row");
        });
        $(".case-study-heading-row").click(function(){
          var rowID = $(this).attr('id');
           $('#'+rowID+'-content').toggleClass("active-content");
           $(this).toggleClass("open-row");
        });
        $(".video-heading-row").click(function(){
          var rowID = $(this).attr('id');
           $('#'+rowID+'-content').toggleClass("active-content");
           $(this).toggleClass("open-row");
        });
      } //window width
    });

    
  });
})(jQuery)
