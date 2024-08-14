$(document).ready(function(){
    $('.menu_icon').click(function(){
        $('.menus').slideToggle(500);
    });
    $('#myCarousel').owlCarousel({
        items:3,
        margin:30,
        nav:true,
        navText: ['<i class="fa-solid fa-chevron-left"></i>','<i class="fa-solid fa-chevron-right"></i>'],
        autoplay:true,
        autoplayTimeout:2000,
        loop:true,
    });
    $('#myCarousel2').owlCarousel({
        items:2,
        margin:30,
        nav:false,
        // navText: ['<i class="fa-solid fa-chevron-left"></i>','<i class="fa-solid fa-chevron-right"></i>'],
        autoplay:true,
        autoplayTimeout:3000,
        loop:true,
    });
    initImage();

	/*

	2. Set Header

	*/
	function initImage()
	{
		var images = $('.image_list li');
		var selected = $('.image_selected img');

		images.each(function()
		{
			var image = $(this);
			image.on('click', function()
			{
				var imagePath = new String(image.data('image'));
				selected.attr('src', imagePath);
			});
		});
	}
});
$(document).ready(function(){
    $('#myCarousel3').owlCarousel({
        items:3,
        margin:30,
        nav:true,
        navText: ['<i class="fa-solid fa-chevron-left"></i>','<i class="fa-solid fa-chevron-right"></i>'],
        autoplay:true,
        autoplayTimeout:2000,
        loop:true,
    });
});
AOS.init();
