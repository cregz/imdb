function onMovieSearchClick(){
	let param = $("#search-param").val();
	if(param){
	    window.location='/movies/list?search='+param;
	}
}