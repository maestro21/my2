var pre='<?=$pre;?>';

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

function showhide(id){
	hideUnhide(id);
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

function linksite(lid,sid){
	ajax_request(pre+'links/linksite/'+lid+'/'+sid,'');
}
function linktags(lid,sid){
	ajax_request(pre+'links/linktag/'+lid+'/'+sid,'');
}


function openDialog(_title, _content, _modal){
        var NewDialog = jQuery('<div id="MenuDialog">'+ _content + '</div>');
        NewDialog.dialog({
            modal: _modal,
            title: _title,
            show: 'clip',
            hide: 'clip',
			width: 'auto',
                    });
        return false;
}

function openIframe(url){
	openDialog(url,'<iframe src="'+url+'" width="100%" height="100%"></iframe>');
}

function loadContent(url){
	ajax_request(url,'ajax=true',_loadContent);
}

function _loadContent(resp){
	var content = resp.responseText;
	var mask=/<title>(.*)<\/title>/;
	var title = content.match(mask); 
	if(title != null){
		content = content.replace(mask,"");
		title = title[1];
	}else{
		title = '';
	}
	
	var mask2=/<modal>/;
	var modal = content.match(mask); 
	if(modal != null){
		openDialog(title,content,true);
	}else{
		openDialog(title,content,false);
	}	
}


function saveForm(id,path,reloadpage) {
	var did = id+'_savemsg';
	jQuery('#'+did).show(500);
	setTimeout("jQuery('#"+did+"').hide()",3000);
	

	reloadpage = typeof reloadpage !== 'undefined' ? reloadpage : false;
	
	
	if(reloadpage)
		ajax_request($(id).action,$(id).serialize()+'&ajax=true',reloadPage);
	else
		ajax_request($(id).action,$(id).serialize()+'&ajax=true');//,reloadPage);
}

function reloadPage() {  ajax_request(document.URL,'ajax=true',_reloadPage); }
function _reloadPage(resp) { $('content').innerHTML=resp.responseText; }


function getNic(){
	var nicE = new nicEditors.findEditor('text');
	$('text').value=nicE.getContent();
}
