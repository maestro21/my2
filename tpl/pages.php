<?php class pages extends masterclass{	public $pagetree;	public $path_to = array();	function extend(){ 		$langs = getVar('langs');		$this->defmethod = 'view'; 		if($this->do == '' || !method_exists($this,$this->do)){  $this->do = 'view'; }		foreach ($langs as $lang){			$this->options['lang'][$lang['abbr']] = $lang['name'];		}		$this->tpl = $this->className = 'pages';		$this->sql = $this->sqlSettings();		if($this->do == 'items' && $this->path[2] != '') $lang = $this->path[2]; else $lang = getVar('lang');		$pages = DBall("SELECT title as name, id, url, pid FROM pages WHERE lang='$lang' ORDER BY pid ASC, order_id ASC");		//inspect($pages);		$this->pagetree = new tree($pages);		$this->options['pid'] = $this->pagetree->options;		//inspect($this->pagetree);	}			function get_page_id_by_path($path, $tree) {		//inspect($path); 		$tmppath = array_shift($path);  		foreach ($tree as $leaf){			//inspect($leaf['url'] . ' ' . $tmppath);			if($leaf['url'] == $tmppath) { 				if(sizeof($path) == 0) {					$ret = $leaf['id'];				} else {					$this->path_to[$tmppath] = $leaf['title'];					$ret = $this->get_page_by_path($path, $leaf['children']);				}				}		}		return $ret;	}		function view(){ 		$path = $this->path;		if($path[0] == 'pages') { unset($path[0]); }		$this->id = $this->get_page_id_by_path($path, $this->pagetree->treeList); // inspect($ret);		$ret = DBrow(sprintf("SELECT * FROM pages WHERe id=%d", $this->id));		$this->title = $ret['title'];		$this->setButtons();		$ret['pathto'] = $this->path_to;		$ret['tree']   = $this->pagetree->treeList;				return $ret;		/*$sql = "SELECT * FROM pages WHERE lang = '".getVar('lang')."'"; 		if($this->id > 0) {			$sql .= "AND id=".$this->id;		}else{			$path = $this->path; if($path[0] == 'pages') { unset($path[0]); }			$sql .= "AND url='".join('/',$path)."'";		}		$data = DBrow($sql); //inspect($data);				$this->title = $data['title'];		$this->buttons['view'] = array( 'item/'.$data['id'] => 'edit' );		*/		return $data;	}			function items(){		return $this->pagetree->treeList;		/*unset($this->fields['text']);		$res = parent :: items();		foreach ($res as $k => $v) unset($res[$k]['text']);				return $res;*/	}		function tags() { 		include('metatags.php'); /*inspect($_METATAGS);*/		$this->title = T('tags');		return $_METATAGS;	}} ?>