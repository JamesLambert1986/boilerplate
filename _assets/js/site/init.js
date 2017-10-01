
/* Vars */
if (typeof arrVars == "undefined") {
	var arrVars = {};
}

//console.log(arrVars);

var previous_position = 0;
var direction = "";

/* 1. FUNCTION: On Page Load */
function onPageLoad(arrVars)
{
    /* SVG polyfill */
    svg4everybody();
    
	// Make sure all images are wrapped in a figure
	$('img').each(function(){
		$this = $(this);
		src = $this.attr('data-src');
		
		$this.removeAttr('height').removeAttr('width');
		
		if($this.parent().is('p')){
			$this.unwrap();	
		}
		
//		if(!$this.parent().is('figure')){
//			$this.wrap('<figure />');
//		}
	});
	
	// Once figure is in view, check if it needs lazy loading, also add in the additional div for CSS display options
	$('figure').on("inview", function() {
		
		$this = $(this);
		
		if(!$this.hasClass('inview')){

			$img = $(this).find('img');
			src = $img.attr('data-src');

			if(src==undefined)
				src = $img.attr('src');


			$img.attr('src',src).removeAttr("data-src");
			$this.append('<div class="inner" style="background-image:url('+src+');"></div>');
			
			$this.addClass('inview');
		}
		
	});
	
	
	$('table').each(function(){
		$this = $(this);
		
		if(!$this.parent().hasClass("table__wrapper")){
			
			$this.wrap('<div class="table__wrapper" />');
		}
	});
	
	
}


/* 2. FUNCTION: Check page width */
function checkWidth(arrVars)
{
	var width = window.innerWidth;
	
	if(width >= arrVars.bp_sml) { }
	if(width >= arrVars.bp_med) { }
    if(width >= arrVars.bp_lrg) { }
}


/* 3. FUNCTION: Check scroll position */
function checkScroll(arrVars)
{
	var top = window.pageYOffset; // get current scroll position
    var height = window.innerHeight;

	if(top > previous_position) direction = "down";
	else if(top < previous_position) direction = "up";
	
	previous_position = window.pageYOffset;
	
    if(top > 2) {
	
		$('body').addClass('scrolled');
	
	}
    else { 
		$('body').removeClass('scrolled');
	}
	

	
}


/************************************* DOCUMENT READY ******************************************/
$(document).ready(function()
{
    $('html').removeClass('no-js').addClass('js');

	
	
    /* Resize Event */
    $(window).resize(function ()
	{
        checkWidth(arrVars);
    });
	
    $(window).scroll(function()
	{
		//console.log('scroll');
		
        checkScroll(arrVars);
    });

    /* Page on load Event plus check the screen width */
    $(window).load(function()
	{
        onPageLoad(arrVars);
        checkWidth(arrVars);
    });
	
	

});




