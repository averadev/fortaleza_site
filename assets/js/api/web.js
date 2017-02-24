$(function() {
	
    // Menus
    $(".goTo").click(function() { window.location = $(this).attr("ref"); });
    // Book Me In
    $(".bookmein").click(function() { showAppConteiner(); });
    // Lenguaje
    $(".langBtn").click(function() { 
        if (!$(this).hasClass("langSel")){
            var preLocat = "home/setLang";
            if (window.location.href.lastIndexOf("suite/") > -1 || window.location.href.lastIndexOf("room/") > -1){
                preLocat = '../'+preLocat;
            }
            $.ajax({
                type: "POST",
                url: preLocat,
                dataType:'json',
                data: { 
                    type: ($(this).html()=="ENGLISH")?"eng":"esp"
                },
                success: function(data){
                    location.reload();
                }
            });
        }
    });
    
});