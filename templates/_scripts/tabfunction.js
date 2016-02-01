//
if(window.addEventListener){
   window.addEventListener("load",initTabs,true);
	}else if(window.attachEvent){ window.attachEvent("onload",initTabs);
}else{ window.onload = initTabs;}

	var tabLinks = new Array();
	var divTabContent = new Array();

function initTabs(){
// grabs all li an 	
var tabListItems = document.getElementById("tabs").childNodes;
    for(var i=0; i<tabListItems.length; i++){
		 if(tabListItems[i].nodeName == "LI"){
			 var getTabLink = getFirstChildElem(tabListItems[i],"A");
			  var itemId = gethashPos( getTabLink.getAttribute('href') ); 
			 tabLinks[itemId] = getTabLink; 
			 divTabContent[itemId] = document.getElementById( itemId );
			}
		}	
     var i = 0;
	 // add mouse events to tab links and selected first
   for( var itemId in tabLinks){
	   tabLinks[itemId].onclick = showTab;
	   tabLinks[itemId].onfocus = function(e){this.blur};
	   if(i == 0 ) tabLinks[itemId].className = 'selected'; 
	   i++;
	   }
  // Hide all div content tabs
 var i = 0;
   for( var itemId in divTabContent ){
	  if( i != 0 ) divTabContent[itemId].className = 'tab_content hide';
	  i++;   
   }
}

function showTab(){
	//Highlight the selected tab and hide all others,Also show seleted div and dim all others
	var selectedTab = gethashPos(this.getAttribute('href'));
	  for( var itemId in divTabContent ){
		  if( itemId == selectedTab ){
			  tabLinks[itemId].className = 'selected';
			  divTabContent[itemId].className = 'tab_content';
			  }else{
			  tabLinks[itemId].className = ' ';
			  divTabContent[itemId].className = 'tab_content hide';
			   }	  
		  }
		 // Stop browser from following link 
	return false;
	}
	
	// get first child element
function getFirstChildElem(element,tagName){
	for(var i =0; element.childNodes.length;i++){
		  if(element.childNodes[i].nodeName == tagName){
			  return element.childNodes[i];
			  }
		  }
	  }


function gethashPos(url){
	 var hashPos = url.lastIndexOf("#");
	 return url.substring(hashPos + 1);
	
	}











