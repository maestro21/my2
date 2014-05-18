<?php class forumthreads extends masterclass{
		
	public $forumstree;
	
	function extend() {
		//fetching forum tree
		$forums = DBall("SELECT * FROM forums ORDER BY pid ASC, order_id ASC");
		$this->forumstree = new tree($forums);
		$this->options['fid'] = $this->forumstree->options;
		
		$this->options['status'] = array ( 
			1 => T('open'),
			2 => T('sticky'),
			3 => T('global'),
			4 => T('closed'),
			0 => T('deleted'),
		);
		$this->search = '';$this->path[4];
		$this->page   = (int)$this->path[3];
		$fid = (int)$this->id;
		$this->sql['items'] = "SELECT ft.*, u.name as lastauthorname, uu.name as authorname 
								FROM forumthreads ft 
								LEFT JOIN users u ON u.id=ft.lastauthor 
								LEFT JOIN users uu ON uu.id=ft.author 
								WHERE fid=$fid 
								ORDER BY lastcomment DESC";
		//echo $this->sql['items'];
	}
	
	function setTitle($id, $fid, $threadname) { 
		if($fid > 0){
			//$ret = $this->forumstree->treeTMPList[$id]; 
			$path = array_reverse($this->forumstree->getPathToRoot($fid));
			$ret['threadsallow'] = true;
			$this->title = "</a><a href='".BASE_PATH."forums'>" . T('forums') . "</a>"; 
			unset($path[0]); //inspect($path); 
			foreach ($path as $forum) {
				$this->title .= " &rarr; <a href='".BASE_PATH."forums/view/$forum'>" . $this->forumstree->treeTMPList[$forum]['name'] . "</a>";	
			}	
			
			if ($id > 0) 
				$this->title .= " &rarr; <a href='".BASE_PATH."forumthreads/view/$id'>$threadname</a>";
			else				
				$this->title .= " &rarr; " . $threadname;
		}
	}
	
	function item() {
		$ret = parent :: item();
		if($this->id > 0 )
			$this->setTitle($this->id, $ret['fid'], $ret['name']);
		return $ret;	
	}
	
	function newtopic() { 
		$this->do = 'item';
		$ret = array( 'fid' => $this->id, 'status' => 1, 'uid' => getUser() ); 
		$this->setTitle(0, $ret['fid'],T('new topic'));
		$this->id = 0;
		return $ret;
	}
	
	function view() {
		$ret = parent:: view();
		//$this->title = $ret['name'];
		if($this->id > 0 )
			$this->setTitle($this->id, $ret['fid'], $ret['name']);
		$ret['comments'] = DBall("SELECT * FROM forumcomments WHERE tid=".(int)$ret['id']);
		$sql = "UPDATE forumthreads SET views=views+1 WHERE id=".(int)$this->id;
		DBquery($sql); //echo $sql;
		return $ret;
	}
	
	function save() {
		if($this->id == 0 ) {
			$this->post['form']['author'] = 1;
			$this->post['form']['lastcomment'] = $this->post['form']['created'];
			$value = $this->post['form']['lastcomment'];
			$author = getUser();
			$date =	date("Y-m-d H:i:s",mktime(intval($value['h']), intval($value['mi']), intval($value['s']),
				intval($value['m']), intval($value['d']), intval($value['y'])));

			$path = array_reverse($this->forumstree->getPathToRoot($this->post['form']['fid']));
			unset($path[0]); $forums = join(',',$path);
			$sql = "UPDATE forums SET themes=themes+1, lastcomment='$date', lastauthor=$author WHERE id IN($forums)";
			DBquery($sql);

		}
		parent :: save();
	}
	
	
	function del() {
		$fid = DBcell("SELECT fid FROM forumthreads WHERE id=".(int)$this->id);
		$path = array_reverse($this->forumstree->getPathToRoot($fid));
		unset($path[0]); $forums = join(',',$path); //inspect($forums);
		$sql = "UPDATE forums SET themes=themes-1 WHERE id IN($forums)";
		DBquery($sql);
			
		parent :: del();
	}

} ?>