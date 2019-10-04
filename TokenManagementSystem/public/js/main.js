function removeNotification(){
	document.getElementById('dot').style.display = 'none';
	this.unReadNotifCount = 0;
}

function showUnreadNotifCount(unReadNotifCount){
	if (unReadNotifCount == 0) {
		document.getElementById('dot').style.display = 'none';		
	}
	else{console.log(unReadNotifCount);
		document.getElementById('dot').style.display = 'all';	
		document.getElementById('dot').innerHTML = unReadNotifCount;
	}
}