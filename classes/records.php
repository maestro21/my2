<?php

class records extends masterclass{

	function extend(){
		$this->search = false;
		$this->all = false;
		global $_PATH;
		$this->orderby = " ORDER BY `date` DESC";
		$this->perpage = 20;
		$id = (int)@$_PATH[5]; //echo $this->do;
		/*if($this->search=='')
			$this->sql['items'] .=" WHERE blog_id=$id";
		else
			$this->orderby = " AND blog_id=$id" . $this->orderby;*/
		
		//$this->sql['count'] .=" WHERE blog_id=$id";
		
		if(isset($_PATH[6])){			
			$this->className = $_PATH[6];
			if($this->className=='all') $this->all = true;
			$this->params['title'] = DBcell("SELECT name from blogs WHERE id=$id"); 
		}	
		
		$tagSQL = "SELECT tag, COUNT( t.tag ) AS total
						FROM tags t
						JOIN records r ON t.post_id = r.id
						WHERE r.blog_id =$id
						GROUP BY t.tag
						ORDER By total DESC";
		$this->params['tagcloud'] = DBall($tagSQL);
		$this->tpl = 'records';
	}
	
	function tag(){
		return $this->items(2);
	}
	
	function search(){
		return $this->items(3);
	}
	
	function all(){
		return $this->items(4);
	}
	
	function items($mode = 1){  // 1 - nothing, 2= tag, search = 3
		$all = $this->all;		//echo $mode;
		$id = (int)@$this->path[5];
		$this->params['mode'] = $mode;
		$tagSQL = "SELECT tag, COUNT( t.tag ) AS total
				FROM tags t
				JOIN records r ON t.post_id = r.id ".
				 ($this->all? " WHERE blog_id='$id'":"") . "
				GROUP BY t.tag
				ORDER By total DESC";
		$this->params['tagcloud'] = DBall($tagSQL);
		//inspect($this->params['tagcloud']);
		 $tag = @$this->path[3];
		$this->sql['count'] = "SELECT count(r.id) FROM records r";
		$this->sql['items'] = "SELECT r.*, GROUP_CONCAT(t.tag) as tags FROM records r ";
		
		if($mode < 3 && $tag!=''){
			$this->sql['items'] .= "  JOIN tags t ON t.post_id = r.id AND t.tag='$tag'"; 
			$this->sql['count'] .= "  JOIN tags t ON t.post_id = r.id AND t.tag='$tag'";
		}else
			$this->sql['items'] .=  " LEFT JOIN tags t ON r.id=t.post_id";
		
		
		$this->sql['items'] .=" WHERE 1"; $this->sql['count'] .=" WHERE 1";
		
		if(!$this->all){	
			$this->sql['items'] .=" AND blog_id=$id";
			$this->sql['count'] .=" AND blog_id=$id";
		}else{
			$this->do = 'all'; //$this->params['all'] = true;
		}
		
		if($mode==3){ 
			$this->sql['items'] .=" AND ( r.text LIKE '%$tag%' OR r.label LIKE '%$tag%') ";
			$this->sql['count'] .=" AND ( r.text LIKE '%$tag%' OR r.label LIKE '%$tag%') ";
		}
		
		$this->sql['items'] .=" GROUP BY r.id";	


		
		$this->pages = ceil(DBfield($this->sql['count'].$cc) / $this->perpage);
		
		$c = split("_",getVar('sort_'.$this->className)); 
		if(isset($this->fields[$c[0]]) && ($c[1]=='ASC' || $c[1] == 'DESC')) $cc .=" ORDER BY `{$c[0]}` ".$c[1];
		if($this->page>0) $this->page--; 
		$cc .=$this->orderby." LIMIT ".$this->page*$this->perpage.",".$this->perpage; 
		//echo $this->sql['items'];
		$this->params['search']  = $this->search = $tag;
		return DBall($this->sql['items'].$cc);
		
	
		/*$id = (int)@$this->path[5];
		
		$this->sql['items'] = "SELECT r.*, GROUP_CONCAT(t.tag) as tags FROM records r ";
		
		if($tag){
			$this->sql['items'] .= "  JOIN tags t ON t.post_id = r.id AND t.tag='{$this->id}'";  
			$this->search = '';
			}
		else
			$this->sql['items'] .=  " LEFT JOIN tags t ON r.id=t.post_id";
		
		if($this->search=='')
			$this->sql['items'] .=" WHERE blog_id=$id";
		else
			$this->orderby = " AND blog_id=$id" . $this->orderby;
		
		$this->sql['items'] .=" GROUP BY r.id";	
		//echo 	$this->sql['items'];
		
		$this->sql['count'] .=" WHERE blog_id=$id";
		
		return parent :: items();*/
	}
	
	function view(){		
		return $this->item();	
	}
	
	function item(){		
		$data = parent :: item();
		$data['tags'] = DBcell( "SELECT GROUP_CONCAT(tag) FROM tags WHERE post_id='{$this->id}'" );	
		return $data;		
	}
	
	function save(){
		$tags = $this->post['form']['tags']; //die(inspect($tags));
		unset($this->post['form']['tags']);
		//inspect($this->post); die();
		parent :: save();
		
		$taglist = split(',',$tags);
		$sql = "DELETE FROM tags WHERE post_id='{$this->id}'";
		DBquery($sql);// echo $sql;
		if($taglist[0] != ''){
			foreach ($taglist as $tag){
				$tag = trim($tag);	
				$sql = "INSERT INTO	tags SET post_id='{$this->id}', tag='$tag'";
				DBquery($sql); //echo $sql;
			}
		}
	}
	
	function getOptions(){  
		 global $blogs;
		 if(isset($blogs)){
			 $this->options['blog_id'] = array( 0 => T('records') ); 
			 foreach ($blogs as $blog){
					$this->options['blog_id'][$blog['id']] = $blog['name']; 
				}
		}
    }
	

}

?>