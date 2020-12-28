$(".owl-carousel.com").owlCarousel({loop:true,nav:true,margin:0,items:1,autoplay:true,autoplayTimeout:6000});
$('.owl-carousel.hot').owlCarousel({loop:true,nav:true,margin:10,items:2,autoplay:true,autoplayTimeout:3000});
        
$('.lftcom').click(function() {$('.com .owl-prev').click();});
$('.rigcom').click(function() {$('.com .owl-next').click();});