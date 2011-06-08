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
	
	/* text replace for "Give and Take" to "Give + Take" */
	$('span.and').text('+');
	
	/* activate image carousel */
	$('#slideshow').slideViewerPro({
		galBorderWidth: 0,
		typo: true,
		thumbsActiveBorderColor: '#9cadc7',
		buttonsTextColor: '#9cadc7',
		// autoslide: true
	});
	
});

