$( document ).ready(function() {
	
	// fixed header
	var myHeader = $('.sub-header');
	var cont = $('main .container');
	myHeader.data( 'position', myHeader.position() );
	$(window).scroll(function(){
		var hPos = myHeader.data('position'), scroll = getScroll();
		if ( hPos.top < scroll.top ){
			myHeader.addClass('fixed');
			cont.addClass('headerSize');
		}
		else {
			myHeader.removeClass('fixed');
			cont.removeClass('headerSize');
		}
	});

	function getScroll () {
		var b = document.body;
		var e = document.documentElement;
		return {
			left: parseFloat( window.pageXOffset || b.scrollLeft || e.scrollLeft ),
			top: parseFloat( window.pageYOffset || b.scrollTop || e.scrollTop )
		};
	}


	$(function(){
		
		
		// find all category links
		$('#filter a').each(function(){
			
			$(this).click(function(){
				
				var cl_group = $(this).attr("data-group");
				
				
				$('#grid .item-box').each(function(){
					
					
					// category for one item
					var i_category = $(this).attr("data-group");
					
					if(i_category != cl_group){
						$(this).hide();
					}if(cl_group == 'all'){
						$(this).show();
					}else if(i_category == cl_group){
						$(this).show();
					}
				});
			});
		});
		
		
		
		
		
		
	});



	
});