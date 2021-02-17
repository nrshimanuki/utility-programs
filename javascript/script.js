(function ($) {

	/*========================================
		menu
	========================================*/
	// $('#l_menu_button').on('click', function() {
	//   $(this).toggleClass('active');
	//   $('#l_menu_bg').fadeToggle();
	//   $('#l_menu').toggleClass('open');
	// });
	// $('#l_menu_bg').click(function () {
	//   $(this).fadeOut();
	//   $('#l_menu_button').removeClass('active');
	//   $('#l_menu').removeClass('open');
	// });

	$('#l_menu_button').on('click', function() {
		if ($(this).hasClass('close')) {
			$('body').css('overflow','hidden');
			$(this).removeClass('close');
			$(this).addClass('open');
			$('#button_text').html('CLOSE');
			$('#l_menu_inner').removeClass('close');
			$('#l_menu_inner').addClass('open');
			let h = $(window).height() - 125;
			$('#l_menu_inner').css('height', h + 'px');
		} else {
			$('body').css('overflow','initial');
			$(this).removeClass('open');
			$(this).addClass('close');
			$('#button_text').html('MENU');
			$('#l_menu_inner').removeClass('open');
			$('#l_menu_inner').addClass('close');
		}
	});
	$('.l_menu_item').on('click', function() {
		$(this).each(function(i,e) {
			if ($(e).hasClass('close')) {
				$(e).removeClass('close');
				$(e).addClass('open');
			} else if ($(e).hasClass('open')) {
				$(e).removeClass('open');
				$(e).addClass('close');
			}
		})
	});


	/*========================================
		parallax
	========================================*/
	var setArea = $('.scroll_event'),
	showHeight = 150;
	setArea.css({display:'block',opacity:'0'});
	$(window).on('load scroll resize',function(){
		setArea.each(function(){
			var setThis = $(this),
			areaTop = setThis.offset().top;

			if ($(window).scrollTop() >= (areaTop + showHeight) - $(window).height()){
				setThis.stop().animate({opacity:'1'}, 600);
			} else {
				// setThis.stop().animate({opacity:'0'}, 600);
			}
		});
	});


	$(window).on('load', function(){
		if(window.matchMedia('(max-width:768px)').matches){
			AOS.init({
				offset: 200,
				duration: 900,
				once: true,
				delay: 0
			});
		} else {
			AOS.init({
				offset: 300,
				duration: 900,
				once: true,
				delay: 0
			});
		}
	});


	/*========================================
		slider
	========================================*/
	$('.slide').slick({
		autoplay: true,
		autoplaySpeed: 3000,
		centerMode: true,
		centerPadding: '400px',
		dots: true,
		speed: 1000,
		infinite: true,
		responsive: [
			{
				breakpoint: 1600,
				settings: {
					centerPadding: '255px',
				}
			},
			{
				breakpoint: 1300,
				settings: {
					centerPadding: '100px',
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					centerMode: false,
					slidesToShow: 1
				}
			}
		]
	});


	/*========================================
		Photo Gallery
	========================================*/
	$('.gallery_thumbnail_sp').on('mouseover touchend',function(){
		$('.gallery_thumbnail_sp').removeClass('active');
		$(this).addClass('active');
		var dataUrl = $(this).attr('src');
		var dataText = $(this).attr('alt');
		$('#gallery_main_img_sp').attr('src', dataUrl);
		$('#gallery_main_text').text(dataText);
	});
	$('.gallery_thumbnail_pc').on('mouseover touchend',function(){
		$('.gallery_thumbnail_pc').removeClass('active');
		$(this).addClass('active');
		var dataUrl = $(this).attr('src');
		var dataText = $(this).attr('alt');
		$('#gallery_main_img_pc').attr('src', dataUrl);
		$('#gallery_main_text').text(dataText);
	});


	/*========================================
		modal
	========================================*/
	$('.modal_open').click(function() {
		let imgSrc = $(this).attr('src');
		$('#modal_img').attr('src', imgSrc);
		$('#modal_area').fadeIn();
	});

	$('#modal_close , #modal_bg').click(function() {
		$('#modal_area').fadeOut();
	});


	/*========================================
		mCustomScrollbar
	========================================*/
	$(window).on("load",function(){
		$(".i_induction_list").mCustomScrollbar();
	});


	/*========================================
		pageTop
	========================================*/
	$('body').append('<a href="javascript:void(0);" id="pageTop"></a>');
	var pageTop = $('#pageTop');
	pageTop.on('click',function(){
		$('html,body').animate({scrollTop: '0'},500);
	});

	$(window).on('load scroll resize',function(){
		var showTop = 200;
		if($(window).scrollTop() > showTop) {
			pageTop.fadeIn();
		} else {
			pageTop.fadeOut();
		}
	});


}(jQuery));
