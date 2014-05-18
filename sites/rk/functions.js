function empt(item,val){
	//alert('1111');
	if(item.value==val) item.value='';
}	

function chk(item,val){
	if(item.value=='') item.value=val;
}
function doSearch(pre){
	location.href=pre+'/search/1/'+$('search').value;
}

function hideUnhide(id){
	if($(id).style.display=='block')
		$(id).style.display='none';
	else
		$(id).style.display='block';
}

function conf(url){
	if(confirm("Are you sure you want it ?")){
		location.href=url;
	}
}

function copyFile(url,del){
	$('from').value = url;
	$('to').value = prompt('Copy or move to',url);
	$('del').value = del;
	$('copyForm').submit();
}


function showHide(id){
	if($(id).style.display=='block')
		$(id).style.display='none';
	else
		$(id).style.display='block';
}
