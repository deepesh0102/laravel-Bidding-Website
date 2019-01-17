
$(document).ready(function(){
	$('.header-block .top .toggle').click(function(){
		/* alert('dsfddf'); */
		 $(this).siblings('.header-block .top .top-nav ul').slideToggle();
	});	
	
	$('.header-block .top .top-nav li').click(function(){
		/* alert('dsfddf');  */
		 $(this).find('ul').slideToggle();
	});	
	/* code for search product  */
	$('.left h3').click(function(){
		$(this).toggleClass('act');
		$(this).siblings('.left .list').slideToggle();
		$(this).parents('.box').siblings('.box').find('.act').removeClass();
		$(this).parents('.box').siblings('.box').find('.list').slideUp();
	});


	function toggleIcon(e) {
		$(e.target)
			.prev('.panel-heading')
			.find(".more-less")
			.toggleClass('fa-plus fa-minus');
	}
	$('.panel-group').on('hidden.bs.collapse', toggleIcon);
	$('.panel-group').on('shown.bs.collapse', toggleIcon);

});
$(document).ready(function(){
	$('.styled-select .selt').click(function(){
		$(this).siblings('ul').slideToggle();
		$(this).addClass('clr');
		$('.styled-select ul li').each(function(){
			var val1 = $(this).find('span').text();			
			$(this).click(function(){
				$(this).parents('ul').slideUp();
				$(this).parents('ul').siblings('a.selt').find('span').text(val1);				
			});
		});
	});
});
$(document).ready(function(){
//Mobile Menu	
	$('.header-block .bottom .navbar-nav li').each(function(){
		$(this).children('ul').before('<span class="submenu"></span>');
		});
	$('.header-block .bottom .navbar-nav li .submenu').click(function(e) {
		$(this).next('ul').slideToggle();
		$(this).toggleClass('submenu-hide');
		});
});