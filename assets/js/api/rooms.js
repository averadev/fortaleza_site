$(function() {
	
    $(".photo").fancybox({
    	openEffect	: 'elastic',
    	closeEffect	: 'elastic',
    	helpers : {
    		title : {
    			type : 'inside'
    		}
    	}
    });
    
    $(".galeria").fancybox({
        autoPlay		: true,
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: false,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});
    
    $("#galeria").click(function() {
      $($( ".galeria" )[3]).click();
    });
    
});