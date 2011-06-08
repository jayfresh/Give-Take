$(document).ready(function() {
	$('span.and').text('+');
});

$('#slideshow').slideViewerPro({
		galBorderWidth: 0,
		typo: true,
		thumbsActiveBorderColor: '#9cadc7',
		buttonsTextColor: '#9cadc7',
		autoslide: false
	});

$(document).ready(function() {
	var $nav = $('#nav'),
		$navLinks = $nav.find('a'),
		diagOffset = 100, /* this is the difference between the top of the fullwidth container and what appears to be the top thanks to the overlapping diagonal */
		navFixedTop = 0, /* this is how far we want the nav to stay from the top of the page when it's fixed */
		navFixedLeft = $nav.offset().left,
		navPosLeft = $nav.css('left'),
		navPosTop = $nav.css('top'),
		scrollTopLimit = $nav.offset().top - navFixedTop,
		$anchors = $('a[name]'),
		scrollBottomLimit = $anchors.eq($anchors.length-1).closest('.fullwidth').offset().top+diagOffset,
		navPosBottom = navFixedTop + scrollBottomLimit;
	$navLinks.click(function(e){
		e.preventDefault();
		var href = $(this).attr('href'),
			goTo = 0;
		href = href.substring(href.lastIndexOf('/')+1);
		if($navLinks.index(this)!==$navLinks.length-1) {
			goTo = $('a[name='+href+']').closest('.fullwidth').offset().top+diagOffset;
		}
		$.scrollTo(goTo, 300);
		return true;
	});
	
	/* make the nav move as well */
	$(window).scroll(function() {
		var scrollTop = $(window).scrollTop();
		if(scrollTop<=scrollTopLimit) {
			if($nav.css('position')==="fixed") {
				$nav.css({
					position: 'absolute',
					top: navPosTop,
					left: navPosLeft
				});
			}
		} else if(scrollTop>scrollTopLimit && scrollTop<=scrollBottomLimit) {
			if($nav.css('position')==="absolute") {
				$nav.css({
					position: 'fixed',
					top: navFixedTop,
					left: navFixedLeft
				});
			}
		} else if(scrollTop>scrollBottomLimit) {
			if($nav.css('position')==="fixed") {
				$nav.css({
					position: 'absolute',
					top: navPosBottom,
					left: navPosLeft
				});
			}
		}
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
});*/
