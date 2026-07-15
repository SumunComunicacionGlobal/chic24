(function ($) {
	jQuery('.wpcf7-uacf7_country_dropdown').each(function(){
	  var fieldId = jQuery(this).attr('id');
	  // var defaultCountry = jQuery(this).attr('country-code');
	  var defaultCountry = jQuery('.wpml-ls-item-active').text();

	  if ( defaultCountry.length == 0 ) {
		defaultCountry = 'es';
	  }

	  console.log(defaultCountry);
	  console.log(fieldId);
  
	  if ( defaultCountry == 'en' ) {
		defaultCountry = 'gb';
	  }
  
	  // alert(defaultCountry);
	  
	  $("#"+fieldId).countrySelect({
		defaultCountry: defaultCountry,
		// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		responsiveDropdown: true,
		preferredCountries: ['es', 'gb', 'fr', 'it', 'de', 'pt', 'us']
	  });


	});
  })(jQuery);

  
( function() {

})();

jQuery(document).ready(function($) {
	var body = $('body');

	jQuery(window).scroll(function() {
		var scroll = $(window).scrollTop();
		if (scroll >= 25) {
			body.addClass("scrolled");
		} else {
			body.removeClass("scrolled");
		}

	   if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
	       body.addClass("near-bottom");
	   } else {
			body.removeClass("near-bottom");
	   }

	});

	$('.slick-carousel-ambientes').slick({
	  dots: false,
	  arrows: true,
	  infinite: true,
	  speed: 300,
	  slidesToShow: 1,
	  centerMode: true,
	  variableWidth: true,
	  autoplay: true,
	  autoplaySpeed: 3000,
	});

	$('.slick-slider').slick({
		dots: false,
		arrows: true,
		infinite: true,
		speed: 600,
		slidesToShow: 1,
		autoplay: true,
		autoplaySpeed: 4000,  
	});

	$('.slick-carousel-home').slick({
		dots: false,
		arrows: false,
		infinite: true,
		speed: 6000,
		cssEase: 'linear',
		waitForAnimate: false,
		pauseOnFocus: false,
		pauseOnHover: false,
		slidesToShow: 1,
		centerMode: true,
		variableWidth: true,
		autoplay: true,
		autoplaySpeed: 0,  
		responsive: [
			{
			  breakpoint: 600,
			  settings: {
				cssEase: 'ease',
				speed: 300,
				autoplaySpeed: 3000
			  }
			}
		  ]
	
	});

});


