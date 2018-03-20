
    	$(window).load(function(){
    		$('.flexslider').flexslider({
    			animation: "slide",
    			rtl: true,
    			start: function(slider){
    				$('body').removeClass('loading');
    			}
    		});
    	});

    	//slider product
		$(document).ready(function() {
              var owl = $('.owl-carousel');
              owl.owlCarousel({
                items: 4,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsiveClass:true,
			    responsive:{
			        0:{
			            items:1,
			        },
			        600:{
			            items:3,
			            nav:false
			        },
			        1000:{
			            items:4,
			            nav:false,
			            loop:true
			        }
			    }
              });
              $('.owl-next').click(function() {
				    owl.trigger('next.owl.carousel');
				})
				$('.owl-prev').click(function() {
				    owl.trigger('prev.owl.carousel', [300]);
				})
            }); 
