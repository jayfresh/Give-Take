$(document).ready(function() {
	$('span.and').text('+');
});

$(document).ready(function() {
	$('a[rel="self"]').click(function(e){
		e.preventDefault();
		var href = $(this).attr('href').substring(1),
			goTo = 0;
		if($('a[rel="self"]').index(this)!==0) {
			goTo = $('a[name='+href+']');
		}
		$.scrollTo(goTo, 300);
		return true;
	});
});


/* this is to make the page scroll around when internal links are clicked. It works with a fixed nav, and switches it to absolute position (so it stays in place) after a certain point */
/*
$(document).ready(function() {
	// make links to anchors on the page scroll to the location.
	var $pageLink = $('.pageLinks'),
		pageLinkParentTop = $pageLink.parent().offset().top, // use parent since it is not fixed
		pageLinkHeight = $pageLink.height()
			+ parseInt($pageLink.css('paddingBottom'),10)
			+ parseInt($pageLink.css('paddingTop'),10)
			//+ parseInt($pageLink.css('marginBottom'),10) // don't include bottom-margin since it is not visible
			+ parseInt($pageLink.css('marginTop'),10)
			+ parseInt($pageLink.css('borderBottomWidth'),10)
			+ parseInt($pageLink.css('borderTopWidth'),10),
		pageLinkHeaderHeight = $pageLink.find('h2').height(),
		$selfLinks = $('a[rel="self"]'),
		$lastLink,
		lastLinkTop,
		lastLinkHeight,
		limit;
	if($pageLink.length && $selfLinks.length) {
		$pageLink.css('top', pageLinkParentTop);
		$lastLink = $('a[name='+$($selfLinks[$selfLinks.length-1]).attr('href').substring(1)+']').closest('div');
		lastLinkTop = $lastLink.offset().top;
		lastLinkHeight = $lastLink.height()
			+ parseInt($lastLink.css('paddingBottom'),10)
			+ parseInt($lastLink.css('paddingTop'),10)
			//+ parseInt($lastLink.css('marginBottom'),10)
			+ parseInt($lastLink.css('marginTop'),10)
			+ parseInt($lastLink.css('borderBottomWidth'),10)
			+ parseInt($lastLink.css('borderTopWidth'),10);
		limit = (lastLinkTop + lastLinkHeight) - (pageLinkParentTop + pageLinkHeight);

		$('a[rel="self"]').click(function(e){
			var place =  $(this).attr('href');
			e.preventDefault();
			if($('a[rel="self"]').index(this)===0) {
				toPlace=0;
			} else {
				toPlace = $('a[name='+place.substring(1)+']').parent();
				toPlace = toPlace.offset().top + (toPlace.height()+parseInt(toPlace.css('padding-bottom'),10)) - (pageLinkHeaderHeight + pageLinkParentTop);
			}
			$.scrollTo(toPlace, 300);
			$(this).blur();
			return false;
		});
		$(window).scroll(function() {
			if($(window).scrollTop()>limit) {
				if($pageLink.css('position')==="fixed") {
					$pageLink.css({
						position: 'absolute',
						top: limit
					});
				}
			} else {
				if($pageLink.css('position')==="absolute") {
					$pageLink.css({
						position: 'fixed',
						top: pageLinkParentTop
					});
				}
			}
			
		});
	}
});
*/