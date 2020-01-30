/**
 * image-wrap.js
 * 
 * Wraps images on the homepage that should be clickable
 * in links that actually makes them clickable.
 */

 // Our Expertise section ========================
 
var expertise = document.querySelectorAll( '#section-agency .interactive-column' );
var expertise_button_links = document.querySelectorAll( '#section-agency .x-anchor' );
var expertise_image_links = [];

getLinks( expertise_button_links, expertise_image_links );
wrapLinks ( expertise, expertise_image_links );

// Case Studies section ========================

var caseStudies = document.querySelectorAll( '#case-studies .esg-media-cover-wrapper' );
var caseStudiesButtonLinks = document.querySelectorAll( '#case-studies .eg-henryharrison-element-2' );
var caseStudiesImageLinks = [];

getLinks( caseStudiesButtonLinks, caseStudiesImageLinks );
wrapLinks ( caseStudies, caseStudiesImageLinks );

// Helper functions ========================

/* Function to retrieve the hrefs from the buttons over the images. */
function getLinks( buttonArray, imageArray ) {
	for( var i = 0; i < buttonArray.length; i++ ) {
		imageArray.push( buttonArray[i].href );
	}
}

/* Function to wrap the images in anchor tags with the previously collected hrefs. */
function wrapLinks( items, imageArray ) {
	for( var i = 0; i < items.length; i++ ) {

		// element that will be wrapped
		var el = items[i];
	
		// create wrapper container
		var link = document.createElement('a');
		link.href = imageArray[i];
		link.style.width = "100%";
		link.style.height = "100%";
	
		// insert wrapper before el in the DOM tree
		el.parentNode.insertBefore(link, el);
	
		// move el into wrapper
		link.appendChild(el);
	}
}
