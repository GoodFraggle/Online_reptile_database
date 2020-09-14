document.createElement("article");
document.createElement("footer");
document.createElement("header");
document.createElement("section");
document.createElement("aside");
document.createElement("nav");

jQuery(document).ready(function() {
		
	jQuery(".menu-trigger").click(function() {
		
		jQuery(".nav-menu").slideToggle(400, function() {
			jQuery(this).toggleClass("nav-expanded").css('display', '');
		});
		
	});
	
});