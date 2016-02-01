window.onload = init;

var commentarea = document.getElementById("comment_area");
var viewcomments = document.getElementById("viewcomments");
var commentform  = document.getElementById("commentform");

	
function init(){
	  
	  var addcommentlink = document.getElementById("addcommentlink");
	  var viewcommentslink = document.getElementById("viewcommentslink");
	viewcommentslink.onclick=function(){
	 	showComments();
	 	return false;
	 };
	 addcommentlink.onclick=function(){
	 	showCommentForm();
	 	return false;
	 };
	 viewcommentslink.onfocus=function(){
	 	showCommentForm();
	 };
	 addcommentlink.onfocus=function(){
	 showComments();
	 };
	 commentform.onsubmit =function(){
	 showCommentForm();
	 commemtform.submit();
	 return false;
	 };
	 hideComments();
}
function hideComments(){
 viewcomments.style.display="none";
 commentform.style.display="none";
}
function showComments(){
 commentform.style.display="none";
 viewcomments.style.display="block";
 }
function showCommentForm(){
 viewcomments.style.display="none";
 commentform.style.display="block";
}