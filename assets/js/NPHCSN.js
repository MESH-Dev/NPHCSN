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

	//external link manager

	  /* ==========
	     Variables
	   ========== */
	   var url = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');

	  /* ==========
	      Utilities
	    ========== */
	   function beginsWith(needle, haystack){
	     return (haystack.substr(0, needle.length) == needle);
	   };


	  /* ==========
	     Anchors open in new tab/window
	   ========== */
	   $('a').each(function(){

	     if(typeof $(this).attr('href') != "undefined") {
	      var test = beginsWith( url, $(this).attr('href') );
	      //if it's an external link then open in a new tab
	      if( test == false && $(this).attr('href').indexOf('#') == -1){
	        $(this).attr('target','_blank').prepend('<span class="sr-only">External link, opens in new window</span>');
	      }
	     }
	   });

   //=============================================================

	//AJAX for member resource filtering

	function loadMemberResources (memberResource, contentType, query) { //*
 
      //console.log(projectType);
      //console.log(query);  //*
      var is_loading = false;
       if (is_loading == false){
            is_loading = true;
 
            $('#loader, .loader-container').fadeIn(200);

            var data = {
                action: 'get_member_resources',  //Our function from function.php
                memberResource: memberResource, //the return value
                contentType: contentType,
                query: query //Are we using the search?  
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader

                console.log(response);
                console.log(data);
                //console.log(memberResource);
                console.log(contentType);
                //console.log(get_member_resources);
                
               //$('a#load-more-photos').show();
                // append: add the new statments to the existing data
                if(response != 0){

                  
                  $('.mr-resource-listing').append(response);
                  //$container.waitForImages(function() {
                  //   $('#loader').hide();
                  // });                  
 					$('#loader').fadeOut(1000);
 					$('.loader-container').fadeOut(300);
 					$('.member-resource-item').addClass('hide');
 					//$('.projects-nav ul > li').removeClass('selected');
 					//Adds slideinLeft and animated classes to each project tile in order
 					$('.member-resource-item').each(function(i, el){
 						//Show each item in it's turn
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

// $('[class*="-filter"] ul li').click(function(){
// 	var memberResource;
// 	var contentType;
// 	$('.member-resource ul li').click(function(){
// 		var memberResource = $(this).attr('data-filter');
// 		//return memberResource;
// 	});
// 	return memberResource;
// 	$('.content-type ul li').click(function(){
// 		var contentType = $(this).attr('data-filter');
// 		//return contentType;
// 	});
// 	return contentType;
// 	//var memberResource = $('.member-resource ul li').attr('data-filter');
// 	//var contentType = $('.content-type ul li').attr('data-filter');
// 	loadMemberResources(memberResource,contentType,''); //theNameOfTheAjaxFunction(theNameOfTheDataItem, '')
// 	console.log('Member resource = ' + memberResource);
// 	console.log('Content type = ' + contentType);
// 	$(this).addClass('selected');
// 	$('.topic-filter ul li.selected').not($(this)).removeClass('selected');
// 	//Delete whatever is already in the project gallery
// 	$('.member-resource-item').detach();
// 	$('.post-error').detach();

// });


$('[class*="filter-"] li').click(function(){
	
	$(this).parent().find('li.selected').removeClass('selected');
	
	$(this).addClass('selected');
	
	var memberResource = $('.topic li.selected').attr('data-filter');
	var contentType = $('.type li.selected').attr('data-filter');
	
	
	if (memberResource != ''){
	$('.topic-filtered span').text(memberResource).addClass('btn');
	}else{
		$('.topic-filtered span').text('All').removeClass('btn');
	}

	if (contentType != ''){
		$('.type-filtered span').text(contentType).addClass('btn');
	}else{
		$('.type-filtered span').text('All').removeClass('btn');
	}

	//Delete whatever is already in the result
	$('.member-resource-item').detach();
	$('.post-error').detach();

	loadMemberResources(memberResource,contentType,'');
	console.log('Member resource = ' + memberResource);
	console.log('Content type = ' + contentType);
	

});

$('.reset').click(function(){
	var memberResource = "";
	var contentType = "";

	$('.member-resource-item').detach();
	$('.post-error').detach();

	$('.topic-filtered span').text('all');
	$('.type-filtered span').text('all');

	loadMemberResources(memberResource,contentType,'');

	$('[class*="filter-"]').find('li.selected').removeClass('selected');

});

// $('.content-filter ul li').click(function(){
// 	var contentType = $(this).attr('data-filter');
// 	//console.log("Content Type is:" + contentType);
	
// 	loadMemberResources('',contentType,''); //theNameOfTheAjaxFunction(theNameOfTheDataItem, '')
// 	$(this).addClass('selected');
// 	$('.content-filter ul li.selected').not($(this)).removeClass('selected');

// 	//Delete whatever is already in the project gallery
// 	$('.member-resource-item').detach();
// 	$('.post-error').detach();

	
// });

$('.search-filter form').submit(function(e){
	e.preventDefault();
	var $form = $(this);
	var $input = $form.find('input[name="s"]');
	var query = $input.val();
	console.log(query);
	loadMemberResources('','',query);
	$('.member-resource-item').detach();
	$('.post-error').detach();
	// $('.gallery-gateway')
	// 	.removeClass('slideOutLeft')
	// 	.addClass('slideInLeft');
	// $('.post.error').detach();
	
});

}); //end ready
