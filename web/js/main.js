function onMovieSearchClick(){
	let param = $("#search-param").val();
	if(param){
	    window.location='/movies/list?search='+param;
	}
}

function onMessageClick(messageId, recipientId, folder){
	window.location='/message/read/'+messageId+'?folder='+folder;
}