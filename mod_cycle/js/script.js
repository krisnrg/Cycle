// On Ducument Ready short hand
jQuery.noConflict();
(function($j){

function bf() {
	if ($j('#slide_wrap').hasClass('over')) {
		$j('.gray').fadeOut(300);
		$j('.gray:hidden').fadeOut(300);
		
	};
}


var today = new Date();

compare = function(one, two){
	if(one >= two){
		return true;
	} else {
		return false;
	}
}



p = function(XMLpath,moduleClass,IdSelector,width,height,padding){

	$j('#rotator').empty().html('<div style="width: 32px; margin: 0 auto; padding: 200px; "><img src="modules/mod_cycle/img/ajax-loader.gif" width="32px" height="32px"/></div>');		
	
	//this is the get ajax request
	$j.get(XMLpath, function(pix) {
		
		// I try to have all my varianles here.
		var rotate = document.getElementById(IdSelector),
		 	next = document.getElementById('next'),
			roll = $j('#'+IdSelector +' li div');
			 //declared but not used doesn't exit yet.
		
		//we want to clear whatever is in our target.
		$j(rotate).empty();
		// now we find the picture node in the xml file then loop thru it
		var num = $j(pix).find('picture').
			each(function(index) {
				//define out variables for each picture element
				var picture = $j(this),
					expires = new Date($j(this).find('expires').text()),
					desc = $j(this).find('desc').text(),
					path = $j(this).find('path').text(),
					link = $j(this).find('link').text(),
					name = "<h2>"+$j(this).find('name').text()+"</h2>",
					close;
	
				if (compare(expires, today)) {
					if (!desc == '') {
						desc = "<div class=\"gray\" style=\" width:" + parseInt(width)/4 + "px; height:" + parseInt(height)+"px; padding:"+parseInt(padding)+ "px;\">" + name + "<span>" + desc + "</span></div>"
					} else {
						desc ='';
					};

					if (!link == '') {
						link = "<a href=\""+link+ "\">"
						close = "</a>"
					} else {
						link = ''; close = '';
					};

					$j(rotate).append(
						"<li>"+ link +"<img class=\"slide\" alt=\"\" src=\"" + path + "\"/>"+ desc + close + "</li>"
					);
				} else {
					$j(rotate).append(
						""
					);
				}
			});
		// end of the each loop
		
		$j('#'+ moduleClass).css({'width': width+'px'});
		
		//wrap the rotate in another div to give it the size we need and put our controls inside
		$j(rotate).wrap('<div id="slide_wrap"/>').css({'height': '410px', 'width': width, 'margin': '0 auto'});
		
		// this is where we apply the cycle plugin. we use num to find the number of images to center the circles
		$j(rotate)
			.after('<div id="circ" style="width: '+(num.length*22)+'px">')
			.cycle(
			   {fx:'scrollRight', 
			    speed: 1000,
				timeout: 4000,
				pause: 1,
				next: '#next',
				slideResize:   1,
				prev: '#back',
				pager: '#circ',
				pauseOnPagerHover: 1}
		);
		slide_wrap = document.getElementById('slide_wrap');
		$j(slide_wrap).hover(function() {
			// drop new animations for this element
				if ($j('#circ').queue().length>0){return}
				if ($j('.gray').queue().length>0){return}
				//do animations
				$j(this).addClass('over');
				console.log('over');
				$j('.gray').fadeIn(500);
				$j('#circ').fadeIn(500);	
			}, function(){
				if ($j('#circ').queue().length>0){return}
				if ($j('.gray').queue().length>0){return}
				//do animation
			 	$j(this).removeClass('over');
				console.log('out');
				$j('.gray').fadeOut(500, function() {
					$j('.gray:hidden').hide();
				});
				$j('#circ').fadeOut(500);
			}
		);
	});
	//end of get function

}



})(jQuery);
		
		// End of OnDocumentReady