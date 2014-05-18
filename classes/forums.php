<?php class forums extends masterclass{
	
	public $forumstree;
	
	function extend() {
		$this->defmethod = 'view';
		
		//fetching forum tree
		$forums = DBall("SELECT f.*, u.name as lastauthorname FROM forums f LEFT JOIN users u ON u.id=f.lastauthor ORDER BY pid ASC, order_id ASC");
		$this->forumstree = new tree($forums);
		$this->options['pid'] = $this->forumstree->options;
		//inspect($this->forumstree->treeList);
	}
	
	function items() {
		$ret = array();
		return $this->forumstree->treeList;
	}
	
	function view() {
		$this->session['lastforumpage'] = BASE_PATH . join('/',$this->path);
		//echo $this->session['lastforumpage'];
		$id = (int) $this->id;
		$ret = array();
		$threadsallow = false;

		//fetching forum info
		if($id > 0){
			//$ret = $this->forumstree->treeTMPList[$id]; 
			$path = array_reverse($this->forumstree->getPathToRoot($id));
			$ret['threadsallow'] = true;
			$this->title = T('forums') . "</a>"; 
			unset($path[0]); //inspect($path); 
			foreach ($path as $forum) {
				$this->title .= " &rarr; <a href='".BASE_PATH."forums/view/$forum'>".$this->forumstree->treeTMPList[$forum]['name']."</a>";	
			}	
		}
		
		//fetching subforums 
		$ret['forums'] = $this->forumstree->branch($id);
		
		//fetching threads
		if($threadsallow) {
			/*$threads = loadClass('forumthreads');
			$threads->fid = 0;
			$ret['threads'] = $forumthreads->items;*/
			$ret['threadsallow'] = true;
		}
		return $ret;
	}
	
	/* 
	function item(){
		$res = parent :: items();
		inspect($this->fields);
		return $res;
	}*/

} ?>