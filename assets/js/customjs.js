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
            console.log("=====", msg);
            $("#contact-form-act")[0].reset();
        },
        error: function() {
			console.log("error");
		}
	});
}

(function ($) {
    "use strict";

    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('keyup', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.remove('is-validated');
                    form.classList.add('is-invalidated');
                } else {
                    form.classList.remove('is-invalidated');
                    form.classList.add('is-validated');
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    $("#js-btn-contact-form-act").on('click', function(){
        if($("#contact-form-act").hasClass('is-validated')){
            var mname 	= jQuery('#inputFullName').val();
            var memail 	= jQuery('#inputEmail').val();
            var mphone 	= jQuery('#inputPhone').val();
            var mcontent = jQuery('#inputContent').val();
            var mnganhnghe = jQuery('#inputNganhnghe').val();
            var mservice = jQuery('#selectService').val();
            var mcode = jQuery('#security_code').val();
            
            var myData = {
                "action": "btn-contact-form-send-ajax",
                "inputFullName": mname ,
                "inputEmail": memail,
                "inputPhone": mphone,
                "inputContent": mcontent,
                "inputNganhnghe": mnganhnghe,
                "selectService": mservice,
                "security_code": mcode
            };
            db_ajax_process_items(myData, "lprocess", "lprocess");
        }
    })

})(jQuery);