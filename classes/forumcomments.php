<?php class forumcomments extends masterclass{
	
	public $forumstree;
	
	function extend() {
		$forums = DBall("SELECT * FROM forums ORDER BY pid ASC, order_id ASC");
		$this->forumstree = new tree($forums);
		$this->options['fid'] = $this->forumstree->options;
	}	
		
	function save(){
		$this->post['form']['time'] = ''; 
		$time = date("Y-m-d H:i:s");  
		//inspect($this->post); die();
		
		if($this->id == 0 ) {
			
			$path = array_reverse($this->forumstree->getPathToRoot($this->post['fid']));
			unset($path[0]); $forums = join(',',$path); 
			$user = getUser();
			$sql = "UPDATE forums SET msgs=msgs+1, lastcomment='$time', lastauthor=$user WHERE id IN($forums)";
			//echo $sql;// die();
			DBquery($sql);
			
			$sql = "UPDATE forumthreads SET comments=comments+1, lastcomment='$time', lastauthor=$user WHERE id=".(int)$this->post['form']['tid'];
			DBquery($sql); //echo $sql;
		
		}
		parent :: save();
		
		$this->do = 'msg';
		return array('redirect' => BASE_PATH.'forumthreads/view/'.$this->post['form']['tid']);
		//redirect(BASE_PATH.'forumthreads/view/'.$this->post['form']['tid']);
	}
	
	
	function del() {
		$id = (int)$this->id;
		$tid = DBcell("SELECT tid FROM forumcomments WHERE id=$id");
		$fid = DBcell("SELECT fid FROM forumthreads WHERE id=$tid");
		
		/*
		//Getting new time in thread
		$sql = "SELECT `time`, uid FROM forumcomments WHERE tid=tid ORDER BY id DESC";
		$time = DBrow($sql);
		if($time['time'] == '')
			$sql = "UPDATE forumthreads SET lastcomment=created, lastauthor=author WHERE id=$tid";
		else
			$sql = "UPDATE forumthreads SET lastcomment='".$time['time']."', lastauthor=".$time['uid']." WHERE id=$tid";
		
		//decreasing comment amount thread*/
		
		$sql = "UPDATE forumthreads SET comments=comments-1 WHERE id=$tid";
		DBquery($sql);
		
		//updating time
		$path = array_reverse($this->forumstree->getPathToRoot($fid));
		unset($path[0]); $forums = join(',',$path);
		//$sql = "SELECT fid, id, lastcomment, author FROM forumthreads WHERE fid IN ($forum) AND lastcomment<'".$time['time']." GROUP BY fid ORDER BY fid ASC HAVING MAX(lastcomment)";
	//	$sql = "UPDATE forums SET lastcomment='".$time['time']."', lastauthor=".$time['uid']."*/
		
		
		$sql = "UPDATE forums SET msgs=msgs-1 WHERE id IN($forums)";
		DBquery($sql);
		
		parent :: del();
		
		goBack();
	}

} ?>