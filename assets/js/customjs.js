// Scroll and fixed main-navbar
var width = window.width
var mainNavbarId = 'main-navbar';
var mainNavbarStickyClass = 'main-navbar-fixed';
var mainNavbar = document.getElementById(mainNavbarId)
var mainNavbarSticky = mainNavbar.offsetTop;
var dataRef = mainNavbar.getAttribute('data-ref');
// if default header (header has banner in top) will be render fixed header 
// if(dataRef == 'default'){
    window.addEventListener('scroll', function(e){onScrollHandle()});
    window.onload = function(){onsLoadHandle()};
// }

function onsLoadHandle() {
    window.scrollTo(window.pageYOffset - 1, 0);
}

function onScrollHandle() {
    if(window.innerWidth >= 992 && (window.pageYOffset > mainNavbarSticky)){
        mainNavbar.classList.add(mainNavbarStickyClass);
    } else {
        mainNavbar.classList.remove(mainNavbarStickyClass);
    }
}
// End Scroll and fixed main-navbar


$(document).ready(function() {
    if ( width > 992 ) {
        $("#second-sidebar").stick_in_parent();
        $("#sidebar").stick_in_parent();
    }
});


// ajax process function

function db_ajax_process_items(mydata, lprocess, lresult)
{
	 $.ajax({
		type: "POST",
		url:  mytheme_urls.ajaxurl,
		dataType: "json",
		data: mydata,
		beforeSend: function() {
           $("#" + lprocess).html("Processing...");
        },
		success: function(msg) {
			console.log("=====111", msg);
        },
        error: function() {
			console.log("error");
		}
	});
}

(function ($) {
    "use strict";

    $("#js-btn-contact-form-act").on('click', function(){
        // var formParams = $('#contact-form-act').serializeArray();
        // formParams.forEach((element, i) => {
        //     formParams[i].isValid = false
        // });

        var mname 	= jQuery('#inputFullName').val();
        var memail 	= jQuery('#inputEmail').val();
        var mphone 	= jQuery('#inputPhone').val();
        var mcontent = jQuery('#inputContent').val();
        var mcode = jQuery('#security_code').val();
        
        var myData = {
            "action": "btn-contact-form-send-ajax",
            "inputFullName": mname ,
            "inputEmail": memail,
            "inputPhone": mphone,
            "inputContent": mcontent,
            "security_code": mcode
        };
        db_ajax_process_items(myData, "lprocess", "lprocess");
    })

})(jQuery);