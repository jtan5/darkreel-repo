
function formatParams(params) {
	return "?" + Object.keys(params).map(function(key){
		return key+"="+params[key];
    }).join("&");
}

function updateQueryStringParameter(uri, key, value) {
	let re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
	let separator = uri.indexOf('?') !== -1 ? "&" : "?";
  
	if (uri.match(re)) {
    	return uri.replace(re, '$1' + key + "=" + value + '$2');
  	}
  	else {
    	return uri + separator + key + "=" + value;
  	}
}

function guidGenerator() {
    let S4 = () => {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
	
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}

// AIM = AJAX <iframe> Method
// Adapted from http://www.webtoolkit.info/ajax_file_upload.html

const AIM = {
    formCollection : null,

    frame : (c, f) => {
        let n = 'ajax_uploads_iframe_' + Math.floor(Math.random() * 99999);
        let d = document.createElement('DIV');
        d.innerHTML = '<iframe style="display:none" src="about:blank" id="'+n+'" name="'+n+'" onload="AIM.loaded(\''+n+'\')"></iframe>';
        document.body.appendChild(d);

        let i = document.getElementById(n);
        
        if (c && typeof(c.onComplete) == 'function') {
            i.onComplete = c.onComplete;
        }

        return n;
    },

    form : (f, name) => {
        f.setAttribute('target', name);
    },

    submit : (f, c) => {
        this.formCollection = f;

        AIM.form(f, AIM.frame(c, f));

        if (c && typeof(c.onStart) == 'function') {
            return c.onStart(f);
        } else {
            return true;
        }
    },

    loaded : (id) => {
        let i = document.getElementById(id);
        let d = null;

        if (i.contentDocument) {
            d = i.contentDocument;
        } else if (i.contentWindow) {
            d = i.contentWindow.document;
        } else {
            d = window.frames[id].document;
        }

        if (d.location.href == "about:blank") {
            return;
        }

        if (typeof(i.onComplete) == 'function') {
            i.onComplete(d.body.innerHTML, this.formCollection);
        }
    }
}


// These are the functions for validation and retrieving the server response
// The validate and response functions get added to a site multiple times
// You need this pair once per form using AIM (change "default" to something specific)

function defaultStartValidate(formElement) {
    // formElement is the <form> object and all of its attributes and elements
}

function defaultCompleteResponse(serverResponse, formElement) {
    // serverResponse is whatever the server returned (typically JSON or HTML)
    // formElement is the <form> object and all of its attributes and elements
}

function postStart() {
	let matches = 0;
	
	let required = document.querySelectorAll('.required');
	
	for (let i = 0; i < required.length; i++) {
		if (required[i].value.trim() == '' || required[i].value.trim() == required[i].defaultValue) {
			matches++;
		}	
	}
	
	if (matches == 2) {
		return false;
	}
	
    let postBlackout = document.querySelector('#post_blackout');
    postBlackout.style.display = 'flex';
}

function postComplete(response) {
    //let return_data = JSON.parse(response);
    
    let newsFeed = document.querySelector('#news_feed');
    
    let newItem = document.createElement("div");
    newItem.innerHTML = response;
    
    newsFeed.insertBefore(newItem, newsFeed.childNodes[0]);
    
    let postNew = document.querySelector('#post_new');
    postNew.reset();
    
    let postBlackout = document.querySelector('#post_blackout');
    postBlackout.style.display = 'none';
}

function toggleTab(thisEle, searchPane) {
    // Get all the search result links and reset the class names
    let theSearchPanes = document.querySelectorAll('.search_result_link');
    
    for (let i = 0; i < theSearchPanes.length; i++) {
        theSearchPanes[i].className = 'search_result_link';
    }
    
    
    // Set this link as active
    thisEle.className = 'search_result_link active';
    
    
    // Find all search_feed panes and hide them
    let searchFeed = document.querySelectorAll('.search_feed');
    
    for (let i = 0; i < searchFeed.length; i++) {
        searchFeed[i].style.display = 'none';
    }
    
    
    // Find all search panes matching the provided class and display them
    let theSearchPane = document.querySelectorAll('.'+searchPane);
    
    for (let i = 0; i < theSearchPane.length; i++) {
        theSearchPane[i].style.display = 'block';
    }
}

function toggleFollowing(thisEle, profileId) {
    let isFollowing = thisEle.getAttribute('data-isfollowing');
    
    let nextAction = 1;
    let nextClass = 'follow_button following_user';
    let nextText = 'Following';
    
    if (isFollowing > 0) { //ALREADY FOLLOWING
        nextAction = 0;
        nextClass = 'follow_button follow_user';
        nextText = 'Follow';
    }
    
    thisEle.setAttribute('data-isfollowing', nextAction);
    thisEle.className = nextClass;
    thisEle.innerHTML = nextText;
    
    let followersC = document.querySelector('#followers_c');
    
    if (followersC) {
        let nextNum = parseInt(followersC.innerHTML) + 1;
        if (isFollowing > 0) { 
            nextNum = parseInt(followersC.innerHTML) - 1;
        }
        
        followersC.innerHTML = nextNum;
    }
    
	
    let req = new XMLHttpRequest();

	/*
    We don't actually do anything with the server response,
	we're only updating the button immediately (see above)

	Leaving this here in case things change in the future

    req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
        	//let response = req.responseText;
            //let response = JSON.parse(req.responseText);
        }
    }							
	*/
	
    let strUrl = 'process/follow-toggle.php';
    req.open("POST", strUrl, true);

    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    let postData = 'id='+profileId+'&next='+nextAction;
    req.send(postData); 
}

function deletePost(postId) {
    let r = confirm("Are you sure you'd like to delete this post?");
    
    if (r) {
        let thePosts = document.querySelectorAll('.post_'+postId);

        for (let x of thePosts) {
            x.style.display = 'none';
        }

        let req = new XMLHttpRequest();

        /*
		We don't actually do anything except hide the post
		the minute the "OK" button is clicked, so we don't
		need the server response. Leaving this here in case
		things change in the future
		
		req.onreadystatechange = function() {
			if (req.readyState == 4 && req.status == 200) {
				//let response = req.responseText;
                //let response = JSON.parse(req.responseText);
			}
		}	
		*/							

        let strUrl = 'process/post-delete.php';
        req.open("POST", strUrl, true);

        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        let postData = 'id='+postId;
        req.send(postData); 
    }
}
