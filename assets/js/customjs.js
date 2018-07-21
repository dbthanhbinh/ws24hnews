$(document).ready(function() {
    var width = $(window).width(); 
    if ( width > 992 ) {
        $("#second-sidebar").stick_in_parent();
        $("#sidebar").stick_in_parent();
    }
});