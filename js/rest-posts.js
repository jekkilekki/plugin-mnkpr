/**
 * File to load Post Content from REST API call in a container on its own page.
 */

var CaseStudyContainer = document.getElementById( 'case-study-container' );
var LinksArray = document.querySelectorAll( '.esg-media-cover-wrapper-a' );
// console.log( LinksArray );

for ( var i = 0; i < LinksArray.length; i++ ) {
	LinksArray[i].addEventListener( 'click', getRESTdata );
}

function getRESTdata( e ) {

	e.preventDefault();
	console.log( e.path[3].href );

	var CaseStudySlugArray = e.path[3].href.split('/');
	var CaseStudySlug = CaseStudySlugArray[ CaseStudySlugArray.length - 1] === '' ? CaseStudySlugArray[ CaseStudySlugArray.length - 2 ] : CaseStudySlugArray[ CaseStudySlugArray.length - 1 ];

	var ourRequest = new XMLHttpRequest();

	ourRequest.open('GET', 'http://mnkpr.local/wp-json/wp/v2/posts?slug=' + CaseStudySlug );
	ourRequest.onload = function() {
		if(ourRequest.status >= 200 && ourRequest.status < 400) {
			var data = JSON.parse(ourRequest.responseText);
			console.log(data);
			createHTML(data);
		} else {
			console.log('We connected to the server, but it returned an error.');
		}
	};

	ourRequest.onerror = function() {
		console.log('Connection error');
	}

	ourRequest.send();
}

function createHTML( postData ) {
	var ourHTMLString = '';
	console.log(postData[0].title.rendered);

	ourHTMLString += '<button class="case-study-close-button">X</button>';
	ourHTMLString += '<h2>' + postData[0].title.rendered + '</h2>';
	ourHTMLString += postData[0].content.rendered;
	ourHTMLString += '<a class="button case-study-read-more" href="' + postData[0].link + '">Read more</a>';

	CaseStudyContainer.innerHTML = ourHTMLString;

	var closeButton = document.querySelector( '.case-study-close-button' );
	closeButton.addEventListener( 'click', function() {
		CaseStudyContainer.innerHTML = '';
	});
}

/**
 * Deprecated work (testing)
 */
// var PostsBtn = document.querySelector( '.get-post a' );
// var PostsContainer = document.getElementById("posts-container");

// if( PostsBtn ) {
// 	var PostSlugArray = PostsBtn.href.split('/');
// 	var PostSlug = PostSlugArray[ PostSlugArray.length - 1] === '' ? PostSlugArray[ PostSlugArray.length - 2 ] : PostSlugArray[ PostSlugArray.length - 1 ];
// 	PostsBtn.addEventListener('click', getRESTdata );
// }