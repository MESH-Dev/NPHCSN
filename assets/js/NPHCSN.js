jQuery(document).ready(function($){



	$('.filter-row a').click(function(){
		// fetch the class of the clicked item
		var filterVal = $(this).data('filter');
		var filterName = $(this).text();
		$('span#filter').html(filterName);

		// reset the active class on all the buttons
		$('.filter-row a').removeClass('active');
		// update the active state on our clicked button
		$(this).addClass('active');

		// hide all elements that don't share filterVal
		$('.resource-listing').children('div:not(.' + filterVal + ')').hide();
		// show all elements that do share filterVal
		$('.resource-listing').children('div.' + filterVal).show();

		return false;
	});

	$('a#reset').click(function(){
		// fetch the class of the clicked item
		var filterVal = $(this).data('filter');
		$('span#filter').html('Everything');

		// reset the active class on all the buttons
		$('.filter-row a').removeClass('active');

		$('.resource-listing').children('div.resource-item').show();

		return false;
	});

	var offset = $("#callout" ).offset();
	$( "#home-arrow" ).click(function() {
		$('html, body').animate({scrollTop: offset.top}, 800);
	});


	$('.back').addClass('hide');


	$('.resource-header').click(function(e){
		e.preventDefault();

		$('#resource-hidden').slideToggle('300');
		$('#x-swap').toggleClass('resourcearrow arrowx');

		$('.face').toggleClass('hide');

		$('.resource-item a').each(function(){
			var divheight = $(this).children('.resource-item-left').height();
			divheight = divheight - 15;
			$(this).children('.resource-item-right').css('margin-top',divheight);


		});


	});

	$('#resource-x').click(function(e){
		e.preventDefault();

		$('#resource-hidden').slideToggle('300');
		$('#x-swap').toggleClass('resourcearrow arrowx');

		$('.face').toggleClass('hide');
	});



	$('li#menu-item-321').mouseover(function(e){
		e.preventDefault();
		$('.pushdown').stop().slideDown('320');
	});
	$('.pushdown').mouseleave(function(e){
		e.preventDefault();
		$('.pushdown').stop().slideUp('320');
	});





	$('a.content-read-more').each(function(){
		var linkString = $(this).html();
		linkString = linkString.replace(/<p>/g, "");
		linkString = linkString.replace(/<\/p>/g, "");
		$(this).html(linkString);

	});

	/*
	$('.resource-item a').each(function(){
		var linkText = $(this).html();
		linkText = linkText + '<img class="rt-arrow" src="/wp-content/themes/NPHCSN/assets/img/right-arrow-orange.png" />';
		$(this).html(linkText);

	});
	*/

	$('.resource-item a').each(function(){
		var divheight = $(this).children('.resource-item-left').height();
		divheight = divheight - 15;
		$(this).children('.resource-item-right').css('margin-top',divheight);


	});














});
