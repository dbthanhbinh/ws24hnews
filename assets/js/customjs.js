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