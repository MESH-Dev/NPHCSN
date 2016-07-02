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

	//AJAX for member resource filtering

	function loadMemberResources (memberResource, contentType, query) { //*
 
      //console.log(projectType);
      //console.log(query);  //*
      var is_loading = false;
       if (is_loading == false){
            is_loading = true;
 
            $('#loader, .loader-container').fadeIn(200);

            var data = {
                action: 'get_member_resources',
                memberResource: memberResource, //*
                query: query //*
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader

                console.log(response);
                
               //$('a#load-more-photos').show();
                // append: add the new statments to the existing data
                if(response != 0){

                  
                  $('#project-gallery').append(response);
                  //$container.waitForImages(function() {
                  //   $('#loader').hide();
                  // });                  
 					$('#loader').fadeOut(1000);
 					$('.loader-container').fadeOut(300);
 					$('.project-tile').addClass('hide');
 					//$('.projects-nav ul > li').removeClass('selected');
 					//Adds slideinLeft and animated classes to each project tile in order
 					$('.project-tile').each(function(i, el){
 						window.setTimeout(function(){
 						$(el).removeClass('hide').addClass('fadeIn animated');
 						}, 50 * i);
 					});
 					$('.search_form')
 						.removeClass('slideInLeft')
 						.addClass('slideOutLeft');
 					// $('.projects-nav.gallery')
 					// 	.removeClass('slideInLeft')
 					// 	.addClass('slideOutLeft');
                  is_loading = false;
                }
                else{
                  $('#loader').hide();
                  
                  is_loading = false;
                }

                
            });
        }    
  }


$('.topic-filter ul li').click(function(){
	var memberResource = $(this).attr('data-filter');
	loadMemberResources(memberResource,''); //theNameOfTheAjaxFunction(theNameOfTheDataItem, '')
	$(this).addClass('selected');
	$('.topic-filter ul li.selected').not($(this)).removeClass('selected');
	//Delete whatever is already in the project gallery
	$('.project-tile').detach();
	$('.search_form')
		.removeClass('slideInLeft')
		.addClass('slideOutLeft')
		.animate({opacity:0}, 300)
		.css({zIndex:-1});
	$('.gallery-gateway')
		.removeClass('slideOutLeft')
		.addClass('slideInLeft');
});

$('.search_form form').submit(function(e){
	e.preventDefault();
	var $form = $(this);
	var $input = $form.find('input[name="s"]');
	var query = $input.val();
	console.log(query);
	loadProjects('',query);
	$('.project-tile').detach();
	$('.gallery-gateway')
		.removeClass('slideOutLeft')
		.addClass('slideInLeft');
	$('.post.error').detach();
	
});

}); //end ready
